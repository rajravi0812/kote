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
    <title>Manage Branches</title>
    <!-- Custom CSS -->
    @include('admin.dashboard.common.header_lib')
    <style>
        .select2-selection__choice__display{
            color: black !important;
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
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        @include('admin.dashboard.common.header')
        <h2 class="mb-4 mt-2 mx-2">Manage Ammunition</h2>
    <div class="container mt-1" style="min-height: 350px;">
       
        <button class="btn btn-success mb-1 btn-sm" data-toggle="modal" data-target="#addAmmunitionModal">Add Ammunition</button>

        <table class="table table-bordered table-sm" >
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Ammunition Name</th>
                    <th width="40%">Weapon Types</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($ammunition))
                    @foreach ($ammunition as $request)
                    <tr>
                        <td><center>{{ ($ammunition->currentPage() - 1) * $ammunition->perPage() + $loop->iteration }}</center></td>
                        <td>{{ $request->amn_name}}</td>
                        @php
                                $wpn_types = \App\Models\WpnTypeAmmunition::where('amn_id', $request->id)->pluck('wpn_type_id');
                                $weaponNames = \App\Models\WpnType::whereIn('id', $wpn_types)->pluck('type');
                                $weaponTypeId= \App\Models\WpnType::whereIn('id', $wpn_types)->pluck('id');
                        @endphp
                        <td>
                        @if(!empty($wpn_types))
                                @foreach($weaponNames as $weapon)
                                    <span class="badge badge-primary" style="font-size: 0.8rem;">{{ $weapon }}</span>
                                @endforeach
                        @endif
                        </td>
                        <td>{{$request->qty}}</td>
                        <td>
                            <button class="btn btn-cyan btn-sm edit-btn" 
                                data-toggle="modal" 
                                data-target="#editAmmunitionModal" 
                                data-id="{{ $request->id }}" 
                                data-name="{{ $request->amn_name }}" 
                                data-types="{{ $weaponTypeId->implode(', ') }}" 
                                data-qty="{{ $request->qty }}">Edit</button>

                            <button data-toggle="modal" 
                                data-target="#amnqtymodal" 
                                data-id="{{ $request->id }}"  
                                data-name="{{ $request->amn_name }}" 
                                class="btn btn-info btn-sm qty-btn"> Add Quantity 
                            </button>  
                            <button class="btn btn-warning btn-sm history-btn" 
                                data-id="{{ $request->id }}"  
                                data-name="{{ $request->amn_name }}" 
                                data-toggle="modal" 
                                data-target="#amnHistoryModal">
                                View History
                            </button>
                            <button class="btn btn-danger btn-sm delete-btn" 
                                data-toggle="modal" 
                                data-target="#deleteAmmunitionModal" 
                                data-id="{{ $request->id }}">Delete</button>
                        </td>
                        
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        <div class="pagination" style="float:right;">
            {!! $ammunition->links() !!}
        </div>
    </div>

    <!-- ADD Ammunition Modal -->
    <div class="modal fade" id="addAmmunitionModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('add.amn') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add Ammunition</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Ammunition Name</label>
                            <input type="text" class="form-control" name="amn_name" required>
                        </div>
                        <div class="form-group">
                            <label>Weapon Types</label>
                            <select class="form-control select2" style="color:black;" multiple name="wpn_types[]">
                            @if(!empty($wpnTypes))
                            @foreach($wpnTypes as $request)
                                <option value="{{ $request->id}}">{{$request->type}}</option>
                             
                            @endforeach
                            @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="number" class="form-control" name="qty" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- EDIT Ammunition Modal -->
    <div class="modal fade" id="editAmmunitionModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('update.amn', ':id') }}" method="POST" id="editAmmunitionForm">
                    @csrf
                    <input type="hidden" name="edit_id" id="edit_id">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Ammunition</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Ammunition Name</label>
                            <input type="text" class="form-control" name="edit_name" id="edit_name" required>
                        </div>
                        <div class="form-group">
                            <label>Weapon Types</label>
                            <select class="form-control select2" multiple name="edit_wpn_types[]" id="edit_wpn_types">
                                @if(!empty($wpnTypes))
                                    @foreach($wpnTypes as $request)
                                        <option value="{{ $request->id}}">{{$request->type}}</option>
                                    
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="number" class="form-control" name="edit_qty" id="edit_qty" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- DELETE Ammunition Modal -->
    <div class="modal fade" id="deleteAmmunitionModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Ammunition</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this ammunition?
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="delete_id">
                    <button type="button" class="btn btn-danger">Delete</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
        @include('admin.dashboard.common.footer')
    </div>

    {{-- added Ammunition quantity modal --}}
    <div class="modal fade" id="amnqtymodal" tabindex="-1" role="dialog"> 
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('add.amn.qty') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <input type="hidden"  id="amn_id" name="amn_id" value="">
                        <h5 class="modal-title">Add Ammunition Qty - <span id="ammunition_name"></span></h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="number" class="form-control" name="qty" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Date & Time</label>
                            <input type="datetime-local" class="form-control" name="date_time" id="current_date_time" readonly required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Ammunition History Modal --}}
    <div class="modal fade" id="amnHistoryModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ammunition History - <span id="history_ammunition_name"></span></h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <!-- Date Filters -->
                    <div class="row mb-3">
                        <div class="col-md-5">
                            <label>From Date</label>
                            <input type="date" id="from_date" class="form-control">
                        </div>
                        <div class="col-md-5">
                            <label>To Date</label>
                            <input type="date" id="to_date" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label>&nbsp;</label>
                            <button class="btn btn-primary btn-block" id="filterBtn">Filter</button>
                        </div>
                    </div>
    
                    <!-- History Table -->
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date & Time</th>
                                <th>Added Quantity</th>
                                
                            </tr>
                        </thead>
                        <tbody id="history_table_body">
                            <!-- History data will be appended here -->
                        </tbody>
                    </table>
    
                    <div id="history_pagination"></div> <!-- Pagination controls -->
                </div>
            </div>
        </div>
    </div>
    
    @include('admin.dashboard.common.footer_lib')
</div>
<script>
$(document).ready(function() {
    $('.edit-btn').click(function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        var types = $(this).data('types'); // Get weapon types as string
        var qty = $(this).data('qty');
        console.log(id,name,types,qty,"this is the data");
        // Set values in the modal fields
        $('#edit_id').val(id);
        $('#edit_name').val(name);
        $('#edit_qty').val(qty);


        types = types ? String(types) : ''; 

        // Convert types into an array correctly
        var selectedTypes = types.length ? types.split(',').map(type => type.trim()) : [];

        console.log(selectedTypes); // Debugging

        // Select values dynamically, ensuring it works for empty, single, or multiple values
        $('#edit_wpn_types').val(selectedTypes.length ? selectedTypes : null).trigger('change');
        var formAction = "{{ route('update.amn') }}";
        $('#editAmmunitionForm').attr('action', formAction);
    });
});

</script>
<script>
 $(document).ready(function() {
    $('.qty-btn').click(function() {
        var amn_id = $(this).data('id');
        var amn_name = $(this).data('name');
        $('#ammunition_name').text(amn_name);
        $('#amn_id').val(amn_id);
        // Get current date and time in YYYY-MM-DDTHH:MM format (for datetime-local)
        var now = new Date();
        var year = now.getFullYear();
        var month = ('0' + (now.getMonth() + 1)).slice(-2);
        var day = ('0' + now.getDate()).slice(-2);
        var hours = ('0' + now.getHours()).slice(-2);
        var minutes = ('0' + now.getMinutes()).slice(-2);
        
        var currentDateTime = `${year}-${month}-${day}T${hours}:${minutes}`;

        // Set the datetime-local input field
        $('#current_date_time').val(currentDateTime);
    });
});

</script>
<script>
    function formatDateTime(dateTime) {
    let date = new Date(dateTime);
    let day = String(date.getDate()).padStart(2, '0');
    let month = String(date.getMonth() + 1).padStart(2, '0'); // Months are 0-based
    let year = date.getFullYear();
    let time = date.toLocaleTimeString(); // Keep time format as it is

    return `${day}-${month}-${year} ${time}`;
}
    $(document).ready(function() {
        // Initialize Select2 for the weapon types dropdown
        $('.select2').select2({
            placeholder: "Select Weapon Types",
            allowClear: true
        });
    
        // Ensure Select2 is reinitialized when modal opens
        $('#addAmmunitionModal').on('shown.bs.modal', function () {
            $('.select2').select2({
                placeholder: "Select Weapon Types",
                allowClear: true
            });
        });
    });
    </script>
    <script>
        $(document).ready(function() {
    let currentAmnId = null;

    $('.history-btn').click(function() {
        currentAmnId = $(this).data('id');
        var amn_name = $(this).data('name');

        $('#history_ammunition_name').text(amn_name);
        $('#from_date').val('');
        $('#to_date').val('');
        fetchHistory(currentAmnId, 1); // Load first page without filters
    });

    function fetchHistory(amn_id, page) {
        var fromDate = $('#from_date').val();
        var toDate = $('#to_date').val();

        $.ajax({
            url: "{{ route('get.amn.history') }}",
            type: "GET",
            data: { 
                amn_id: amn_id, 
                page: page,
                from_date: fromDate,
                to_date: toDate
            },
            success: function(response) {
                $('#history_table_body').empty();
                $('#history_pagination').empty();

                if (response.data.length > 0) {
                    $.each(response.data, function(index, history) {
                        $('#history_table_body').append(`
                            <tr>
                                <td>${(response.current_page - 1) * response.per_page + (index + 1)}</td>
                                <td>${formatDateTime(history.created_at)}</td>
                                <td>${history.added_qty}</td>
                                
                            </tr>
                        `);
                    });

                    // Pagination
                    if (response.last_page > 1) {
                        var pagination = '<nav><ul class="pagination justify-content-center">';
                        
                        if (response.current_page > 1) {
                            pagination += `<li class="page-item"><a class="page-link pagination-link" data-page="${response.current_page - 1}" href="#">Previous</a></li>`;
                        }

                        for (var i = 1; i <= response.last_page; i++) {
                            pagination += `<li class="page-item ${i === response.current_page ? 'active' : ''}"><a class="page-link pagination-link" data-page="${i}" href="#">${i}</a></li>`;
                        }

                        if (response.current_page < response.last_page) {
                            pagination += `<li class="page-item"><a class="page-link pagination-link" data-page="${response.current_page + 1}" href="#">Next</a></li>`;
                        }

                        pagination += '</ul></nav>';
                        $('#history_pagination').html(pagination);
                    }
                } else {
                    $('#history_table_body').append('<tr><td colspan="3" class="text-center">No history found</td></tr>');
                }
            }
        });
    }

    // Filter button click event
    $('#filterBtn').click(function() {
        if (currentAmnId) {
            console.log(currentAmnId);
            fetchHistory(currentAmnId, 1);
        }
    });

    // Handle pagination click
    $(document).on('click', '.pagination-link', function(e) {
        e.preventDefault();
        var page = $(this).data('page');
        fetchHistory(currentAmnId, page);
    });
});

    </script>

</body>
</html>
