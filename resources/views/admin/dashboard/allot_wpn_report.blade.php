<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>Allotment List</title>
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
                        <h4 class="page-title">Wpn Allotment List</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Wpn Allotment List</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <form method="GET" action="">
                           
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <input type="text" name="emp_id" id="emp_id" class="form-control"
                                           value="{{ $filters['emp_id'] ?? '' }}" placeholder="Enter Id No">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="name" id="name" class="form-control"
                                           value="{{ $filters['name'] ?? '' }}" placeholder="Enter Name">
                                </div>
                                <div class="col-md-2">
                                      <select name="rank" id="rank" class="form-control">
                                        <option value="">All Ranks</option>
                                        @foreach($ranks as $rank)
                                            <option value="{{ $rank->id }}" {{ ($filters['rank'] ?? '') == $rank->id ? 'selected' : '' }}>
                                                {{ $rank->rank_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select name="unit" id="unit" class="form-control">
                                        <option value="">All Unit</option>
                                        @foreach($units as $unit)
                                            <option value="{{ $unit->id }}" {{ ($filters['unit'] ?? '') == $unit->id ? 'selected' : '' }}>
                                                {{ $unit->unit_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select name="company" id="company" class="form-control">
                                        <option value="">All Companies</option>
                                        @foreach($companies as $company)
                                            <option value="{{ $company->id }}" {{ ($filters['company'] ?? '') == $company->id ? 'selected' : '' }}>
                                                {{ $company->company_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                                    <a href="{{ route('allot.wpn.report') }}" class="btn btn-secondary btn-sm">Reset</a>
                                    <a href="{{ route('allot.wpn.report', array_merge(request()->all(), ['export_excel' => true])) }}" class="btn btn-success btn-sm">
    Excel
</a>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
                
                

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <p>Total Records: </p>
                                {{-- <a style="float:right" href="{{ route('assign.form')}}"  type="button" class="btn btn-success btn-sm m-2">New</a> --}}
                                <div class="table-responsive">
                                   <table class="table table-bordered table-sm table-striped table-hover">
    <thead class="bg-cyan" style="color:white">
        <tr>
            <th><b>S.No</b></th>
            <th><b>Emp ID</b></th>
            <th><b>Name</b></th>
            <th><b>Mobile</b></th>
            <th><b>Status</b></th>
     
            <th><b>Rank Name</b></th>
            <th><b>Unit Name</b></th>
            <th><b>Company Name</b></th>
            
        
            <th><b>Weapon Tag</b></th>
            <th><b>Weapon Type</b></th>
            <th><b>Regd No.</b></th>
            <th><b>Butt No.</b></th>
            <th><b>Assign Type</b></th>
        
           
        </tr>
    </thead>
    <tbody>
        @if($employees->isNotEmpty())
            @foreach($employees as $key => $employee)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $employee->emp_id }}</td>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->mobile ?? 'N/A' }}</td>
                    <td>{{ $employee->status == 1 ? 'Active' : 'Inactive' }}</td>
                   
                    <td>{{ $employee->rank_name ?? 'N/A' }}</td>
                    <td>{{ $employee->unit_name }}</td>
                    <td>{{ $employee->company_name }}</td>
                   
                    <td>{{ $employee->wpn_tag }}</td>
                    <td>{{ $employee->wpn_types->type }}</td>
                    <td>{{ $employee->regd_no }}</td>
                    <td>{{ $employee->butt_no }}</td>
                    <td>{{ $employee->assign_type }}</td>
          
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="13"><center>No Data Found</center></td>
            </tr>
        @endif
    </tbody>
</table>

                                    <div class="pagination" style="float:right;">
                                        {!! $employees->links() !!}
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