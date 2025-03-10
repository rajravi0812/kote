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
    <title>Product List</title>
    <!-- Custom CSS -->
    @include('admin.dashboard.common.header_lib')
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
                        <h4 class="page-title">Products List</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Products List</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                {{-- <a style="float:right" href="{{ route('assign.form')}}"  type="button" class="btn btn-success btn-sm m-2">New</a> --}}
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered table-sm">
                                        <thead class="bg-cyan" style="color:white;">
                                            <tr>
                                                <th><center><b>S.No</b></center></th>
                                                <th><center><b>Product Name</b></center></th>
                                                <th><center><b>Product Cat</b></center></th>
                                                {{-- <th><center><b>Image</b></center></th> --}}
                                                <th><center><b>Fund Type</b></center></th>
                                                <th><center><b>Fund Sub-Cat</b></center></th>
                                                <th><center><b>Product Qty</b></center></th>
                                                <th><center><b>Qty Issued</b></center></th>
                                                <th><center><b>Action</b></center></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(!empty($product_list))
                                            @foreach($product_list as $product)
                                            <tr>
                                                <td><center>{{ ($product_list->currentPage() - 1) * $product_list->perPage() + $loop->iteration }}</center></td>
                                                <td><center>{{ $product->product_name }}</center></td>
                                                <td><center>{{ $product->p_cat_name }}</center></td>
                                                {{-- <td><center><img src="{{ url('storage/app/public/' . $product->product_img) }}" alt="Product Image" width="50"></center></td> --}}
                                                <td><center>{{ $product->fund_cat_name }}</center></td>
                                                <td><center>{{ $product->fund_subcat_name }}</center></td>
                                                <td><center>{{ $product->product_qty}}</center></td>
                                                <td><center>{{ $product->issued_qty}}</center></td>
                                                <td><center>
                                                    {{-- <a class="btn btn-success" href="{{route('product.view',['id' => $product->id])}}">View</a> --}}
                                                    <a class="btn btn-sm btn-primary" href="{{route('issue.products',['id' => $product->id])}}">Issue</a>
                                                    <a class="btn btn-sm btn-warning" href="{{route('edit.assign.form',['id'=>$product->id])}}">Edit</a>
                                                    <a class="btn btn-sm btn-success" href="#">View</a>
                                                </center></td>
                                            </tr>
                                            @endforeach
                                            @else
                                            <td colspan="23"><center>No Data Found</center></td>
                                            @endif
                                        </tbody>
                                    </table>
                                    <div class="pagination" style="float:right;">
                                        {!! $product_list->links() !!}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                  
                </div>
            </div>



            {{-- <div class="modal fade none-border" id="delete-event">
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
            </div> --}}


                        <!-- Accessory Details Modal -->
            <!-- Product Details Modal -->
            <div class="modal fade" id="productDetailsModal">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="productDetailsModalLabel">Product Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="productDetailsContainer"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
</body>

</html>