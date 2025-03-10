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
    <title>Master Report</title>
    <!-- Custom CSS -->
    @include('admin.dashboard.common.header_lib')
    <style>
       
        table th, table td {
            white-space: nowrap;
         
        }
        .table-container {
            overflow-x: auto;
        }
        .font-sm{
            font-size: 12px;
        }

        .select2-container .select2-selection--single {
             height: 35px; 
            /* width: 280px; */
            display: flex;
            
            border:0;
            align-items: center; /* Center the text */
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            font-size: 14px; /* Optional: Adjust text size */
            padding: 5px 0px 0px 10px; /* Optional: Add padding */
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
           height: 35px; 
            /* border: 0;
            width: 150px; */ 
        }
    </style>
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
                                    <li class="breadcrumb-item active" aria-current="page">In Out Report</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="">
                    <h3 class="mb-4">WEAPON IN/OUT REPORT</h3>
                    
                    <table class="table table-sm table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>SR NO.</th>
                                <th>WPN TYPE</th>
                                <th>AUTH</th>
                                <th>HELD</th>
                                <th>IN KOTE</th>
                                <th>ON DUTY (LESS THAN 24 HRS)</th>
                                <th>OUT DUTY (MORE THAN 24 HRS)</th>
                                <th>TOTAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- <tr>
                                <td>1</td>
                                <td>Shotgun</td>
                                <td>14</td>
                                <td class="text-danger">2</td>
                                <td class="text-danger">2</td>
                                <td class="text-danger">0</td>
                                <td class="text-danger">0</td>
                                <td class="text-danger">2</td>
                            </tr> --}}

                            @php
                            // $wpntype = $this->db->from('wpn_types')->get()->result();
                            $wpntype = DB::table('wpn_types')->get();
                            @endphp
                @if (!empty($wpntype)) 
                    @php  
                    $i = 1;
                    @endphp
                    @foreach($wpntype as $key)
                    @php 
                            $held = DB::table('wpn_list')
                                ->where('wpn_type', $key->id)
                                ->count();

                            $kote = DB::table('wpn_list')
                                ->where('wpn_type', $key->id)
                                ->where('status', 0)
                                ->count();

                            $less24 = DB::table('wpn_issue_rec')
                                ->join('wpn_list', 'wpn_list.id', '=', 'wpn_issue_rec.wpn_id')
                                ->where('wpn_type', $key->id)
                                ->whereNull('return_date')
                                ->where('nature', 0)
                                ->count();

                            $more24 = DB::table('wpn_issue_rec')
                                ->join('wpn_list', 'wpn_list.id', '=', 'wpn_issue_rec.wpn_id')
                                ->where('wpn_type', $key->id)
                                ->whereNull('return_date')
                                ->where('nature', 1)
                                ->count();

                        @endphp
                                {{-- <tr>
                                    <td><?php echo $i ?></td>
                                    <td><?= $key->type ?></td>
                                    <td><?= $key->qty ?></td>
                                    <td onclick="get_held_wpn('{{ $key->id}}')"><?= $held != 0 
                                        ? "<span style='color:red;font-weight:600;cursor: pointer;'>$held</span>" 
                                        : "<span style='color:red;font-weight:600;'>$held</span>" ?></td>
                                    <td onclick="get_kote_wpn('<?=$key->id?>')"><?= $kote != 0 
                                        ? "<span style='color:red;font-weight:600;cursor: pointer;'>$kote</span>" 
                                        : "<span style='color:red;font-weight:600;'>$kote</span>" ?></td>
                                    <td onclick="get_less24_wpn('<?=$key->id?>')"><?= $less24 != 0 
                                        ? "<span style='color:red;font-weight:600;cursor: pointer;'>$less24</span>" 
                                        : "<span style='color:red;font-weight:600;'>$less24</span>" ?></td>
                                    <td onclick="get_more24_wpn('<?=$key->id?>')"><?= $more24 != 0 
                                        ? "<span style='color:red;font-weight:600;cursor: pointer;'>$more24</span>" 
                                        : "<span style='color:red;font-weight:600;'>$more24</span>" ?></td>
                                    <td onclick="get_held_wpn('<?=$key->id?>')">
                                        <?= $held != 0 
                                        ? "<span style='color:red;font-weight:600;cursor: pointer;'>$held</span>" 
                                        : "<span style='color:red;font-weight:600;'>$held</span>" ?>
                                    </td>
                                </tr> --}}

                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $key->type }}</td>
                                    <td>{{ $key->qty }}</td>
                                    <td onclick="get_held_wpn('{{ $key->id }}')">
                                        @if($held != 0)
                                            <span style="color:red; font-weight:600; cursor: pointer;">{{ $held }}</span>
                                        @else
                                            <span style="color:red; font-weight:600;">{{ $held }}</span>
                                        @endif
                                    </td>
                                    <td onclick="get_kote_wpn('{{ $key->id }}')">
                                        @if($kote != 0)
                                            <span style="color:red; font-weight:600; cursor: pointer;">{{ $kote }}</span>
                                        @else
                                            <span style="color:red; font-weight:600;">{{ $kote }}</span>
                                        @endif
                                    </td>
                                    <td onclick="get_less24_wpn('{{ $key->id }}')">
                                        @if($less24 != 0)
                                            <span style="color:red; font-weight:600; cursor: pointer;">{{ $less24 }}</span>
                                        @else
                                            <span style="color:red; font-weight:600;">{{ $less24 }}</span>
                                        @endif
                                    </td>
                                    <td onclick="get_more24_wpn('{{ $key->id }}')">
                                        @if($more24 != 0)
                                            <span style="color:red; font-weight:600; cursor: pointer;">{{ $more24 }}</span>
                                        @else
                                            <span style="color:red; font-weight:600;">{{ $more24 }}</span>
                                        @endif
                                    </td>
                                    <td onclick="get_held_wpn('{{ $key->id }}')">
                                        @if($held != 0)
                                            <span style="color:red; font-weight:600; cursor: pointer;">{{ $held }}</span>
                                        @else
                                            <span style="color:red; font-weight:600;">{{ $held }}</span>
                                        @endif
                                    </td>
                                </tr>
                    @endforeach
                            @php
                           $i++;
                           @endphp
                
                @else
                            <tr>
                                <td colspan="16">
                                    <font color="red">
                                        <center>No Result found</center>
                                    </font>
                                </td>
                            </tr>
                @endif
                            


                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog modal-md">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"></h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered mg-b-0" id="dataTables-example">
                                    <thead class="thead-dark" >
                                        <tr>
                                            <th>Wpn Tag</th>
                                            <th>Type</th>
                                            <th>Regd No</th>
                                            <th>Butt No</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tblval">
                                        <tr>
                                            <td>Alfreds </td>
                                            <td>Maria Anders</td>
                                            <td>Germany</td>
                                            <td>Germany</td>
                                            
                                        </tr>
                                    </tbody>
                                </table>
                            </div>


                        </div>
                        <!-- <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div> -->
                    </div>

                </div>
            </div>

            <div class="modal fade" id="myModal1" role="dialog">
                <div class="modal-dialog modal-lg">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"></h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered mg-b-0" id="dataTables-example">
                                    <thead class="thead-dark" >
                                        <tr>
                                            <th>Wpn Tag</th>
                                            <th>Type</th>
                                            <th>Regd No</th>
                                            <th>Butt No</th>
                                            <th>Army No</th>
                                            <th>Name</th>
                                            <th>Rank</th>
                                            <th>purpose</th>
                                            <th>Issue Date</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody id="tblval1">
                                        <tr>
                                            <td>Alfreds </td>
                                            <td>Maria Anders</td>
                                            <td>Germany</td>
                                            <td>Germany</td>
                                            <td>Germany</td>
                                            <td>Germany</td>
                                            <td>Germany</td>
                                            <td>Germany</td>
                                            <td>Germany</td>
                                            
                                            
                                        </tr>
                                    </tbody>
                                </table>
                            </div>


                        </div>
                        <!-- <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div> -->
                    </div>

                </div>
            </div>
            @include('admin.dashboard.common.footer')

        </div>
    </div>

    @include('admin.dashboard.common.footer_lib')
    <script>
        $(document).ready(function() {
            $('.select21').select2({
                placeholder: 'Select ID No',
                allowClear: true
            });
        });
        $(document).ready(function() {
            $('.select22').select2({
                placeholder: 'Select Rank',
                allowClear: true
            });
        });
        $(document).ready(function() {
            $('.select23').select2({
                placeholder: 'Select WPN Type',
                allowClear: true
            });
        });
       
    </script>

<script>
    function get_held_wpn(wpn_type_id) {
        console.log(wpn_type_id);
                var url = '{{ route("weapons.getHeld")}}';
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        'wpn_type_id': wpn_type_id,
                        _token: '{{ csrf_token() }}',
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data.length > 0) {

                            $('#tblval').html('');

                            var tabl_html = '';
                            $.each(data, function(ind, val) {
                                tabl_html = tabl_html + '<tr><td>' + val.wpn_tag + '</td><td>' + val
                                    .type + '</td><td>' + val.regd_no + '</td><td>' + val
                                    .butt_no + '</td></tr>';
                            })

                            $('#tblval').html(tabl_html);
                            $('#myModal').modal('show');
                        }
                    }

                });

            }


            function get_kote_wpn(wpn_type_id) {
                var url = '{{ route("weapons.getKote")}}';
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        'wpn_type_id': wpn_type_id,
                        _token: '{{ csrf_token() }}',
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data.length > 0) {
                            $('#tblval').html('');
                            var tabl_html = '';
                            $.each(data, function(ind, val) {
                                tabl_html = tabl_html + '<tr><td>' + val.wpn_tag + '</td><td>' + val
                                    .type + '</td><td>' + val.regd_no + '</td><td>' + val
                                    .butt_no + '</td></tr>';
                            })
                            $('#tblval').html(tabl_html);
                            $('#myModal').modal('show');
                        }
                    }
                });
            }

            function get_less24_wpn(wpn_type_id) {
                var url = '{{ route("weapons.getLess24")}}';
                // console.log(wpn_type_id);
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        'wpn_type_id': wpn_type_id,
                        _token: '{{ csrf_token() }}',
                    },
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        if (data.length > 0) {
                            $('#tblval1').html('');
                            var tabl_html = '';
                            $.each(data, function(ind, val) {
                                let date = new Date(val.created_at);
                                let options = { year: 'numeric', month: 'long', day: '2-digit' };
                                let formated_date = date.toLocaleDateString('en-GB', options); // Date part
                                let hours = String(date.getHours()).padStart(2, '0');
                                let minutes = String(date.getMinutes()).padStart(2, '0');
                                let formated_data = formated_date + ' ' + hours + ':' + minutes;
                                tabl_html = tabl_html + '<tr><td>' + val.wpn_tag + '</td><td>' + val
                                    .type + '</td><td>' + val.regd_no + '</td><td>' + val
                                    .butt_no + '</td><td>' + val.emp_id + '</td><td>' 
                                    + val.emp_name + '</td><td>' + val.rank_name + '</td><td>' + val.purpose + '</td><td>' 
                                    + formated_data + '</td></tr>';
                            })
                            $('#tblval1').html(tabl_html);
                            $('#myModal1').modal('show');
                        }
                    }
                });
            }

            function get_more24_wpn(wpn_type_id) {
                var url = '{{ route("weapons.getMore24")}}';
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        'wpn_type_id': wpn_type_id,
                        _token: '{{ csrf_token() }}',
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data.length > 0) {
                            $('#tblval1').html('');
                            var tabl_html = '';
                            $.each(data, function(ind, val) {
                                let date = new Date(val.created_at);
                                let options = { year: 'numeric', month: 'long', day: '2-digit' };
                                let formated_date = date.toLocaleDateString('en-GB', options); // Date part
                                let hours = String(date.getHours()).padStart(2, '0');
                                let minutes = String(date.getMinutes()).padStart(2, '0');
                                let formated_data = formated_date + ' ' + hours + ':' + minutes;
                                tabl_html = tabl_html + '<tr><td>' + val.wpn_tag + '</td><td>' + val
                                    .type + '</td><td>' + val.regd_no + '</td><td>' + val
                                    .butt_no + '</td><td>' + val.emp_id + '</td><td>' 
                                    + val.emp_name + '</td><td>' + val.rank_name + '</td><td>' + val.purpose + '</td><td>' 
                                    + formated_data + '</td></tr>';
                            })
                            $('#tblval1').html(tabl_html);
                            $('#myModal1').modal('show');
                        }
                    }
                });
            }
</script>
    
</body>

</html>