
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
.nav-item.dropdown:hover .dropdown-menu {
    display: block;
}

.nav-item.dropdown > .nav-link {
    pointer-events: none; /* Disable click only for dropdown */
}

</style>
<header class="main-header">
    <div class="logo left-logo">
      <img src="{{url("assets/img/top.png")}}" width="80px"  alt="Main Left Logo">
    </div>
    <div class="title">
      <h3> 
        {{-- <img src="{{url("assets/img/kote.png")}}" width="200px" height="100px;" alt=""> --}}
        <i class="fas fa-shield-alt"> {{$headerTitle[0]->title1}}</i></h3>
      <h4 style="color:#ffcc00;" > {{$headerTitle[0]->title2}}</i></h5>
    </div>
    <div class="logo right-logo">
      <img src="{{url("assets/img/india.png")}}" width="100px" alt="Main Right Logo">
    </div>
</header>
<header class="topbar" data-navbarbg="skin5">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header" data-logobg="skin5">
            <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
        </div>
        <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
            <ul class="navbar-nav float-left mr-auto">
                <a class="navbar-brand" href="index.html" style="margin-top:10px">
                    <!-- Logo icon -->
                    <b class="logo-icon p-l-10">
                        {{-- <img src="{{url('assets/images/logo-icon.png')}}" alt="homepage" class="light-logo" /> --}}
                    </b>

                    <span class="logo-text">
                        <!-- dark Logo text -->
                        {{-- <img src="{{url('assets/images/logo-text.png')}}" alt="homepage" class="light-logo" /> --}}
                    </span>
                </a>

                <li class="nav-item">
                    <a class="nav-link " href="{{ route('dashboard') }}"  role="button"  aria-haspopup="true" aria-expanded="false" id="main">
                    <span class="d-none d-md-block">Dashboard</span>
                    </a>
                </li>
                @if(in_array($role_id, [1]))
              
                <li class="nav-item ">
                    <a class="nav-link " href="{{ route('wpn.issue') }}"  >
                    <span class="d-none d-md-block">Issue Wpn </span>
                      
                    </a>
                
                </li>
                <li class="nav-item ">
                    <a class="nav-link " href="{{ route('wpn.return') }}"  >
                    <span class="d-none d-md-block">Return Wpn </span>
                      
                    </a>
                
                </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="d-none d-md-block">Indl <i class="fa fa-angle-down"></i></span>
                    <span class="d-block d-md-none"><i class="fa fa-plus"></i></span>   
                    </a>
                
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('add.indl')}}">Add Indl</a>
                        <a class="dropdown-item" href="{{ route('indl.list')}}">Indl List</a>
                     
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="d-none d-md-block">Wpn <i class="fa fa-angle-down"></i></span>
                    <span class="d-block d-md-none"><i class="fa fa-plus"></i></span>   
                    </a>
                
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('add.wpn')}}">Add Wpn</a>
                        <a class="dropdown-item" href="{{ route('wpn.list')}}">Wpn List</a>
                        <a class="dropdown-item" href="{{ route('indl.allot.list')}}">Allot Wpn</a>
                     
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="d-none d-md-block">Reports <i class="fa fa-angle-down"></i></span>
                    <span class="d-block d-md-none"><i class="fa fa-plus"></i></span>   
                    </a>
                
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('master.report')}}">Master Report</a>
                        <a class="dropdown-item" href="{{ route('indl.weapon.report')}}">Indl Reports</a>
                        <a class="dropdown-item" href="{{ route('wpn.summary')}}">Wpn Report</a>
                        <a class="dropdown-item" href="{{ route('inout.report')}}">In/Out Report</a>
                        <a class="dropdown-item" href="{{ route('allot.wpn.report')}}">Wpn Allotments Report</a>
                     
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="d-none d-md-block">Manage Section <i class="fa fa-angle-down"></i></span>
                    <span class="d-block d-md-none"><i class="fa fa-plus"></i></span>   
                    </a>
                
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('view.user')}}">Admin User</a>
                        <a class="dropdown-item" href="{{ route('manage.rank')}}">Manage Rank</a>
                        <a class="dropdown-item" href="{{ route('manage.unit')}}">Manage Unit</a>
                        <a class="dropdown-item" href="{{ route('manage.company')}}">Manage Company</a>
                        <a class="dropdown-item" href="{{ route('manage.wpntype')}}">Manage Wpn Type</a>
                        <a class="dropdown-item" href="{{ route('manage.wpn.src')}}">Manage Wpn Source</a>  
                       <a class="dropdown-item" href="{{ route('manage.amn')}}">Manage Ammunition</a>
                     
                    </div>
                </li>
                @endif
            </ul>
            <ul class="navbar-nav float-right">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="assets/images/users/1.jpg" alt="user" class="rounded-circle" width="31"></a>
                    <div class="dropdown-menu dropdown-menu-right user-dd animated">
                        <a class="dropdown-item" href="javascript:void(0)"><i class="ti-user m-r-5 m-l-5"></i>{{ $username}} </a>
                        {{-- <a class="dropdown-item" href="javascript:void(0)"><i class="ti-wallet m-r-5 m-l-5"></i>My Profile </a>
                        <a class="dropdown-item" href="javascript:void(0)"><i class="ti-email m-r-5 m-l-5"></i> Inbox</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="javascript:void(0)"><i class="ti-settings m-r-5 m-l-5"></i> Account Setting</a>
                        <div class="dropdown-divider"></div> --}}
                        <a class="dropdown-item" href="{{route('signout')}}"><i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
                        {{-- <div class="dropdown-divider"></div> --}}
                        {{-- <div class="p-l-30 p-10"><a href="javascript:void(0)" class="btn btn-sm btn-success btn-rounded">View Profile</a></div> --}}
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>

