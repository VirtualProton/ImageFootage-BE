<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
// //for api

// //end api

Route::group([
    'middleware' => ['api','CORS'],

], function () {

    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');

	Route::post('user_contactus', 'UserContactusController@submitContactUs');
	Route::post('user_cart_list', 'FrontuserController@userCartList');

	Route::post('validate_otp_for_reset', 'FrontuserController@validateOtpForcontributorPass');
	Route::post('reset_contributer_pass', 'FrontuserController@resetContributerPass');
    Route::post('contact_us', 'AuthController@contactUs');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('sendPasswordResetLink', 'ResetPasswordController@sendEmail');
    Route::post('resetPassword', 'ChangePasswordController@process');
    Route::post('/products_api', 'ProductController@productListApi');
    Route::post('search','SearchController@index');
	Route::post('relatedsearch','SearchController@relatedProductList');
    Route::get('details/{id}/{origin}/{type}','MediaController@index');
    Route::get('home','SearchController@home');
    Route::get('pantherImageUpload', 'CronController@pantherImageUpload');
    Route::get('pantherImageUpdate', 'CronController@pantherImageUpdate');
    Route::get('pond5Upload', 'CronController@pond5Upload');
	Route::get('get_side_filtes', 'FiltersController@getAllFilters');
    Route::get('getCountyStatesCityList', 'UserContactusController@getCountyStatesCityList');
    Route::get('getCountyStatesList/{id}', 'UserContactusController@getCountyStatesList');
    Route::get('getStateCityList/{id}', 'UserContactusController@getStateCityList');
    Route::post('atomPayResponse', 'PaymentController@atomPayResponse');
	Route::post('contributorSignup', 'UserContactusController@contributorSignup');
	Route::get('packages','PackageApiController@packageList');

	Route::get('contributorprofile/{id}','UserController@contributorProfile');
    Route::post('resendOtp', 'UserContactusController@resendOtp');
    Route::post('verifyOtp', 'UserContactusController@verifyOtp');
    Route::post('verifyOtp', 'UserContactusController@verifyOtp');
    Route::get('categoryListApi', 'MediaController@categoryListApi');
    Route::post('payUResponse', 'PaymentController@payUResponse');
    Route::post('validUser', 'UserController@validUser');
	Route::post('fbLogin','AuthController@fbLogin');
	Route::post('forgotResetPassword', 'UserContactusController@forResetPassword');
	



});

Route::group([
    'middleware' => ['api','CORS'], //'jwt.verify'

], function () {
    Route::post('add_to_cart', 'FrontuserController@addtocart');
    Route::post('user_cart_list', 'FrontuserController@userCartList');
    Route::post('delete_cart_item', 'FrontuserController@deleteCartItem');
    Route::post('addto_wishlist', 'FrontuserController@addtoWishlist');
    Route::post('delete_wishlist_product', 'FrontuserController@deleteWishlistItem');
    Route::post('wishlist', 'FrontuserController@wishlist');
    Route::post('payment', 'PaymentController@payment');
    Route::post('orderDetails', 'PaymentController@orderDetails');
    Route::get('userprofile/{id}','UserController@userProfile');
    Route::get('userOrders/{id}', 'UserController@userOrders');
    Route::get('get_subscription_plan', 'PackageApiController@packageList');

});
