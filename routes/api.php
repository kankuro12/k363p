<?php

Route::post('sms/mock','MockSmsController@mock');
Route::group([ 'middleware' => 'CheckApiKey','prefix'=>''],function (){
    // XXX hompage function
    Route::get('homepage','API\HomeController@homePage');


    Route::post('login', 'API\User\AuthController@login');
    Route::post('register', 'API\User\AuthController@register');
    Route::post('activate', 'API\User\AuthController@signupActivate');

    Route::post('login', 'API\Vendor\Auth\AuthController@login');

    Route::Post('vendors/featured','API\User\General@info');
    Route::group([ 'middleware' => 'auth:api','prefix'=>'user'],function (){
        Route::get('test', function(){
            echo "test ok";
        });
        Route::get('info', 'API\User\General@info');
    });


});

/* Vendor Controller */
Route::group(['prefix'=>'vendor'],function (){
    //Register
    Route::post('auth/register', 'API\Vendor\Auth\AuthController@register');
    //Activate
    Route::get('auth/register/activate/{token}', 'API\Vendor\Auth\AuthController@signupActivate');
    //Login
    Route::post('auth/login', 'API\Vendor\Auth\AuthController@login');
});
Route::group([ 'middleware' => 'auth:api','prefix'=>'vendor'],function (){
    //Basic Details
    Route::apiResource('vbasic-details', 'API\Vendor\BasicDetailsController')->only(['index','update']);
    //Amenities Routes
    Route::apiResource('amenities', 'API\Vendor\AmenitiesController');
    //Galleries Routes
    Route::apiResource('galleries', 'API\Vendor\GalleriesController');
    //Rooms Routes
    Route::apiResource('rooms', 'API\Vendor\RoomsController');
    //Policies Routes
    Route::apiResource('policies', 'API\Vendor\PoliciesController');



});

/* Admin Routes */
Route::group(['prefix'=>'admin'],function (){
    //Categories Routes
    Route::apiResource('categories', 'API\Admin\CategoryController');
    //Vendors Routes
    Route::apiResource('vendors', 'API\Admin\VendorController');
    //Amenities Routes
    Route::apiResource('amenities', 'API\Admin\AmenitiesController');


});

//Password Reset
Route::group(['middleware' => 'api', 'prefix' => 'password'
], function () {
    Route::post('create', 'API\PasswordResetController@create');
    Route::get('find/{token}', 'API\PasswordResetController@find');
    Route::post('reset', 'API\PasswordResetController@reset');
});