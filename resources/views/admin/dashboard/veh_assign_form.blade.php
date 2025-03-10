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
            /* margin: 20px auto; */
            border: 8px solid #f3f3f3;
            border-radius: 50%;
            border-top: 8px solid #3498db;
            width: 30px;
            height: 30px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        fieldset {
  background-color: #f4f3f3;
  border-radius: 5px;
}

legend {
  background-color: rgb(48, 80, 167);
  color: white;
  width:150px;
  padding: 3px 10px;
  margin-left:20px;
  font-size: 17px;
  border-radius:5px;
}

    </style>
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
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
                        <h4 class="page-title">Product Form</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Product Form</li>
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
                            <form action="{{ route('assign.vehicle') }}" method="POST" id="assignVehForm"  enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group row">
                                        <div class="">
                                           
                                                <div class="col-md-12">
                                                    <fieldset style="border:1px solid rgb(199, 199, 199);">
                                                        <legend>Product</legend>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group row">
                                                                    <label for="productName" class="col-sm-5 text-right control-label col-form-label">Product Name</label>
                                                                    <div class="col-md-7">
                                                                        <input type="text" class="form-control" id="productName" placeholder="Enter Product Name" name="product_name" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group row">
                                                                    <label for="category" class="col-sm-5 text-right control-label col-form-label">Select Category</label>
                                                                    <div class="col-md-7">
                                                                        <select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="category" required>
                                                                            <option value="">Select</option>
                                                                            @foreach ($productCat as $cat)
                                                                                <option value="{{ $cat->id }}">{{ $cat->p_cat_name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group row">
                                                                    <label for="productImage" class="col-sm-5 text-right control-label col-form-label">Product Image</label>
                                                                    <div class="col-md-7">
                                                                        <input type="file" class="form-control" id="productImage" name="product_image">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group row">
                                                                    <label for="fundCategory" class="col-sm-5 text-right control-label col-form-label">Select Fund Cat</label>
                                                                    <div class="col-md-7">
                                                                        <select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="fund_category" >
                                                                            <option value="">Select</option>
                                                                            @foreach ($fundCat as $cat)
                                                                                <option value="{{ $cat->id }}">{{ $cat->fund_cat_name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group row">
                                                                    <label for="fundSubCategory" class="col-sm-5 text-right control-label col-form-label">Select Fund Sub-Cat</label>
                                                                    <div class="col-md-7">
                                                                        <select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="fund_sub_category" >
                                                                            <option value="">Select</option>
                                                                            @foreach ($fundSubCat as $cat)
                                                                                <option value="{{ $cat->id }}">{{ $cat->fund_subcat_name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                           
                                                            {{-- <div class="col-md-12">
                                                                <div class="form-group row">
                                                                    <label class="col-sm-3 text-right control-label col-form-label">
                                                                        Is the product have serial No (Yes/No):
                                                                    </label>
                                                                    <div class="col-md-8 d-flex align-items-center">
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="radio" name="hasSerial" id="serialYes" value="no" checked required>
                                                                            <label class="form-check-label" for="serialYes">No</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="radio" name="hasSerial" id="serialNo" value="yes">
                                                                            <label class="form-check-label" for="serialNo">Yes</label>
                                                                        </div>
                                                                        <!-- Input field initially hidden -->
                                                                        <div class="ml-3 d-none" id="serialNumberField">
                                                                            <input type="text" class="form-control" id="serialNoInput" name="serialNo" placeholder="Enter Serial No">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div> --}}
                                                            <div class="col-md-4">
                                                                <div class="form-group row">
                                                                    <label for="qty" class="col-sm-5 text-right control-label col-form-label">Product Qty</label>
                                                                    <div class="col-md-7">
                                                                        <input type="text" class="form-control" id="qty" placeholder="Enter Product Qty" name="qty" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-md-12">
                                                                <div class="form-group row">
                                                                    <label class="col-sm-3 text-right control-label col-form-label">
                                                                        Is the product have serial No (Yes/No):
                                                                    </label>
                                                                    <div class="col-md-8 d-flex align-items-center">
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="radio" name="hasSerial" id="serialNo" value="no" checked >
                                                                            <label class="form-check-label" for="serialNo">No</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="radio" name="hasSerial" id="serialYes" value="yes">
                                                                            <label class="form-check-label" for="serialYes">Yes</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Serial Numbers Section -->
                                                            <div class="col-md-12 d-none" id="serialNumbersContainer">
                                                                <div class="form-group row">
                                                                    <label class="col-sm-2 text-right control-label col-form-label">
                                                                        Enter Serial Numbers:
                                                                    </label>
                                                                    <div class="col-md-10" id="serialFields"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                            
                                                <div class="col-md-12 mt-4">
                                                    <fieldset style="border:1px solid rgb(199, 199, 199);">
                                                        <legend>Product Details</legend>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group row">
                                                                    <label for="crvNo" class="col-sm-5 text-right control-label col-form-label">CRV No</label>
                                                                    <div class="col-md-7">
                                                                        <input type="text" class="form-control" id="crvNo" name="crv_no" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group row">
                                                                    <label for="crvDate" class="col-sm-5 text-right control-label col-form-label">CRV Date</label>
                                                                    <div class="col-md-7">
                                                                        <input type="date" class="form-control" id="crvDate" name="crv_date" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group row">
                                                                    <label for="ledgerNo" class="col-sm-5 text-right control-label col-form-label">Ledger No</label>
                                                                    <div class="col-md-7">
                                                                        <input type="text" class="form-control" id="ledgerNo" name="ledger_no" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group row">
                                                                    <label for="ledgerPageNo" class="col-sm-5 text-right control-label col-form-label">Ledger Page No</label>
                                                                    <div class="col-md-7">
                                                                        <input type="text" class="form-control" id="ledgerPageNo" name="ledger_page_no" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group row">
                                                                    <label for="issueVoucherNo" class="col-sm-5 text-right control-label col-form-label">Issue Voucher No</label>
                                                                    <div class="col-md-7">
                                                                        <input type="text" class="form-control" id="issueVoucherNo" name="issue_voucher_no" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group row">
                                                                    <label for="issueVoucherDate" class="col-sm-5 text-right control-label col-form-label">Issue Voucher Date</label>
                                                                    <div class="col-md-7">
                                                                        <input type="date" class="form-control" id="issueVoucherDate" name="issue_voucher_date" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group row">
                                                                    <label for="billNo" class="col-sm-5 text-right control-label col-form-label">Bill No</label>
                                                                    <div class="col-md-7">
                                                                        <input type="text" class="form-control" id="billNo" name="bill_no" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group row">
                                                                    <label for="billDate" class="col-sm-5 text-right control-label col-form-label">Bill Date</label>
                                                                    <div class="col-md-7">
                                                                        <input type="date" class="form-control" id="billDate" name="bill_date" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                            
                                                <div class="col-md-12 mt-4">
                                                    <fieldset style="border:1px solid rgb(199, 199, 199);">
                                                        <legend style="width:230px;">Warranty & AMC Details</legend>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group row">
                                                                    <label for="warrantyYears" class="col-sm-5 text-right control-label col-form-label">Warranty (In Years)</label>
                                                                    <div class="col-md-7">
                                                                        <input type="number" class="form-control" id="warrantyYears" name="warranty_years" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group row">
                                                                    <label for="warrantyExpiry" class="col-sm-5 text-right control-label col-form-label">Warranty Expiry Date</label>
                                                                    <div class="col-md-7">
                                                                        <input type="date" class="form-control" id="warrantyExpiry" name="warranty_expiry_date" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group row">
                                                                    <label for="amcDueDate" class="col-sm-5 text-right control-label col-form-label">AMC Due Date</label>
                                                                    <div class="col-md-7">
                                                                        <input type="date" class="form-control" id="amcDueDate" name="amc_due_date" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group row">
                                                                    <label for="price" class="col-sm-5 text-right control-label col-form-label">Price</label>
                                                                    <div class="col-md-7">
                                                                        <input type="number" class="form-control" id="price" name="price" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group row">
                                                                    <label for="annualDepreciation" class="col-sm-5 text-right control-label col-form-label">Annual Depreciation (in %)</label>
                                                                    <div class="col-md-7">
                                                                        <input type="number" class="form-control" id="annualDepreciation" name="annual_dep" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group row">
                                                                    <label for="current_price" class="col-sm-5 text-right control-label col-form-label">Current Price</label>
                                                                    <div class="col-md-7">
                                                                        <input type="number" class="form-control" id="current_price" name="current_price" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group row">
                                                                    <label for="barcode" class="col-sm-5 text-right control-label col-form-label">Scan BarCode</label>
                                                                    <div class="col-md-7">
                                                                        <input type="text" class="form-control" id="barcode" name="barcode" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group row">
                                                                    <label for="remarks" class="col-sm-5 text-right control-label col-form-label">Any Remarks</label>
                                                                    <div class="col-md-7">
                                                                        <input type="text" class="form-control" id="remarks" name="remarks" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                <div class="border-top">
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-success">Submit</button>
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
     <!-- Include jQuery -->
     {{-- <script>
        $(document).ready(function () {
            // Listen for changes to the radio buttons
            $('input[name="hasSerial"]').on('change', function () {
                if ($(this).val() === 'yes') {
                    // Show the serial number field if "No" is selected
                    $('#serialNumberField').removeClass('d-none');
                } else {
                    // Hide the serial number field if "Yes" is selected
                    $('#serialNumberField').addClass('d-none');
                    // Clear the input value
                    $('#serialNoInput').val('');
                }
            });
        });
    </script> --}}

    <script>
        $(document).ready(function () {
            // Listen for changes to the radio buttons
            $('input[name="hasSerial"]').on('change', function () {
                if ($(this).val() === 'yes') {
                    const qty = parseInt($('#qty').val()); // Get the quantity value
                    if (!isNaN(qty) && qty > 0) {
                        generateSerialFields(qty); // Generate serial fields
                    } else {
                        alert('Please enter a valid Product Quantity first.');
                        $('input[name="hasSerial"][value="no"]').prop('checked', true); // Reset to "No"
                    }
                } else {
                    $('#serialNumbersContainer').addClass('d-none'); // Hide serial fields
                    $('#serialFields').html(''); // Clear the fields
                }
            });
    
            // Function to generate serial number fields
            function generateSerialFields(qty) {
                const serialFields = $('#serialFields');
                serialFields.html(''); // Clear existing serial fields
    
                // Create input fields dynamically
                for (let i = 1; i <= qty; i++) {
                    const inputField = `
                        <input type="text" class="form-control mb-2 mr-2 d-inline-block" 
                               style="width: calc(15% - 10px);" 
                               name="serialNo[]" 
                               placeholder="Serial No ${i}">
                    `;
                    serialFields.append(inputField);
    
                    // Ensure new row after every 6 inputs
                    if (i % 6 === 0) {
                        serialFields.append('<div class="w-100"></div>');
                    }
                }
    
                $('#serialNumbersContainer').removeClass('d-none'); // Show container
            }
        });
    </script>
</body>

</html>