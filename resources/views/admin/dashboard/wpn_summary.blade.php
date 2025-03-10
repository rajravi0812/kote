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
    <title>Wpn List</title>
    <!-- Custom CSS -->
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
                        <h4 class="page-title">Wpn List</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Wpn List</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <form method="GET" action="">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <input type="text" name="wpn_tag" id="wpn_tag" class="form-control"
                                           value="{{ $filters['wpn_tag'] ?? '' }}" placeholder="Enter Wpn Tag">
                                </div>
                                <div class="col-md-1">
                                    <input type="text" name="regd_no" id="regd_no" class="form-control"
                                           value="{{ $filters['regd_no'] ?? '' }}" placeholder="Regd No">
                                </div>
                                <div class="col-md-2">
                                    <select name="wpn_type" id="wpn_type" class="form-control">
                                        <option value="">All Wpn Types</option>
                                        @foreach($wpntype as $wpn_type)
                                            <option value="{{ $wpn_type->id }}" {{ ($filters['wpn_type'] ?? '') == $wpn_type->id ? 'selected' : '' }}>
                                                {{ $wpn_type->type }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <input type="text" name="butt_no" id="butt_no" class="form-control"
                                           value="{{ $filters['butt_no'] ?? '' }}" placeholder="Butt No">
                                </div>
                                <div class="col-md-2">
                                    <select name="company" id="company" class="form-control">
                                        <option value="">Select Company</option>
                                        @foreach($companies as $company)
                                            <option value="{{ $company->id }}" {{ ($filters['company'] ?? '') == $company->id ? 'selected' : '' }}>
                                                {{ $company->company_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select name="service" id="service" class="form-control">
                                        <option value="">Serviceability</option>
                                        <option value="Yes" {{ ($filters['service'] ?? '') == "Yes" ? 'selected' : '' }}>
                                                Yes
                                        </option>
                                        <option value="No" {{ ($filters['service'] ?? '') == "No" ? 'selected' : '' }}>
                                            No
                                        </option>
                                    </select>
                                </div>
                                

                                <div class="col-md-2 text-center">
                                    <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                                    <a href="{{ route('wpn.list') }}" class="btn btn-secondary btn-sm">Reset</a>
                                    <a href="{{ route('wpn.summary', array_merge(request()->all(), ['export_excel' => true])) }}" class="btn btn-success btn-sm">
    Download Excel
</a>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
                
                

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <p>Total Records: {{$totalRecords}}</p>
                                    </div>
                                    <div class="col-md-8"></div>
                                    <div class="col-md-2">
                                        <a style="float:right" href="{{ route('add.wpn')}}"  type="button" class="btn btn-success btn-sm m-2">New</a>
                                    </div>
                                </div>
                                
                                
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered table-sm">
                                        <thead class="bg-cyan" style="color:white;">
                                            <tr>
                                                <th><center><b>S.No</b></center></th>
                                                <th><center><b>WPN TAG</b></center></th>
                                                <th><center><b>WPN TYPE</b></center></th>
                                                <th><center><b>REGD NO.</b></center></th>
                                                <th><center><b>BUTT NO.</b></center></th>
                                                <th><center><b>Company</b></center></th>
                                                <th><center><b>REMARKS</b></center></th>
                                                <th><center><b>SERVICABILITY</b></center></th>
                                                <th><center><b>Action</b></center></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(!empty($weapons))
                                            @foreach($weapons as $product)
                                            <tr>
                                                <td><center>{{ ($weapons->currentPage() - 1) * $weapons->perPage() + $loop->iteration }}</center></td>
                                                <td><center>{{ $product->wpn_tag }}</center></td>
                                                <td><center>{{ $product->wpn_types->type }}</center></td>
                                                {{-- <td><center><img src="{{ url('storage/app/public/' . $product->product_img) }}" alt="Product Image" width="50"></center></td> --}}
                                                <td><center>{{ $product->regd_no }}</center></td>
                                                <td><center>{{ $product->butt_no}}</center></td>
                                                <td><center>{{ $product->company->company_name}}</center></td>
                                                <td><center>{{ $product->remarks}}</center></td>
                                                <td><center>{{ $product->servicability}}</center></td>
                                            
                                                <td><center>
                                                    {{-- <a href="{{ route('edit.wpn',['id'=>$product->id])}}" class="btn btn-sm btn-primary" rel="{{$product->id}}">Wpn Report</a> --}}
                                                            <button rel="{{ $product->id }}" type="button" class="btn current_history btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#myModal">Current Issued</button>
                                                           <a href="{{ route('wpn.issue.history',$product->id) }}"><button class="btn btn-warning btn-sm">Issued History</button></a>
                                                    
                                                    {{-- <button rel="{{ $product->id }}" type="button" class="btn btn-danger btn-sm btn-delete" data-toggle="modal" data-target="#delete-event" >Delete</button> --}}
                                                </center></td>
                                            </tr>
                                            @endforeach
                                            @else
                                            <td colspan="23"><center>No Data Found</center></td>
                                            @endif
                                        </tbody>
                                    </table>
                                    <div class="pagination" style="float:right;">
                                        {!! $weapons->links() !!}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade none-border" id="add-edit-event">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <form action="#" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h4 class="modal-title"><strong>Edit</strong> Wpn</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            
                                <div class="row">
                                    <div class="col-md-8">
                                        <label class="control-label">Name</label>
                                        <input class="form-control form-white" placeholder="Enter name" type="text" id="edit_army" name="edit_name" />
                                    </div>
                                   
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <label class="control-label">Emp Id</label>
                                        <input class="form-control form-white" placeholder="Enter Emp Id" type="text" id="edit_rank" name="edit_emp_id" />
                                    </div>
                                   
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <label class="control-label">Mobile No</label>
                                        <input class="form-control form-white" placeholder="Enter Mobile" type="text" id="edit_name" name="edit_mobile" />
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <input type='hidden' id="edit_id" value="" name="edit_id">  
                            <button type="submit" class="btn btn-danger waves-effect waves-light ">Save</button>
                            <button type="button" class="btn btn-secondary waves-effect " data-dismiss="modal">Close</button>
                        </div>
                    </form>
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
                            <form action="{{ route('delete.wpn') }}" method="POST">
                                @csrf
                              <input type='hidden' id="del_id" value="" name="del_id">  
                              <button type="button" class="btn btn-secondary waves-effect " data-dismiss="modal">No</button>
                              <button type="submit" class="btn btn-primary">Yes</button>
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
        $(document).ready(function(){
            $('.btn-delete').click(function(){
                let del_id = $(this).attr('rel');
                $('#del_id').val(del_id);
                console.log(del_id);
            })
             
        });
    </script>
   <script>

    $(document).on("click", ".current_history", function () {
    var id = $(this).attr("rel"); // Get ID from 'rel' attribute
    // alert(id); // Debugging

    $.ajax({
        url: "{{ route('wpn.current.history') }}",
        type: "GET",
        dataType: "json",
        data: { id: id },
        success: function (response) {
            console.log(response);
            if (response.length > 0) {
                var tableHtml = '<table class="table table-bordered">';
                tableHtml += '<thead><tr>';
                $.each(response[0], function (key) {
                    tableHtml += "<th>" + key.replace("_", " ").toUpperCase() + "</th>";
                });
                tableHtml += "</tr></thead><tbody>";

                $.each(response, function (_, record) {
                    tableHtml += "<tr>";
                    $.each(record, function (_, value) {
                        tableHtml += "<td>" + (value !== null ? value : "N/A") + "</td>";
                    });
                    tableHtml += "</tr>";
                });

                tableHtml += "</tbody></table>";

                $(".modal-body .table-responsive").html(tableHtml);
            } else {
                $(".modal-body .table-responsive").html("<p>No records found.</p>");
            }

            $("#myModal").modal("show");
        },
        error: function (xhr, status, error) {
            console.error("Error:", status, error);
            console.error("Response Text:", xhr.responseText);
            $(".modal-body .table-responsive").html("<p>Error fetching data. Please try again.</p>");
            $("#myModal").modal("show");
        },
    });
});

   </script>

</body>
<div class="modal fade " id="myModal" role="dialog">
    <div class="modal-dialog modal-lg"> <!-- Changed to modal-lg for more space -->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Current Issued</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="table-responsive"></div> <!-- Table data will be injected here -->
            </div>
        </div>
    </div>
</div>

</html>