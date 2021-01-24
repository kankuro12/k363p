<?php
use Illuminate\Support\Facades\Route;

//Password reset routes
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('fpass');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

//***********************


Route::group(['prefix' => ''], function () {
    Route::name('n.')->group(function(){
        Route::get('','Need\HomeController@index')->name('home');
        Route::post('location/search','Need\HomeController@locSearch')->name('location.search');
        Route::post('mobile/search','Need\HomeController@mobileSearch')->name('mobile.search');
        Route::get('search','Need\HomeController@search')->name('search');

        Route::get('vendor/{slug}',[
        'uses'=>'Need\HomeController@single_vendor',
        'as'=>'single_vendor'
        ]);

        Route::get('service/{v_slug}/{r_slug}',[
            'uses'=>'Need\HomeController@single_service',
            'as'=>'single_service'
            ]);

        Route::get('ajaxsearch','Need\HomeController@ajaxSearch')->name('ajaxsearch');

        // XXX Booking Start
        Route::match(['get', 'post'],'startbooking','Need\BookingController@start')->name('startbooking');

        // XXX User Authentication
        Route::group(['prefix' => 'user'], function () {
            Route::name('user.')->group(function(){
                Route::match(['get', 'post'], 'login','Need\Auth\BookingController@login')->name('login');
                Route::match(['get', 'post'], 'signup','Need\Auth\BookingController@signup')->name('signup');
                Route::match(['get', 'post'], 'otp','Need\Auth\BookingController@otp')->name('otp');
                Route::match(['get', 'post'], 'resendotp','Need\Auth\BookingController@resendotp')->name('resendotp');
                Route::match(['get', 'post'], 'logout','Need\Auth\BookingController@logout')->name('logout');

                Route::get('auth/{provider}', 'Need\Auth\BookingController@redirect')->name('social');
	            Route::get('auth/{provider}/callback', 'Need\Auth\BookingController@callback')->name('social-login');
            });
        });
        Route::group(['prefix'=>'user','middleware'=>['authen','type'],'type'=>['user']],function(){
            // Route::match(['get', 'post'], 'startbook', startbook);
            Route::match(['get', 'post'],'verifyBooking','Need\BookingController@verifyBooking')->name('verifyBooking');
            Route::match(['get', 'post'],'book','Need\BookingController@book')->name('book');

            Route::name('user.')->group(function(){
                Route::match(['get', 'post'],'dashboard','Need\UserController@index')->name('dashboard');
                Route::match(['get', 'post'],'logout','Need\UserController@logout')->name('logout');
                Route::match(['get', 'post'],'changepic','Need\UserController@changePic')->name('changepic');
                Route::match(['get', 'post'],'updateprofile','Need\UserController@updateProfile')->name('updateprofile');

                Route::group(['prefix' => 'booking'], function () {
					route::get('','Need\UserController@booking')->name('booking');
                    Route::get('single/{code}','Need\UserController@SingleBooking')->name('singlebooking');
                });

                Route::group(['prefix' => 'notification'], function () {
					route::get('','Need\UserController@notifications')->name('notifications');
                    Route::get('notification/{id}','Need\UserController@notification')->name('singlenotification');
                });
            });


        });
    });
});

Route::get('test',function(){
	// \App\User::where('id','>','1')->update(['password'=>bcrypt('admin@123')]);
    // dd(bcrypt('admin@123'));
    $arr1=[1,2,3,4,5,6];
    $arr1[1]=99;

    $arr2=[];
    $arr2['first']=1;
    $arr2['second']=2;
    dd($arr1,$arr2);
});

Route::get('sms/show','MockSmsController@show');




