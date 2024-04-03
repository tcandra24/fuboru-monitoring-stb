<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/branches', [\App\Http\Controllers\Api\BranchController::class, 'store']);
Route::post('/customers', [\App\Http\Controllers\Api\CustomerController::class, 'store']);
Route::post('/divisions', [\App\Http\Controllers\Api\DivisionController::class, 'store']);
Route::post('/salesmans', [\App\Http\Controllers\Api\SalesmanController::class, 'store']);

Route::post('/stb/sync', [\App\Http\Controllers\Api\StbController::class, 'sync']);
