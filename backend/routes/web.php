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
Route::get('/add_product_colors', 'ProductColorController@addProductColor');
Route::post('/addproductcolorprocess', 'ProductColorController@addProductColorProcess');
Route::get('/product_colors_list', 'ProductColorController@productColorsList');
Route::get('/product_colors_status/{status}/{id}', 'ProductColorController@changePackageStatus');
Route::get('/deletepcolor/{id}', 'ProductColorController@deletePcolorPage');
Route::get('/editproductcolor/{id}', 'ProductColorController@editProduCtcolor');
Route::post('/updateproductcolor', 'ProductColorController@updateProductColor');
//product gender
Route::get('/add_product_gender', 'ProductGenderController@addProductGender');
Route::post('/addproductgenderprocess', 'ProductGenderController@addProductColorProcess');
Route::get('/product_gender_list', 'ProductGenderController@ProductGendersList');
Route::get('/product_gender_status/{status}/{id}', 'ProductGenderController@changeGenderStatus');
Route::get('/deletepgender/{id}', 'ProductGenderController@deletePgenderPage');
Route::get('/editproductgender/{id}', 'ProductGenderController@editProduCtgender');
Route::post('/updateproductgender', 'ProductGenderController@updateProductGender');
//Product ethinicities
Route::get('/add_product_ethinicities', 'ProductEthinicitiesController@addProductGender');
Route::post('/addproductethinicitiesprocess', 'ProductEthinicitiesController@addProductEthinicitiesProcess');
Route::get('/product_ethinicities_list', 'ProductEthinicitiesController@ProductEthinicitiesList');
Route::get('/product_ethinicities_status/{status}/{id}', 'ProductEthinicitiesController@changeEthinicitiesStatus');
Route::get('/deletepethinicities/{id}', 'ProductEthinicitiesController@deletePethinicitiesPage');
Route::get('/editproductethinicities/{id}', 'ProductEthinicitiesController@editProductEthinicities');
Route::post('/updateproductethinicities', 'ProductEthinicitiesController@updateProductEthinicities');

//Product locations
Route::get('/add_product_locations', 'ProductLocationsController@addProductLocation');
Route::post('/addproduct_ocations_rocess', 'ProductLocationsController@addProductLocationsProcess');
Route::get('/product_locations_list', 'ProductLocationsController@ProductLocationsList');
Route::get('/product_locations_status/{status}/{id}', 'ProductLocationsController@changeLocationsStatus');
Route::get('/deletelocation/{id}', 'ProductLocationsController@deleteProductLocation');
Route::get('/editproductlocation/{id}', 'ProductLocationsController@editProductLocations');
Route::post('/updateproductlocation', 'ProductLocationsController@updateProductLocations');

//Product image sizes
Route::get('/add_product_image_sizes', 'ProductImageSizesController@addProductImageSize');
Route::post('/addproduct_imagesizes_process', 'ProductImageSizesController@addProductImageSizesProcess');
Route::get('/product_image_sizes_list', 'ProductImageSizesController@ProductImageSizesList');
Route::get('/product_imagesizes_status/{status}/{id}', 'ProductImageSizesController@changeProductImageSizesStatus');
Route::get('/deleteproductimagesizes/{id}', 'ProductImageSizesController@deleteProductImageSizes');
Route::get('/editproductimagesizes/{id}', 'ProductImageSizesController@editProductImageSizes');
Route::post('/updateproductimagesizes', 'ProductImageSizesController@updateProductImageSizes');

//Product image types
Route::get('/add_product_image_types', 'ProductImageTypesController@addProductImageType');
Route::post('/addproduct_imagetype_process', 'ProductImageTypesController@addProductImageTypesProcess');
Route::get('/product_image_types_list', 'ProductImageTypesController@productImageTypesList');
Route::get('/product_imagetypes_status/{status}/{id}', 'ProductImageTypesController@changeProductImageTypesStatus');
Route::get('/deleteproductimagestatus/{id}', 'ProductImageTypesController@deleteProductImageTypes');
Route::get('/editproductimagetypes/{id}', 'ProductImageTypesController@editProductImageTypes');
Route::post('/updateproductimagetypes', 'ProductImageTypesController@updateProductImageTypes');

//for api
Route::get('/products_api', 'ProductController@productListApi');
//end api
Route::get('/accounts/status/{status}/{id}', 'AccountController@status');

Route::resource('/accounts', 'AccountController');

Route::get('/users/status/{status}/{id}', 'UserController@status');

Route::resource('/users', 'UserController');
Route::post('/getStatesByCounty', 'CommonController@getStatesByCounty');
Route::post('/getCityByState', 'CommonController@getCityByState');


Route::get('/send_invoice', 'InvoiceController@send_invoice');
Route::post('/get_email_template', 'InvoiceController@get_email_template');


Route::post('/sendmail','InvoiceController@sendmail');


Route::get('/quotation/{id}', 'InvoiceController@quotation');


//Route::get('dashboard', 'Admin\DashboardController@dashboard');
//Route::get('login', 'Admin\DashboardController@login');
//Route::post('admin_login_process', 'Admin\DashboardController@admin_login_process');
//Route::get('logout', 'Admin\DashboardController@logout');
});
