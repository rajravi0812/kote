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
    <title>Add Vehicle </title>
    <!-- Custom CSS -->
    @include('admin.dashboard.common.header_lib')

    <style>
        .table {
    border-collapse: collapse; /* Ensure borders are collapsed */
}

.table th, .table td {
    padding: 10px; /* Add padding to cells */
    text-align: left; /* Align text to the left */
}

.table th {
    background-color: #f8f9fa; /* Light background for the header */
    font-weight: bold; /* Make header text bold */
}

.table-bordered {
    border: 1px solid #dee2e6; /* Border for the table */
}

.table-bordered th, .table-bordered td {
    border: 1px solid #dee2e6; /* Border for table cells */
}

.loader {
            display: none;
            margin: 20px auto;
            border: 8px solid #f3f3f3;
            border-radius: 50%;
            border-top: 8px solid #3498db;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        fieldset {
  background-color: #fafafa;
  border-radius: 5px;
}

legend {
  background-color: rgb(48, 80, 167);
  color: white;
  width:150px;
  padding: 3px 10px;
  margin-left:20px;
  font-size: 17px;
  border-radius:5px;
}

    </style>
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
                        <h4 class="page-title">Scanned Detail</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Scanned Detail</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div class="container-fluid">    
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <form action="{{ route('s2.assign.vehicle') }}" method="POST" id="assignVehForm">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label for="card" class="col-sm-3 text-right control-label col-form-label"><b style="color:crimson;font-size:17px;">Scan Card Detail</b></label>
                                                <div class="col-md-6 d-flex align-items-center">
                                                    <input type="text" 
                                                           style="font-size:15px;color:crimson;width:60%;" 
                                                           class="form-control me-2" 
                                                           id="uid"
                                                           value="{{$detailedProducts[0]['asgn_card']}}" 
                                                           name="assign_card" 
                                                           placeholder="Enter Card Number" 
                                                           onkeydown="moveToNextField(event)" readonly>
                                                           
                                                    {{-- <button type="button" class="btn btn-primary" id="uid2">Scan Card</button> --}}
                                                </div>
                                                <div class="loader" id="loader"></div>            
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <fieldset style="border:1px solid rgb(199, 199, 199);">
                                                <legend>Vehicle Detail</legend>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group row">
                                                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Type of Veh</label>
                                                                <div class="col-md-8">
                                                                    <input type="text" readonly value="{{$detailedProducts[0]['vehicle_type']['veh_name']}}" class="form-control" id="veh" placeholder="Enter Veh No" name="veh_num" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group row">
                                                                <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Veh No.</label>
                                                                <div class="col-md-8">
                                                                    <input type="text" readonly value="{{$detailedProducts[0]['vehicle_no']}}" class="form-control" id="veh" placeholder="Enter Veh No" name="veh_num" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group row">
                                                                <label for="category_id" class="col-sm-3 text-right control-label col-form-label">Issuing Unit</label>
                                                                <div class="col-md-8">
                                                                    <input type="text" readonly value="{{$detailedProducts[0]['unit']['unit_name']}}" class="form-control" id="veh" placeholder="Enter Veh No" name="veh_num" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group row">
                                                                <label for="email1" class="col-sm-3 text-right control-label col-form-label">Type of Store</label>
                                                                <div class="col-md-8">
                                                                    <input type="text" readonly value="{{$detailedProducts[0]['store']['store_name']}}" class="form-control" id="veh" placeholder="Enter Veh No" name="veh_num" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group row">
                                                                <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Block No.</label>
                                                                <div class="col-md-8">
                                                                    <input type="text" readonly value="{{$detailedProducts[0]['block_no']}}" class="form-control" id="cono1" placeholder="Enter Block No" name="block_no" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group row">
                                                                <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Serial No.</label>
                                                                <div class="col-md-8">
                                                                    <input type="text" readonly value="{{$detailedProducts[0]['serial_no']}}" class="form-control" id="serial_no" placeholder="Enter Serial No" name="serial_no" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group row">
                                                                <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Date & Time</label>
                                                                <div class="col-md-8">
                                                                    <input type="text" value="{{$detailedProducts[0]['date']}}" class="form-control"  placeholder="Enter Date & Time" name="date" readonly required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </fieldset>
                                        </div>

                                        <div class="col-md-12 mt-2">
                                            <fieldset style="border:1px solid rgb(199, 199, 199);">
                                                <legend>Driver Detail</legend>
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    <label for="cono1" class="col-sm-4 text-right control-label col-form-label">Army No/Aadhar</label>
                                                                    <div class="col-md-7">
                                                                        <input type="text" readonly value="{{$detailedProducts[0]['army_no']}}" class="form-control" id="army" placeholder="Enter Army/Aadhar No" name="army_no" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Rank</label>
                                                                    <div class="col-md-8">
                                                                        <input type="text" readonly value="{{$detailedProducts[0]['rank']['rank_name']}}" class="form-control" id="veh" placeholder="Enter Veh No" name="veh_num" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Dvr Name</label>
                                                                    <div class="col-md-8">
                                                                        <input type="text" readonly value="{{$detailedProducts[0]['driver_name']}}" class="form-control" id="cono1" placeholder="Enter Dvr Name" name="dvr" required>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                          
                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    <label for="formation" class="col-sm-3 text-right control-label col-form-label">Formation</label>
                                                                    <div class="col-md-8">
                                                                        <input type="text" readonly value="{{$detailedProducts[0]['formation_id']['formation_name']}}" class="form-control" id="veh" placeholder="Enter Veh No" name="veh_num" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    <label for="unit" class="col-sm-3 text-right control-label col-form-label">Unit</label>
                                                                    <div class="col-md-8">
                                                                        <input type="text" readonly value="{{$detailedProducts[0]['formation_unit_id']['f_unit_name']}}" class="form-control" id="veh" placeholder="Enter Veh No" name="veh_num" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    <label for="category_id" class="col-sm-3 text-right control-label col-form-label">Mob No</label>
                                                                    <div class="col-md-8">
                                                                        <input type="text" readonly value="{{$detailedProducts[0]['dvr_mob']}}" class="form-control" id="mob" placeholder="Enter Dvr Name" name="dvr_mob" required>
                                                                    </div>
                                                                </div>
                                                            </div> 
                                                            
                                                        </div> 
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="row">
                                                            {{-- <div class="col-4"><label for="inputphoto" class="form-label">Take Photo:</label></div> --}}
                                                            <div class="col-5">
                                                            
                                                                <button type="button"  class="btn btn-danger ml-auto btn-sm"
                                                                                data-toggle="modal" data-target="#exampleModal1">
                                                                                Capture Photo
                                                                </button>
                                                            </div>
                                                            <div class="col-7">
                                                                <img src="{{url($detailedProducts[0]['driver_image'])}}" id="sample" height="100px" width="160px" style="border-radius:3px;">
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </div>
                                                                                                      
                                            </fieldset>
                                        </div>  
                                        
                                        <div class="col-md-12 mt-2">
                                            <fieldset style="border:1px solid rgb(199, 199, 199);">
                                                <legend>Co-Driver Detail</legend>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group row">
                                                                <label for="cono1" class="col-sm-4 text-right control-label col-form-label">Army No/Aadhar</label>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly value="{{$detailedProducts[0]['co_army_n']}}" class="form-control" id="army" placeholder="Enter Army/Aadhar No" name="co_army_n" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group row">
                                                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Rank</label>
                                                                <div class="col-md-8">
                                                                    <input type="text" readonly value="{{$detailedProducts[0]['co_rank']}}" class="form-control" id="veh" placeholder="Enter Veh No" name="veh_num" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group row">
                                                                <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Co-Dvr Name</label>
                                                                <div class="col-md-8">
                                                                    <input type="text" readonly value="{{$detailedProducts[0]['co_dvr']}}" class="form-control" id="codvr" placeholder="Enter Dvr Name" name="co_dvr" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group row">
                                                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Formation</label>
                                                                <div class="col-md-8">
                                                                    <input type="text" readonly value="{{$detailedProducts[0]['co_formation_id']['formation_name']}}" class="form-control" id="veh" placeholder="Enter Veh No" name="veh_num" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        
                                                        
                                                        <div class="col-md-4">
                                                            <div class="form-group row">
                                                                <label for="category_id" class="col-sm-3 text-right control-label col-form-label">Unit</label>
                                                                <div class="col-md-8">
                                                                    <input type="text" readonly value="{{$detailedProducts[0]['co_f_unit_id']['f_unit_name']}}" class="form-control" id="veh" placeholder="Enter Veh No" name="veh_num" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                            </fieldset>
                                        </div> 

                                        <div class="col-md-12 mt-2">
                                            <fieldset style="border:1px solid rgb(199, 199, 199);">
                                                <legend>Destination</legend>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group row">
                                                                <label for="email1" class="col-sm-3 text-right control-label col-form-label">Destination</label>
                                                                <div class="col-md-8">
                                                                    <input type="text" readonly value="{{$detailedProducts[0]['destination']['dest_name']}}" class="form-control" id="veh" placeholder="Enter Veh No" name="veh_num" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    
                                                        <div class="col-md-4">
                                                            <div class="form-group row">
                                                                <label for="cono1" class="col-sm-3 text-right control-label col-form-label">GR</label>
                                                                <div class="col-md-8">
                                                                    <input type="text" readonly value="{{$detailedProducts[0]['gr']}}" class="form-control" id="gr" placeholder="Enter GR" name="gr" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="form-group row">
                                                                {{-- <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Uploaded Image</label>
                                                                <div class="col-md-8">
                                                                    <input type="file" class="form-control" id="cono1" placeholder="" name="des_image" >
                                                                </div> --}}
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-4">
                                                            <div class="form-group row">
                                                                <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Latitude</label>
                                                                <div class="col-md-8">
                                                                    <input type="text" readonly value="{{$detailedProducts[0]['latitude']}}" class="form-control" id="lat" placeholder="Enter Latitude" name="latitude" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group row">
                                                                <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Longitude</label>
                                                                <div class="col-md-8">
                                                                    <input type="text" readonly value="{{$detailedProducts[0]['longitude']}}" class="form-control" id="long" placeholder="Enter Longitude" name="longitude" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                       
                                                        <div class="col-md-4">
                                                            <div class="form-group row">
                                                                <label for="cono1" class="col-sm-4 text-right control-label col-form-label">Army No/Aadhar</label>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly value="{{$detailedProducts[0]['des_army']}}" class="form-control" id="army" placeholder="Enter Army/Aadhar No" name="des_army" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group row">
                                                                <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Person Name</label>
                                                                <div class="col-md-8">
                                                                    <input type="text" readonly value="{{$detailedProducts[0]['des_name']}}" class="form-control" id="cono1" placeholder="Enter Dvr Name" name="des_name" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group row">
                                                                <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Contact</label>
                                                                <div class="col-md-8">
                                                                    <input type="text" readonly value="{{$detailedProducts[0]['des_contact']}}" class="form-control" id="cono1" placeholder="Enter Contact Name" name="des_contact" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group row">
                                                                <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Unit Name</label>
                                                                <div class="col-md-8">
                                                                    <input type="text" readonly value="{{$detailedProducts[0]['des_unit']}}" class="form-control" id="cono1" placeholder="Enter Unit Name" name="des_unit" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                            </fieldset>
                                        </div> 
                                        {{-- <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="card" class="col-sm-3 text-right control-label col-form-label"><b style="color:crimson;font-size:17px;">Card Number</b></label>
                                                <div class="col-md-6">
                                                    <input type="text" style="font-size:17px;color:crimson" class="form-control"  value="{{$detailedProducts[0]['asgn_card']}}" name="assign_card" placeholder="Enter Card Number"  readonly>
                                                    <div class="loader" id="loader"></div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Type of Veh</label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" id="veh_type1"  value="{{$detailedProducts[0]['vehicle_type']['veh_name']}}"  name="veh_type1" required readonly>
                                                    <input type="hidden"  id="veh_type"  value="{{$detailedProducts[0]['vehicle_type']['id']}}"  name="type_veh">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Block No.</label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" id="cono1"  value="{{$detailedProducts[0]['block_no']}}" placeholder="Enter Block No" name="block_no" required readonly>
                                                    
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Dvr Name</label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" id="cono1"  value="{{$detailedProducts[0]['driver_name']}}" placeholder="Enter Dvr Name" name="dvr" required readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Rank</label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" id="rank1"  value="{{$detailedProducts[0]['rank']['rank_name']}}" placeholder="Rank" name="rank1" required readonly>
                                                    <input type="hidden"  id="rank"  value="{{$detailedProducts[0]['rank']['id']}}" placeholder="Rank" name="rank">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="category_id" class="col-sm-3 text-right control-label col-form-label">Unit</label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" id="unit1"  value="{{$detailedProducts[0]['unit']['unit_name']}}" placeholder="unit" name="unit1" required readonly>
                                                    <input type="hidden"  id="unit"  value="{{$detailedProducts[0]['unit']['id']}}" placeholder="unit" name="unit" >
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="category_id" class="col-sm-3 text-right control-label col-form-label">Destination</label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" id="destination1"  value="{{$detailedProducts[0]['destination']['dest_name']}}" placeholder="unit" name="destination1" required readonly>
                                                    <input type="hidden"  id="destination"  value="{{$detailedProducts[0]['destination']['id']}}" placeholder="unit" name="destination" >
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="cono1" class="col-sm-4 text-right control-label col-form-label">Veh No.</label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" id="cono1"  value="{{$detailedProducts[0]['vehicle_no']}}" placeholder="Enter Veh No" name="veh_num" required readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="cono1" class="col-sm-4 text-right control-label col-form-label">Army No/Aadhar</label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" id="cono1"  value="{{$detailedProducts[0]['army_no']}}" placeholder="Enter Army/Aadhar No" name="army_no" required readonly>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="cono1" class="col-sm-4 text-right control-label col-form-label">Serial No</label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" id="serial"  value="{{$detailedProducts[0]['serial_no']}}"  name="serial_no" required readonly>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label for="email1" class="col-sm-4 text-right control-label col-form-label">Type of Store</label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" id="store1"  value="{{$detailedProducts[0]['store']['store_name']}}" placeholder="store" name="store1" required readonly>
                                                    <input type="hidden"  id="store"  value="{{$detailedProducts[0]['store']['id']}}" placeholder="store" name="store">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="cono1" class="col-sm-4 text-right control-label col-form-label">Date & Time(Stage 1)</label>
                                                <div class="col-md-5">
                                                    <input type="datetime-local" class="form-control" id="olddate" value="{{$detailedProducts[0]['date']}}" placeholder="Enter Date & Time" name="olddate" required readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="cono1" class="col-sm-4 text-right control-label col-form-label">Date & Time(Stage 2)</label>
                                                <div class="col-md-5">
                                                    <input type="datetime-local" class="form-control" id="date"  placeholder="Enter Date & Time" name="date" required>
                                                </div>
                                            </div>
                                        </div> --}}
                                    </div>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <h3>Product to be uploaded to Veh:</h3>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            {{-- <button type="button" id="add-product-btn" class="btn btn-success mt-3">Add Product</button> --}}
                                        </div>
                                    </div>
                                    
                                    <div id="product-section">
                                        @foreach ($detailedProducts as $productIndex => $products)
                                        <div class="product-item border p-3 mb-3">
                                            <div class="form-group row">
                                                <label for="product_name_{{ $productIndex }}" class="col-sm-2 col-form-label">Product</label>
                                                <div class="col-md-4">
                                                    <input 
                                                        type="text" 
                                                        class="form-control form-control-sm product-quantity" 
                                                        value="{{ $products['product']['product_name'] }}" 
                                                        placeholder="Enter Quantity" 
                                                        required 
                                                        readonly
                                                    >
                                                    <input 
                                                        type="hidden" 
                                                        class="form-control product-quantity" 
                                                        value="{{ $products['product']['id'] }}" 
                                                        name="products[{{ $productIndex }}][name]" 
                                                        placeholder="Enter Quantity" 
                                                        required 
                                                        readonly
                                                    >
                                                </div>
                                                
                                                <label for="quantity_{{ $productIndex }}" class="col-sm-2 col-form-label">Quantity</label>
                                                <div class="col-md-3">
                                                    <input 
                                                        type="number" 
                                                        class="form-control form-control-sm product-quantity" 
                                                        value="{{ $products['quantity'] }}" 
                                                        name="products[{{ $productIndex }}][quantity]" 
                                                        placeholder="Enter Quantity" 
                                                        required 
                                                        readonly
                                                    >
                                                </div>
                                            </div>
                                            
                                            <div class="sub-product-table-container mt-3">
                                                <div class="table-responsive" style="text-align: center;">
                                                    <table class="table table-bordered table-sm" style="width: 60%; margin: 0 auto;">
                                                        <thead>
                                                            <tr>
                                                                <th>Accessory Name</th>
                                                                <th>Accessory Qty</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($products['accessories'] as $accessoryIndex => $accessory)
                                                            <tr>
                                                                <td>
                                                                    <input 
                                                                        type="text" 
                                                                        class="form-control form-control-sm" 
                                                                        value="{{ $accessory['accessory']['acc_name'] }}" 
                                                                        readonly
                                                                    >
                                                                    <input 
                                                                        type="hidden" 
                                                                        class="form-control" 
                                                                        name="products[{{ $productIndex }}][accessories][{{ $accessoryIndex }}][name]" 
                                                                        value="{{ $accessory['accessory']['id'] }}" 
                                                                        readonly
                                                                    >
                                                                </td>
                                                                <td>
                                                                    <input 
                                                                        type="number" 
                                                                        class="form-control form-control-sm accessory-quantity" 
                                                                        name="products[{{ $productIndex }}][accessories][{{ $accessoryIndex }}][quantity]" 
                                                                        value="{{ $accessory['quantity'] }}" 
                                                                        data-original-qty="" 
                                                                        min="0" 
                                                                        readonly
                                                                    >
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    
                                <div class="border-top">
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-primary">Save & Continue</button>
                                    </div>
                                </div>
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
        // Get the current date and time
        const now = new Date();
    
        // Format the date and time for the 'datetime-local' input
        const year = now.getFullYear();
        const month = String(now.getMonth() + 1).padStart(2, '0'); // Months are 0-indexed
        const day = String(now.getDate()).padStart(2, '0');
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
    
        // Combine into 'YYYY-MM-DDTHH:mm' format
        const formattedDateTime = `${year}-${month}-${day}T${hours}:${minutes}`;
    
        // Set the value of the input field
        document.getElementById('date').value = formattedDateTime;
    </script>
    
  

</body>

</html>