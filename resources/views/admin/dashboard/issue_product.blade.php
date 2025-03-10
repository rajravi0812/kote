<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>Add Vehicle </title>

    @include('admin.dashboard.common.header_lib')

    <style>
        .selectable-card {
            border: 2px solid #ddd;
            border-radius: 8px;
            padding: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .selectable-card:hover {
            border-color: #3498db;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .selectable-card.selected {
            border-color: #3498db;
            background-color: #3498db;
            color:white;
        }

        .hidden-radio {
            display: none;
        }

        #serialNumbersSection {
            padding: 20px;
            background: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    
        .form-check-input.custom-checkbox {
            appearance: none;
            width: 20px;
            height: 20px;
            border: 2px solid #007bff;
            border-radius: 4px;
            background-color: #fff;
            transition: all 0.2s;
            cursor: pointer;
        }
    
        .form-check-input.custom-checkbox:checked {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
        }
    
        .form-check-label {
            margin-left: 10px;
            font-size: 14px;
            font-weight: 500;
        }
    
        #serialNumbersList {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
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
                        <h4 class="page-title">Issue Product</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Issue Product</li>
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
           

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="container-fluid">    
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <form action="{{route('issue.products.action')}}" method="POST" id="assignVehForm">
                                @csrf
                                <input type="hidden" name="product_id" value="{{$products->id}}">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                            <table id="zero_config" class="table  table-bordered table-sm">
                                                <thead  style="color:white; background-color:#3498db;">
                                                    <tr>
                                                        <th><center><b>Product Name</b></center></th>
                                                        <th><center><b>Product Cat</b></center></th>
                                                        <th><center><b>Fund Type</b></center></th>
                                                        <th><center><b>Fund Sub-Cat</b></center></th>
                                                        <th><center><b>Product Qty</b></center></th>
                                                        <th><center><b>Qty Issued</b></center></th>
                                                        <th><center><b>Quantity to Issue</b></center></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if(!empty($products))
                                                    <tr>
                                                        <td><center>{{ $products->product_name }}</center></td>
                                                        <td><center>{{ $products->p_cat_name }}</center></td>
                                                        <td><center>{{ $products->fund_cat_name }}</center></td>
                                                        <td><center>{{ $products->fund_subcat_name }}</center></td>
                                                        <td><center>{{ $products->product_qty}}</center></td>
                                                        <td><center>{{ $products->issued_qty}}</center></td>
                                                        <td><center><input type="number" class="form-control quantity-input" name="quantity_to_issue" max="{{ $products->product_qty - $products->issued_qty }}" placeholder="Enter quantity" required></center></td>
                                                    </tr>
                                                    @else
                                                    <td colspan="23"><center>No Data Found</center></td>
                                                    @endif
                                                </tbody>
                                            </table>
                                            </div>
                                        </div>
                                        <!-- Serial Numbers Section -->
                                        {{-- <div id="serialNumbersSection" style="display: none;">
                                            <h3>Select Serial Numbers:</h3>
                                            <div class="form-group">
                                                <label for="serialNumbers">Available Serial Numbers:</label>
                                                <div id="serialNumbersList">
                                                    @if (is_array($serialNumbers) && count($serialNumbers) > 0)
                                                        @foreach ($serialNumbers as $serial)
                                                            <div class="form-check">
                                                                <input class="form-check-input serial-checkbox" type="checkbox" 
                                                                    name="serial_numbers[]" value="{{ $serial }}" 
                                                                    id="serial_{{ $serial }}">
                                                                <label class="form-check-label" for="serial_{{ $serial }}">
                                                                    {{ $serial }}
                                                                </label>
                                                            </div>
                                                    @endforeach
                                                    @endif
                                                </div>
                                                <small class="form-text text-muted">Select up to the issue quantity.</small>
                                            </div>
                                        </div> --}}

                                        @if ($products->having_serial == "yes")
                                        <div id="serialNumbersSection">
                                            <h3>Select Serial Numbers:</h3>
                                            <div class="form-group">
                                                <label for="serialNumbers">Available Serial Numbers:</label>
                                                <div id="serialNumbersList" class="row row-cols-1 row-cols-md-4 g-3">
                                                    @if (is_array($serialNumbers) && count($serialNumbers) > 0)
                                                        @foreach ($serialNumbers as $serial)
                                                        <div class="col">
                                                            <div class="form-check">
                                                                <input class="form-check-input serial-checkbox" type="checkbox" 
                                                                    name="serial_numbers[]" value="{{ $serial }}" 
                                                                    id="serial_{{ $serial }}">
                                                                <label class="form-check-label" for="serial_{{ $serial }}">
                                                                    {{ $serial }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    @else
                                                        <p class="text-muted">No serial numbers available.</p>
                                                    @endif
                                                </div>
                                                <small class="form-text text-muted">You must select exactly the number of serial numbers as the issue quantity.</small>
                                            </div>
                                        </div>
                                        {{-- @else
                                        <p>serial no not available</p> --}}
                                        @endif


                                        <div class="col-md-12">
                                            <h3>Product to Be Issued To:</h3>
                                            <div class="row">
                                                <div class="col-md-3"></div>
                                                <div class="col-md-3">
                                                    <center>
                                                    <label class="selectable-card" for="branchOption">
                                                        <input type="radio" class="hidden-radio" name="issueOption" value="branch" id="branchOption">
                                                        <div>
                                                            <h5>Branch</h5>
                                                            <select id="branchSelect" class="form-control" name="branch_id" disabled>
                                                                <option value="">Select Branch</option>
                                                                @foreach ($branch as $branches)
                                                                    <option value="{{$branches->id}}">{{$branches->branch_name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </label>
                                                    </center>
                                                </div>
                                                <div class="col-md-3">
                                                    <center>
                                                    <label class="selectable-card" for="storeOption">
                                                        <input type="radio" class="hidden-radio" name="issueOption" value="store" id="storeOption">
                                                        <div>
                                                            <h5>Store</h5>
                                                            <select id="storeSelect" class="form-control" name="store_id" disabled>
                                                                <option value="">Select Store</option>
                                                                @foreach ($store as $stores)
                                                                    <option value="{{$stores->id}}">{{$stores->store_name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </label>
                                                    </center>
                                                </div>
                                                <div class="col-md-3"></div>
                                            </div>
                                        </div>
                                    </div>
                                <div class="border-top">
                                    <div class="card-body" style="float:right;">
                                        <input type="hidden" value="{{$products->having_serial}}" name="having_serial">
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
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.selectable-card');
            const branchOption = document.getElementById('branchOption');
            const storeOption = document.getElementById('storeOption');
            const branchSelect = document.getElementById('branchSelect');
            const storeSelect = document.getElementById('storeSelect');
            const issueoption = document.getElementsByName('issueOption');
            console.log(issueoption);
            function resetSelect(selectElement) {
                selectElement.selectedIndex = 0;
            }

            cards.forEach(card => {
                card.addEventListener('click', function() {
                    cards.forEach(c => c.classList.remove('selected'));
                    this.classList.add('selected');

                    if (branchOption.checked) {
                        branchSelect.disabled = false;
                        storeSelect.disabled = true;
                        resetSelect(storeSelect);
                    } else if (storeOption.checked) {
                        storeSelect.disabled = false;
                        branchSelect.disabled = true;
                        resetSelect(branchSelect);
                    }
                });
            });

            const quantityInputs = document.querySelectorAll('.quantity-input');
            quantityInputs.forEach(input => {
                input.addEventListener('input', function() {
                    const max = parseInt(this.max, 10);
                    if (parseInt(this.value, 10) > max) {
                        alert('Quantity cannot exceed available product quantity.');
                        this.value = max;
                    }
                });
            });
        });

    </script>
     @if ($products->having_serial == "yes")
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const quantityInput = document.querySelector('.quantity-input');
            const serialNumbersSection = document.getElementById('serialNumbersSection');
            const serialCheckboxes = document.querySelectorAll('.serial-checkbox');
            const form = document.querySelector('form');
    
            // Enforce issue quantity selection
            form.addEventListener('submit', function (event) {
                const selectedCheckboxes = Array.from(serialCheckboxes).filter(checkbox => checkbox.checked);
                const issueQuantity = parseInt(quantityInput.value, 10);
    
                if (selectedCheckboxes.length !== issueQuantity) {
                    event.preventDefault();
                    alert(`Please select exactly ${issueQuantity} serial number(s).`);
                }
            });
    
            function updateSerialSelection() {
                const maxSelection = parseInt(quantityInput.value, 10) || 0;
                let selectedCount = 0;
    
                serialCheckboxes.forEach(checkbox => {
                    if (checkbox.checked) selectedCount++;
                    checkbox.disabled = selectedCount >= maxSelection && !checkbox.checked;
                });
    
                if (selectedCount > maxSelection) {
                    alert(`You can select only ${maxSelection} serial numbers.`);
                    this.checked = false;
                }
            }
    
            quantityInput.addEventListener('input', updateSerialSelection);
            serialCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateSerialSelection);
            });
        });
    </script>
    @endif
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const quantityInput = document.querySelector('.quantity-input');
            const serialNumbersSection = document.getElementById('serialNumbersSection');
            const serialCheckboxes = document.querySelectorAll('.serial-checkbox');
            const form = document.querySelector('form');

            // Enforce issue quantity selection
            form.addEventListener('submit', function (event) {
                const selectedCheckboxes = Array.from(serialCheckboxes).filter(checkbox => checkbox.checked);
                const issueQuantity = parseInt(quantityInput.value, 10);

                if (selectedCheckboxes.length !== issueQuantity) {
                    event.preventDefault();
                    alert(`Please select exactly ${issueQuantity} serial number(s).`);
                }
            });

            function toggleSerialNumberSection() {
                const hasSerial = {{ $products->having_serial ? 'true' : 'false' }}; // Pass from server
                serialNumbersSection.style.display = hasSerial ? 'block' : 'none';
            }

            function updateSerialSelection() {
                const maxSelection = parseInt(quantityInput.value, 10) || 0;
                let selectedCount = 0;

                serialCheckboxes.forEach(checkbox => {
                    if (checkbox.checked) selectedCount++;
                    checkbox.disabled = selectedCount >= maxSelection && !checkbox.checked;
                });

                if (selectedCount > maxSelection) {
                    alert(`You can select only ${maxSelection} serial numbers.`);
                    this.checked = false;
                }

            }

            quantityInput.addEventListener('input', updateSerialSelection);
            serialCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateSerialSelection);
            });

            toggleSerialNumberSection();
        });
    </script> --}}
</body>

</html>
