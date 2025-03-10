<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>Login</title>
    <!-- Custom CSS -->
    <link href="{{url('/assets/css/style.min.css')}}" rel="stylesheet">
    <style>
        .main-header {
          display: flex;
          align-items: center;
          justify-content: space-between;
          background: linear-gradient(45deg, #002147, #005792); /* Elegant gradient */
          padding: 15px 20px;
          box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow */
          border-bottom: 4px solid #ffcc00;
        }
        
        .main-header .logo {
          width: 15%;
          text-align: center;
        }
        
        .main-header .logo img {
          max-width: 100%;
          height: auto;
          border-radius: 10%; /* Rounded logos */
          border: 2px solid #ffffff; /* White border */
        }
        
        .main-header .title {
          flex-grow: 1;
          text-align: center;
        }
        
        .main-header .title h3 {
          font-size: 1.5em;
          color: #ffffff; /* White text */
          /* text-transform: uppercase; */
          letter-spacing: 2px;
          display: flex;
          align-items: center;
          justify-content: center;
          gap: 10px; /* Space for icon */
        }
        
        .main-header .title i {
          font-size: 1.5em;
          color: #ffcc00; /* Yellow icon */
        }
        
        /* Sub-Header Styles */
        .sub-header {
          background: #005792; /* Contrasting blue */
          padding: 10px 0;
          box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }
        
        .sub-header nav ul {
          display: flex;
          justify-content: center;
          list-style: none;
        }
        
        .sub-header nav ul li {
          margin: 0 20px;
        }
        
        .sub-header nav ul li a {
          text-decoration: none;
          color: #ffffff; /* White text */
          font-size: 1em;
          text-transform: uppercase;
          display: flex;
          align-items: center;
          gap: 5px; /* Space for icons */
          padding: 5px 10px;
          transition: all 0.3s ease; /* Smooth hover effects */
        }
        
        .sub-header nav ul li a:hover {
          background-color: #ffcc00; /* Yellow highlight */
          color: #002147; /* Navy text on hover */
          border-radius: 5px;
        }
        
        /* Responsive Adjustments */
        @media (max-width: 768px) {
          .main-header .logo {
            width: 20%;
          }
          
          .main-header .title h1 {
            font-size: 1.5em;
          }
        
          .sub-header nav ul li {
            margin: 0 10px;
          }
        }
        
        </style>
</head>

<body>
 
        <header class="main-header">
            <div class="logo left-logo">
              <img src="{{url("assets/img/top.png")}}" width="80px"  alt="Main Left Logo">
            </div>
            <div class="title">
              <h3><i class="fas fa-shield-alt"> {{$headerTitle[0]->title1}}</i></h3>
              <h4 style="color:#ffcc00;" > {{$headerTitle[0]->title2}}</i></h5>
            </div>
            <div class="logo right-logo">
              <img src="{{url("assets/img/india.png")}}" width="100px" alt="Main Right Logo">
            </div>
        </header>
    <div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center bg-light">
            <div class="auth-box bg-light border-secondary">
                <div id="loginform">
                    <div class="text-center">
                        <span class="db"><img src="assets/img/logo.png" alt="logo" width="350px" /></span>
                  
                    </div>
                    <!-- Form -->
                    <form class="form-horizontal m-t-20" id="loginform" method="POST" action="{{route('sign_in')}}">
						@csrf
                        <div class="row p-b-30">
                            <div class="col-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" placeholder="Username" id="email" name="email" required autofocus aria-label="Username" aria-describedby="basic-addon1" > 
									@if ($errors->has('email'))
									<span class="text-danger">{{ $errors->first('email') }}</span>
									@endif
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-warning text-white" id="basic-addon2"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input  id="password" name="password" type="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" required>
									@if ($errors->has('password'))
									<span class="text-danger">{{ $errors->first('password') }}</span>
									@endif
                                </div>
                            </div>
                        </div>
                        <div class="row  border-secondary">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="">
                                        {{-- <button class="btn btn-info" id="to-recover" type="button"><i class="fa fa-lock m-r-5"></i> Lost password?</button> --}}
                                        <button class=" form-control btn btn-success float-right" type="submit">Login</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                {{-- <div id="recoverform">
                    <div class="text-center">
                        <span class="text-white">Enter your e-mail address below and we will send you instructions how to recover a password.</span>
                    </div>
                    <div class="row m-t-20">
                        <!-- Form -->
                        <form class="col-12" action="index.html">
                            <!-- email -->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-danger text-white" id="basic-addon1"><i class="ti-email"></i></span>
                                </div>
                                <input type="text" class="form-control form-control-lg" placeholder="Email Address" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <!-- pwd -->
                            <div class="row m-t-20 p-t-20 border-top border-secondary">
                                <div class="col-12">
                                    <a class="btn btn-success" href="#" id="to-login" name="action">Back To Login</a>
                                    <button class="btn btn-info float-right" type="button" name="action">Recover</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> --}}
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="{{url('/assets/libs/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{url('/assets/libs/popper.js/dist/umd/popper.min.js')}}"></script>
    <script src="{{url('/assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>

    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();
    // ============================================================== 
    // Login and Recover Password 
    // ============================================================== 
    $('#to-recover').on("click", function() {
        $("#loginform").slideUp();
        $("#recoverform").fadeIn();
    });
    $('#to-login').click(function(){
        
        $("#recoverform").hide();
        $("#loginform").fadeIn();
    });
    </script>

</body>

</html>