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
        Route::resource('/customers', App\Http\Controllers\Admin\Master\CustomerController::class, [
            'only' => [
                'index', 'create', 'store', 'edit', 'update'
            ], 'parameters' => [
                'customers' => 'kode'
            ]
        ])
        ->middleware('permission:master.customers.index|master.customers.create|master.customers.edit')->names([
            'index' => 'master.customers.index',
            'create' => 'master.customers.create',
            'store' => 'master.customers.store',
            'edit' => 'master.customers.edit',
            'update' => 'master.customers.update',
        ]);

        Route::resource('/branches', App\Http\Controllers\Admin\Master\BranchController::class, [
            'only' => [
                'index', 'create', 'store', 'edit', 'update'
            ], 'parameters' => [
                'branches' => 'kode'
            ]
        ])
        ->middleware('permission:master.branches.index|master.branches.create|master.branches.edit')->names([
            'index' => 'master.branches.index',
            'create' => 'master.branches.create',
            'store' => 'master.branches.store',
            'edit' => 'master.branches.edit',
            'update' => 'master.branches.update',
        ]);

        Route::resource('/salesmans', App\Http\Controllers\Admin\Master\SalesmanController::class, [
            'only' => [
                'index', 'create', 'store', 'edit', 'update'
            ], 'parameters' => [
                'salesmans' => 'kode'
            ]
        ])
        ->middleware('permission:master.salesmans.index|master.salesmans.create|master.salesmans.edit')->names([
            'index' => 'master.salesmans.index',
            'create' => 'master.salesmans.create',
            'store' => 'master.salesmans.store',
            'edit' => 'master.salesmans.edit',
            'update' => 'master.salesmans.update',
        ]);

        Route::resource('/divisions', App\Http\Controllers\Admin\Master\DivisionController::class, [
            'only' => [
                'index', 'create', 'store', 'edit', 'update'
            ], 'parameters' => [
                'divisions' => 'kode'
            ]
        ])
        ->middleware('permission:master.divisions.index|master.divisions.create|master.divisions.edit')->names([
            'index' => 'master.divisions.index',
            'create' => 'master.divisions.create',
            'store' => 'master.divisions.store',
            'edit' => 'master.divisions.edit',
            'update' => 'master.divisions.update',
        ]);
    });

    Route::group(['prefix' => '/report'], function() {
        Route::resource('/stb', App\Http\Controllers\Admin\Report\StbController::class, [ 'only' => ['index', 'show'], 'parameters' => [
            'stb' => 'nomer_kontrak'
        ] ])->middleware('permission:report.stb.index')->names([
            'index' => 'report.stb.index',
            'show' => 'report.stb.detail',
        ]);

        Route::get('/export/stb', App\Http\Controllers\Admin\Report\ExportController::class)->name('report.stb.export');

        Route::patch('/stb/update/{kode_nota}', \App\Http\Controllers\Admin\Report\ChangestatusController::class)
        ->middleware('permission:report.stb.change-status')
        ->name('report.stb.change-status');
    });

    Route::group(['prefix' => '/setting'], function() {
        Route::resource('/users', App\Http\Controllers\Admin\Setting\UserController::class, [ 'except' => ['show']])
        ->middleware('permission:setting.users.index|setting.users.create|setting.users.edit|setting.users.delete')->names([
            'index' => 'setting.users.index',
            'create' => 'setting.users.create',
            'store' => 'setting.roles.store',
            'edit' => 'setting.users.edit',
            'update' => 'setting.users.update',
            'destroy' => 'setting.users.detail',
        ]);;

        Route::resource('/roles', App\Http\Controllers\Admin\Setting\RoleController::class, [ 'except' => ['show']])
        ->middleware('permission:setting.roles.index|setting.roles.create|setting.roles.edit|setting.roles.delete')->names([
            'index' => 'setting.roles.index',
            'create' => 'setting.roles.create',
            'edit' => 'setting.roles.edit',
            'update' => 'setting.roles.update',
            'destroy' => 'setting.roles.detail',
        ]);;

        Route::get('/permissions', [ \App\Http\Controllers\Admin\Setting\PermissionController::class, 'index' ])
        ->middleware('permission:setting.permissions.index')->name('setting.permissions.index');

        Route::get('/profile', [App\Http\Controllers\Admin\Setting\ProfileController::class, 'index'])->name('profile.index');
        Route::post('/profile/change-password', [App\Http\Controllers\Admin\Setting\ProfileController::class, 'change_password']);
    });
});
