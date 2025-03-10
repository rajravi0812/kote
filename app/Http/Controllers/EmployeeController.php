<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\IssuerDetail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    // public function details($emp_id)
    // {
    //     try {
    //         // Get employee details with only existing fields
    //         $employee = DB::table('employees')
    //             ->select(
    //                 'emp_id',
    //                 'name',
    //                 // 'mobile',
    //                 'created_at'
    //             )
    //             ->where('emp_id', $emp_id)
    //             ->first();

    //         if (!$employee) {
    //             return view('errors.employee-not-found');
    //         }

    //         return view('employee.details', [
    //             'employee' => $employee,
    //             'verification_time' => now()
    //         ]);
    //     } catch (\Exception $e) {
    //         Log::error("Error displaying employee details: " . $e->getMessage());
    //         return view('errors.generic-error');
    //     }
    // }

    // public function details($emp_id)
    // {
    //     try {
    //         // Get employee details with only existing fields
    //         $employee = Employee::with(['rank', 'unit', 'company'])
    //             ->where('emp_id', $emp_id)
    //             ->first();

    //         if (!$employee) {
    //             return view('errors.employee-not-found');
    //         }
    //         session(['employee_data' => $employee->emp_id]);
    //         return response('<script>window.close();</script>');
    //         // return view('admin.dashboard.wpn_issue_result', [
    //         //     'employee' => $employee,
    //         //     'verification_time' => now()
    //         // ]);
    //     } catch (\Exception $e) {
    //         Log::error("Error displaying employee details: " . $e->getMessage());
    //         return view('errors.generic-error');
    //     }
    // }


    public function details($emp_id)
    {
        try {
            // Get employee details with required relations
            $employee = Employee::with(['rank', 'unit', 'company'])
                ->where('emp_id', $emp_id)
                ->first();
    
            if (!$employee) {
                return view('errors.employee-not-found');
            }
    
            // Store only the necessary attributes in the session
            session([
                'employee_data' => [
                    'emp_id' => $employee->emp_id,
                    'name' => $employee->name,
                    'rank' => $employee->rank->rank_name ?? null, // Assuming `rank` has a `name` attribute
                    'unit' => $employee->unit->unit_name ?? null, // Assuming `unit` has a `name` attribute
                    'company' => $employee->company->company_name ?? null, // Assuming `company` has a `name` attribute
                    'image' => $employee->photo
                ]
            ]);
    
            // return response('<script>window.close();</script>');
            return response()->make('<html><head><script>window.close();</script></head><body></body></html>', 200, ['Content-Type' => 'text/html']);

            // return redirect()->route('wpn.issue')->with('success', 'Fingerprint Fetch successfully');
        } catch (\Exception $e) {
            Log::error("Error displaying employee details: " . $e->getMessage());
            return view('errors.generic-error');
        }
    }
    

    public function checkEmployeeSession(Request $request)
    {
        if (session()->has('employee_data')) {
            $employeeData = session('employee_data');
            
            // Clear the session if needed
            session()->forget('employee_data');
    
            // Return the session data
            return response()->json([
                'success' => true,
                'data' => $employeeData,
            ]);
        }
    
        // If session data is not found
        return response()->json([
            'success' => false,
            'message' => 'Data not found',
        ]);
    }
    


    //   public function details($emp_id)
    // {
    //     try {
    //         // Get employee details with only existing fields
    //         $employee = Employee::with(['rank', 'unit', 'company'])
    //             ->where('emp_id', $emp_id)
    //             ->first();

    //         if (!$employee) {
    //             return view('errors.employee-not-found');
    //         }
    //         session(['employee_data' => $employee]);
    //         return response()->json([
    //             'status' => 'success',
    //             'data' => $employee,
    //             'verification_time' => now()->toDateTimeString(),
    //         ], 200);
    //     } catch (\Exception $e) {
    //         Log::error("Error displaying employee details: " . $e->getMessage());
    //         return view('errors.generic-error');
    //     }
    // }
 

}