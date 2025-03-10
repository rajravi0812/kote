<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\IssuerDetail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator; 
use Exception;

class IssuerController extends Controller
{
    public function getAllIssuers()
    {
        try {
            // Use DB facade for raw query to properly handle binary data
            $issuers = DB::select("SELECT emp_id, name,mobile, fp_key FROM employees ORDER BY created_at DESC");
            
            if (empty($issuers)) {
                return response()->json([
                    'success' => false,
                    'message' => 'No issuers found'
                ]);
            }

            // Convert binary fp_key to base64
            $formatted_issuers = array_map(function($issuer) {
                return [
                    'emp_id' => $issuer->emp_id,
                    'name' => $issuer->name,
                    'mobile' => $issuer->mobile,
                    'fp_key' => $issuer->fp_key ? base64_encode($issuer->fp_key) : null
                ];
            }, $issuers);

            return response()->json([
                'success' => true,
                'data' => $formatted_issuers
            ]);

        } catch (Exception $e) {
            Log::error("Error fetching issuers: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Internal server error'
            ], 500);
        }
    }

    public function verify(Request $request)
    {
    try {
        Log::info('Verify request received:', [
            'emp_id' => $request->emp_id,
            'request_data' => $request->all()
        ]);

        $employee = Employee::where('emp_id', $request->emp_id)->first();

        Log::info('Database query result:', [
            'employee_found' => $employee ? 'yes' : 'no',
            'query_sql' => Employee::where('emp_id', $request->emp_id)->toSql()
        ]);

        if (!$employee) {
            Log::warning('Employee not found:', ['emp_id' => $request->emp_id]);
            return response()->json([
                'success' => false,
                'message' => 'Employee not found'
            ], 404);
        }

        // Generate the full URL for the employee details page
        $detailsUrl = url("/issue/{$employee->emp_id}");

        return response()->json([
            'success' => true,
            'message' => 'Employee verified successfully',
            'data' => [
                'emp_id' => $employee->emp_id,
                'name' => $employee->name,
                'mobile' => $employee->mobile,
                'verification_time' => now(),
                'details_url' => $detailsUrl
            ]
        ]);

    } catch (Exception $e) {
        Log::error("Verification error: " . $e->getMessage(), [
            'emp_id' => $request->emp_id,
            'stack_trace' => $e->getTraceAsString()
        ]);
        return response()->json([
            'success' => false,
            'message' => 'Internal server error'
        ], 500);
    }
}

public function updateFingerprint(Request $request)
    {
        try {
            Log::info('Fingerprint update request received', [
                'emp_id' => $request->emp_id,
                'content_type' => $request->header('Content-Type'),
                'request_size' => strlen($request->getContent())
            ]);

            // Validate request
            $validator = Validator::make($request->all(), [
                'emp_id' => 'required|string',
                'fp_key' => 'required|string|min:1'
            ]);

            if ($validator->fails()) {
                Log::warning('Validation failed', [
                    'errors' => $validator->errors()->toArray()
                ]);
                return response()->json([
                    'success' => false,
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Find employee
            $issuer = Employee::where('emp_id', $request->emp_id)->first();
            
            if (!$issuer) {
                Log::warning('Employee not found', [
                    'emp_id' => $request->emp_id
                ]);
                return response()->json([
                    'success' => false,
                    'message' => 'Employee not found'
                ], 404);
            }

            // Decode and verify base64
            $fpTemplate = base64_decode($request->fp_key, true);
            if ($fpTemplate === false) {
                Log::error('Invalid base64 data received', [
                    'emp_id' => $request->emp_id
                ]);
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid fingerprint data format'
                ], 400);
            }

            // Use DB facade for direct update to handle binary data properly
            $updated = DB::table('employees')
                ->where('emp_id', $request->emp_id)
                ->update([
                    'fp_key' => $fpTemplate,
                    'status' => 1,
                    'updated_at' => now()
                ]);

            if (!$updated) {
                throw new Exception('Failed to update fingerprint data');
            }

            Log::info('Fingerprint updated successfully', [
                'emp_id' => $request->emp_id
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Fingerprint template updated successfully'
            ]);

        } catch (Exception $e) {
            Log::error('Fingerprint update error', [
                'message' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
                'emp_id' => $request->emp_id ?? 'unknown'
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Internal server error'
            ], 500);
        }
    }

    public function checkDuplicate(Request $request)
{
    try {
        Log::info('Duplicate check request received', [
            'content_type' => $request->header('Content-Type'),
            'request_size' => strlen($request->getContent())
        ]);

        // Validate request
        $validator = Validator::make($request->all(), [
            'fp_template' => 'required|string|min:1'
        ]);

        if ($validator->fails()) {
            Log::warning('Validation failed', [
                'errors' => $validator->errors()->toArray()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Get the new template
        $newTemplate = base64_decode($request->fp_template, true);
        if ($newTemplate === false) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid fingerprint data format'
            ], 400);
        }

        // Get all existing fingerprints
        $existingFingerprints = DB::select("SELECT emp_id, name, fp_key FROM employees WHERE fp_key IS NOT NULL");
        
        $duplicates = [];
        foreach ($existingFingerprints as $record) {
            if ($record->fp_key) {
                $duplicates[] = [
                    'emp_id' => $record->emp_id,
                    'name' => $record->name,
                    'fp_key' => base64_encode($record->fp_key)
                ];
            }
        }

        return response()->json([
            'success' => true,
            'data' => $duplicates
        ]);

    } catch (Exception $e) {
        Log::error('Duplicate check error', [
            'message' => $e->getMessage(),
            'stack_trace' => $e->getTraceAsString()
        ]);
        
        return response()->json([
            'success' => false,
            'message' => 'Internal server error'
        ], 500);
    }
}
}