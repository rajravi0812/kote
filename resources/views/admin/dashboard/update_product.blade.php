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
    <title>Update Product</title>
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
                        <h4 class="page-title">Update Product</h4>
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
                            <form action="{{ route('update.product', ['id' => $product->id]) }}" method="POST">
                                @csrf
                                @method('PUT')
                            
                                <!-- Product Details -->
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label class="control-label">Product ID</label>
                                            <input class="form-control" type="text" value="{{ $product->product_id }}" readonly />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label">Product Name</label>
                                            <input class="form-control" type="text" name="p_name" value="{{ $product->product_name }}" required />
                                        </div>
                                        <div class="col-md-4">
                                            <label class="control-label">Product Quantity</label>
                                            <input class="form-control" type="number" name="p_qty" value="{{ $product->product_qty }}" required />
                                        </div>
                                    </div>

                            
                                    <hr>
                            
                                    <!-- Accessories Section -->
                                    <h5>Accessory Details</h5>
                                    <div id="accessory-container">
                                        @foreach ($accessories as $accessory)
                                            <div class="row accessory-row mb-3" id="accessory-row-{{ $accessory['acc_id'] }}">
                                                <div class="col-md-2">
                                                    <label>Accessory ID</label>
                                                    <input class="form-control" type="text" value="{{ $accessory['acc_id'] }}" readonly />
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Accessory Name</label>
                                                    <input class="form-control" type="text" name="acc_name[]" value="{{ $accessory['acc_name'] }}" required />
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Accessory Quantity</label>
                                                    <input class="form-control" type="number" name="acc_qty[]" value="{{ $accessory['acc_qty'] }}" required />
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Accessory issued per unit</label>
                                                    <input class="form-control" type="number" name="issued_qty[]" value="{{ $accessory['issued_qty'] }}" required />
                                                </div>
                                                <div class="col-md-1" style="margin-top:28px">
                                                    <a href="{{ route('delete.accessory', $accessory['id']) }}" 
                                                       onclick="event.preventDefault(); 
                                                       if(confirm('Are you sure you want to delete this accessory?')) {
                                                           window.location.href='{{ route('delete.accessory', $accessory['id']) }}';
                                                       }" 
                                                       class="btn btn-link">Delete</a>
                                                </div>
                                                
                                                <input type="hidden" name="acc_id[]" value="{{ $accessory['acc_id'] }}" /> <!-- Hidden field to track accessory ID -->
                                            </div>
                                        @endforeach
                                    </div>
                                    
                                </div>
                            
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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

<script>
    $(document).on('click', '.delete-accessory', function() {
        var accessoryId = $(this).data('id');
        var row = $('#accessory-row-' + accessoryId);
    
        if (confirm('Are you sure you want to delete this accessory?')) {
            $.ajax({
                url: '/accessory/' + accessoryId,
                type: 'DELETE',
                success: function(response) {
                    console.log(response);
                    if (response.success) {
                        row.remove(); // Remove the row from the DOM
                        alert(response.message); // Show success message
                    } else {
                        alert(response.message); // Show error message
                    }
                },
                error: function(xhr) {
                    alert('An error occurred while deleting the accessory.');
                }
            });
        }
    });
    </script>
    

</body>

</html>