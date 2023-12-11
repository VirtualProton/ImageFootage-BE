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

Route::group([
    'middleware' => ['api', 'CORS'],

], function () {

    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::post('resend_verification_link/{email?}', 'AuthController@resendVerificationLink');
    Route::get('active_user_account/{token?}', "AuthController@activeUserAccount");
    Route::post('verify_mobile', "AuthController@verifyMobile");
    Route::post('resend_otp', "AuthController@resendOtp");

    Route::post('user_contactus', 'UserContactusController@submitContactUs');
    Route::post('user_cart_list', 'FrontuserController@userCartList');

    Route::post('validate_otp_for_reset', 'FrontuserController@validateOtpForcontributorPass');
    Route::post('reset_contributer_pass', 'FrontuserController@resetContributerPass');
    Route::post('contact_us', 'AuthController@contactUs');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh')->middleware('jwt.verify');
    Route::post('me', 'AuthController@me');
    Route::post('sendPasswordResetLink', 'ResetPasswordController@sendEmail');
    Route::post('resetPassword', 'ChangePasswordController@process');
    Route::post('/products_api', 'ProductController@productListApi');
    Route::post('search', 'SearchController@index');
    Route::get('get-home-products', 'SearchController@getHomePageProducts');
    Route::get('music-search/{query}', 'SearchController@musicSearchByTitle'); # search by music title
    Route::post('relatedsearch', 'SearchController@relatedProductList');
    Route::post('details', 'MediaController@index');
    Route::post('get-already-downloaded-image', 'MediaController@getAlreadyDownloadedImage');

    Route::get('home', 'SearchController@home');

    Route::get('pantherImageUpdate', 'CronController@pantherImageUpdate');

    Route::get('get_side_filtes', 'FiltersController@getAllFilters');
    Route::post('get-side-filters-v2', 'FiltersController@getAllFiltersV2');
    Route::get('getCountyStatesCityList', 'UserContactusController@getCountyStatesCityList');
    Route::get('getCountyStatesList/{id}', 'UserContactusController@getCountyStatesList');
    Route::get('getStateCityList/{id}', 'UserContactusController@getStateCityList');
    Route::post('atomPayResponse', 'PaymentController@atomPayResponse');
    Route::post('contributorSignup', 'UserContactusController@contributorSignup');
    Route::get('packages', 'PackageApiController@packageList');

    Route::get('contributorprofile/{id}', 'UserController@contributorProfile');
    Route::post('resendOtp', 'UserContactusController@resendOtp');
    Route::post('verifyOtp', 'UserContactusController@verifyOtp');
    Route::post('verifyOtp', 'UserContactusController@verifyOtp');
    Route::get('categories', 'MediaController@categoryListApi');
    Route::post('payUResponse', 'PaymentController@payUResponse');
    Route::post('validUser', 'UserController@validUser');
    Route::post('validMobileUser', 'UserController@validMobileUser');
    Route::post('requestChangePassword', 'UserController@requestChangePassword');
    Route::post('forgotResetPassword', 'UserContactusController@forResetPassword');
    Route::post('userchangepassword', 'UserContactusController@uchangepassword');
    Route::post('atomPayPlanResponse', 'PaymentController@atomPayPlanResponse');
    Route::post('atomPayInvoiceResponse', 'PaymentController@atomPayInvoiceResponse');
    Route::post('sampledownloadFootage', 'MediaController@sampledownloadFootage');
    Route::post('razor_response', 'PaymentController@razor_response');
    Route::post('razor_plan_response', 'PaymentController@razor_plan_response');
    Route::post('payUplanResponse', 'PaymentController@payUplanResponse');
    Route::post('atomPayInvoiceResponsePlan', 'PaymentController@atomPayInvoiceResponsePlan');
    Route::get('atompayinvoiceplan', 'PaymentController@atompayinvoiceplan');
    Route::get('paymentSuccess', 'PaymentController@paymentSuccess');
    Route::post('atomSubPayInvoiceResponse', 'PaymentController@atomSubPayInvoiceResponse');
    Route::get('/promotion/{page?}', 'Admin\PromotionController@getPromotion');

    Route::get('/add_products_api', 'ProductApiController@getAddProduct');
    Route::post('/add_products_api', 'ProductApiController@postAddProduct');
    Route::get('/update_products_api/{id}', 'ProductApiController@getUpdateProduct');
    Route::post('/update_products_api', 'ProductApiController@postUpdateProduct');
    Route::get('emailHtml', 'PaymentController@emailHtml');
    Route::get('categoryWiseData', 'SearchController@categoryWiseData');
    Route::get('/product/{id}', 'ProductController@getproduct');
    Route::get('/search-keywords/get/{keyword?}', 'SearchController@getKeywords');

    Route::post('delete_user_profile/{id}', 'AuthController@delete_user_profile');


    Route::post('user/delete-account/{user_id}', 'UserController@deleteUserAccount');

    Route::get('/get_trending_keywords/{keyword?}', 'SearchController@getTrendingKeywords');
    Route::get('/get_discount_messages/{page?}', 'Admin\DiscountMessageController@discountMessagesList');
    Route::get('/get_countries_list', 'AuthController@getCountriesList');
    Route::get('/get_states_list/{country_id?}', 'AuthController@getStatesList');
    Route::get('/get_cities_list/{state_id?}', 'AuthController@getCitiesList');
    Route::post('relatedsearchImage', 'SearchController@relatedSimilarImageList');
    Route::get('/category-list', 'ProductController@categoryLists');
    Route::post('/category-details', 'ProductController@categoryDetails');
});

Route::group([
    'middleware' => ['api', 'CORS','jwt.verify'],

], function () {
    Route::post('add_to_cart', 'FrontuserController@addtocart');
    Route::post('user_cart_list', 'FrontuserController@userCartList');
    Route::post('delete_cart_item', 'FrontuserController@deleteCartItem');
    Route::post('addto_wishlist', 'FrontuserController@addtoWishlist');
    Route::post('delete_wishlist_product', 'FrontuserController@deleteWishlistItem');
    Route::post('wishlist', 'FrontuserController@wishlist');
    Route::post('wishlist-app-v2', 'FrontuserController@wishlistAppV2');
    Route::post('wishlistfs', 'FrontuserController@wishlistfs');
    Route::post('payment', 'PaymentController@payment');
    Route::post('orderDetails', 'PaymentController@orderDetails');
    Route::get('userprofile/{id}', 'UserController@userProfile');
    Route::post('get-available-package-list', 'UserController@getAvailablePackageList');
    Route::post('myplan', 'UserController@myPlan');
    Route::get('userOrders/{id}', 'UserController@userOrders');
    Route::post('purchase-history', 'UserController@purchaseHistory');
    Route::post('download-history', 'UserController@downloadHistory');
    Route::get('get_subscription_plan', 'PackageApiController@packageList');
    Route::post('paymentPlan', 'PaymentController@paymentPlan');
    Route::post('download', 'MediaController@download');
    Route::post('multi-download', 'MediaController@multipleDownload');
    Route::post('re-download', 'MediaController@reDownload');
    Route::post('downloadindi', 'MediaController@downloadindi');
    Route::post('getuseraddress', 'UserController@getUserAddress');
    Route::post('update_profile', 'UserController@update_profile');
    Route::post('callback_download', 'MediaController@callback_download');

    Route::get('getIpAddress', 'FrontuserController@getIpAddress');
    Route::get('getLocationDetails', 'FrontuserController@ip_details');
    Route::get('getCurrencies', 'FrontuserController@getCurrencies');
    Route::post('/getCustomPage/{slug}', 'StaticController@getCustomPage');

    # Wishlist
    Route::post('/share-wishlist', 'WishListController@shareWishListCreateLink');
    Route::post('/accept-wishlist-link', 'WishListController@acceptWishlistFolder');
    Route::post('/add-products-to-wishlist', 'WishListController@addProductToWishlist');
    Route::post('/get-user-wishlist-products', 'WishListController@getUserWishlistData');
    Route::post('/create-update-wishlist', 'WishListController@createOrUpdateWishlist');
    Route::post('/remove-products-from-wishlist', 'WishListController@removeProductFromWishlist');
    Route::post('/delete-wishlist-data', 'WishListController@deleteWishlist');
    Route::post('/get-wishlist-data', 'WishListController@getWishlistData');

    Route::post('/get-author-products', 'SearchController@getAuthorProducts');
    Route::post('/get-author-musics', 'SearchController@getAuthorMusics');
    Route::post('/get-category-products', 'SearchController@getCategoryProducts');
    Route::post('/get-category-musics', 'SearchController@getCategoryMusics');
});


/**For new updated designs modules */

Route::group(['prefix' => 'v2'], function () {
    Route::group([
        'middleware' => ['api', 'CORS'],

    ], function () {
        Route::post('signup-v2', 'AuthController@signupV2');
        Route::post('login-v2', 'AuthController@loginV2');
        Route::get('packages-v2', 'PackageApiController@packageListv2');
        Route::get('editorials-v2', 'EditorialController@editorialListv2');
        Route::get('editorials-stories-v2', 'EditorialController@editorialStoryListv2');
        Route::get('editorials-v2/{id}', 'EditorialController@editorialDetailv2');
        Route::post('social-login', 'AuthController@socialLoginv2');  # new socialLogin
        Route::post('refresh', 'AuthController@refresh');
    });
});


# Elasticsearch
Route::get('/search/{query}', 'ElasticSearchController@search');
Route::post('/store-elasticword', 'ElasticSearchController@storeNewWorld');


// CRONS path
Route::group([
    'middleware' => ['api', 'CORS']
], function () {
    Route::get('panther-media-home-categories-image-upload', 'CronController@pantherMediaHomeCategoriesImageUpload');
    Route::get('panther-media-other-categories-image-upload', 'CronController@pantherMediaOtherCategoriesImageUpload');

    Route::get('pond5-home-categories-footage-upload', 'CronController@pond5HomeCategoriesFootageUpload');
    Route::get('pond5-other-categories-footage-upload', 'CronController@pond5OtherCategoriesFootageUpload');

    Route::get('pond5-home-categories-music-upload', 'CronController@pond5HomeCategoriesMusicUpload');
    Route::get('pond5-other-categories-music-upload', 'CronController@pond5OtherCategoriesMusicUpload');

    Route::get('pond5-home-categories-image-upload', 'CronController@pond5HomeCategoriesImageUpload');
    Route::get('pond5-other-categories-image-upload', 'CronController@pond5OtherCategoriesImageUpload');
});


