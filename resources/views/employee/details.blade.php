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
                        <h4 class="page-title">Employee Details</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Employee Details</li>
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
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <tbody>
                                            <tr>
                                                <th width="30%">Employee ID</th>
                                                <td>{{ $employee->emp_id }}</td>
                                            </tr>
                                            <tr>
                                                <th>Name</th>
                                                <td>{{ $employee->name }}</td>
                                            </tr>
                                            {{-- <tr>
                                                <th>Mobile</th>
                                                <td>{{ $employee->mobile }}</td>
                                            </tr> --}}
                                            <tr>
                                                <th>Joining Date</th>
                                                <td>{{ $employee->created_at ? date('d M Y', strtotime($employee->created_at)) : 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Verification Time</th>
                                                <td>{{ $verification_time->format('d M Y H:i:s') }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>

            @include('admin.dashboard.common.footer')
        </div>
    </div>

    @include('admin.dashboard.common.footer_lib')
</body>
</html>