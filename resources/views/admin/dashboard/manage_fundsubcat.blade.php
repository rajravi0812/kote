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
    <title>Fund Sub Cat</title>
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
        <!-- ============================================================== -->
       
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Manage Fund Sub-Category</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Sub Cat</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
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
                                                <th><center><b>Fund Cat Name</b></center></th>
                                                <th><center><b>Fund SubCat Name</b></center></th>
                                                <th><center><b>Action</b></center></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(!empty($formationUnits))
                                            @foreach($formationUnits as $request)
                                            <tr>
                                                <td><center>{{ ($formationUnits->currentPage() - 1) * $formationUnits->perPage() + $loop->iteration }}</center></td>
                                                <td id="f_{{ $request->id }}" rel="{{ $request->fund_cat_id }}"><center>{{ $request->fund_cat_name }}</center></td>
                                                <td id="f_name_{{ $request->id }}"><center>{{ $request->fund_subcat_name}}</center></td>
                                                <td><center>
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
                    <form action="{{ route('add.fund.subcat') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h4 class="modal-title"><strong>Add</strong> Fund subcat</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            
                                <div class="row">
                                    <div class="col-md-8">
                                        <label class="control-label">Fund Category</label>
                                        <select class="form-control form-white" placeholder="Enter name" type="text" name="f_id">
                                            @foreach ($formations as $formation)
                                                <option value="{{$formation->id}}">{{$formation->fund_cat_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <label class="control-label">Fund Sub-Cat Name</label>
                                        <input class="form-control form-white" placeholder="Enter name" type="text" name="f_unit_name" />
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
                    <form action="{{ route('update.fund.subcat') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h4 class="modal-title"><strong>Edit</strong> Fund Sub-Cayegory</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            
                            <div class="row">
                                <div class="col-md-8">
                                    <label class="control-label">Fund Category</label>
                                    <select class="form-control form-white" placeholder="Enter name" id="edit_f_id" type="text" name="edit_f_id">
                                        @foreach ($formations as $formation)
                                            <option value="{{$formation->id}}" >{{$formation->fund_cat_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <label class="control-label">Fund SubCat Name</label>
                                    <input class="form-control form-white" value="" id="edit_f_unit_name" placeholder="Enter name" type="text" name="edit_f_unit_name" />
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
            </div>

            <div class="modal fade none-border" id="delete-event">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><strong>Delete</strong> Fund Sub-Category</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            Are You Sure Want to Delete
                        </div>
                        <div class="modal-footer">
                            <form action="{{ route('delete.fund.subcat') }}" method="POST">
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
            console.log("testing")
            $('.edit-data').click(function(){
                let id = $(this).attr("rel");
                let f_id = $("#f_" + id).attr("rel");
                let unit_name = $("#f_name_" + id).text();
                console.log(f_id);
                $('#edit_f_id').val(f_id);
                $('#edit_f_unit_name').val(unit_name);
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
</body>

</html>