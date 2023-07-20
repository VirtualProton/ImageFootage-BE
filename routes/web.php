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

// Route::get('/', function () {
//     return view('welcome');
// });
Auth::routes();

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function(){
Route::get('/login', 'AdminController@login');
Route::post('/authenticate', 'AdminController@authenticate');
Route::get('logout', 'AdminController@logout');


Route::get('forget-password', 'ForgotPasswordController@showForgetPasswordForm')->name('forget.password.get');
Route::post('forget-password', 'ForgotPasswordController@submitForgetPasswordForm')->name('forget.password.post'); 
Route::get('reset-password/{token}', 'ForgotPasswordController@showResetPasswordForm')->name('reset.password.get');
Route::post('reset-password', 'ForgotPasswordController@submitResetPasswordForm')->name('reset.password.post');


Route::get('/dashboard', 'DashboardController@dashboard');
Route::get('/add_product', 'ProductController@index');
Route::post('/createproduct', 'ProductController@create');
Route::get('/all_products', 'ProductController@productsList');
Route::get('/subadmin/status/{status}/{id}', 'SubAdminController@status');
Route::get('/subadmin/access_management', 'SubAdminController@access_management');
Route::post('/save_access', 'SubAdminController@save_access');
Route::post('/subadmin/mapping_data', 'SubAdminController@mapping_data');

Route::get('/subadmin/view/{id}', 'SubAdminController@view');
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
// Route::get('/product/{id}', 'ProductController@getProduct');


//ContributorController
Route::get('/add_contributor', 'ContributorController@index');
Route::post('/addcontributor', 'ContributorController@addcontributor');
Route::get('/contributor_list', 'ContributorController@contributorList');
Route::get('/contributor_status/{status}/{id}', 'ContributorController@changeContributorStatus');
Route::get('/updatecontributor/{id}', 'ContributorController@updateContributor');
Route::post('/editcontributor', 'ContributorController@editcontributor');
Route::get('/viewcontributor/{id}', 'ContributorController@viewcontributor');
Route::get('/deletecontributor/{id}', 'ContributorController@destroy');
Route::post('/request_for_contributorpass/{id}', 'ContributorController@requestForContributorPass');
Route::post('/ajaxRequestForUserPass/{id}', 'ContributorController@ajaxRequestForUserPass');

Route::get('/contributorotpvalidate/{id}', 'ContributorController@contVerifyRegisteriedOtp');
Route::post('/contributorotpvalidateprocess', 'ContributorController@contVerifyRegisteriedOtpprocess');
Route::get('/contributor_set_password/{id}', 'ContributorController@contSetPassword');
Route::post('/contributorsetpasswordprocess', 'ContributorController@setContributorPassword');
Route::get('/contributorotpreset/{id}', 'ContributorController@contributorotpverifyReset');
Route::post('/contributorotpvaliprocess', 'ContributorController@verifyOtpforsetpass');
Route::get('/contributor_reset_password/{id}', 'ContributorController@contResetPassword');
Route::post('/contributorresetpassprocess', 'ContributorController@contResetPasswordProcess');

//end ContributorController

Route::get('/create_package', 'PackageController@createPackage');
Route::post('/addpackage', 'PackageController@addPackage');
Route::get('/package_list', 'PackageController@packageList');
Route::get('/package/{status}/{id}', 'PackageController@changePackageStatus');
Route::get('/package/home/{view}/{id}', 'PackageController@changePackageHomeView');
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
Route::get('/add_api_quota', 'ProductApiController@addApiQuota');
Route::post('/insertapiquota', 'ProductApiController@insertApiQuota');
Route::get('/api_quota_list', 'ProductApiController@apiQuotaList');
Route::get('/updateapiquata/{id}', 'ProductApiController@updateApiQuata');
Route::post('/editapiquata', 'ProductApiController@editApiQuata');
Route::get('/deleteapiquata/{id}', 'ProductApiController@deleteapiquata');

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

//Product peoples
Route::get('/add_product_image_peoples', 'ProductImagePeoplesController@addProductImageSize');
Route::post('/addproduct_imagepeoples_process', 'ProductImagePeoplesController@addProductPeoplesProcess');
Route::get('/product_image_peoples_list', 'ProductImagePeoplesController@ProductPeoplesList');
Route::get('/product_imagepeoples_status/{status}/{id}', 'ProductImagePeoplesController@changeProductPeoplesStatus');
Route::get('/deleteproductpeoples/{id}', 'ProductImagePeoplesController@deleteProductPeoples');
Route::get('/editproductpeoples/{id}', 'ProductImagePeoplesController@editProductPeoples');
Route::post('/updateproductpeoples', 'ProductImagePeoplesController@updateProductPeoples');
//orders related
Route::get('/orders', 'ProductOrdersController@index');
Route::get('/users/user_orders/{id}', 'ProductOrdersController@userOrderList');
Route::get('/userListapi/{id}', 'ProductOrdersController@userListapi');
//subscriber
Route::get('/getSubscribers', 'SubscribersController@getSubscribers');

//Product  Orientations
Route::get('/add_product_orientations ', 'ProductImageOrientationsController@addProductOrientations');
Route::post('/addproduct_orientations_process', 'ProductImageOrientationsController@addProductOrientationsProcess');
Route::get('/product_orientations_list', 'ProductImageOrientationsController@ProductOrientationsList');
Route::get('/product_orientations_status/{status}/{id}', 'ProductImageOrientationsController@changeProductOrientationsStatus');
Route::get('/deleteproductorientations/{id}', 'ProductImageOrientationsController@deleteProductOrientations');
Route::get('/editproductorientations/{id}', 'ProductImageOrientationsController@editProductOrientations');
Route::post('/updateproductorientations', 'ProductImageOrientationsController@updateProductOrientations');

//Product  Sort Types
Route::get('/add_product_sort_type', 'ProductImageSortTypesController@addImageSortTypes');
Route::post('/addproduct_sort_type_process', 'ProductImageSortTypesController@addImageSortTypesProcess');
Route::get('/product_sort_type_list', 'ProductImageSortTypesController@ImageSortTypesList');
Route::get('/product_sort_type_status/{status}/{id}', 'ProductImageSortTypesController@changeImageSortTypeStatus');
Route::get('/deleteproductsorttype/{id}', 'ProductImageSortTypesController@deleteImageSortTypes');
Route::get('/editproductsort_type/{id}', 'ProductImageSortTypesController@editImageSortTypes');
Route::post('/updatproductsort_type', 'ProductImageSortTypesController@updateImageSortTypes');

//bulk upload products
Route::get('/upload_products_csv', 'ProductBulkUploadController@uploadCSV');
Route::post('/produt_bulk_upload', 'ProductBulkUploadController@importCSV');

//for api
Route::get('/products_api', 'ProductController@productListApi');
//end api
Route::get('/accounts/status/{status}/{id}', 'AccountController@status');
Route::get('/accounts/view/{id}', 'AccountController@show');

Route::resource('/accounts', 'AccountController');

# Promo Code
Route::get('/promo-codes/status/{status}/{id}', 'PromoCodeController@status');
Route::resource('/promo-codes', 'PromoCodeController');

Route::get('/users/status/{status}/{id}', 'UserController@status');
Route::get('/users/show/{id}', 'UserController@show');



Route::resource('/users', 'UserController');
Route::post('/getStatesByCounty', 'CommonController@getStatesByCounty');
Route::post('/getCityByState', 'CommonController@getCityByState');


Route::get('/send_invoice', 'InvoiceController@send_invoice');
Route::post('/get_email_template', 'InvoiceController@get_email_template');
Route::get('/purchase_orders', 'InvoiceController@purchase_orders');


Route::post('/sendmail','InvoiceController@sendmail');
//Route::get('/product/{id}', 'ProductController@getproduct');
//custom Invoice routes
Route::get('/users/invoices/{id}', 'UserController@invoices');
Route::post('/users/comments/', 'InvoiceController@comments');

Route::post('/users/update_user/', 'UserController@updateUser');

Route::get('/quotation/{id}', 'InvoiceController@quotation');
Route::get('/quotation2/{id}', 'InvoiceController@quotation2');
Route::get('/edit_quotation/{user_id}/{id}', 'InvoiceController@edit_quotation');
Route::post('/edit_quotation_data', 'InvoiceController@edit_quotation_data');
Route::post('/saveInvoice', 'InvoiceController@saveInvoice');
Route::post('/create_invoice','InvoiceController@create_invoice');
Route::post('/change_invoice_status','InvoiceController@change_invoice_status');
Route::get('/subscribers','SubscribersController@index');
Route::get('/subscribers/details/{id}','SubscribersController@subscribers_details');
Route::post('/plans', 'PackageController@plans');
Route::post('/saveSubscriptionInvoice', 'InvoiceController@saveSubscriptionInvoice');
Route::post('/saveDownloadInvoice', 'InvoiceController@saveDownloadInvoice');
Route::post('/create_invoice_subcription','InvoiceController@create_invoice_subcription');


//Route::get('dashboard', 'Admin\DashboardController@dashboard');
//Route::get('login', 'Admin\DashboardController@login');
//Route::post('admin_login_process', 'Admin\DashboardController@admin_login_process');
//Route::get('logout', 'Admin\DashboardController@logout');
Route::get('/new_registrants', 'UserController@newRegistrants');
Route::get('/user_cart', 'UserController@userCart');
Route::get('/abandoned_cart', 'UserController@abandoned_cart');
Route::get('/new_client_sales', 'UserController@newClientSales');
Route::get('/quotation_report', 'InvoiceController@quotationReport');
Route::get('/quotation_cancel/{id}', 'InvoiceController@quotationCancel');
Route::get('/outstanding_report', 'InvoiceController@outstandingReport');



Route::post('/changeAbandonedCartStatus/{id}', 'UserController@changeAbandonedCartStatus');
Route::get('/edit_profile/{id}', 'SubAdminController@editProfile');
Route::post('/subadmin/edit_profile/{id}', 'SubAdminController@updateProfile');
//Route for Promtion 
Route::get('/add_promotion', 'PromotionController@index');
Route::post('/createpromotion', 'PromotionController@create');
Route::get('/list_promotion', 'PromotionController@promotionList');

Route::get('/promotionstatus/{status}/{id}', 'PromotionController@changePromotionStatus');
Route::get('/deletepromotion/{id}', 'PromotionController@destroy');
Route::get('/updatepromotion/{id}', 'PromotionController@updatePromotion');
Route::post('/editpromotion', 'PromotionController@editPromotion');

//Route for Module 
Route::get('/add_module', 'ModuleController@index');
Route::post('/createmodule', 'ModuleController@create');
Route::get('/list_module', 'ModuleController@modulesList');

Route::get('/modulestatus/{status}/{id}', 'ModuleController@changeModulesStatus');
Route::get('/deletemodule/{id}', 'ModuleController@destroy');
Route::get('/updatemodule/{id}', 'ModuleController@updateModules');
Route::post('/editmodules', 'ModuleController@editModules');

});

Route::get('emailVerification','UserContactusController@emailVerification');
Route::get('payu/{id}','PaymentController@payu');
Route::get('payuplan/{id}','PaymentController@payuplan');
Route::get('invoiceConfirmation/{id}','PaymentController@invoiceConfirmation');

// Route for active user account
Route::get('active_user_account/{email?}', "UserController@activeUserAccount");






