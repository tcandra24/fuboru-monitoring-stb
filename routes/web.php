<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function(){
    return \Inertia\Inertia::render('Auth/Login');
})->middleware('guest');

Route::group(['middleware' => ['auth']], function(){
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])
    ->middleware('permission:dashboard.index')->name('dashboard.index');

    Route::group(['prefix' => '/master'], function() {
        Route::get('/customers', [ \App\Http\Controllers\Admin\Master\CustomerController::class, 'index' ])
        ->middleware('permission:master.customers.index');

        Route::get('/branches', [ \App\Http\Controllers\Admin\Master\BranchController::class, 'index' ])
        ->middleware('permission:master.branches.index');

        Route::get('/salesmans', [ \App\Http\Controllers\Admin\Master\SalesmanController::class, 'index' ])
        ->middleware('permission:master.salesmans.index');

        Route::get('/divisions', [ \App\Http\Controllers\Admin\Master\DivisionController::class, 'index' ])
        ->middleware('permission:master.divisions.index');
    });

    Route::group(['prefix' => '/report'], function() {
        Route::resource('/stb', App\Http\Controllers\Admin\Report\StbController::class, [ 'only' => ['index', 'show'], 'parameters' => [
            'stb' => 'nomer_kontrak'
        ] ])->middleware('permission:report.stb.index');
    });

    Route::group(['prefix' => '/setting'], function() {
        Route::resource('/users', App\Http\Controllers\Admin\Setting\UserController::class)
        ->middleware('permission:setting.users.index|setting.users.create|setting.users.edit|setting.users.delete');

        Route::resource('/roles', App\Http\Controllers\Admin\Setting\RoleController::class)
        ->middleware('permission:setting.roles.index|setting.roles.create|setting.roles.edit|setting.roles.delete');

        Route::get('/permissions', [ \App\Http\Controllers\Admin\Setting\PermissionController::class, 'index' ])
        ->middleware('permission:setting.permissions.index');

        Route::get('/profile', [App\Http\Controllers\Admin\Setting\ProfileController::class, 'index'])->name('profile.index');
        Route::post('/profile/change-password', [App\Http\Controllers\Admin\Setting\ProfileController::class, 'change_password']);
    });
});
