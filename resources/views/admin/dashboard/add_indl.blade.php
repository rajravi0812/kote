<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>Add Indl</title>

    @include('admin.dashboard.common.header_lib')

    <style>
         body{
            background: #eeeeee;
        }
        .form-container {
            background-color: #add8e6;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 500px;
            margin: 50px auto;
        }
    .form-title {
      text-align: center;
      font-weight: bold;
      margin-bottom: 20px;
      color: #3f4142;
    }
    .btn-capture {
      background-color: #d9534f;
      color: white;
      border: none;
    }
    .btn-capture:hover {
      background-color: #c9302c;
    }
    .btn-add {
      background-color: #6f42c1;
      color: white;
      width: 100%;
      border: none;
    }
    .btn-add:hover {
      background-color: #5a3799;
    }
    .or-text {
      text-align: center;
      font-weight: bold;
      color: gray;
      margin: 10px 0;
    }
    .photo-box {
      border: 1px solid #ccc;
      width: 100px;
      height: 100px;
      margin: 0 auto;
      background-color: #f8f9fa;
      display: flex;
      justify-content: center;
      align-items: center;
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
            
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
           

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="form-container mt-3">
                <h2 class="form-title ">Add INDL</h2>

               <form action="{{route('add.indlAction')}}" method="POST" enctype="multipart/form-data" onkeydown="return event.key !== 'Enter';">
                @csrf
                <div class="row mb-3">
                    <label for="id" class="col-sm-4 col-form-label">Id No.</label>
                    <div class="col-sm-8">
                    <input type="text" name="emp_id" class="form-control" id="id" placeholder="Enter ID" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="rank" class="col-sm-4 col-form-label">Rank</label>
                    <div class="col-sm-8">
                    <select class="form-select form-control"  id="rank" name="rank_id" required>
                        <option selected>Select Rank</option>
                        @foreach ($rank as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->rank_name }}</option>
                        @endforeach
                    </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="name" class="col-sm-4 col-form-label">Name</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="subUnit" class="col-sm-4 col-form-label">Unit</label>
                    <div class="col-sm-8">
                    <select class="form-select form-control" id="subUnit" name="unit_id" required>
                    
                        @foreach ($unit as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->unit_name }}</option>
                        @endforeach
                    </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="company" class="col-sm-4 col-form-label">Company</label>
                    <div class="col-sm-8">
                    <select class="form-select form-control" id="company" name="company_id" required>
                       
                        @foreach ($company as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->company_name }}</option>
                        @endforeach
                    </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="photo" class="col-sm-4 col-form-label">Photo</label>
                    <div class="col-sm-8">
                    <input class="form-control" type="file" name="file" id="photo" >
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-12">
                        <center>
                        Or
                        </center>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Capture</label>
                    <div class="col-sm-8">
                        <button type="button"  class="btn btn-danger ml-auto btn-sm"
                        data-toggle="modal" data-target="#exampleModal1" id="capturePhotoBtn" >
                        Capture Photo
                        </button>
                    </div>
                </div>
                <div class="row mb-3 text-center">
                    <div class="col-12">
                    <div class="photo-box">
                        <img id="sample" height="100px" width="160px" style="border-radius:3px;">
                    </div>
                    </div>
                </div>
                <input type="hidden" name="image" class="image-tag" >
                <button type="submit" class="btn btn-add">Add</button>
                </form>
              </div>
              <div class="modal fade" id="exampleModal1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <!-- Adjusted width here -->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Upload Image</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                                <input type="hidden" name="id" value="vehicle_image">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="my_camera"></div>
                                            <br />
                                            
                                        <div class="row">
                                            <div class="col-sm-6"><u>Live Camera</u>
                                            <div id="webcam"></div>
                                            <input type="button" id="btnFrontBack" value="Back" class="btn btn-warning"/>
                                            <input type="button" id="btnCapture" value="Capture" class="btn btn-danger" />
                                            </div>
                                            <div class="col-sm-6">
                                            <u>Captured Picture</u>
                                            <img  id="imgCapture"/>
                                            </div>
                                        </div>
                                        
                                        </div>
                                       

                                
                                    </div>
                                </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary closeBtn"
                                    data-dismiss="modal" >Close</button>
                                <button type="button"  class="btn btn-primary closeBtn" data-dismiss="modal">Save</button>
                            </div>
                    </div>
                </div>
            </div>
            @include('admin.dashboard.common.footer')
        </div>
    </div>
    @include('admin.dashboard.common.footer_lib')
    <script src="{{ url('/assets/js/webcam.min.js') }}"></script>
    <script type="text/javascript">
    $(document).ready(function () {
    let capturePhotoStarted = false; // Track if the function is started

        $("#capturePhotoBtn").click(function () {
            if (!capturePhotoStarted) 
            {
                capturePhotoStarted = true;
                ApplyPlugin();
                $("#btnCapture").click(function () {
                    Webcam.snap(function (data_uri) {
                        $("#imgCapture")[0].src = data_uri;
                        $(".image-tag").val(data_uri);
                        console.log(data_uri);
                        $('#sample').attr('src',data_uri);
                    });
                });
        
                $("#btnFrontBack").click(function () {
                    $('#btnFrontBack').val($('#btnFrontBack').val() == 'Back' ? 'Front' : 'Back');
                    Webcam.reset();
                    ApplyPlugin();
                });
            }
        });
     
        function ApplyPlugin() {
            var mode = $('#btnFrontBack').val() == 'Back' ? 'user' : 'environment';
            Webcam.set({
                width: 280,
                height: 240,
                image_format: 'jpeg',
                jpeg_quality: 90,
                constraints: { facingMode: mode }
            });
            Webcam.attach('#webcam');
        }

        $(".closeBtn").click(function () {
        if (capturePhotoStarted) {
            capturePhotoStarted = false;

            // Unbind events to stop functionality
            $("#btnCapture").off("click");
            $("#btnFrontBack").off("click");

            // Reset the webcam or any related plugins
            Webcam.reset();

            console.log("Capture functionality stopped.");
        }
    });
    });
    </script>
<script>

</script>
   
   
</body>

</html>
