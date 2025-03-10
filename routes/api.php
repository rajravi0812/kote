<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\IssuerController;  // Add this line - important!
use App\Http\Controllers\Api\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Auth route for users
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Your API routes - outside the auth middleware
Route::prefix('v1')->group(function () {
    Route::post('/verify', [IssuerController::class, 'verify']);
    Route::get('/issuers', [IssuerController::class, 'getAllIssuers']);
    Route::get('/issuers/{emp_code}', [IssuerController::class, 'getIssuer']);
    Route::put('issuers', [IssuerController::class, 'updateFingerprint']);
    Route::post('issuers/verify', [IssuerController::class, 'verify']);
    Route::post('login', [App\Http\Controllers\Api\AuthController::class, 'login']);
    Route::post('check-duplicate', [IssuerController::class, 'checkDuplicate']);
});