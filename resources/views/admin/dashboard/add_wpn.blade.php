<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title> Add Wpn </title>

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
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }
        .btn-custom {
            background-color: #4c4cff;
            color: white;
        }
        .btn-custom:hover {
            background-color: #3a3ac7;
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
            <div class="form-container">
                <h2>ADD WPN</h2>
                <form action="{{route('add.wpnAction')}}" method="POST">
                    @csrf
                    <!-- WPN Tag -->
                    <div class="mb-3 row ">
                        <label for="wpn-tag" class="form-label col-md-4">Assign Wpn Tag:</label>
                        <div class="col-md-8">
                            <input type="text" id="wpn-tag" name="wpn_tag" class="form-control" placeholder="Assign Wpn Tag" required>
                        </div>
                    </div>
        
                    <!-- Weapon Type -->
                    <div class="mb-3 row">
                        <label for="weapon-type" class="form-label col-md-4">Weapon Type:</label>
                        <div class="col-md-8">
                            <select id="weapon-type" class="form-select form-control" name="wpn_type" required>
                                <option value="">Select Weapon Type</option>
                                @foreach ($wpntype as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->type }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="weapon-src" class="form-label col-md-4">Weapon Source:</label>
                        <div class="col-md-8">
                            <select id="weapon-src" class="form-select form-control" name="wpn_src" required>
                                <option value="">Select Weapon Source</option>
                                @foreach ($wpn_src as $src)
                                    <option value="{{ $src->id }}">{{ $src->wpn_src_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
        
                    <!-- Regd. No -->
                    <div class="mb-3 row">
                        <label for="regd-no" class="form-label col-md-4">Regd. No.:</label>
                        <div class="col-md-8">
                            <input type="text" id="regd-no" name="regd_no" class="form-control" placeholder="Enter Regd. No." required>
                        </div>
                    </div>
        
                    <!-- Butt No -->
                    <div class="mb-3 row">
                        <label for="butt-no" class="form-label col-md-4">Butt No.:</label>
                        <div class="col-md-8">
                            <input type="text" id="butt-no" name="butt_no" class="form-control" placeholder="Enter Butt No." required>
                        </div>
                    </div>
        
                    <!-- Company -->
                    <div class="mb-3 row">
                        <label for="company" class="form-label col-md-4">COY:</label>
                        <div class="col-md-8">
                            <select id="company" class="form-select form-control" name="company_id" required>
                               
                                @foreach ($company as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->company_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
        
                    <!-- Remarks -->
                    <div class="mb-3 row">
                        <label for="remarks" class="form-label col-md-4">Remarks:</label>
                        <div class="col-md-8">
                            <textarea id="remarks" class="form-control" name="remarks" rows="3" placeholder="Enter remarks"></textarea>
                        </div>
                    </div>
        
                    <!-- Serviceability -->
                    <div class="mb-3 row">
                        <label class="form-label col-md-4 d-block">Serviceability:</label>
                        <div class="col-md-8">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="service" id="serviceable-yes" value="Yes" checked>
                                <label class="form-check-label" for="serviceable-yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="service" id="serviceable-no" value="No">
                                <label class="form-check-label" for="serviceable-no">No</label>
                            </div>
                        </div>
                    </div>
        
                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-custom w-100">Add</button>
                </form>
            </div>
            @include('admin.dashboard.common.footer')
        </div>
    </div>
    @include('admin.dashboard.common.footer_lib')
   
</body>

</html>
<script>
    document.getElementById('wpn-tag').addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault(); // Prevents the Enter key from being processed
        }
    });
    </script>