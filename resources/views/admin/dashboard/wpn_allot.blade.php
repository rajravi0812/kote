<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>Product List</title>
    @include('admin.dashboard.common.header_lib')
    <style>
        .header {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .section-title {
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        .table-container {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            background-color: #f1f5f8;
        }

        .btn-alloc {
            background-color: #28a745;
            color: white;
        }

        .btn-remove {
            background-color: #dc3545;
            color: white;
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
            <div class="container-fluid mt-1 border">
                <!-- Header -->
                <div class="header d-flex align-items-center row mb-4" style="margin:0px 150px 0px 150px;">
                    <div class="me-3 col-md-2">
                        <img src="{{ url('/public' . $employee->photo)}}" alt="User Image" height="160px" width="120px">
                    </div>
                    <div class="col-md-5">
                        <p><strong>ID No: &nbsp;&nbsp;&nbsp;&nbsp; </strong> {{ $employee->emp_id}}</p>
                        <p><strong>Name:&nbsp;&nbsp;&nbsp;&nbsp;  </strong> {{$employee->name}}</p>
                        <p><strong>Rank: &nbsp;&nbsp;&nbsp;&nbsp; </strong> {{ $employee->rank->rank_name ?? ""}}</p>
                    </div>
                    <div class="col-md-5">
                        <p><strong>Company: &nbsp;&nbsp;&nbsp;&nbsp; </strong> {{ $employee->company->company_name ?? ""}}</p>
                        <p><strong>Unit: &nbsp;&nbsp;&nbsp;&nbsp; </strong> {{ $employee->unit->unit_name ?? ""}}</p>
                        <p><strong></strong></p>
                    </div>
                </div>
        
                <!-- Main Content -->
                <div class="row">
                    <!-- Available Weapons Section -->
                    <div class="col-md-6">
                        <h5 class="section-title"><u>Available Wpns</u></h5>
                        <div class="table-container">
                            <input type="hidden" name="id" id="emp_code" value="{{ $employee->emp_id}}">
                            <div class="mb-3 d-flex row">
                                <div class="col-md-4">
                                    <select class="form-select form-control me-2" id="wpn_type" name="wpn_type" aria-label="Search Weapon Type">
                                        <option value="">All</option>
                                        @foreach ($wpn_type as $types)
                                            <option value="{{$types->type}}">{{$types->type}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control me-2" id="butt_no"   name="butt_no" placeholder="Search Butt No.">
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-secondary">Reset</button>
                                </div>
                            </div>
                            <table class="table table-sm table-bordered ">
                                <thead class="bg-primary" style="color:whitesmoke;">
                                    <tr>
                                        <th>SR NO.</th>
                                        <th>BARCODE</th>
                                        <th>WPN TYPE</th>
                                        <th>REGD NO</th>
                                        <th>BUTT NO</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody1">
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($wpn as $row)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$row->wpn_tag}}</td>
                                        <td>{{ $row->wpn_types->type}}</td>
                                        <td>{{$row->regd_no}}</td>
                                        <td>{{$row->butt_no}}</td>
                                        <td><button class="btn btn-sm btn-alloc allot-btn" rel="{{$row->id}}">Allot</button></td>
                                    </tr>
                                    @php
                                    $i++;
                                    @endphp
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
        
                    <!-- Allotted Weapons Section -->
                    <div class="col-md-6">
                        <h5 class="section-title"><u>Allotted Wpns</u></h5>
                        <div class="table-container">
                            <div class="mb-3 d-flex row">
                                <div class="col-md-4">
                                    <select class="form-select form-control me-2" aria-label="Search Weapon Type" id="wpn_type2" name="wpn_type">
                                        <option value="">All</option>
                                        @foreach ($wpn_type as $types)
                                            <option value="{{$types->type}}">{{$types->type}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control me-2" id="butt_no2" name="butt_no" placeholder="Search Butt No.">
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-secondary">Reset</button>
                                </div>
                            </div>
                            <table class="table table-sm table-bordered">
                                <thead class="bg-primary" style="color:whitesmoke;">
                                    <tr>
                                        <th>SR NO.</th>
                                        <th>ASSIGNED TYPE</th>
                                        <th>WPN TYPE</th>
                                        <th>REGD NO</th>
                                        <th>BUTT NO</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                    @php
                                        $j = 1;
                                    @endphp
                                    @foreach ($wpn_allot as $allot)
                                    <tr>
                                        <td>{{$j}}</td>
                                        @php $btn = isset($allot->assign_type) && $allot->assign_type == 'Secondary' ? "secondary" : "warning"
                                        @endphp
                                        <td>
                                            <button class="btn btn-<?= $btn;?> asgn-btn" rel="{{ $allot->id}}" value="{{ $allot->assign_type}}"  style="border-radius:4px">{{ $allot->assign_type}}</button>
                                        </td>
                                        {{-- <td>{{$allot->assign_type}}</td> --}}
                                        <td>{{$allot->wpns_list->wpn_types->type}}</td>
                                        <td>{{$allot->wpns_list->regd_no}}</td>
                                        <td>{{$allot->wpns_list->butt_no}}</td>
                                        <td><button rel="{{$allot->id}}" class="btn btn-sm btn-remove del-btn">Remove</button></td>
                                    </tr>
                                    @php
                                    $j++;
                                    @endphp
                                    @endforeach
                                </tbody>
                            </table>
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


<script>
    $(document).ready(function() {
        $('#tbody1').on('click','.allot-btn', function() {
            var wpn_id = $(this).attr('rel');
            var emp_code = $('#emp_code').val();
            var butt_no = $('#butt_no2').val();
            var type = $('#wpn_type2').val();
            var url = '{{ route("add.allot.wpn") }}';
            var url2 = '{{ route("fetch.wpn.allot") }}';
            
            // Check if emp_code is not empty before sending the request
            if (!emp_code) {
                alert('Please enter the employee code.');
                return;
            }
            // console.log(wpn_id, emp_code,butt_no,type,url,url2);
            // First AJAX call to allot the weapon
            $.ajax({
                url: url,
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'wpn_id': wpn_id,
                    'emp_id': emp_code,
                },
                success: function(data) {
                    console.log(data);
                    if (data.status == 1) {
                        alert('Weapon allotted successfully.');
                        fetch_list(emp_code,type,butt_no,url2);
                        // Second AJAX call to get the allotment list
                    } else if(data.status==2) {
                        alert('Weapon Already Alloted.');
                    }
                    else{
                        alert("Failed to Allot wpn");
                    }
                },
                
               
            });
        });
    
        $('#tbody').on('click', '.del-btn', function(){
            var id = $(this).attr('rel');
            var emp_code = $('#emp_code').val();
            var butt_no = $('#butt_no2').val();
            var type = $('#wpn_type2').val();
            var url = '{{ route("del.allot.wpn") }}';
            var url2 = '{{ route("fetch.wpn.allot") }}';
            console.log(id,emp_code,url);
            $.ajax({
                url: url,
                type:"post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:{
                    "id":id,
                },
                success:function(data){
                    if(data == 1){
                        console.log(data);
                        alert('Weapon Deleted Successfully.');
                        fetch_list(emp_code,type,butt_no,url2);
                    }
                }
            })
        })
        $('#wpn_type2').on('change',function(){
            var type = $(this).val();
            var url = '{{ route("fetch.wpn.allot") }}';
            var emp_code = $('#emp_code').val();
            var butt_no = $('#butt_no2').val();
            console.log(type);
            fetch_list(emp_code,type,butt_no,url);
        })
        $('#butt_no2').on('keyup',function(){
            var type = $('#wpn_type2').val();
            var url = '{{ route("fetch.wpn.allot") }}';
            var emp_code = $('#emp_code').val();
            var butt_no = $(this).val();
            console.log(type);
            fetch_list(emp_code,type,butt_no,url);
        })

        $('#wpn_type').on('change',function(){
            var type = $(this).val();
            var url = '{{ route("fetch.wpn.avail")}}';
            var butt_no = $('#butt_no2').val();
            console.log(type);
            fetch_list_avail(type,butt_no,url);
        })
        $('#butt_no').on('keyup',function(){
            var type = $('#wpn_type2').val();
            var url = '{{ route("fetch.wpn.avail")}}';
            var butt_no = $(this).val();
            fetch_list_avail(type,butt_no,url);
        })

        // $('#tbody').on('click', '.asgn-btn', function() {
        //     var assign_val = $(this).val();
        //     var toggle_val = "";


        //     if (assign_val === "Secondary") {
        //         toggle_val = "Primary";
        //     } else {
        //         toggle_val = "Secondary";
        //     }

        //     var id = $(this).attr('rel'); 
        //     var emp_code = $('#emp_code').val(); 
        //     var button = $(this); 

        //     console.log(toggle_val, id, emp_code, "this is employee value");
        //     var url = '{{ route("update.assign.type")}}';
        //     $.ajax({
        //         url: url,
        //         type: "post",
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        //         data: {
        //             "id": id,
        //             "asgn_type": toggle_val,
        //             "emp_code": emp_code
        //         },
        //         success: function(data) {
        //             if (data.status == "success") {
        //                 button.val(toggle_val);
        //                 button.text(toggle_val); 
        //                 if (toggle_val === "Primary") {
        //                         button.css("background-color", "#ffc107"); // Set to green for Primary
        //                         button.css("color", "black"); 
        //                     } else {
        //                         button.css("background-color", "#7987a1");
        //                         button.css("color", "white"); // Set to red for Secondary
        //                     }
        //                 alert('Assignment type updated successfully.');
        //             } else {
        //                 alert('Failed to update assignment type.');
        //             }
        //         },
        //         error: function(xhr, status, error) {
        //             console.error(xhr.responseText);
        //             alert('Error updating assignment type.');
        //         }
        //     });
        // });


        $('#tbody').on('click', '.asgn-btn', function() {
    var assign_val = $(this).val();
    var toggle_val = assign_val === "Secondary" ? "Primary" : "Secondary";
    var id = $(this).attr('rel'); 
    var emp_code = $('#emp_code').val(); 
    var button = $(this); 

    console.log(toggle_val, id, emp_code, "this is employee value");
    var url = '{{ route("update.assign.type")}}';
    
    $.ajax({
        url: url,
        type: "post",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            "id": id,
            "asgn_type": toggle_val,
            "emp_code": emp_code
        },
        success: function(data) {
            if (data.status == "success") {
                // Use the actual assigned value returned from the server
                var new_assign_type = data.new_assign_type;
                button.val(new_assign_type);
                button.text(new_assign_type);

                if (new_assign_type === "Primary") {
                    button.css("background-color", "#ffc107"); // Yellow for Primary
                    button.css("color", "black");
                } else {
                    button.css("background-color", "#7987a1"); // Gray for Secondary
                    button.css("color", "white");
                }
                
                alert('Assignment type updated successfully.');
            } else {
                alert('Failed to update assignment type.');
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            alert('Error updating assignment type.');
        }
    });
});




        function fetch_list_avail(type,butt_no,url){
                    $.ajax({
                            url: url,
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                "type":type,
                                "butt_no":butt_no,
                            },
                            dataType: 'json',
                            success: function(list) {
                                console.log(list.data);
                                // Clear existing rows (optional, if you want to refresh the list)
                                $('#tbody1').empty(); 

                                if (list.data.length > 0) {
                                    // Loop through the data and append rows to the table
                                    $.each(list.data, function(index, alloted) {
                                        var row = '<tr>' +
                                            '<td>' + (index + 1) + '</td>' +
                                            '<td>' + alloted.wpn_tag + '</td>' + // Fixed property names
                                            '<td>' + alloted.type + '</td>' + // Assuming this corresponds to the weapon type
                                            '<td>' + alloted.regd_no + '</td>' + // Make sure this corresponds to the correct variable
                                            '<td>' + alloted.butt_no + '</td>' +
                                            '<td>' +
                                            '<button rel="'+ alloted.id +'"  style="border-radius:5px" class="btn del-btn btn-success allot-btn">Allot</button>' +
                                            '</td>' +
                                            '</tr>';

                                        // Append the row to the table body
                                        $('#tbody1').append(row);
                                    });
                                } else {
                                    $('#tbody1').append('<tr><td colspan="6" class="text-center">No Wpn Found in Inventory</td></tr>');
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                                alert('Failed to fetch the allotment list: ' + error);
                            }
                        });
    }


        function fetch_list(emp_code,type,butt_no,url){
                    console.log(emp_code,type,butt_no,url);
                    $.ajax({
                            url: url,
                            type: 'POST',
                            headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                            data: {
                                "type":type,
                                "emp_id":emp_code,
                                "butt_no":butt_no,
                            },
                            dataType: 'json',
                            success: function(list) {
                                console.log(list.data);
                                // Clear existing rows (optional, if you want to refresh the list)
                                $('#tbody').empty(); 

                                if (list.data.length > 0) {
                                    // Loop through the data and append rows to the table
                                    $.each(list.data, function(index, alloted) {
                                        // Determine the button class based on 'assign_type'
                                        var btnClass = (alloted.assign_type === 'Secondary') ? 'btn-secondary' : 'btn-warning';

                                        var row = '<tr>' +
                                            '<td>' + (index + 1) + '</td>' +
                                            '<td>' +
                                                '<button class="btn ' + btnClass + ' asgn-btn" rel="' + alloted.id + '" value="' + alloted.assign_type + '" style="border-radius:4px">' + alloted.assign_type + '</button>' +
                                            '</td>' +
                                            '<td>' + alloted.type + '</td>' + // Assuming this corresponds to the weapon type
                                            '<td>' + alloted.regd_no + '</td>' + // Ensure this corresponds to the correct variable
                                            '<td>' + alloted.butt_no + '</td>' +
                                            '<td>' +
                                                '<button rel="' + alloted.id + '" style="border-radius:5px" class="btn del-btn btn-danger">Remove</button>' +
                                            '</td>' +
                                            '</tr>';

                                        // Append the row to the table body
                                        $('#tbody').append(row);
                                    });

                                } else {
                                    $('#tbody').append('<tr><td colspan="6" class="text-center">No Allotted Inventory</td></tr>');
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                                alert('Failed to fetch the allotment list: ' + error);
                            }
                        });
    }

})
</script>
</body>

</html>