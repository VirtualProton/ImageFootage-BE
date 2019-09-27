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
Route::get('/subadmin/status/{status}/{id}', 'SubAdminController@status');
Route::get('/subadmin/access_management', 'SubAdminController@access_management');
Route::resource('/subadmin', 'SubAdminController');
Route::get('/product/{status}/{id}', 'ProductController@changeProductStatus');
Route::get('/deleteproduct/{id}', 'ProductController@destroy');
Route::get('/editproduct/{id}', 'ProductController@updateProduct');
Route::post('/editproduct', 'ProductController@update');
Route::get('/viewproduct/{id}', 'ProductController@viewproduct');
Route::get('/email', 'ProductController@html_email');
Route::post('/update_product_verify', 'ProductController@ajaxProductVerify');



Route::get('/add_product_category', 'ProductCategoryController@index');
Route::post('/insert_product_category', 'ProductCategoryController@createCategory');
Route::get('/all_product_category', 'ProductCategoryController@productCategoryList');
Route::get('/productcategory/{status}/{id}', 'ProductCategoryController@changeProductStatus');
Route::get('/deleteproductcategory/{id}', 'ProductCategoryController@destroy');
Route::get('/updateproductcategory/{id}', 'ProductCategoryController@updateProduct');
Route::post('/editproductcategory', 'ProductCategoryController@editProductCategory');
Route::get('/add_product_subcategory', 'ProductSubCategoryController@index');
Route::post('/insert_product_subcategory', 'ProductSubCategoryController@addProductSubCategory');
Route::get('/all_product_subcategory', 'ProductSubCategoryController@productSubCategoryList');
Route::get('/productsubcategory/{status}/{id}', 'ProductSubCategoryController@changeProductStatus');
Route::get('/deleteproductsubcategory/{id}', 'ProductSubCategoryController@destroy');
Route::get('/updateproductsubcategory/{id}', 'ProductSubCategoryController@updateProduct');
Route::post('/editproductsubcategory', 'ProductSubCategoryController@update');
Route::post('/get_related_subcat', 'ProductController@get_relatedsubcat');

Route::get('/add_contributor', 'ContributorController@index');
Route::post('/addcontributor', 'ContributorController@addcontributor');
Route::get('/contributor_list', 'ContributorController@contributorList');
Route::get('/contributor_status/{status}/{id}', 'ContributorController@changeContributorStatus');
Route::get('/updatecontributor/{id}', 'ContributorController@updateContributor');
Route::post('/editcontributor', 'ContributorController@editcontributor');
Route::get('/deletecontributor/{id}', 'ContributorController@destroy');

Route::get('/create_package', 'PackageController@createPackage');
Route::post('/addpackage', 'PackageController@addPackage');
Route::get('/package_list', 'PackageController@packageList');
Route::get('/package/{status}/{id}', 'PackageController@changePackageStatus');
Route::get('/updatepackage/{id}', 'PackageController@updatePackage');
Route::post('/editpackage', 'PackageController@editPackage');
Route::get('/deletepackage/{id}', 'PackageController@deletePackage');

Route::get('/create_static_pages', 'StaticPagesController@createStaticPage');
Route::post('/addstaticpage', 'StaticPagesController@addStaticPage');
Route::get('/static_pages_list', 'StaticPagesController@statiePagesList');
Route::get('/staticpages/{status}/{id}', 'StaticPagesController@changePackageStatus');
Route::get('/updatestaticpage/{id}', 'StaticPagesController@updateStaticPage');
Route::post('/editstaticpage', 'StaticPagesController@editStaticPage');
Route::get('/deletestaticpage/{id}', 'StaticPagesController@deleteStaticPage');

//for api
Route::get('/products_api', 'ProductController@productListApi');
//end api

Route::get('/accounts/status/{status}/{id}', 'AccountController@status');

Route::resource('/accounts', 'AccountController');

Route::get('/users/status/{status}/{id}', 'UserController@status');

Route::resource('/users', 'UserController');
Route::post('/getStatesByCounty', 'CommonController@getStatesByCounty');
Route::post('/getCityByState', 'CommonController@getCityByState');

//Route::get('dashboard', 'Admin\DashboardController@dashboard');
//Route::get('login', 'Admin\DashboardController@login');
//Route::post('admin_login_process', 'Admin\DashboardController@admin_login_process');
//Route::get('logout', 'Admin\DashboardController@logout');
});
