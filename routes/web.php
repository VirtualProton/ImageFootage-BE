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
Auth::routes();
Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function(){
Route::get('/login', 'AdminController@login');
Route::post('/authenticate', 'AdminController@authenticate');
Route::get('logout', 'AdminController@logout');
Route::get('/dashboard', 'DashboardController@dashboard');
Route::get('/add_product', 'ProductController@index');
Route::post('/createproduct', 'ProductController@create');
Route::get('/all_products', 'ProductController@productsList');
Route::resource('/subadmin', 'SubAdminController');
Route::get('/product/{status}/{id}', 'ProductController@changeProductStatus');
Route::get('/deleteproduct/{id}', 'ProductController@destroy');
Route::get('/editproduct/{id}', 'ProductController@updateProduct');
Route::post('/editproduct', 'ProductController@update');
//Route::get('dashboard', 'Admin\DashboardController@dashboard');
//Route::get('login', 'Admin\DashboardController@login');
//Route::post('admin_login_process', 'Admin\DashboardController@admin_login_process');
//Route::get('logout', 'Admin\DashboardController@logout');
});
