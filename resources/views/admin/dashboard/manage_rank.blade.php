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
    <title>Manage Product Category</title>
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
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Manage Rank</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Manage Rank</li>
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
                                {{-- <h5 class="card-title">Category List</h5> --}}
                                <button style="float:right"  type="button" data-toggle="modal" data-target="#add-new-event"  class="btn btn-success btn-sm m-2">Add</button>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th><center><b>S.No</b></center></th>
                                                <th><center><b>Rank</b></center></th>
                                                <th><center><b>Action</b></center></th>
                                            
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(!empty($veh_cat))
                                            @foreach($veh_cat as $request)
                                            <tr>
                                                <td><center>{{ ($veh_cat->currentPage() - 1) * $veh_cat->perPage() + $loop->iteration }}</center></td>
                                                <td id="cat_{{ $request->id }}"><center>{{ $request->rank_name }}</center></td>
                                                <td><center>
                                                    <input type="hidden" id="sort_{{ $request->id }}" rel="{{ $request->sort }}"/>
                                                    <button rel="{{ $request->id }}" type="button" data-toggle="modal" data-target="#add-edit-event"  class="btn btn-primary btn-sm edit-data">Edit</button>
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
                                    <div class="pagination" style="float:right;">
                                        {!! $veh_cat->links() !!}
                                    </div>
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
                    <form action="{{ route('add.rank') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h4 class="modal-title"><strong>Add</strong> Rank</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            
                                <div class="row">
                                    <div class="col-md-8">
                                        <label class="control-label">Rank </label>
                                        <input class="form-control form-white" placeholder="Enter Rank" type="text" name="item_category_name" />
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label">Sort</label>
                                        <input type="number" class="form-control form-white" placeholder=" Sort Order" type="text" name="sort" />
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
            </div>

            <div class="modal fade none-border" id="add-edit-event">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <form action="{{ route('update.rank') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h4 class="modal-title"><strong>Edit</strong> Rank</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            
                               
                                <div class="row">
                                    <div class="col-md-8">
                                        <label class="control-label">Rank </label>
                                        <input class="form-control form-white" placeholder="Enter name" type="text" id="category_name" name="category_name" />
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label">Sort</label>
                                        <input type="number" class="form-control form-white" placeholder=" Sort Order" type="text" id="edit_sort" name="edit_sort" />
                                    </div>
                                    {{-- <div class="col-md-4">
                                        <label class="control-label">Status</label>
                                        <select class="form-control form-white" data-placeholder="Status" id="category_status" name="category_status">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div> --}}
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
            </div>

            <div class="modal fade none-border" id="delete-event">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><strong>Delete</strong> Rank</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            Are You Sure Want to Delete
                        </div>
                        <div class="modal-footer">
                            <form action="{{ route('delete.rank') }}" method="POST">
                                @csrf
                              <input type='hidden' id="del_id" value="" name="del_id">  
                              <button type="button" class="btn btn-secondary waves-effect " data-dismiss="modal">No</button>
                              <button type="submit" class="btn btn-primary">Yes</button>
                            </form>
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
                let sort = $("#sort_" + id).attr("rel");
                let cat_name = $("#cat_" + id).text();
                console.log(sort);
                $('#category_name').val(cat_name);
                $('#cat_id').val(id);
                $('#edit_sort').val(sort);
                // console.log(cat_name,id,status_code);
            });
            $('.btn-delete').click(function(){
                let del_id = $(this).attr('rel');
                $('#del_id').val(del_id);
                console.log(del_id);
            })
        });
    </script>
</body>

</html>