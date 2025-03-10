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
    <title>Dashboard</title>
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
                        <h4 class="page-title">Dashboard</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4"></div>

                    <div class="col-lg-2">
                        <a href="{{ route('add.wpn')}}">
                        {{-- <div class="card card-hover"> --}}
                            <div class="box text-center">
                                <h1 class="font-light text-white"><img src="{{url("assets/img/add_wpn.png")}}" width="90px"  alt="Main"></h1>
                                <h6 class="text-dark">Add Wpn</h6>
                            </div>
                        {{-- </div> --}}
                        </a>
                    </div>
                    <div class="col-lg-2">
                        <a href="{{ route('wpn.list')}}">
                        {{-- <div class="card card-hover"> --}}
                            <div class="box  text-center">
                                <h1 class="font-light text-white"><img src="{{url("assets/img/wpn_list.png")}}" width="90px"  alt="Main"></h1>
                                <h6 class="text-dark">Wpn List</h6>
                            </div>
                        {{-- </div> --}}
                        </a>
                    </div>
                    <div class="col-lg-4"></div>
                </div>
            </div>
            @include('admin.dashboard.common.footer')

        </div>
    </div>

    @include('admin.dashboard.common.footer_lib')

</body>

</html>