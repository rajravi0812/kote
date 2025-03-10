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
    <title>Master Report</title>
    <!-- Custom CSS -->
    @include('admin.dashboard.common.header_lib')
    <style>
       
        table th, table td {
            white-space: nowrap;
         
        }
        .table-container {
            overflow-x: auto;
        }
        .font-sm{
            font-size: 12px;
        }

        .select2-container .select2-selection--single {
             height: 35px; 
            /* width: 280px; */
            display: flex;
            
            border:0;
            align-items: center; /* Center the text */
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            font-size: 14px; /* Optional: Adjust text size */
            padding: 5px 0px 0px 10px; /* Optional: Add padding */
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
           height: 35px; 
            /* border: 0;
            width: 150px; */ 
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
                        <h4 class="page-title">Dashboard</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Master Report</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="">
                    <h3 class="mb-4">Master Report</h3>
                    {{-- <form action="{{ route("master.report")}}" method="GET">
                        @csrf
                    <div class="row g-3 mb-4">
                        <div class="col-md-2 mb-3 mb-3">
                            <input type="text" class="form-control" placeholder="Name">
                        </div>
                        <div class="col-md-2 mb-3">
                            <select class="form-select form-control select21" name="emp_id">
                                <option value=""></option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->emp_id}}">{{$employee->emp_id}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 mb-3 ">
                            <select class="form-select form-control select22 mx-2" name="rank">
                                <option value=""></option>
                                @foreach ($ranks as $rank)
                                    <option value="{{ $rank->id}}">{{$rank->rank_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <select class="form-select form-control" name="nature">
                                <option value="">Select Nature</option>
                                <option value="0">Less Than 24Hr</option>
                                <option value="1">More Than 24Hr</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <select class="form-select form-control" name="purpose">
                                <option value="">Select Purpose</option>
                                <option value="Maintenance">Maintenance</option>
                                <option value="Firing">Firing</option>
                                <option value="Guard Duties">Guard Duties</option>
                                <option value="BPET">BPET</option>
                                <option value="Out Stn">Out Stn</option>
                                <option value="R1">R1</option>
                                <option value="R1">R2</option>
                                <option value="R1">R4</option>
                                <option value="Before Insp">Before Insp</option>
                                <option value="After Insp">After Insp</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <select class="form-select form-control select23" name="wpn_type">
                                <option value=""></option>
                                @foreach ($wpn_types as $wpn_type)
                                    <option value="{{ $wpn_type->id}}">{{$wpn_type->type}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <input type="text" class="form-control" placeholder="Regd No" name="regd_no" >
                        </div>
                        <div class="col-md-2 mb-3">
                            <input type="text" class="form-control" placeholder="Butt No" name="butt_no">
                        </div>
                        <div class="col-md-2 mb-3">
                            <select class="form-select form-control" name="status">
                                <option value="">Status</option>
                                <option value="0">Not Returned</option>
                                <option value="1">Returned</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <input type="date" class="form-control" name="from_date" placeholder="From Date">
                        </div>
                        <div class="col-md-2 mb-3">
                            <input type="date" class="form-control" name="to_date" placeholder="To Date">
                        </div>
                        
                        <div class="col-md-2 text-end mt-1">
                            <button type="submit" class="btn btn-sm btn-primary">Search</button>
                            <a type="reset" class="btn btn-sm btn-secondary" href="{{ route("master.report")}}">Reset</a>
                            <button type="button" class="btn btn-sm btn-warning">Export</button>
                        </div>
                    </div>
                    </form> --}}
                    
                    <form action="{{ route('master.report') }}" method="GET">
                        <div class="row g-3 mb-4">
                            <div class="col-md-2 mb-3">
                                <input type="text" class="form-control" name="name" placeholder="Name" value="{{ request('name') }}">
                            </div>
                            <div class="col-md-2 mb-3">
                                <select class="form-select form-control select21" name="emp_id">
                                    <option value="">Select Employee</option>
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->emp_id }}" {{ request('emp_id') == $employee->emp_id ? 'selected' : '' }}>
                                            {{ $employee->emp_id }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <select class="form-select form-control select22" name="rank">
                                    <option value="">Select Rank</option>
                                    @foreach ($ranks as $rank)
                                        <option value="{{ $rank->id }}" {{ request('rank') == $rank->id ? 'selected' : '' }}>
                                            {{ $rank->rank_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <select class="form-select form-control" name="nature">
                                    <option value="">Select Nature</option>
                                    <option value="0" {{ request('nature') == '0' ? 'selected' : '' }}>Less Than 24Hr</option>
                                    <option value="1" {{ request('nature') == '1' ? 'selected' : '' }}>More Than 24Hr</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <select class="form-select form-control" name="purpose">
                                    <option value="">Select Purpose</option>
                                    @foreach(['Maintenance', 'Firing', 'Guard Duties', 'BPET', 'Out Stn', 'R1', 'R2', 'R4', 'Before Insp', 'After Insp'] as $purpose)
                                        <option value="{{ $purpose }}" {{ request('purpose') == $purpose ? 'selected' : '' }}>
                                            {{ $purpose }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <select class="form-select form-control select23" name="wpn_type">
                                    <option value="">Select Weapon Type</option>
                                    @foreach ($wpn_types as $wpn_type)
                                        <option value="{{ $wpn_type->id }}" {{ request('wpn_type') == $wpn_type->id ? 'selected' : '' }}>
                                            {{ $wpn_type->type }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <input type="text" class="form-control" name="regd_no" placeholder="Regd No" value="{{ request('regd_no') }}">
                            </div>
                            <div class="col-md-2 mb-3">
                                <input type="text" class="form-control" name="butt_no" placeholder="Butt No" value="{{ request('butt_no') }}">
                            </div>
                            <div class="col-md-2 mb-3">
                                <select class="form-select form-control" name="status">
                                    <option value="">Status</option>
                                    <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Not Returned</option>
                                    <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Returned</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <input type="date" class="form-control" name="from_date" value="{{ request('from_date') }}">
                            </div>
                            <div class="col-md-2 mb-3">
                                <input type="date" class="form-control" name="to_date" value="{{ request('to_date') }}">
                            </div>
                            <div class="col-md-2 text-end mt-1">
                                <button type="submit" class="btn btn-sm btn-primary">Search</button>
                                <a href="{{ route('master.report') }}" class="btn btn-sm btn-secondary">Reset</a>
                                <button type="submit" name="export_excel" class="btn btn-sm btn-warning">Export</button>
                            </div>
                        </div>
                    </form>
                    
            
                    <div class="table-container">
                        <table class="table table-sm table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th class="font-sm">SR NO.</th>
                                    <th class="font-sm">Date and Time Out</th>
                                    <th class="font-sm">Date and Time In</th>
                                    <th class="font-sm">ID No</th>
                                    <th class="font-sm">Rank</th>
                                    <th class="font-sm">Name</th>
                                    <th class="font-sm">Nature</th>
                                    <th class="font-sm">Purpose</th>
                                    <th class="font-sm">Type of Wpn</th>
                                    <th class="font-sm">Butt No.</th>
                                    <th class="font-sm">Regd No.</th>
                                    <th class="font-sm">Mag Issued</th>
                                    <th class="font-sm">Mag Return</th>
                                    <th class="font-sm">Slings Issued</th>
                                    <th class="font-sm">Slings REturn</th>
                                    <th class="font-sm">Bayonet Issued</th>
                                    <th class="font-sm">Bayonet Return</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($data))
                                @foreach($data as $request)
                                <tr>
                                    <td><center>{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</center></td>
                                    <td id="cat_{{ $request->id }}"><center>{{ $request->created_at }}</center></td>
                                    <td><center>{{ $request->return_date }}</center></td>
                                    <td><center>{{ $request->emp_id }}</center></td>
                                    <td><center>{{ $request->rank_name }}</center></td>
                                    <td><center>{{ $request->emp_name }}</center></td>
                                    <td><center>{{ $request->nature == 0 ? "Less Than 24hr" : "More Than 24hr" }}</center></td>
                                    <td><center>{{ $request->purpose }}</center></td>
                                    <td><center>{{ $request->type }}</center></td>
                                    <td><center>{{ $request->butt_no }}</center></td>
                                    <td><center>{{ $request->regd_no }}</center></td>
                                    <td><center>{{ $request->megazins }}</center></td>
                                    <td><center>{{ $request->ret_megazins }}</center></td>
                                    <td><center>{{ $request->slings }}</center></td>
                                    <td><center>{{ $request->ret_slings }}</center></td>
                                    <td><center>{{ $request->bayonet }}</center></td>
                                    <td><center>{{ $request->ret_bayonet }}</center></td>
                                    {{-- <td><center>
                                        <button rel="{{ $request->id }}" type="button" data-toggle="modal" data-target="#add-edit-event"  class="btn btn-primary btn-sm edit-data">Edit</button>
                                        <button rel="{{ $request->id }}" type="button" class="btn btn-danger btn-sm btn-delete" data-toggle="modal" data-target="#delete-event" >Delete</button>
                                    </center>
                                    </td> --}}
                                </tr>
                                @endforeach
                                @else
                                <td colspan="14"><center>No Data Found</center></td>
                                @endif
                                
                                <!-- Additional rows as needed -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @include('admin.dashboard.common.footer')

        </div>
    </div>

    @include('admin.dashboard.common.footer_lib')
    <script>
        $(document).ready(function() {
            $('.select21').select2({
                placeholder: 'Select ID No',
                allowClear: true
            });
        });
        $(document).ready(function() {
            $('.select22').select2({
                placeholder: 'Select Rank',
                allowClear: true
            });
        });
        $(document).ready(function() {
            $('.select23').select2({
                placeholder: 'Select WPN Type',
                allowClear: true
            });
        });
       
    </script>
    
</body>

</html>