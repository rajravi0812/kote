<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>Add Vehicle </title>
    <!-- Custom CSS -->
    @include('admin.dashboard.common.header_lib')

    <style>
        .table {
    border-collapse: collapse; /* Ensure borders are collapsed */
}

.table th, .table td {
    padding: 10px; /* Add padding to cells */
    text-align: left; /* Align text to the left */
}

.table th {
    background-color: #f8f9fa; /* Light background for the header */
    font-weight: bold; /* Make header text bold */
}

.table-bordered {
    border: 1px solid #dee2e6; /* Border for the table */
}

.table-bordered th, .table-bordered td {
    border: 1px solid #dee2e6; /* Border for table cells */
}

.loader {
            display: none;
            margin: 20px auto;
            border: 8px solid #f3f3f3;
            border-radius: 50%;
            border-top: 8px solid #3498db;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

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
                        <h4 class="page-title">Scanned Detail</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Scanned Detail</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div class="container-fluid">    
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <form action="{{ route('assign.vehicle') }}" method="POST" id="assignVehForm">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="card" class="col-sm-3 text-right control-label col-form-label"><b style="color:crimson;font-size:17px;">Card Number</b></label>
                                                <div class="col-md-6">
                                                    <input type="text" style="font-size:17px;color:crimson" class="form-control"  value="{{$detailedProducts[0]['asgn_card']}}" name="assign_card" placeholder="Enter Card Number"  readonly>
                                                    <div class="loader" id="loader"></div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Type of Veh</label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" id="veh_type"  value="{{$detailedProducts[0]['vehicle_type']['veh_name']}}"  name="veh_type" required readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Block No.</label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" id="cono1"  value="{{$detailedProducts[0]['block_no']}}" placeholder="Enter Block No" name="block_no" required readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Dvr Name</label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" id="cono1"  value="{{$detailedProducts[0]['driver_name']}}" placeholder="Enter Dvr Name" name="dvr" required readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Rank</label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" id="rank"  value="{{$detailedProducts[0]['rank']['rank_name']}}" placeholder="Rank" name="rank" required readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="category_id" class="col-sm-3 text-right control-label col-form-label">Unit</label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" id="unit"  value="{{$detailedProducts[0]['unit']['unit_name']}}" placeholder="unit" name="unit" required readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="category_id" class="col-sm-3 text-right control-label col-form-label">Destination</label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" id="destination"  value="{{$detailedProducts[0]['destination']['dest_name']}}" placeholder="unit" name="destination" required readonly>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Veh No.</label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" id="cono1"  value="{{$detailedProducts[0]['vehicle_no']}}" placeholder="Enter Veh No" name="veh_num" required readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Army No/Aadhar</label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" id="cono1"  value="{{$detailedProducts[0]['army_no']}}" placeholder="Enter Army/Aadhar No" name="army_no" required readonly>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Serial No</label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" id="serial"  value="{{$detailedProducts[0]['serial_no']}}"  name="serial_no" required readonly>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label for="email1" class="col-sm-3 text-right control-label col-form-label">Type of Store</label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" id="store"  value="{{$detailedProducts[0]['store']['store_name']}}" placeholder="store" name="store" required readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Stage 1</label>
                                                <div class="col-md-5">
                                                    <input type="datetime-local" class="form-control" id="oldDate" value="{{$detailedProducts[0]['date']}}" placeholder="Enter Date & Time" name="date" required readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Date & Time</label>
                                                <div class="col-md-5">
                                                    <input type="datetime-local" class="form-control" id="date"  placeholder="Enter Date & Time" name="date" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <h3>Product to be uploaded to Veh:</h3>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            {{-- <button type="button" id="add-product-btn" class="btn btn-success mt-3">Add Product</button> --}}
                                        </div>
                                    </div>
                                    
                                    <div id="product-section">
                                        @foreach ($detailedProducts as $products)
                                        <div class="product-item border p-3 mb-3">
                                            <div class="form-group row">
                                                <label for="product_name" class="col-sm-2 col-form-label">Product</label>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control product-quantity" value="{{$products['product']['product_name']}}" name="" placeholder="Enter Quantity" required readonly>
                                                </div>
                                                
                                                <label for="quantity" class="col-sm-2 col-form-label">Quantity</label>
                                                <div class="col-md-3">
                                                    <input type="number" class="form-control product-quantity" value="{{$products['quantity']}}" name="" placeholder="Enter Quantity" required readonly>
                                                </div>
                                                <div class="col-md-1">
                                                    {{-- <button type="button" class="btn btn-danger remove-product-btn">X</button> --}}
                                                </div>
                                            </div>
                                           
                                            <div class="sub-product-table-container mt-3">
                                                
                                                <div class="table-responsive" style="text-align: center;">
                                                <table class="table table-bordered" style="width: 60%; margin: 0 auto;">
                                                    <thead>
                                                        <tr>
                                                            <th>Accessory Name</th>
                                                            <th>Accessory Qty</th>
                                                            {{-- <th>Action</th> <!-- Add an action column --> --}}
                                                        </tr>
                                                    </thead>
                                                    <tbody>  
                                                        @foreach ($products['accessories'] as $accesory)
                                                        <tr>
                                                            <td>
                                                                <input type="text" class="form-control" name="" value="{{$accesory['accessory']['acc_name']}}" readonly>
                                                            </td>
                                                            <td>
                                                                <input type="number" class="form-control accessory-quantity" name="" value="{{$accesory['quantity']}}" data-original-qty="" min="0" readonly>
                                                            </td>
                                                            {{-- <td><button type="button" class="btn btn-danger remove-accessory-btn">Remove</button></td> --}}
                                                        </tr> 
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                </div> 
                                               
                                            </div>    
                                        </div>
                                        @endforeach
                                    </div>
                                <div class="border-top">
                                    <div class="card-body">
                                        {{-- <button type="button" class="btn btn-primary">Update</button> --}}
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @include('admin.dashboard.common.footer')
        </div>
    </div>
    @include('admin.dashboard.common.footer_lib')
    <script>
        // Get the current date and time
        const now = new Date();
    
        // Format the date and time for the 'datetime-local' input
        const year = now.getFullYear();
        const month = String(now.getMonth() + 1).padStart(2, '0'); // Months are 0-indexed
        const day = String(now.getDate()).padStart(2, '0');
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
    
        // Combine into 'YYYY-MM-DDTHH:mm' format
        const formattedDateTime = `${year}-${month}-${day}T${hours}:${minutes}`;
    
        // Set the value of the input field
        document.getElementById('date').value = formattedDateTime;
    </script>
    
    <script>
        $(document).ready(function () {
            $('#uid').click(function () {
                $('#loader').show();
                $('#uid').val('');

                $.ajax({
                    url:'{{ route("scan.card") }}', // Laravel route
                    type: 'GET',
                    dataType: 'json',
                    success: function (response) {
                        $('#loader').hide();

                        if (response.success) {
                            $('#uid').val(response.uid);
                        } else {
                            $('#uid').val('Error: ' + response.message);
                        }
                    },
                    error: function () {
                        $('#loader').hide();
                        $('#uid').val('Error: Failed to fetch card UID.');
                    }
                });
            });
        });
    </script>
    
    <script>
        $(document).ready(function() {
            $(".select2").select2(); // Initialize Select2 for existing dropdowns
            
            let productCount = 1; // Track the number of products
        
            // Add new product item
            $('#add-product-btn').click(function() {
                const productItem = `
                    <div class="product-item border p-3 mb-3">
                        <div class="form-group row">
                            <label for="product_name" class="col-sm-2 col-form-label">Product</label>
                            <div class="col-md-4">
                                <select style="width:300px;" class="form-control product-dropdown select2" name="products[${productCount}][name]" required>
                                    <option value="">Select Product</option>
                                </select>
                            </div>
                            
                            <label for="quantity" class="col-sm-2 col-form-label">Quantity</label>
                            <div class="col-md-3">
                                <input type="number" class="form-control product-quantity" value="1" name="products[${productCount}][quantity]" placeholder="Enter Quantity" required>
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-danger remove-product-btn">X</button>
                            </div>
                        </div>
                       
                        <div class="sub-product-table-container mt-3"></div>    
                    </div>
                `;
                
                $('#product-section').append(productItem);
                
                const newDropdown = $('.product-dropdown').last();
                populateProductDropdown(newDropdown); // Populate products
                newDropdown.select2(); // Initialize Select2 for the new dropdown
        
                productCount++;
            });
        
            // Handle removal of product items
            $(document).on('click', '.remove-product-btn', function() {
                $(this).closest('.product-item').remove();
            });
        
            // Populate dropdown options via AJAX
            function populateProductDropdown(dropdown) {
                $.ajax({
                    url: '{{ route("products") }}', 
                    type: 'GET',
                    success: function(response) {
                        dropdown.empty().append('<option value="">Select Product</option>');
                        $.each(response, function(index, product) {
                            dropdown.append(`<option value="${product.id}">${product.product_name}</option>`);
                        });
                    },
                    error: function() {
                        alert('Failed to load products');
                    }
                });
            }
        
            // Fetch and display sub-products when a product is selected
            $(document).on('change', '.product-dropdown', function() {
                const productId = $(this).val();
                const subProductContainer = $(this).closest('.product-item').find('.sub-product-table-container');
    
                if (productId) {
                    // Make the AJAX call to fetch sub-products
                    $.ajax({
                        url: `{{ url('/subproducts') }}/${productId}`, // Assuming productId is a valid variable
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            displaySubProductsTable(response, subProductContainer);
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error("Failed to load sub-products:", textStatus, errorThrown);
                            console.log("Response Text:", jqXHR.responseText);
                            alert('Failed to load sub-products');
                        }
                    });
                } else {
                    subProductContainer.empty();
                }
            });
    
            function displaySubProductsTable(subProducts, container) {
                container.empty();
                
                if (subProducts.length > 0) {
                    let table = `
                        <div class="table-responsive" style="text-align: center;">
                            <table class="table table-bordered" style="width: 60%; margin: 0 auto;">
                                <thead>
                                    <tr>
                                        <th>Accessory Name</th>
                                        <th>Accessory Qty</th>
                                        <th>Action</th> <!-- Add an action column -->
                                    </tr>
                                </thead>
                                <tbody>
                    `;
    
                    $.each(subProducts, function(index, subProduct) {
                        table += `
                        <tr>
                            <td>
                                <input type="hidden" class="form-control" name="products[${productCount - 1}][accessories][${index}][name]" value="${subProduct.id}" readonly>
                                ${subProduct.acc_name}
                            </td>
                            <td>
                                <input type="number" class="form-control accessory-quantity" name="products[${productCount - 1}][accessories][${index}][quantity]" value="${subProduct.issued_qty}" data-original-qty="${subProduct.issued_qty}" min="0">
                            </td>
                            <td><button type="button" class="btn btn-danger remove-accessory-btn">Remove</button></td>
                        </tr>
                        `;
                    });
    
                    table += `</tbody></table></div>`;
                    container.html(table);
                } else {
                    container.html('<p>No accessories available for this product.</p>');
                }
                
                // Add event listener for remove buttons
                $(document).on('click', '.remove-accessory-btn', function() {
                    $(this).closest('tr').remove(); // Remove the row from the table
                });
            }
    
            $(document).on('input', '.product-quantity', function() {
                const productQuantity = $(this).val(); 
                const accessoryQuantities = $(this).closest('.product-item').find('.accessory-quantity');
                accessoryQuantities.each(function() {
                    const originalQty = $(this).data('original-qty');
                    $(this).val(originalQty * productQuantity);
                });
            });
        });
    </script>

</body>

</html>