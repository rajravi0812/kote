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
                        <form method="GET" action="{{ route('indl.allot.list') }}">
                            @csrf
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
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                    <a href="{{ route('indl.allot.list') }}" class="btn btn-secondary">Reset</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
                
                

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <p>Total Records: {{$totalRecords}}</p>
                                {{-- <a style="float:right" href="{{ route('assign.form')}}"  type="button" class="btn btn-success btn-sm m-2">New</a> --}}
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered table-sm">
                                        <thead class="bg-cyan" style="color:white;">
                                            <tr>
                                                <th width="5%"><center><b>S.No</b></center></th>
                                                {{-- <th><center><b>Image</b></center></th> --}}
                                                <th width="10%"><center><b>Id No.</b></center></th>
                                                <th width="10%"><center><b>Rank</b></center></th>
                                                <th width="10%"><center><b>Name</b></center></th>
                                                <th width="10%"><center><b>Unit</b></center></th>
                                                <th width="10%"><center><b>Company</b></center></th>
                                                <th width="10%"><center><b>No Of Wpns Alloted</b></center></th>
                                                <th width="10%"><center><b>Action</b></center></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(!empty($employee))
                                            @foreach($employee as $product)
                                            @php
                                                $count = \App\Models\WpnAllot::where('emp_id', $product->emp_id)->count();
                                            @endphp
                                            <tr>
                                                <td><center>{{ ($employee->currentPage() - 1) * $employee->perPage() + $loop->iteration }}</center></td>
                                                <td><center>{{ $product->emp_id }}</center></td>
                                                <td><center>{{ $product->rank->rank_name ?? "" }}</center></td>
                                                {{-- <td><center><img src="{{ url('storage/app/public/' . $product->product_img) }}" alt="Product Image" width="50"></center></td> --}}
                                                <td><center>{{ $product->name }}</center></td>
                                                <td><center>{{ $product->unit->unit_name ?? "" }}</center></td>
                                                <td><center>{{ $product->company->company_name ?? ""}}</center></td>
                                                <td><center>{{ $count }}</center></td>

                                                <td><center>                                                   
                                                    <a class="btn btn-sm btn-warning" href="{{route('wpn.allot',['id'=>$product->id])}}">Allot Weapon</a>
                                                </center></td>
                                            </tr>
                                            @endforeach
                                            @else
                                            <td colspan="23"><center>No Data Found</center></td>
                                            @endif
                                        </tbody>
                                    </table>
                                    <div class="pagination" style="float:right;">
                                        {!! $employee->links() !!}
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