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
    <title>Manage User</title>
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
                        <h4 class="page-title">Manage User</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Manage User</li>
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
                                                <th><center><b>Name</b></center></th>
                                                <th><center><b>Username</b></center></th>
                                                <th><center><b>Role</b></center></th>
                                                <th><center><b>Action</b></center></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(!empty($user))
                                            @foreach($user as $request)
                                            @php
                                                $roles = [
                                                    1 => 'Admin',
                                                    2 => 'User',
                                                
                                                ];
                                            @endphp

                                            <tr>
                                                <td><center>{{ ($user->currentPage() - 1) * $user->perPage() + $loop->iteration }}</center></td>
                                                <td id="name_{{ $request->id }}"><center>{{ $request->username }}</center></td>
                                                <td id="user_{{ $request->id }}"><center>{{ $request->email }}</center></td>
                                                <td id="role_{{ $request->id }}" rel="{{$request->role_id}}"><center>{{ $roles[$request->role_id] ?? 'Unknown Role' }}</center></td>
                                                {{-- <input type="hidden"  id="password_{{$request->id}}" value="{{$request->password}}"> --}}
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
                    <form action="{{ route('add.user') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h4 class="modal-title"><strong>Add</strong> User</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            
                                <div class="row">
                                    <div class="col-md-8">
                                        <label class="control-label">Name</label>
                                        <input class="form-control form-white" placeholder="Enter name" type="text" name="name" />
                                    </div>

                                    <div class="col-md-8">
                                        <label class="control-label">Username</label>
                                        <input class="form-control form-white" placeholder="Enter Username" type="text" name="username" />
                                    </div>

                                    <div class="col-md-8">
                                        <label class="control-label">Password</label>
                                        <input class="form-control form-white" placeholder="Enter Password" type="password" name="password" />
                                    </div>

                                    <div class="col-md-8">
                                        <label class="control-label">Role</label>
                                        <select class="form-control form-white" name="role" >
                                            <option>---Select---</option>
                                            <option value="1">Admin</option>
                                            <option value="2">User</option>
                                                                                </select>
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
                    <form action="{{ route('update.user') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h4 class="modal-title"><strong>Edit</strong> Store</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            
                            <div class="row">
                                <div class="col-md-8">
                                    <label class="control-label">Name</label>
                                    <input class="form-control form-white" placeholder="Enter name" type="text" id="edit_name" name="edit_name" />
                                </div>

                                <div class="col-md-8">
                                    <label class="control-label">Username</label>
                                    <input class="form-control form-white" placeholder="Enter Username" type="text" id="edit_user" name="edit_username" />
                                </div>

                                <div class="col-md-8">
                                    <label class="control-label">Password</label>
                                    <input class="form-control form-white" placeholder="Enter Password" type="password" id="edit_pass" name="edit_password" />
                                </div>

                                <div class="col-md-8">
                                    <label class="control-label">Role</label>
                                    <select class="form-control form-white" name="edit_role" id="edit_role" >
                                        <option>---Select---</option>
                                        <option value="1">Admin</option>
                                        <option value="2">User</option>
                                      
                                    </select>
                                </div>
                               
                            </div>
                           
                        </div>
                        <div class="modal-footer">
                            <input type='hidden' id="cat_id" value="" name="id">  
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
                            <h4 class="modal-title"><strong>Delete</strong> Store</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            Are You Sure Want to Delete
                        </div>
                        <div class="modal-footer">
                            <form action="{{ route('delete.user') }}" method="POST">
                                @csrf
                              <input type='hidden' id="del_id" value="" name="del_id">  
                              <button type="button" class="btn btn-secondary waves-effect " data-dismiss="modal">No</button>
                              <button type="submit" class="btn btn-primary">Yes</button>
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
         $(document).ready(function(){
            // console.log("testing")
            $('.edit-data').click(function(){
                let id = $(this).attr("rel");
                let name = $("#name_" + id).text();
                let user = $("#user_" + id).text();
                let role = $("#role_" + id).attr("rel");
                // let pass = $("#password_" + id).val();

                $('#edit_name').val(name);
                $('#edit_user').val(user);
                $('#edit_role').val(role);
                $('#cat_id').val(id);
                // $('#edit_pass').val(pass);
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