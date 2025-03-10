<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee; // Assuming this is your employee model name

class FingerprintController extends Controller
{
    public function enrollList()
    {
        // Get employees without fingerprints
        $employees = Employee::whereNull('fp_key')
            ->orWhere('fp_key', '')
            ->get();

        return view('fingerprint.enroll', compact('employees'));
    }

    // API endpoint to update fingerprint data
    public function updateFingerprint(Request $request)
    {
        $request->validate([
            'emp_id' => 'required',
            'fp_key' => 'required'
        ]);

        $employee = Employee::where('emp_id', $request->emp_id)->first();
        
        if ($employee) {
            $employee->fp_key = $request->fp_key;
            $employee->save();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Employee not found']);
    }
}