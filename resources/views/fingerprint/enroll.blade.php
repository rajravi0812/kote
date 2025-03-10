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
                        <h4 class="page-title">Employee Biometric Enrollment</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Biometric Enrollment</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
   
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th width="5%"><center><b>S.No</b></center></th> <!-- Added width -->
                                                <th width="30%"><center><b>Name</b></center></th>
                                                <th width="20%"><center><b>Emp Id</b></center></th>
                                                <th width="20%"><center><b>Status</b></center></th>
                                                <th width="25%"><center><b>Action</b></center></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($employees as $key => $employee)
                                            <tr>
                                                <td><center>{{ $key + 1 }}</center></td>
                                                <td><center>{{ $employee->name }}</center></td>
                                                <td><center>{{ $employee->emp_id }}</center></td>
                                                <td><center>
                                                    <span class="badge badge-danger">Pending Enrollment</span>
                                                </center></td>
                                                <td><center>
                                                    <a href="fingerprintapp://enroll?emp_id={{ urlencode($employee->emp_id) }}&name={{ urlencode($employee->name) }}" 
                                                       class="btn btn-primary btn-sm">
                                                        <i class="fas fa-fingerprint"></i> Enroll
                                                    </a>
                                                </center></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
        $(document).ready(function() {
            $('#zero_config').DataTable();
        });
    </script>
</body>
</html>