<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RFID Card Reader</title>
    <style>
        .output-container {
            margin-top: 20px;
            border: 1px solid #ccc;
            padding: 10px;
            background-color: #f9f9f9;
            white-space: pre-wrap;
            font-family: monospace;
        }
        .btn1 {
            padding: 10px 20px;
            cursor: pointer;
            color: #fff;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
        }

         /* Button styling */
         .btn2 {
            display: none; /* Initially hidden */
            padding: 10px 20px;
            font-size: 20px;
            color: white;
            background-color: #28a745;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width:150px;
            transform-origin: center; /* Center the zoom effect */
            animation: zoomEffect 1s infinite;
        }

        /* Zoom animation */
        @keyframes zoomEffect {
            0% {
                transform: scale(1); /* Normal size */
            }
            50% {
                transform: scale(1.1); /* Slightly bigger */
            }
            100% {
                transform: scale(1); /* Back to normal */
            }
        }
    </style>
      @include('admin.dashboard.common.header_lib')
</head>
<body>
    <div class="container-fluid">
    <center><h1>RFID Card Reader</h1>
    <p>Click the button below to scan the RFID card.</p>
    <button class="btn1" id="scanCard">Scan Card</button></center>

    <div class="output-container" id="output">Waiting for scan...</div>
    <form method="post" action="{{route('read.nfc1')}}">
        @csrf
        <input type="hidden" value="" id="nfc1" name="data"><br>
    <center><button class="btn btn2 btn-success" type="submit" id="view" style="display:none;">View</button></center>
    </form>
</div>
    @include('admin.dashboard.common.footer_lib')
    
    <script>
$('#scanCard').click(function () {
    $('#output').text('Scanning card, please wait...');

    $.ajax({
        url: '{{ route("read.nfc") }}', // Laravel route
        type: 'GET',
        success: function (response) {
            console.log('AJAX Success:', response); // Log response
            
            if (response.success) {
                let rawData = response.data;
                try {
                    let cleanedData = rawData.replace(/(\w+):/g, '"$1":');
                    let parsedData = JSON.parse(cleanedData);
                    $('#output').text(JSON.stringify(parsedData, null, 2));
                } catch (error) {
                    console.error('Parsing Error:', error.message);
                    $('#output').text('Failed to parse card data.');
                }
            } else {
                $('#output').text('Card data not found.');
            }
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error:', xhr.responseText); // Log error
            const result = extractJsonLikeContent(xhr.responseJSON?.message);
            const result2 = removeBefore4thQuote(result);
            // const jsonData = convertToJSON(result2);
            // $('#output').text(result2);
            $('#output').text("Data Read Successfully please click View button to View Data");
            $('#view').css('display', 'block');
            $('#nfc1').val(result2);
        }
    });
});


function extractJsonLikeContent(message) {
    // Regular expression to match JSON-like content
    const pattern = /\{.*\}/s; // Match content between { and }, including nested structures
    const match = message.match(pattern);
    return match ? match[0] : "No JSON-like content found.";
}

function removeBefore4thQuote(str) {
    // Find the position of the 4th quotation mark
    var fourthQuoteIndex = str.split('"').slice(0, 4).join('"').length;
    
    // Return the substring after the 4th quotation mark
    return str.substring(fourthQuoteIndex + 1); // +1 to remove the quotation mark itself
}


    </script>
</body>
</html>
