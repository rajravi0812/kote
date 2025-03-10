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
    <title>Weapon Issue History</title>
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
                        <h4 class="page-title">Indl List</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Indl List</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                
                    </div>
                </div>
                
                
                

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <p>Total Records: </p>
                                {{-- <a style="float:right" href="{{ route('assign.form')}}"  type="button" class="btn btn-success btn-sm m-2">New</a> --}}
                                <div class="table-responsive">
                                  <table id="zero_config" class="table table-striped table-bordered table-sm">
    <thead class="bg-cyan" style="color:white;">
        <tr>
            <th class="font-sm"><center><b>S.No</b></center></th>
            <th class="font-sm"><center><b>Name</b></center></th>
            <th class="font-sm"><center><b>Wpn Tag</b></center></th>
            <th class="font-sm"><center><b>Butt No.</b></center></th>
            <th class="font-sm"><center><b>Regd No.</b></center></th>
            <th class="font-sm"><center><b>Weapon Type</b></center></th>
            <th class="font-sm"><center><b>Nature</b></center></th>
            <th class="font-sm"><center><b>Purpose</b></center></th>
            <th class="font-sm"><center><b>Mag Issued</b></center></th>
            <th class="font-sm"><center><b>Mag Return</b></center></th>
            <th class="font-sm"><center><b>Slings Issued</b></center></th>
            <th class="font-sm"><center><b>Slings REturn</b></center></th>
            <th class="font-sm"><center><b>Bayonet Issued</b></center></th>
            <th class="font-sm"><center><b>Bayonet Return</b></center></th>
            <th class="font-sm"><center><b>Issued Date</b></center></th>
            <th class="font-sm"><center><b>Return Date</b></center></th>
           
        </tr>
    </thead>
    <tbody>
   @if($records->isEmpty())
    <tr>
        <td colspan="16"><center><b>No Records Found</b></center></td>
    </tr>
@else
    @foreach($records as $record)
    <tr>
        <td><center>{{ $loop->iteration }}</center></td>
        <td><center>{{ $record->emp_name }}</center></td>
        <td><center>{{ $record->wpn_tag }}</center></td>
        <td><center>{{ $record->butt_no }}</center></td>
        <td><center>{{ $record->regd_no }}</center></td>
        <td><center>{{ $record->type }}</center></td>
        <td><center>{{ $record->nature == 0 ? "Less than 24 Hr." : "More than 24 Hr." }}</center></td>
        <td><center>{{ $record->purpose }}</center></td>
        <td><center>{{ $record->megazins }}</center></td>
        <td><center>{{ $record->ret_megazins }}</center></td>
        <td><center>{{ $record->slings }}</center></td>
        <td><center>{{ $record->ret_slings }}</center></td>
        <td><center>{{ $record->bayonet }}</center></td>
        <td><center>{{ $record->ret_bayonet }}</center></td>
        <td><center>{{ $record->created_at }}</center></td>
        <td><center>{{ $record->return_date }}</center></td>
    </tr>
    @endforeach
@endif

    </tbody>
</table>

                                    <div class="pagination" style="float:right;">
                                        {!! $records->links() !!}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal fade none-border" id="delete-event">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title"><strong>Delete</strong> Employee</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                </div>
                                <div class="modal-body">
                                    Are You Sure Want to Delete
                                </div>
                                <div class="modal-footer">
                                    <form action="{{ route('delete.indl') }}" method="POST">
                                        @csrf
                                      <input type='hidden' id="del_id" value="" name="del_id">  
                                      <button type="button" class="btn btn-secondary waves-effect " data-dismiss="modal">No</button>
                                      <button type="submit" class="btn btn-primary">Yes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('admin.dashboard.common.footer')
        </div>
    </div>
    @include('admin.dashboard.common.footer_lib')

     <!-- bootstrap modal -->

  

  

     <!-- end modal  -->


</body>

</html>