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
    <title>Add Product</title>
    <!-- Custom CSS -->
    @include('admin.dashboard.common.header_lib')
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
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        @include('admin.dashboard.common.header')
       
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Add Product</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add Vehicle</li>
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
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <div class="card">
                            <form action="{{ route('add.items') }}" method="POST"> 
                                @csrf
                              
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label class="control-label">Product Name</label>
                                            <input class="form-control form-white" placeholder="Enter name" type="text" name="p_name" />
                                        </div>
                                        <div class="col-md-4">
                                            <label class="control-label">Product Qty</label>
                                            <input class="form-control form-white" placeholder="Enter Qty" type="number" name="p_qty" />
                                        </div>
                                    </div><br>
                                    
                                    <div class="row mb-3">
                                        <div class="col-md-10">
                                            <h5>Accessory Details</h5>
                                        </div>
                                        <div class="col-md-2 text-end">
                                            <button type="button" id="add-row" class="btn btn-sm btn-primary">Add More</button>
                                        </div>
                                    </div>
                                    
                                    <div id="">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="control-label">Accessory Name</label>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="control-label"> Qty</label>
                                            </div>
                                            <div class="col-md-3"> 
                                                <label class="control-label"> Accessory issued per unit</label>
                                            </div>
                                        </div>
                                    </div>
        
                                    <div id="accessory-container">
                                        <div class="row accessory-row mb-3">
                                            <div class="col-md-6">
                                                <input class="form-control form-white" placeholder="Enter name" type="text" name="acc_name[]" />
                                            </div>
                                            <div class="col-md-3">
                                                <input class="form-control form-white" placeholder="Enter Qty" type="number" name="acc_qty[]" />
                                            </div>
                                            <div class="col-md-3"> 
                                                <input class="form-control form-white" placeholder="Issued Qty" type="number" name="issued_qty[]" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-danger waves-effect waves-light">Save</button>
                                    <button type="button" class="btn btn-secondary waves-effect " data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>

 
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            @include('admin.dashboard.common.footer')
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>

    @include('admin.dashboard.common.footer_lib')
    <script>
        $(".select2").select2();
    </script>

<script>
    $(document).ready(function() {
        $('#add-row').click(function() {
            let newRow = $('.accessory-row').first().clone();
            newRow.find('input').val(''); // Clear input values
            $('#accessory-container').append(newRow); // Append new row
        });
    });
    </script>
    

</body>

</html>