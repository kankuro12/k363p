<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'vendor','middleware'=>'guest'],function(){


    Route::match(['GET','POST'],'request',[
		'uses'=>'Vendor\RequestController@index',
		'as'=>'vendor.request'
	]);

	Route::get('register',[
		'uses'=>'Vendor\Auth\RegisterController@getRegister',
		'as'=>'vendor.getRegister'
	]);
	Route::post('register',[
		'uses'=>'Vendor\Auth\RegisterController@postRegister',
		'as'=>'vendor.postRegister'
	]);
	Route::get('login',[
		'uses'=>'Vendor\Auth\LoginController@getLogin',
		'as'=>'vendor.getLogin'
	]);
	Route::post('login',[
		'uses'=>'Vendor\Auth\LoginController@postLogin',
		'as'=>'vendor.postLogin'
	]);
	Route::get('auth/register/activate/{token}',[
		'uses'=>'Vendor\Auth\LoginController@signupActivate',
		'as'=>'vendor.signupActivate'
	]);
	Route::get('auth/resend-verification',[
		'as' => 'vendor.resend_verification',
	    'uses' => 'Vendor\Auth\RegisterController@resend'
    ]);

});
Route::group(['prefix'=>'vendor','middleware'=>['authen','type','step'],'type'=>['vendor']],function(){

    Route::match(['get','post'],'resendotp',[
		'uses'=>'Vendor\Auth\RegisterController@resendotp',
		'as'=>'vendor.resendotp'
    ]);
	Route::get('logout',[
		'uses'=>'Vendor\Auth\LoginController@getLogout',
		'as'=>'vendor.getLogout'
	]);

	Route::match(['get','post'],'step1',[
		'uses'=>'Vendor\StepController@step1',
		'as'=>'vendor.step1'
    ]);


	Route::match(['get','post'],'step2',[
		'uses'=>'Vendor\StepController@step2',
		'as'=>'vendor.step2'
	]);

	Route::match(['get','post'],'step3',[
		'uses'=>'Vendor\StepController@step3',
		'as'=>'vendor.step3'
	]);



	Route::get('logout',[
		'uses'=>'Vendor\Auth\LoginController@getLogout',
		'as'=>'vendor.getLogout'
	]);
	Route::get('dashboard',[
		'uses'=>'Vendor\DashboardController@index',
		'as'=>'vendor.dashboard'
	]);
	Route::get('basic-info',[
		'uses'=>'Vendor\BasicDetailsController@index',
		'as'=>'vendor.get_basic_details'
	]);
	Route::post('basic-info',[
		'uses'=>'Vendor\BasicDetailsController@update',
		'as'=>'vendor.post_basic_details'
	]);
	Route::post('change-profile-pic',[
		'uses'=>'Vendor\BasicDetailsController@change_profile_pic',
		'as'=>'vendor.change_profile_pic'
	]);
	Route::post('change-cover-pic',[
		'uses'=>'Vendor\BasicDetailsController@change_cover_pic',
		'as'=>'vendor.change_cover_pic'
	]);
	Route::get('privacy-policy',[
		'uses'=>'Vendor\BasicDetailsController@privacy_policy',
		'as'=>'vendor.get_privacy_policy'
	]);
	Route::post('privacy-policy',[
		'uses'=>'Vendor\BasicDetailsController@privacy_policy_update',
		'as'=>'vendor.post_privacy_policy'
	]);
	Route::get('gallery',[
		'uses'=>'Vendor\BasicDetailsController@get_gallery',
		'as'=>'vendor.get_gallery'
	]);
	Route::get('gallery-edit',[
		'uses'=>'Vendor\BasicDetailsController@get_edit_gallery',
		'as'=>'vendor.get_edit_gallery'
	]);
	Route::post('gallery-edit',[
		'uses'=>'Vendor\BasicDetailsController@edit_post_gallery',
		'as'=>'vendor.post_edit_gallery'
	]);
	Route::post('gallery',[
		'uses'=>'Vendor\BasicDetailsController@post_gallery',
		'as'=>'vendor.post_gallery'
	]);
	Route::post('delete-gallery',[
		'uses'=>'Vendor\BasicDetailsController@delete_gallery',
		'as'=>'vendor.delete_gallery'
	]);
	Route::get('amenities',[
		'uses'=>'Vendor\BasicDetailsController@get_amenities',
		'as'=>'vendor.get_amenities'
	]);
	Route::post('change-amenity',[
		'uses'=>'Vendor\BasicDetailsController@change_amenity',
		'as'=>'vendor.change_amenity'
	]);
	Route::get('packages',[
		'uses'=>'Vendor\RoomsController@index',
		'as'=>'vendor.get_rooms'
	]);
	Route::get('packages/basic-info',[
		'uses'=>'Vendor\RoomsController@create',
		'as'=>'vendor.get_create_rooms'
	]);
	Route::post('packages/basic-info',[
		'uses'=>'Vendor\RoomsController@store',
		'as'=>'vendor.post_create_rooms'
	]);
	Route::get('packages/{id}/amenities',[
		'uses'=>'Vendor\RoomsController@amenities',
		'as'=>'vendor.get_amenities_rooms'
	]);
	Route::post('packages/{id}/amenities',[
		'uses'=>'Vendor\RoomsController@post_amenities',
		'as'=>'vendor.post_amenities_rooms'
	]);
	Route::get('packages/{id}/photos',[
		'uses'=>'Vendor\RoomsController@photos',
		'as'=>'vendor.get_photos_rooms'
	]);
	Route::post('packages/{id}/photos',[
		'uses'=>'Vendor\RoomsController@post_photos',
		'as'=>'vendor.post_photos_rooms'
	]);

	Route::get('packages/{id}/privacy-policy',[
		'uses'=>'Vendor\RoomsController@privacy_policy',
		'as'=>'vendor.get_privacy_policy_rooms'
	]);
	Route::post('packages/{id}/privacy-policy',[
		'uses'=>'Vendor\RoomsController@post_privacy_policy',
		'as'=>'vendor.post_privacy_policy_rooms'
	]);
	Route::get('packages/payment-mode',[
		'uses'=>'Vendor\RoomsController@payment_mode',
		'as'=>'vendor.get_payment_mode_rooms'
	]);
	Route::get('packages/basic-info/edit/{id}',[
		'uses'=>'Vendor\RoomsController@edit',
		'as'=>'vendor.get_edit_rooms'
	]);
	Route::post('packages/basic-info/edit/{id}',[
		'uses'=>'Vendor\RoomsController@update',
		'as'=>'vendor.post_edit_rooms'
	]);
	Route::get('packages/{id}/amenities/edit/',[
		'uses'=>'Vendor\RoomsController@edit_amenities',
		'as'=>'vendor.get_edit_amenities_rooms'
	]);
	Route::post('packages/{id}/amenities/edit/',[
		'uses'=>'Vendor\RoomsController@post_edit_amenities',
		'as'=>'vendor.post_edit_amenities_rooms'
	]);
	Route::post('packages/{id}/amenities/delete/',[
		'uses'=>'Vendor\RoomsController@delete_amenities_rooms',
		'as'=>'vendor.delete_amenities_rooms'
	]);
	Route::post('packages/{id}/amenities/update/',[
		'uses'=>'Vendor\RoomsController@update_amenities_rooms',
		'as'=>'vendor.update_amenities_rooms'
	]);
	Route::get('packages/{id}/photos/edit/',[
		'uses'=>'Vendor\RoomsController@edit_photos',
		'as'=>'vendor.get_edit_photos_rooms'
	]);
	Route::post('packages/{id}/photos/delete/',[
		'uses'=>'Vendor\RoomsController@delete_photos',
		'as'=>'vendor.get_delete_photos_rooms'
	]);
	Route::post('packages/{id}/bed/delete/',[
		'uses'=>'Vendor\RoomsController@delete_bed',
		'as'=>'vendor.get_delete_bed_rooms'
	]);
	Route::post('packages/delete/',[
		'uses'=>'Vendor\RoomsController@destroy',
		'as'=>'vendor.delete_room'
	]);
	Route::get('meals',[
		'uses'=>'Vendor\MealsController@index',
		'as'=>'vendor.get_meals'
	]);
	Route::get('meals/create',[
		'uses'=>'Vendor\MealsController@create',
		'as'=>'vendor.get_create_meals'
	]);
	Route::post('meals/create',[
		'uses'=>'Vendor\MealsController@store',
		'as'=>'vendor.post_create_meals'
	]);
	Route::get('meals/edit',[
		'uses'=>'Vendor\MealsController@edit',
		'as'=>'vendor.get_edit_meal'
	]);
	Route::post('meals/edit',[
		'uses'=>'Vendor\MealsController@update',
		'as'=>'vendor.post_edit_meal'
	]);
	Route::post('meals/delete',[
		'uses'=>'Vendor\MealsController@destroy',
		'as'=>'vendor.delete_meal'
	]);
	Route::get('bookings',[
		'uses'=>'Vendor\BookingController@index',
		'as'=>'vendor.bookings'
	]);
	Route::get('bookings/{id}',[
		'uses'=>'Vendor\BookingController@show',
		'as'=>'vendor.show_booking'
	]);
	Route::get('bookings/confirm/{id}',[
		'uses'=>'Vendor\BookingController@confirm',
		'as'=>'vendor.confirm_booking'
	]);
	Route::get('bookings/reject/{id}',[
		'uses'=>'Vendor\BookingController@reject',
		'as'=>'vendor.reject_booking'
	]);
	Route::get('bookings/complete/{id}',[
		'uses'=>'Vendor\BookingController@complete_booking',
		'as'=>'vendor.complete_booking'
	]);
	Route::get('bookings/payment_complete/{id}',[
		'uses'=>'Vendor\BookingController@complete_payment',
		'as'=>'vendor.complete_payment'
	]);

	Route::post('bookings/{id}',[
		'uses'=>'Vendor\BookingController@update',
		'as'=>'vendor.post_update_booking'
	]);


	Route::get('reviews',[
		'uses'=>'Vendor\ReviewsController@index',
		'as'=>'vendor.reviews'
	]);
	Route::get('reviews/{id}',[
		'uses'=>'Vendor\ReviewsController@show',
		'as'=>'vendor.review'
	]);
	Route::match(['get', 'post'], '/manage-coupon', [
        'as' => 'vendor.manage-coupon',
        'uses' => 'Vendor\CouponController@manageCoupon'
    ]);
    Route::match(['get', 'post'], '/add-coupon', [
        'as' => 'vendor.add-coupon',
        'uses' => 'Vendor\CouponController@addCoupon'
    ]);
    Route::match(['get', 'post'], '/insert-coupon', [
        'as' => 'vendor.insert-coupon',
        'uses' => 'Vendor\CouponController@insertCoupon'
    ]);
    Route::get('coupon/manage-coupon/{id}',[
    	'uses'=>'Vendor\CouponController@assign_coupon',
    	'as'=>'vendor.assign-coupon'
    ]);
    Route::get('coupon/disable-coupon/{id}',[
    	'uses'=>'Vendor\CouponController@disable_coupon',
    	'as'=>'vendor.disable-coupon'
    ]);
    Route::post('coupon/manage-coupon/{id}',[
    	'uses'=>'Vendor\CouponController@post_assign_coupon',
    	'as'=>'vendor.post_assign_coupon'
    ]);

    Route::get('settings/email-change',[
    	'uses'=>'Vendor\SettingController@get_settings_change_email',
    	'as'=>'vendor.get_settings_change_email'
    ]);
    Route::post('settings/email-change',[
    	'uses'=>'Vendor\SettingController@post_settings_change_email',
    	'as'=>'vendor.post_settings_change_email'
    ]);
    Route::get('settings/change-password',[
    	'uses'=>'Vendor\SettingController@get_settings_change_password',
    	'as'=>'vendor.get_settings_change_password'
    ]);
    Route::post('settings/change-password',[
    	'uses'=>'Vendor\SettingController@post_settings_change_password',
    	'as'=>'vendor.post_settings_change_password'
    ]);
    Route::get('notify/{id}',[
    	'uses'=>'Vendor\DashboardController@get_notification',
    	'as'=>'vendor.get_notification'
    ]);
    Route::get('notifications',[
    	'uses'=>'Vendor\DashboardController@get_notifications',
    	'as'=>'vendor.get_notifications'
    ]);





});
