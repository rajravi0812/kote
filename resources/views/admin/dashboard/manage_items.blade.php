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
    <title>Manage Items</title>
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
                        <h4 class="page-title">Manage Items</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Manage Items</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <a style="float:right" href="{{ route('add.product')}}"  type="button" class="btn btn-success btn-sm m-2">Add</a>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th><center><b>S.No</b></center></th>
                                                <th><center><b>Product Name</b></center></th>
                                                <th><center><b>Product ID</b></center></th>
                                                <th><center><b>Product Qty</b></center></th>
                                                <th><center><b>Accessories</b></center></th>
                                                <th><center><b>Action</b></center></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(!empty($item))
                                            @foreach($item as $request)
                                            <tr>
                                                <td><center>{{ ($item->currentPage() - 1) * $item->perPage() + $loop->iteration }}</center></td>
                                                <td id="cat_{{ $request->id }}"><center>{{ $request->product_name }}</center></td>
                                                <td id="{{ $request->id }}"><center>{{ $request->product_id}}</center></td>
                                                <td id="cat_{{ $request->id }}"><center>{{ $request->product_qty }}</center></td>
                                                @php
                                                     $productId = $request->id; // Replace this with the correct product ID variable if necessary.
                                                    $accessoryCount = \DB::table('accessory')
                                                                        ->where('p_id', $productId) 
                                                                        ->count();

                                                    $accessories = \DB::table('accessory')
                                                                    ->where('p_id', $productId) 
                                                                    ->get();
                                                @endphp
                                                <td id="cat_{{ $request->id }}">
                                                    <center>
                                                            {{ $accessoryCount }}
                                                           (<a href="javascript:void(0);" class="view-accessories" data-id="{{ $request->id }}">view
                                                        </a>)
                                                    </center>
                                                </td>
                                                
                                                <td><center>
                                                    <a href="{{ route('edit.product', ['id' => $request->id]) }}" type="button" class="btn btn-primary btn-sm edit-data">Edit</a>
                                                    <button rel="{{ $request->id }}" type="button" class="btn btn-danger btn-sm btn-delete" data-toggle="modal" data-target="#delete-event" >Delete</button>
                                                </center>
                                            </td>
                                            </tr>
                                            @endforeach
                                            @else
                                            <td colspan="4"><center>No Data Found</center></td>
                                            @endif
                                        </tbody>
                                       
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>

            <div class="modal fade none-border" id="add-new-event">
                <div class="modal-dialog">
                    <div class="modal-content">
                    {{-- <form action="{{ route('add.items') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h4 class="modal-title"><strong>Add</strong> a Product</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
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
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="control-label">Product Name</label>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">Product Qty</label>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">Issued Qty</label>
                                    </div>
                                </div>
                                <div id="accessory-container">
                                    <div class="row accessory-row mb-3">
                                        <div class="col-md-6">
                                            <input class="form-control form-white" placeholder="Enter name" type="text" name="p_name[]" />
                                        </div>
                                        <div class="col-md-3">
                                            <input class="form-control form-white" placeholder="Enter Qty" type="number" name="p_qty[]" />
                                        </div>
                                        <div class="col-md-3"> 
                                            <input class="form-control form-white" placeholder="Enter Qty" type="number" name="issued_qty[]" />
                                        </div>
                                    </div>
                                </div>
                                
                            
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger waves-effect waves-light">Save</button>
                            <button type="button" class="btn btn-secondary waves-effect " data-dismiss="modal">Close</button>
                        </div>
                    </form> --}}


                   


                    </div>
                </div>
            </div>

            {{-- <div class="modal fade none-border" id="add-edit-event">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <form action="{{ route('update.items') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h4 class="modal-title"><strong>Edit</strong>  Product</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            
                               
                                <div class="row">
                                    <div class="col-md-8">
                                        <label class="control-label">Product Name</label>
                                        <input class="form-control form-white" placeholder="Enter name" type="text" id="category_name" name="category_name" />
                                    </div>
                                    
                                </div>
                           
                        </div>
                        <div class="modal-footer">
                            <input type='hidden' id="cat_id" value="" name="cat_id">  
                            <button type="submit" class="btn btn-danger waves-effect waves-light ">Save</button>
                            <button type="button" class="btn btn-secondary waves-effect " data-dismiss="modal">Close</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div> --}}

            <div class="modal fade none-border" id="delete-event">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><strong>Delete</strong> Product</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            Are You Sure Want to Delete
                        </div>
                        <div class="modal-footer">
                            <form action="{{ route('delete.items') }}" method="POST">
                                @csrf
                              <input type='hidden' id="del_id" value="" name="del_id">  
                              <button type="button" class="btn btn-secondary waves-effect " data-dismiss="modal">No</button>
                              <button type="submit" class="btn btn-primary">Yes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


                        <!-- Accessory Details Modal -->
            <div class="modal fade" id="accessoryModal"  >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="accessoryModalLabel">Accessory Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="accessoryDetails"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
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
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    @include('admin.dashboard.common.footer_lib')

    <script>
         $(document).ready(function(){
            // console.log("testing")
            $('.edit-data').click(function(){
                let id = $(this).attr("rel");
                let cat_name = $("#cat_" + id).text();

                $('#category_name').val(cat_name);
                $('#cat_id').val(id);
                // console.log(cat_name,id,status_code);
            });
            $('.btn-delete').click(function(){
                let del_id = $(this).attr('rel');
                $('#del_id').val(del_id);
                console.log(del_id);
            })
        });
    </script>

        <script>
    $(document).ready(function() {
        $('.view-accessories').on('click', function() {
            var productId = $(this).data('id');

            // AJAX request to fetch accessory details
            $.ajax({
                url: '{{ route('accessories', '') }}/' + productId,
                method: 'GET',
                success: function(data) {
                    // Populate the modal with accessory details
                    var detailsHtml = '<table class="table table-bordered"><thead><tr><th>Accessory ID</th><th>Name</th><th>Quantity</th><th>Issued Quantity</th></tr></thead><tbody>';
                    data.forEach(function(accessory) {
                        console.log(accessory);
                        detailsHtml += '<tr>'; // Start a new table row
                        detailsHtml += '<td>' + accessory.acc_id + '</td>'; // Accessory ID
                        detailsHtml += '<td>' + accessory.acc_name + '</td>'; // Accessory Name
                        detailsHtml += '<td>' + accessory.acc_qty + '</td>'; // Accessory Quantity
                        detailsHtml += '<td>' + accessory.issued_qty + '</td>'; // Issued Quantity
                        detailsHtml += '</tr>'; // End the table row
                    });
                    detailsHtml += '</tbody></table>'; // Close the tbody and table tags


                    $('#accessoryDetails').html(detailsHtml);
                    $('#accessoryModal').modal('show'); // Show the modal
                },
                error: function(xhr) {
                    console.error('Error fetching accessory details:', xhr);
                }
            });
        });
    });
</script>



</body>

</html>