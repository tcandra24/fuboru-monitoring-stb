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

// Route::post('/stb/sync', [\App\Http\Controllers\Api\StbController::class, 'sync']);

Route::group(['prefix' => '/master'], function() {
    Route::post('/branches', [\App\Http\Controllers\Api\BranchController::class, 'store']);
    Route::post('/customers', [\App\Http\Controllers\Api\CustomerController::class, 'store']);
    Route::post('/divisions', [\App\Http\Controllers\Api\DivisionController::class, 'store']);
    Route::post('/salesmans', [\App\Http\Controllers\Api\SalesmanController::class, 'store']);

    Route::group(['prefix' => '/sync'], function() {
        Route::patch('/customers', [ \App\Http\Controllers\Api\CustomerController::class, 'sync' ])
        ->name('master.sync.customers.index');

        Route::patch('/branches', [ \App\Http\Controllers\Api\BranchController::class, 'sync' ])
        ->name('master.sync.branches.index');

        Route::patch('/salesmans', [ \App\Http\Controllers\Api\SalesmanController::class, 'sync' ])
        ->name('master.sync.salesmans.index');

        Route::patch('/divisions', [ \App\Http\Controllers\Api\DivisionController::class, 'sync' ])
        ->name('master.sync.divisions.index');
    });
});
