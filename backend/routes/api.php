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
	Route::post('add_to_cart', 'FrontuserController@addtocart');
	Route::post('user_cart_list', 'FrontuserController@userCartList');
	Route::post('deleate_cart_itom/{id}', 'FrontuserController@deleteCartItom');
	Route::post('contact_us', 'AuthController@contactUs');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('sendPasswordResetLink', 'ResetPasswordController@sendEmail');
    Route::post('resetPassword', 'ChangePasswordController@process');
    Route::post('/products_api', 'ProductController@productListApi');
    Route::post('search','SearchController@index');
});
