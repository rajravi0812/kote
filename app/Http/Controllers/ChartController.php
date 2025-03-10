<?php

namespace App\Http\Controllers;

use App\Models\AssignCard;
use DB;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.pie_chart_report');
    }

//     public function unitwise_chart(Request $request)
// {
//     $startDate = $request->input('start_date');
//     $endDate = $request->input('end_date'); // Default end date to today if not provided

//     $query = AssignCard::join('f_units', 'f_units.id', '=', 'assign_veh.formation_unit_id')
//         ->select('f_units.f_unit_name', DB::raw('COUNT(*) as vehicle_count'));

//     // Apply date filter only if `start_date` is provided
//     if ($startDate) {
//         $query->whereBetween('chk_pt4', [$startDate, $endDate]);
//     } else {
//         $query->whereDate('chk_pt4', '<=', now()->format('Y-m-d'));
//     }

//     // Group by both f_unit_name and formation_unit_id to comply with ONLY_FULL_GROUP_BY
//     $vehicles = $query->groupBy('f_units.f_unit_name')->get();

//     // Format data for the chart
//     $data = [
//         'labels' => $vehicles->pluck('f_unit_name'),
//         'values' => $vehicles->pluck('vehicle_count'),
//     ];
//     // dd($data);
//     //  store wise chart report
//     $startDate2 = $request->input('start_date2');
//     $endDate2 = $request->input('end_date2'); // Default end date to today if not provided

//     $query2 = AssignCard::join('stores', 'stores.id', '=', 'assign_veh.str_t')
//         ->select('stores.store_name', DB::raw('COUNT(*) as vehicle_count'));

//     // Apply date filter only if `start_date` is provided
//     if ($startDate) {
//         $query2->whereBetween('chk_pt4', [$startDate2, $endDate2]);
//     } else {
//         $query2->whereDate('chk_pt4', '<=', now()->format('Y-m-d'));
//     }


//     $vehicles2 = $query2->groupBy('stores.store_name')->get();

//     // Format data for the chart
//     $data2 = [
//         'labels' => $vehicles2->pluck('store_name'),
//         'values' => $vehicles2->pluck('vehicle_count'),
//     ];
//     return view('admin.dashboard.unitwise_chart', compact('data','startDate','endDate','data2','startDate2','endDate2'));
// }

// public function unitwise_chart(Request $request)
// {
//     $startDate = $request->input('start_date');
//     $endDate = $request->input('end_date'); // Default end date to today if not provided

//     $query = AssignCard::join('f_units', 'f_units.id', '=', 'assign_veh.formation_unit_id')
//         ->select('f_units.f_unit_name', DB::raw('COUNT(*) as vehicle_count'))
//         ->where('level',4);

//     // Apply date filter only if `start_date` is provided
//     if ($startDate) {
//         $query->whereBetween('chk_pt4', [$startDate, $endDate]);
//     } else {
//         $query->whereDate('chk_pt4', '<=', now()->format('Y-m-d'));
//     }

//     // Group by both f_unit_name and formation_unit_id to comply with ONLY_FULL_GROUP_BY
//     $vehicles = $query->groupBy('f_units.f_unit_name')->get();

//     // Format data for the chart
//     $data = [
//         'labels' => $vehicles->pluck('f_unit_name'),
//         'values' => $vehicles->pluck('vehicle_count'),
//     ];

//     // Store wise chart report
//     $startDate2 = $request->input('start_date2');
//     $endDate2 = $request->input('end_date2'); // Default end date to today if not provided

//     $query2 = AssignCard::join('stores', 'stores.id', '=', 'assign_veh.str_t')
//         ->select('stores.store_name', DB::raw('COUNT(*) as vehicle_count'))
//         ->where('level',4);

//     // Apply date filter only if `start_date2` is provided
//     if ($startDate2) {
//         $query2->whereBetween('chk_pt4', [$startDate2, $endDate2]);
//     } else {
//         $query2->whereDate('chk_pt4', '<=', now()->format('Y-m-d'));
//     }

//     $vehicles2 = $query2->groupBy('stores.store_name')->get();
//     // dd($vehicles, $vehicles2);
//     // Format data for the chart
//     $data2 = [
//         'labels' => $vehicles2->pluck('store_name'),
//         'values' => $vehicles2->pluck('vehicle_count'),
//     ];
    
//     return view('admin.dashboard.unitwise_chart', compact('data', 'startDate', 'endDate', 'data2', 'startDate2', 'endDate2'));
// }


public function unitwise_chart(Request $request) 
{
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date'); // Default end date to today if not provided
    $startDate2 = $request->input('start_date2');
    $endDate2 = $request->input('end_date2');

    $unitQuery = AssignCard::join('f_units', 'f_units.id', '=', 'assign_veh.formation_unit_id')
        ->select('f_units.f_unit_name', DB::raw('COUNT(*) as vehicle_count'))
        ->where('level', 4);

    if ($startDate) {
        $unitQuery->whereBetween('chk_pt4', [$startDate, $endDate]);
    } else {
        $unitQuery->whereDate('chk_pt4', '<=',now()->format('Y-m-d'));
    }

    $unitVehicles = $unitQuery->groupBy('f_units.f_unit_name')->get();


    $storeQuery = AssignCard::join('stores', 'stores.id', '=', 'assign_veh.str_t')
    ->select('stores.store_name', DB::raw('COUNT(*) as vehicle_count'))
    ->where('level', 4);

    if ($startDate2) {
        $storeQuery->whereBetween('chk_pt4', [$startDate2, $endDate2]);
    } else {
        $storeQuery->whereDate('chk_pt4', '<=', now()->format('Y-m-d'));
    }

    $storeVehicles = $storeQuery->groupBy('stores.store_name')->get();

    // Data for unit-wise pie chart and table
    $unitData = [
        'labels' => $unitVehicles->pluck('f_unit_name'),
        'values' => $unitVehicles->pluck('vehicle_count'),
        'table' => $unitVehicles, // Full data for the table
    ];

 
    $storeData = [
        'labels' => $storeVehicles->pluck('store_name'),
        'values' => $storeVehicles->pluck('vehicle_count'),
        'table' => $storeVehicles, // Full data for the table
    ];
    // dd($storeData);
    // Render the view with all data
    return view('admin.dashboard.unitwise_chart', compact('unitData', 'startDate', 'endDate', 'storeData', 'startDate2', 'endDate2'));
}


    
}
