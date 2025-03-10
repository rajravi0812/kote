<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Add this at the start of the method
        if (!$request->isJson()) {
            return response()->json([
                'success' => false,
                'message' => 'Request must be JSON'
            ], 400);
        }

        try {
            // Validate request
            $validator = Validator::make($request->all(), [
                'username' => 'required|string',
                'password' => 'required|string'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Find user
            $user = User::where('username', $request->username)
                    ->orWhere('email', $request->username)
                    ->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid credentials'
                ], 401);
            }

            // Get role name based on role_id
            $roleName = $this->getRoleName($user->role_id);

            return response()->json([
                'success' => true,
                'message' => 'Login successful',
                'data' => [
                    'user_id' => $user->id,
                    'username' => $user->username,
                    'user_type' => $roleName
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Server error'
            ], 500);
        }
    }

    private function getRoleName($roleId)
    {
        switch ($roleId) {
            case 1:
                return 'Administrator';
            case 2:
                return 'Stage1';
            case 3:
                return 'Stage2';
            case 4:
                return 'Stage3';
            case 5:
                return 'Stage4';
            default:
                return 'Unknown';
        }
    }
}