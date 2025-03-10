<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>Wpn Issued</title>
    @include('admin.dashboard.common.header_lib')
    <style>
        .card {
          border: none;
          box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        .btn-active {
          background-color: #007bff;
          color: white;
        }
        .status-in {
          background-color: #d4edda;
          color: #155724;
          font-weight: bold;
        }
        .status-out {
          background-color: #f8d7da;
          color: #721c24;
          font-weight: bold;
        }
        .btn {
          margin-right: 10px;
        }
        .scan-input {
          border: 1px solid #dc3545;
          border-radius: 5px;
        }
      </style>
      <style>
        #loader {
            display: none; /* Hide the loader by default */
        }
    
        .table2 thead {
        position: sticky;
        top: 0; /* Sticks the header to the top */
    
        z-index: 1; /* Keeps the header above the table body */
    }
    
    /* radio buttons */
    .custom-radio-group {
      display: inline-block;
      position: relative;
      margin-right: 10px;
    }
    
    .custom-radio-group input[type="radio"] {
      display: none; /* Hide default radio button */
    }
    
    .custom-radio {
      padding: 5px 10px;
      border: 2px solid #1d7ca5;
      border-radius: 5px;
      background-color: white;
      color: #1d7ca5;
      font-size: 14px;
      cursor: pointer;
      transition: all 0.3s ease;
    }
    
    .custom-radio:hover {
      background-color: #1d7ca5;
      color: white;
    }
    
    .custom-radio-group input[type="radio"]:checked + .custom-radio {
      background-color: #1d7ca5;
      color: white;
    }
    
    /* barcode  */
    
    .scan-label {
      font-size: 16px;
      color: #e60026;
    }
    
    .input-group {
      display: flex;
      position: relative;
    }
    
    .scan-input {
      width: 100%;
      padding: 5px;
      border: 2px solid #e60026;
      border-radius: 5px;
      box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
      font-size: 15px;
      transition: all 0.3s ease;
    }
    
    .scan-input:focus {
      outline: none;
      border-color: #007bff;
      box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    }
    
    .input-group-addon {
      display: flex;
      align-items: center;
      padding: 10px;
      background-color: #e60026;
      color: white;
      border-radius: 0 8px 8px 0;
    }
    
    .input-group-addon i {
      font-size: 20px;
    }
    
    .scan-input:hover {
      border-color: #007bff;
    }
    
    .scan-input::placeholder {
      color: #aaa;
      font-size: 14px;
    }
    
    
    /* added css */
    
    
    
    </style>
</head>
<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper">
        @include('admin.dashboard.common.header')
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Issue Wpn</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Wpn Issue</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid mt-1">
                <div class="row">
                  <!-- Left Panel -->
                  <div class="col-md-4">
                    <div class="card p-3">
                        <div class="text-center mb-4">
                            <a href="fingerprintapp://verify-in"  class="btn btn-warning btn-md" style="border-radius: 5px; width: 100%; font-weight:700;" id="myButton" >
                                <i class="fas fa-fingerprint"></i>Click Here To Scan Fingerprint
                            </a>
                        </div>
                        <div id="details" class="mb-4">
                            <div class="row align-items-center mb-3">
                                <div class="col-md-4">
                                    <label class="form-label">Photo:</label>
                                </div>
                                <div class="col-md-8 text-center" id="image">
                                    <img src="" alt="" class="img-fluid rounded-square" style="max-width: 150px; height: auto;">
                                </div>
                            </div>
                            
                            <div class="row align-items-center mb-3">
                                <div class="col-md-4">
                                    <label class="form-label">ID No:</label>
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label" id="army_no"></label>
                                </div>
                            </div>
                            <div class="row align-items-center mb-3">
                                <div class="col-md-4">
                                    <label class="form-label">Rank:</label>
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label" id="rank"></label>
                                </div>
                            </div>
                            <div class="row align-items-center mb-3">
                                <div class="col-md-4">
                                    <label class="form-label">Name:</label>
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label" id="name"></label>
                                </div>
                            </div>
                            <div class="row align-items-center mb-3">
                                <div class="col-md-4">
                                    <label class="form-label">Unit:</label>
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label" id="unit"></label>
                                </div>
                            </div>
                            <div class="row align-items-center mb-3">
                                <div class="col-md-4">
                                    <label class="form-label">Company:</label>
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label" id="company"></label>
                                </div> 
                            </div>
                        </div>
                    </div>
                  </div>
              
                  <!-- Right Panel -->
                  <div class="col-md-8 pb-4" style="background-color: #f8f9fa; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); pointer-events: none;opacity: 0.6;" id="editable">
                    <div class="card p-3">
                      <!-- Duty and Purpose Section -->
                      <div class="justify-content-between">
                        <div class="row row-xs align-items-center ">
                            <div class="col-md-2">
                                <label class="form-label mg-b-0" style="font-size:15px;font-weight:600;">Nature of Duty:</label>
                            </div>
                            <div class="col-md-3 mg-t-5 mg-md-t-0 flex">
                                <div class="custom-radio-group">
                                    <input type="radio" id="less24" name="nature" value="0" checked required>
                                    <label for="less24" class="custom-radio">Less than 24 hrs</label>
                                </div>
                            </div>

                            <div class="col-md-5 mg-t-5 mg-md-t-0 flex">
                                <div class="custom-radio-group">
                                    <input type="radio" id="more24" name="nature" value="1" required>
                                    <label for="more24" class="custom-radio">More than 24 hrs</label>
                                </div>
                            </div>
                        </div>
                         
                          
                          
                        <hr>
                        <div class="row row-xs align-items-center">
                            <div class="col-md-2">
                                <label class="form-label mg-b-0" style="font-size:15px;font-weight:600;">Purpose:</label>
                            </div>
                            <div style="display: flex; align-items: center;" class="col-md-10 mg-t-5 mg-md-t-0">
                                <div style="display: flex; align-items: center;" class="custom-radio-group">
                                    <input id="maintenance" name="purpose" checked value="maintenance" required autocomplete="off" type="radio" style="margin-top: 0;">
                                    <label for="maintenance" class="form-label custom-radio" style="margin:0px 0 0 5px;">Maintenance</label>
                                </div>
                                <div style="display: flex; align-items: center; margin-left: 10px;" class="custom-radio-group" >
                                    <input id="firing" name="purpose" value="firing" required autocomplete="off" type="radio" style="margin-top: 0;">
                                    <label for="firing" class="form-label custom-radio" style="margin:0px 0 0 5px;">Firing</label>
                                </div>
                                <div style="display: flex; align-items: center; margin-left: 10px;" class="custom-radio-group">
                                    <input id="guard" name="purpose" value="guard duties" required autocomplete="off" type="radio" style="margin-top: 0;">
                                    <label for="guard" class="form-label custom-radio"  style="margin:0px 0 0 5px;">Guard Duties</label>
                                </div>
                                <div style="display: flex; align-items: center; margin-left: 10px;" class="custom-radio-group">
                                    <input id="bpet" name="purpose" value="bpet" required autocomplete="off" type="radio" style="margin-top: 0;">
                                    <label for="bpet" class="form-label custom-radio" style="margin:0px 0 0 5px;">BPET</label>
                                </div>
                                <div style="display: flex; align-items: center; margin-left: 10px;" class="custom-radio-group">
                                    <input id="out" name="purpose" value="out_stn" required autocomplete="off" type="radio" style="margin-top: 0;">
                                    <label for="out" class="form-label custom-radio" style="margin:0px 0 0 5px;">Out Stn</label>
                                </div>
                                <div style="display: flex; align-items: center;" class="custom-radio-group">
                                    <input id="r1" name="purpose" value="r1" required autocomplete="off" type="radio" style="margin-top: 0;">
                                    <label for="r1" class="form-label custom-radio" style="margin:0px 0 0 5px;">R1</label>
                                </div>
                                <div style="display: flex; align-items: center; margin-left: 10px;" class="custom-radio-group">
                                    <input id="r2" name="purpose" value="r2" required autocomplete="off" type="radio" style="margin-top: 0;">
                                    <label for="r2" class="form-label custom-radio" style="margin:0px 0 0 5px;">R2</label>
                                </div>
                                <div style="display: flex; align-items: center; margin-left: 10px;" class="custom-radio-group">
                                    <input id="r4" name="purpose" value="r4" required autocomplete="off" type="radio" style="margin-top: 0;">
                                    <label for="r4" class="form-label custom-radio"  style="margin:0px 0 0 5px;">R4</label>
                                </div>
                            </div>

                            <div class="col-md-2">
                                
                            </div>

                            <div style="display: flex; align-items: center;" class="col-md-10 mg-t-5 mg-md-t-0 mt-2">
                                <div style="display: flex; align-items: center;" class="custom-radio-group">
                                    <input id="befins" name="purpose" value="before_ins" required autocomplete="off" type="radio" style="margin-top: 0;">
                                    <label for="befins" class="form-label custom-radio" style="margin:0px 0 0 5px;">Before Insp</label>
                                </div>
                                <div style="display: flex; align-items: center; margin-left: 10px;" class="custom-radio-group">
                                    <input id="afterins" name="purpose" vlaue="on" required autocomplete="off" type="radio" style="margin-top: 0;">
                                    <label for="afterins"  class="form-label custom-radio" style="margin:0px 0 0 5px;">After Insp</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row row-xs align-items-center mg-b-20" style="position:absolute; top:-60px;">
                            <div class="col-md-5">
                                <label class="form-label mg-b-0 scan-label" style="color:#e60026;"><b>Scan Weapon:</b></label>
                            </div>
                            <div class="col-md-7">
                                <div class="input-group">
                                    <input class="form-control scan-input" type="text" id="barcode" placeholder="Scan/Enter Wpn Tag">
                                    <span class="input-group-addon">
                                        <i class="fa fa-barcode"></i>
                                    </span>
                                    <input type="hidden" value="" id="barcode_data" required name="barcode_data[]">
                                </div>
                            </div>
                        </div>
                      </div>          
                    </div>
              
                    <!-- Table -->
                    <div class="mt-4">
                        <div class="table-responsive table2 mt-4" style="max-height:400px;">
                            <table class="table  table-bordered text-center table-sm" >
                                <thead class=" text-white" style="background-color:#1d7ca5;">
                                <tr>
                                    <th>SR NO.</th>
                                    <th>WEAPON TYPE</th>
                                    <th>REGD NO</th>
                                    <th>BUTT NUMBER</th>
                                    <th>WPN TAG</th>
                                    <th>STATUS</th>
                                </tr>
                                </thead>
                                <tbody id=tbody>
                                {{-- <tr>
                                    <td>1</td>
                                    <td>Shotgun</td>
                                    <td>fert34</td>
                                    <td>ger34</td>
                                    <td>43245444</td>
                                    <td class="status-in">IN</td>
                                </tr> --}}
                               
                                
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-2">
                            <label class="form-label mg-b-0" ><b>No. of Magazines:</b></label>
                        </div>
                        <div class="col-md-2">
                            <input type="text" id="megazins" class="form-control"  >
                        </div>
                        <div class="col-md-2">
                            <label class="form-label mg-b-0" style="float:right;"><b>No. of Slings:</b></label>
                        </div>
                        <div class="col-md-2">
                            <input type="text" id="slings" class="form-control"  >
                        </div>
                        <div class="col-md-2">
                            <label class="form-label mg-b-0" style="float:right;"><b>No. of Bayonet:</b></label>
                        </div>
                        <div class="col-md-2">
                            <input type="text" id="bayonet" class="form-control"  >
                        </div>
                    </div>
                    <hr>
                    <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-2">
                            <label class="form-label mg-b-0" ><b>Remark:</b></label>
                        </div>
                        <div class="col-md-10">
                            <textarea type="text" name="remark" id="remark" class="form-control" rows="3" cols="80"></textarea>
                        </div>
                    </div>
                    <hr>
                    <div class="row row-xs align-items-center ">
                        <div class="col-md-8">
                            
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-success btn-update"  style="border-radius:4px"> Issue </button>
                        </div>
                        <div class="col-md-2">
                            <a href="{{route("wpn.issue")}}" class="btn btn-danger" style="border-radius:4px"> Cancel </a>
                        </div>
                    </div>
                  </div>
                </div>
                
              </div>

            @include('admin.dashboard.common.footer')
        </div>
    </div>
    @include('admin.dashboard.common.footer_lib')
    <script>
        $(document).ready(function(){
            $('.btn-delete').click(function(){
                let del_id = $(this).attr('rel');
                $('#del_id').val(del_id);
                console.log(del_id);
            })
        });
    </script>

<script>
    let intervalId;
    var emp_id = "";
    function fetchSessionData() {
        $.ajax({
            url: '{{ route("check.session") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}', // CSRF token for security
            },
            success: function(response) {
                if (response.success) {
                    clearInterval(intervalId); // Stop the interval
                    console.log(response.data.image);
                    const publicBaseUrl = "{{ url('/storage/app') }}"; // Pass the base URL from Laravel to JavaScript

                    const imageUrl = response.data.image 
                        ? `${publicBaseUrl}${response.data.image}` 
                        : `${publicBaseUrl}/public/static/notfound.png`; // Default image path if no photo is provided
                    console.log(imageUrl);
                    $('#image img').attr('src', imageUrl);
                    $('#army_no').text(response.data.emp_id || 'N/A');
                    $('#emp_id').val(response.data.emp_id || '');
                    $('#rank').text(response.data.rank || 'N/A');
                    $('#name').text(response.data.name || 'N/A');
                    $('#unit').text(response.data.unit || 'N/A');
                    $('#company').text(response.data.company || 'N/A');
                    emp_id = response.data.emp_id;
                    $('#editable').css({
                                            'pointer-events': 'auto', 
                                            'opacity': '1'
                                        });
                    
                } else {
                    console.log(response.message); // Log the message for debugging
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }

    // Call the function every second
    intervalId = setInterval(fetchSessionData, 1000);
</script>


<script>
    $(document).ready(function() {
       
      
        var barcodesArray = [];
        var purpose = "";
        var wpn_ids = [];

        function handleFetch() {
            barcodesArray = [];
            wpn_ids = [];
            var type = $('input[name="purpose"]:checked').val(); // Get the currently selected radio button value
            var url = '{{ route("fetch.wpn.avail")}}';
            var url1 = '{{ route("fetch.wpn.alloted")}}';
            console.log(type);
            
            if (type == "maintenance" || type == "before_ins" || type == "on" || 
                type == "bpet" || type == "out_stn" || type == "r1" || 
                type == "r2" || type == "r4") {
                purpose = "";
                fetch_list_avail("", "", url); 
            } else {
                fetch_list_allot(emp_id, url1); 
                purpose = "1";
            }
        }

        handleFetch();

        // Run the function when the radio button changes
        $('input[name="purpose"]').on('change', function() {
            handleFetch(); 
        });

        function fetch_list_avail(type,butt_no,url){
            $.ajax({
                    url: url,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    success: function(list) {
                        console.log(list.data);
                        $('#tbody').empty(); 

                        if (list.data.length > 0) {
                            $.each(list.data, function(index, alloted) {
                                if(alloted.status == 0){
                                                status = "IN";
                                                color = "#52b539c2";
                                            }else{
                                                status = "OUT";
                                                color = "#e12f2fbf";
                                            }
                                var row = '<tr>' +
                                    '<td>' + (index + 1) + '</td>' +
                                    '<td>' + alloted.type + '</td>' +
                                    '<td>' + alloted.regd_no + '</td>' +
                                    '<td>' + alloted.butt_no + '</td>' +
                                    '<td>' + alloted.wpn_tag + '</td>' +
                                    '<td style="background-color: ' + color + '; color: white;">' + status + '</td>' +
                                    '</tr>';

                                // Append the row to the table body
                                $('#tbody').append(row);
                            });
                        } else {
                            $('#tbody').append('<tr><td colspan="6" class="text-center">No Wpn Found in Inventory</td></tr>');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('Failed to fetch the Wpns list: ' + error);
                    }
                });
            }
            function fetch_list_allot(emp_id,url){
            $.ajax({
                    url: url,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        "emp_id":emp_id,
                    },
                    dataType: 'json',
                    success: function(list) {
                        console.log(list.data);
                       
                        $('#tbody').empty(); 
                        if (list.data.length > 0) {
                           
                            $.each(list.data, function(index, alloted) {
                                if(alloted.status == 0){
                                                status = "IN";
                                                color = "#52b539c2";
                                            }else{
                                                status = "OUT";
                                                color = "#e12f2fbf";
                                            }
                                var row = '<tr>' +
                                    '<td>' + (index + 1) + '</td>' +
                                    '<td>' + alloted.type + '</td>' +
                                    '<td>' + alloted.regd_no + '</td>' +
                                    '<td>' + alloted.butt_no + '</td>' +
                                    '<td>' + alloted.wpn_tag + '</td>' +
                                    '<td style="background-color: ' + color + '; color: white;">' + status + '</td>' +
                                    '</tr>';

                                // Append the row to the table body
                                $('#tbody').append(row);
                            });
                        } else {
                            $('#tbody').append('<tr><td colspan="6" class="text-center">No Wpn Found in Inventory</td></tr>');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('Failed to fetch the Wpns list: ' + error);
                    }
                });
            }


            // $('#barcode').keypress(function(event) {
            //     var status ="";
            //     var color = "";
            //     var not_selected = "";
            //     if (event.which === 13) {
            //         event.preventDefault();
            //         var barcode = $('#barcode').val();
            //         barcodesArray.push(barcode);
            //         console.log(barcodesArray,emp_id,purpose,"this is testing");
                    
            //         // Show the loader
            //         $('#loader').show();

            //         // First AJAX call
            //         $.ajax({
            //             url: '{{ route("fetch.wpn.barcode")}}',
            //             type: 'POST',
            //             headers: {
            //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //             },
            //             data: { barcode: barcodesArray,
            //                     emp_id:emp_id,
            //                     purpose:purpose,
            //                 },
            //             success: function(response1) {
            //                 try {
            //                     console.log(response1);
            //                     // response1 = JSON.parse(response1);
            //                 } catch (e) {
            //                     console.error("Failed to parse response1:", e);
            //                     return;
            //                 }
                            
            //                 console.log('Response1:', response1);
            //                 $('#tbody').empty();
            //                 wpn_ids=[];       
            //                 if (Array.isArray(response1) && response1.length > 0) {
            //                     $.each(response1, function(index, alloted) {
            //                         if(alloted.status == 0){
            //                                     status = "IN";
            //                                     color = "#52b539c2";
            //                                 }else{
            //                                     status = "OUT";
            //                                     color = "#e12f2fbf";
            //                                 }
            //                         var row = '<tr style="background-color:#e1d459">' +
            //                             '<td>' + (index + 1) + '</td>' +
            //                             '<td>' + alloted.type + '</td>' +
            //                             '<td>' + alloted.regd_no + '</td>' +
            //                             '<td>' + alloted.butt_no + '</td>' +
            //                             '<td>' + alloted.wpn_tag + '</td>' +
            //                             '<td style="background-color: ' + color + '; color: white;">' + status + '</td>' +
            //                             '</tr>';

            //                         // Append the row to the table body
            //                         $('#tbody').append(row);
            //                         wpn_ids.push(alloted.id);
            //                         not_selected = barcodesArray.length+1;       
            //                     });
            //                 } else {
            //                     // $('#tbody').append('<tr><td colspan="6" class="text-center">No Wpn Found in Inventory</td></tr>');
            //                     alert("Weapon Not in Inventory");
            //                     not_selected = barcodesArray.length; 
            //                 }
            //             },
            //             error: function(xhr, status, error) {
            //                 // Handle errors
            //                 console.error('Error:', error);
            //             },
            //             complete: function() {
            //                 // Hide the loader after the first request is complete
            //                 $('#loader').hide();

            //                 // Start the second AJAX call
            //                 $.ajax({
            //                     url: '{{ route("fetch.wpn.barcode.not") }}',
            //                     type: 'POST',
            //                     headers: {
            //                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //                     },
            //                     data: { barcode: barcodesArray,
            //                             emp_id:emp_id,
            //                             purpose:purpose,
            //                             },
            //                     success: function(response2) {
            //                         try {
            //                             // response2 = JSON.parse(response2);
            //                         } catch (e) {
            //                             console.error("Failed to parse response2:", e);
            //                             return;
            //                         }
            //                         console.log('Response2:', response2);

            //                         if (Array.isArray(response2) && response2.length > 0) {
            //                             $.each(response2, function(index, alloted) {
            //                                 if(alloted.status == 0){
            //                                     status = "IN";
            //                                     color = "#52b539c2";
            //                                 }else{
            //                                     status = "OUT";
            //                                     color = "#e12f2fbf";
            //                                 }
            //                                 var row = '<tr>' +
            //                                     '<td>' + (index + not_selected) + '</td>' +
            //                                     '<td>' + alloted.type + '</td>' +
            //                                     '<td>' + alloted.regd_no + '</td>' +
            //                                     '<td>' + alloted.butt_no + '</td>' +
            //                                     '<td>' + alloted.wpn_tag + '</td>' +
            //                                     '<td style="background-color: ' + color + '; color: white;">' + status + '</td>' +
            //                                     '</tr>';

            //                                 // Append the row to the table body
            //                                 $('#tbody').append(row);
            //                             });
            //                         } else {
            //                             // $('#tbody').append('<tr><td colspan="6" class="text-center">No Wpn Found in Inventory</td></tr>');
            //                             alert("Weapon Not Found");
            //                         }
            //                     },
            //                     error: function(xhr, status, error) {
            //                         // Handle errors
            //                         console.error('Error:', error);
            //                     }
            //                 });
            //             }
            //         });

            //         $('#barcode').val('');
            //     }
            // });


            $('#barcode').keypress(function(event) {
    var status = "";
    var color = "";
    var not_selected = "";
    if (event.which === 13) {
        event.preventDefault();
        var barcode = $('#barcode').val();
        barcodesArray.push(barcode);
        console.log(barcodesArray, emp_id, purpose, "this is testing");

        // Show the loader
        $('#loader').show();

        // First AJAX call
        $.ajax({
            url: '{{ route("fetch.wpn.barcode")}}',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: { barcode: barcodesArray, emp_id: emp_id, purpose: purpose },
            success: function(response1) {
                try {
                    console.log(response1);
                } catch (e) {
                    console.error("Failed to parse response1:", e);
                    return;
                }

                console.log('Response1:', response1);
                $('#tbody').empty();
                wpn_ids = [];
                if (Array.isArray(response1) && response1.length > 0) {
                    $.each(response1, function(index, alloted) {
                        if (alloted.status == 0) {
                            status = "IN";
                            color = "#52b539c2";
                        } else {
                            status = "OUT";
                            color = "#e12f2fbf";
                        }
                        var row = '<tr style="background-color:#e1d459">' +
                            '<td>' + (index + 1) + '</td>' +
                            '<td>' + alloted.type + '</td>' +
                            '<td>' + alloted.regd_no + '</td>' +
                            '<td>' + alloted.butt_no + '</td>' +
                            '<td>' + alloted.wpn_tag + '</td>' +
                            '<td style="background-color: ' + color + '; color: white;">' + status + '</td>' +
                            '</tr>';

                        // Append the row to the table body
                        $('#tbody').append(row);
                        wpn_ids.push(alloted.id);
                        not_selected = barcodesArray.length + 1;
                    });
                } else {
                    alert("Weapon Not in Inventory");
                    not_selected = barcodesArray.length;
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            },
            complete: function() {
                // Hide the loader after the first request is complete
                $('#loader').hide();

                // Start the second AJAX call
                $.ajax({
                    url: '{{ route("fetch.wpn.barcode.not") }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: { barcode: barcodesArray, emp_id: emp_id, purpose: purpose },
                    success: function(response2) {
                        try {
                            console.log(response2);
                        } catch (e) {
                            console.error("Failed to parse response2:", e);
                            return;
                        }

                        console.log('Response2:', response2);

                        if (Array.isArray(response2) && response2.length > 0) {
                            $.each(response2, function(index, alloted) {
                                // Check if the barcode has already been processed
                                if (!barcodesArray.includes(alloted.barcode)) {
                                    if (alloted.status == 0) {
                                        status = "IN";
                                        color = "#52b539c2";
                                    } else {
                                        status = "OUT";
                                        color = "#e12f2fbf";
                                    }
                                    var row = '<tr>' +
                                        '<td>' + (index + not_selected) + '</td>' +
                                        '<td>' + alloted.type + '</td>' +
                                        '<td>' + alloted.regd_no + '</td>' +
                                        '<td>' + alloted.butt_no + '</td>' +
                                        '<td>' + alloted.wpn_tag + '</td>' +
                                        '<td style="background-color: ' + color + '; color: white;">' + status + '</td>' +
                                        '</tr>';

                                    // Append the row to the table body
                                    $('#tbody').append(row);
                                }
                            });
                        } else {
                            console("Weapon Not Found");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            }
        });

        $('#barcode').val('');
    }
});



            $(".btn-update").on('click', function() {

                if (!confirm("Are you sure ?")) {
                    return; // Stop execution if user cancels
                }
                // Fetch input values
                var nature = $('input[name="nature"]:checked').val(); 
                var purpose = $('input[name="purpose"]:checked').val(); 
                var megazins = $('#megazins').val();
                var slings = $('#slings').val();
                var bayonet = $('#bayonet').val();
                var remark = $('#remark').val();
                
                // Assuming wpn_ids and emp_id are defined somewhere
                console.log(nature, purpose, megazins, slings, bayonet, remark, wpn_ids, emp_id);

                // Make sure wpn_ids and emp_id are defined
                if (wpn_ids && emp_id) {
                    $.ajax({
                        url: '{{ route("add.issue.return")}}',
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: { 
                            emp_id: emp_id,
                            purpose: purpose,
                            wpn_ids: wpn_ids, // Pass the array of weapon IDs
                            nature: nature,
                            megazins: megazins,
                            slings: slings,
                            bayonet: bayonet,
                            remark: remark
                        },
                        success: function(data) {
                            console.log(data);
                            if (data == 1) {
                                alert('Weapon Issue Successfully');
                                window.location.reload();
                                //   window.close();
                            } else {
                                alert('Failed to submit data');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX Error:', error);
                        }
                    });
                } else {
                    alert('Weapon IDs or Employee Code are missing.');
                }
            });

    });
</script>

<script>
    $(document).ready(function () {
        $("#myButton").click(function (e) {
            e.preventDefault();  // Prevent the default anchor behavior

            let button = $(this);
            
            // Disable the button by adding a 'disabled' class or using CSS
            button.addClass("disabled");
            button.css("pointer-events", "none");  // Disable further clicks

            // Get the URL from the href attribute
            let url = button.attr("href");

            // Log the URL to see if it's being captured correctly
            console.log("Navigating to URL:", url);

            // Open the link (this will trigger the app)
            window.location.href = url;

            // Re-enable the button after 4 seconds
            setTimeout(function () {
                button.removeClass("disabled");
                button.css("pointer-events", "auto");
            }, 4000);
        });
    });
</script>
</body>

</html>