<?php

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('admin/dashboard', 'Admin\DashboardController@dashboard');
Route::get('admin', 'Admin\DashboardController@login');
Route::post('admin/admin_login_process', 'Admin\DashboardController@admin_login_process');
Route::get('admin/logout', 'Admin\DashboardController@logout');
