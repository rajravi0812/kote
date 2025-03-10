<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>Wpn Issued</title>
    @include('admin.dashboard.common.header_lib')
    <style>
        .card {
          border: none;
          box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        .btn-active {
          background-color: #007bff;
          color: white;
        }
        .status-in {
          background-color: #d4edda;
          color: #155724;
          font-weight: bold;
        }
        .status-out {
          background-color: #f8d7da;
          color: #721c24;
          font-weight: bold;
        }
        .btn {
          margin-right: 10px;
        }
        .scan-input {
          border: 1px solid #dc3545;
          border-radius: 5px;
        }
      </style>
      <style>
        #loader {
            display: none; /* Hide the loader by default */
        }
    
        .table2 thead {
        position: sticky;
        top: 0; /* Sticks the header to the top */
    
        z-index: 1; /* Keeps the header above the table body */
    }
    
    /* radio buttons */
    .custom-radio-group {
      display: inline-block;
      position: relative;
      margin-right: 10px;
    }
    
    .custom-radio-group input[type="radio"] {
      display: none; /* Hide default radio button */
    }
    
    .custom-radio {
      padding: 5px 10px;
      border: 2px solid #1d7ca5;
      border-radius: 5px;
      background-color: white;
      color: #1d7ca5;
      font-size: 14px;
      cursor: pointer;
      transition: all 0.3s ease;
    }
    
    .custom-radio:hover {
      background-color: #1d7ca5;
      color: white;
    }
    
    .custom-radio-group input[type="radio"]:checked + .custom-radio {
      background-color: #1d7ca5;
      color: white;
    }
    
    /* barcode  */
    
    .scan-label {
      font-size: 16px;
      color: #e60026;
    }
    
    .input-group {
      display: flex;
      position: relative;
    }
    
    .scan-input {
      width: 100%;
      padding: 5px;
      border: 2px solid #e60026;
      border-radius: 5px;
      box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
      font-size: 15px;
      transition: all 0.3s ease;
    }
    
    .scan-input:focus {
      outline: none;
      border-color: #007bff;
      box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    }
    
    .input-group-addon {
      display: flex;
      align-items: center;
      padding: 10px;
      background-color: #e60026;
      color: white;
      border-radius: 0 8px 8px 0;
    }
    
    .input-group-addon i {
      font-size: 20px;
    }
    
    .scan-input:hover {
      border-color: #007bff;
    }
    
    .scan-input::placeholder {
      color: #aaa;
      font-size: 14px;
    }
    
    
    /* added css */
    
    
    
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
                        <h4 class="page-title">Wpn Return</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Wpn Return</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid mt-1">
                <div class="row">
                  <!-- Left Panel -->
                  <div class="col-md-4">
                    <div class="card p-3">
                        <div class="text-center mb-4">
                            <a href="fingerprintapp://verify-in"  class="btn btn-warning btn-md" style="border-radius: 5px; width: 100%; font-weight:700;" id="myButton">
                                <i class="fas fa-fingerprint"></i> Click Here to Scan Fingerprint
                            </a>
                        </div>
                        <div id="details" class="mb-4">
                            <div class="row align-items-center mb-3">
                                <div class="col-md-4">
                                    <label class="form-label">Photo:</label>
                                </div>
                                <div class="col-md-8 text-center" id="image">
                                    <img src="" alt="" class="img-fluid rounded-square" style="max-width: 150px; height: auto;">
                                </div>
                            </div>
                            
                            <div class="row align-items-center mb-3">
                                <div class="col-md-4">
                                    <label class="form-label">ID No:</label>
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label" id="army_no"></label>
                                </div>
                            </div>
                            <div class="row align-items-center mb-3">
                                <div class="col-md-4">
                                    <label class="form-label">Rank:</label>
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label" id="rank"></label>
                                </div>
                            </div>
                            <div class="row align-items-center mb-3">
                                <div class="col-md-4">
                                    <label class="form-label">Name:</label>
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label" id="name"></label>
                                </div>
                            </div>
                            <div class="row align-items-center mb-3">
                                <div class="col-md-4">
                                    <label class="form-label">Unit:</label>
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label" id="unit"></label>
                                </div>
                            </div>
                            <div class="row align-items-center mb-3">
                                <div class="col-md-4">
                                    <label class="form-label">Company:</label>
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label" id="company"></label>
                                </div> 
                            </div>
                        </div>
                    </div>
                  </div>
              
                  <!-- Right Panel -->
                  <div class="col-md-8 pb-4" style="background-color: #f8f9fa; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); pointer-events: none;opacity: 0.6;" id="editable">
                    <div class="card p-3">
                      <!-- Duty and Purpose Section -->
                      <div class="justify-content-between">
                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-2">
                                <label class="form-label mg-b-0 scan-label" style="color:#e60026;"><b>Scan Weapon:</b></label>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <input class="form-control scan-input" type="text" id="barcode" placeholder="Scan or Enter Weapon ID">
                                    <span class="input-group-addon">
                                        <i class="fa fa-barcode"></i>
                                    </span>
                                    <input type="hidden" value="" id="barcode_data" required name="barcode_data[]">
                                </div>
                            </div>
                        </div>
                      </div>          
                    </div>
              
                    <!-- Table -->
                    <div class="mt-4">
                        <div class="table-responsive table2 mt-4" style="max-height:400px;">
                            <table class="table  table-bordered text-center table-sm" >
                                <thead class=" text-white" style="background-color:#1d7ca5;">
                                <tr>
                                    <th>SR NO.</th>
                                    <th>WEAPON TYPE</th>
                                    <th>REGD NO</th>
                                    <th>BUTT NUMBER</th>
                                    <th>WPN TAG</th>
                                    <th>Nature</th>
                                    <th>Purpose</th>
                                    <th>Issue Date</th>
                                </tr>
                                </thead>
                                <tbody id=tbody>
                                
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr>
                   
                    <hr>
                    <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-2">
                            <label class="form-label mg-b-0" ><b>Remark:</b></label>
                        </div>
                        <div class="col-md-10">
                            <textarea type="text" name="remark" id="remark" class="form-control" rows="3" cols="80"></textarea>
                        </div>
                    </div>
                    <hr>
                    <div class="row row-xs align-items-center ">
                        <div class="col-md-8">
                            
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-success btn-update"  style="border-radius:4px"> Return </button>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-danger" style="border-radius:4px" onclick="location.reload();">Cancel</button>

                        </div>
                    </div>
                  </div>
                </div>
                
              </div>

            @include('admin.dashboard.common.footer')
        </div>
    </div>
    @include('admin.dashboard.common.footer_lib')


<script>

$(document).ready(function() {
     
     var barcodesArray = [];
     var purpose = "";
     var wpn_ids = []; 

    let intervalId;
    var emp_id = "";
    function fetchSessionData() {
        $.ajax({
            url: '{{ route("check.session") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}', // CSRF token for security
            },
            success: function(response) {
                if (response.success) {
                    clearInterval(intervalId); // Stop the interval
                    console.log(response.data.image);
                    const publicBaseUrl = "{{ url('/storage/app') }}"; // Pass the base URL from Laravel to JavaScript

                    const imageUrl = response.data.image 
                        ? `${publicBaseUrl}${response.data.image}` 
                        : `${publicBaseUrl}/public/static/notfound.png`;  // Default image path if no photo is provided

                    $('#image img').attr('src', imageUrl);
                    $('#army_no').text(response.data.emp_id || 'N/A');
                    $('#emp_id').val(response.data.emp_id || '');
                    $('#rank').text(response.data.rank || 'N/A');
                    $('#name').text(response.data.name || 'N/A');
                    $('#unit').text(response.data.unit || 'N/A');
                    $('#company').text(response.data.company || 'N/A');
                    emp_id = response.data.emp_id;
                    $('#editable').css({
                                            'pointer-events': 'auto', 
                                            'opacity': '1'
                                        });
                    get_issue_wpn(emp_id);
                } else {
                    console.log(response.message); // Log the message for debugging
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }

    // Call the function every second
    intervalId = setInterval(fetchSessionData, 1000);



      function get_issue_wpn(emp_id) {
          var wpn_url = '{{ route("wpn.return.indl")}}';
          console.log(emp_id);
          $.ajax({
              url: wpn_url,
              type: 'POST',
              data: {
                  "emp_id": emp_id,
                  _token: '{{ csrf_token() }}',
              },
              dataType: 'json',
              success: function(list) {
                  $('#tbody').empty();
                  if (list.data.length > 0) {
                      $.each(list.data, function(index, alloted) {

                          var createdAt = new Date(alloted.created_at);
                          var formattedDate = ("0" + createdAt.getDate()).slice(-2) + "-" + 
                              ("0" + (createdAt.getMonth() + 1)).slice(-2) + "-" + 
                              createdAt.getFullYear() + " " + 
                              ("0" + createdAt.getHours()).slice(-2) + ":" + 
                              ("0" + createdAt.getMinutes()).slice(-2) + ":" + 
                              ("0" + createdAt.getSeconds()).slice(-2);

                          var nature = alloted.nature == 0 ? "Less Than 24hr" : "More Than 24hr"
                          var row = '<tr class="main-row" data-index="' + index + '" style="background-color:#F2F4FF">' +
                              '<td>' + (index + 1) + '</td>' +
                              '<td>' + alloted.type + '</td>' +
                              '<td>' + alloted.regd_no + '</td>' +
                              '<td>' + alloted.butt_no + '</td>' +
                              '<td>' + alloted.wpn_tag + '</td>' +
                              '<td>' + nature + '</td>' +
                              '<td>' + alloted.purpose + '</td>' +
                              '<td>' + formattedDate + '</td>' +
                              '</tr>';

                          var subRow = '<tr class="" data-index="' + index + '" style="background-color:#F2F4FF">' +
                              '<td colspan="8">' +
                              '<div class="sub-details">' +
                              '<label>Mag Issued:</label> <input readonly style="background-color:lightgrey;width:100px;" type="text" name="magissue_' + index + '" id="magissue_' + index + '" value="'+ alloted.megazins +'">' +
                              '<label>Slings Issued:</label> <input readonly style="background-color:lightgrey;width:100px;" type="text" name="slingsissue_' + index + '" id="slingsissue_' + index + '" value="'+ alloted.slings +'">' +
                              '<label>Bayonet Issued:</label> <input readonly style="background-color:lightgrey;width:100px;" type="text" name="bayonetissue_' + index + '" id="bayonetissue_' + index + '" value="'+ alloted.bayonet +'">' + '<br>' +
                              '<label>Mag Return:</label> <input readonly style="background-color:lightgrey;width:100px;" type="text" name="magret_' + index + '" id="magret_' + index + '" value="">' +
                              '<label>Slings Return:</label> <input readonly style="background-color:lightgrey;width:100px;" type="text" name="slingsret_' + index + '" id="slingsret_' + index + '" value="">' +
                              '<label>Bayonet Return:</label> <input readonly style="background-color:lightgrey;width:100px;" type="text" name="bayonetret_' + index + '" id="bayonetret_' + index + '" value="">' +
                              '</div>' +
                              '</td>' +
                              '</tr>';

                          $('#tbody').append(row + subRow);
                      });

                      // $('.main-row').on('click', function() {
                      //     var index = $(this).data('index');
                      //     $('tr.sub-row[data-index="' + index + '"]').toggle(); 
                      // });

                  } else {
                      $('#tbody').append('<tr><td colspan="8" class="text-center">No Wpn Found in Inventory</td></tr>');
                  }
              },
              error: function(xhr, status, error) {
                  console.error(xhr.responseText);
                  alert('Failed to fetch the Wpns list: ' + error);
              }
          });
      }

  
     

          $('#barcode').keypress(function(event) {
              var status ="";
              var color = "";
              var not_selected = "";
              if (event.which === 13) {
                  event.preventDefault();
                  var barcode = $('#barcode').val();
                  barcodesArray.push(barcode);
                  console.log(barcodesArray,emp_id);
                  
                  // Show the loader
                  $('#loader').show();

                  // First AJAX call
                  $.ajax({
                      url: '{{ route("fetch.wpn.selected")}}',
                      type: 'POST',
                      data: { barcode: barcodesArray,
                              emp_id:emp_id,
                              _token: '{{ csrf_token() }}',
                          },
                      success: function(response1) {
                          try {
                              // response1 = JSON.parse(response1);
                          } catch (e) {
                              console.error("Failed to parse response1:", e);
                              return;
                          }
                          
                          console.log('Response1:', response1);
                          $('#tbody').empty();
                          wpn_ids=[];       
                          if (Array.isArray(response1) && response1.length > 0) {
                              $.each(response1, function(index, alloted) {
                                  let nature = alloted.nature == 0 ? "Less Then 24Hr" : "More Than 24Hr";
                                  var createdAt = new Date(alloted.created_at);
                                  var formattedDate = ("0" + createdAt.getDate()).slice(-2) + "-" + 
                                      ("0" + (createdAt.getMonth() + 1)).slice(-2) + "-" + 
                                      createdAt.getFullYear() + " " + 
                                      ("0" + createdAt.getHours()).slice(-2) + ":" + 
                                      ("0" + createdAt.getMinutes()).slice(-2) + ":" + 
                                      ("0" + createdAt.getSeconds()).slice(-2);


                                  var row = '<tr style="background-color:#C3C4FF" class="main-row" data-index="' + index + '">' +
                                  '<td>' + (index + 1) + '</td>' +
                                  '<td>' + alloted.type + '</td>' +
                                  '<td>' + alloted.regd_no + '</td>' +
                                  '<td>' + alloted.butt_no + '</td>' +
                                  '<td>' + alloted.wpn_tag + '</td>' +
                                  '<td>' + nature + '</td>' +
                                  '<td>' + alloted.purpose + '</td>' +
                                  '<td>' + formattedDate + '</td>' +
                                  '</tr>';


                                  var subRow = '<tr class="sub-row" style="background-color:#C3C4FF" data-index="' + index + '">' +
                                  '<td colspan="8">' +
                                  '<div class="sub-details">' +
                                  '<input type="hidden" value="'+alloted.id+'" id=wpn_id_'+index+'>' +
                                  '<label>Mag Issued:</label> <input readonly style="background-color:lightgrey;width:100px;" type="text" name="magissue_' + index + '" id="magissue_' + index + '" value="'+ alloted.megazins +'">' +
                                  '<label>Slings Issued:</label> <input readonly style="background-color:lightgrey;width:100px;" type="text" name="slingsissue_' + index + '" id="slingsissue_' + index + '" value="'+ alloted.slings +'">' +
                                  '<label>Bayonet Issued:</label> <input readonly style="background-color:lightgrey;width:100px;" type="text" name="bayonetissue_' + index + '" id="bayonetissue_' + index + '" value="'+ alloted.bayonet +'">' + '<br>' +
                                  '<label>Mag Return:</label> <input type="text" style="width:100px;" name="magret_' + index + '" id="magret_' + index + '" value="">' +
                                  '<label>Slings Return:</label> <input type="text" style="width:100px;" name="slingsret_' + index + '" id="slingsret_' + index + '" value="">' +
                                  '<label>Bayonet Return:</label> <input type="text" style="width:100px;" name="bayonetret_' + index + '" id="bayonetret_' + index + '" value="">' +
                                  '</div>' +
                                  '</td>' +
                                  '</tr>';

                                  // Append the row to the table body
                                  $('#tbody').append(row + subRow);
                                  // wpn_ids.push({
                                  //     id:alloted.id,
                                  //     // megazins:alloted.megazins,
                                  //     // slings:alloted.slings,
                                  //     // bayonet:alloted.bayonet
                                  // });
                                  not_selected = barcodesArray.length+1;   
                                  // $('.main-row').on('click', function() {
                                  //     var index = $(this).data('index');
                                  //     $('tr.sub-row[data-index="' + index + '"]').toggle(); 
                                  // });    
                              });
                          } else {
                              // $('#tbody').append('<tr><td colspan="6" class="text-center">No Wpn Found in Inventory</td></tr>');
                              alert("Weapon Not in Inventory");
                              not_selected = barcodesArray.length; 
                          }
                      },
                      error: function(xhr, status, error) {
                          // Handle errors
                          console.error('Error:', error);
                      },
                      complete: function() {
                          // Hide the loader after the first request is complete
                          $('#loader').hide();

                          // Start the second AJAX call
                          $.ajax({
                              url: '{{ route("fetch.wpn.notselected")}}',
                              type: 'POST',
                              data: { barcode: barcodesArray,
                                      emp_id:emp_id,
                                      _token: '{{ csrf_token() }}',
                                      },
                              success: function(response2) {
                                  try {
                                      // response2 = JSON.parse(response2);
                                  } catch (e) {
                                      console.error("Failed to parse response2:", e);
                                      return;
                                  }
                                  console.log('Response2:', response2); 

                                  if (Array.isArray(response2) && response2.length > 0) {
                                      $.each(response2, function(index, alloted) {
                                          let nature = alloted.nature == 0 ? "Less Then 24Hr" : "More Than 24Hr";
                                          var createdAt = new Date(alloted.created_at);
                                          var formattedDate = ("0" + createdAt.getDate()).slice(-2) + "-" + 
                                              ("0" + (createdAt.getMonth() + 1)).slice(-2) + "-" + 
                                              createdAt.getFullYear() + " " + 
                                              ("0" + createdAt.getHours()).slice(-2) + ":" + 
                                              ("0" + createdAt.getMinutes()).slice(-2) + ":" + 
                                              ("0" + createdAt.getSeconds()).slice(-2);

                                          var row = '<tr class="main-row" data-index="' + index + '" style="background-color:#F2F4FF">' +
                                          '<td>' + (index + not_selected) + '</td>' +
                                          '<td>' + alloted.type + '</td>' +
                                          '<td>' + alloted.regd_no + '</td>' +
                                          '<td>' + alloted.butt_no + '</td>' +
                                          '<td>' + alloted.wpn_tag + '</td>' +
                                          '<td>' + nature + '</td>' +
                                          '<td>' + alloted.purpose + '</td>' +
                                          '<td>' + formattedDate + '</td>' +
                                          '</tr>'; 

                                          var subRow = '<tr class="" data-index="' + index + '" style="background-color:#F2F4FF">' +
                                          '<td colspan="8">' +
                                          '<div class="sub-details">' +
                                          '<label>Mag Issued:</label> <input readonly style="background-color:lightgrey;" type="text" name="magissue_' + index + '" id="magissue_' + index + '" value="'+ alloted.megazins +'">' +
                                          '<label>Slings Issued:</label> <input readonly style="background-color:lightgrey;" type="text" name="slingsissue_' + index + '" id="slingsissue_' + index + '" value="'+ alloted.slings +'">' +
                                          '<label>Bayonet Issued:</label> <input readonly style="background-color:lightgrey;" type="text" name="bayonetissue_' + index + '" id="bayonetissue_' + index + '" value="'+ alloted.bayonet +'">' + '<br>' +
                                          '<label>Mag Return:</label> <input readonly style="background-color:lightgrey;" type="text" name="magret_' + index + '" id="magret_' + index + '" value="">' +
                                          '<label>Slings Return:</label> <input readonly style="background-color:lightgrey;" type="text" name="slingsret_' + index + '" id="slingsret_' + index + '" value="">' +
                                          '<label>Bayonet Return:</label> <input readonly style="background-color:lightgrey;" type="text" name="bayonetret_' + index + '" id="bayonetret_' + index + '" value="">' +
                                          '</div>' +
                                          '</td>' +
                                          '</tr>';

                                          // Append the row to the table body
                                          $('#tbody').append(row + subRow);

                                          // $('.main-row').on('click', function() {
                                          //     var index = $(this).data('index');
                                          //     $('tr.sub-row[data-index="' + index + '"]').toggle(); 
                                          // });
                                      });
                                  } else {
                                      // $('#tbody').append('<tr><td colspan="6" class="text-center">No Wpn Found in Inventory</td></tr>');
                                      // alert("Weapon Not Found");
                                  }
                              },
                              error: function(xhr, status, error) {
                                  // Handle errors
                                  console.error('Error:', error);
                              }
                          });
                      }
                  });

                  $('#barcode').val('');
              }
          });

      

          $(".btn-update").on('click', function() {
            if (!confirm("Are you sure ?")) {
                    return; // Stop execution if user cancels
                }
              wpn_ids = collectReturnData(); 
              console.log(wpn_ids,emp_id);
              if (wpn_ids && emp_id) {
                  $.ajax({
                      url: '{{ route("update.return.wpn")}}',
                      type: "POST",
                      data: { 
                          emp_id: emp_id,
                          wpn_ids: wpn_ids, 
                          _token: '{{ csrf_token() }}',
                      },
                      success: function(data) {
                         
                          if (data.status == "success") {
                              alert('Weapon Return Successfully');
                              window.location.reload();
                          } else {
                              alert('Failed to submit data');
                          }
                      },
                      error: function(xhr, status, error) {
                          console.error('AJAX Error:', error);
                      }
                  });
              } else {
                  alert('Weapon IDs or Employee Code are missing.');
              }
          });

          function collectReturnData() {
              var returnData = [];
              $('.sub-row').each(function() {
                  var index = $(this).data('index'); // Get the index from data-index attribute
                  var wpn_id = $('#wpn_id_' + index).val();
                  var magReturn = $('#magret_' + index).val(); // Get the value of Mag Return
                  var slingsReturn = $('#slingsret_' + index).val(); // Get the value of Slings Return
                  var bayonetReturn = $('#bayonetret_' + index).val(); // Get the value of Bayonet Return
                  
                  // Store the data for each row
                  returnData.push({
                      id:wpn_id,
                      megazins:magReturn,
                      slings:slingsReturn,
                      bayonet:bayonetReturn
                  });
              });
              return returnData; // Return the collected data
          }


  });
      </script>

<script>
    $(document).ready(function () {
        $("#myButton").click(function (e) {
            e.preventDefault();  // Prevent the default anchor behavior

            let button = $(this);
            
            // Disable the button by adding a 'disabled' class or using CSS
            button.addClass("disabled");
            button.css("pointer-events", "none");  // Disable further clicks

            // Get the URL from the href attribute
            let url = button.attr("href");

            // Log the URL to see if it's being captured correctly
            console.log("Navigating to URL:", url);

            // Open the link (this will trigger the app)
            window.location.href = url;

            // Re-enable the button after 4 seconds
            setTimeout(function () {
                button.removeClass("disabled");
                button.css("pointer-events", "auto");
            }, 4000);
        });
    });
</script>
</body>

</html>