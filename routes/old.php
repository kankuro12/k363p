<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'old'], function () {
    Route::get('/',[
        'uses'=>'HomeController@home',
        'as'=>'public.home'
    ]);

    Route::post('/searchloc',[
        'uses'=>'HomeController@search',
        'as'=>'public.searchloc'
    ]);
    Route::get('/home1',[
        'uses'=>'HomeController@home1',
        'as'=>'public.home1'
    ]);
    Route::get('v/{slug}',[
        'uses'=>'HomeController@single_vendor',
        'as'=>'public.single_vendor'
    ]);
    Route::get('room',[
        'uses'=>'HomeController@get_room',
        'as'=>'public.single_room'
    ]);
    Route::get('vendor/{slug}/review/',[
        'uses'=>'HomeController@get_review',
        'as'=>'public.get_review'
    ]);
    Route::get('vendor/{vslug}/service/{rslug}',[
        'uses'=>'HomeController@get_room',
        'as'=>'public.get_room'
    ]);

    Route::get('/test',function(){
        return view('layouts.vendor.index');
    });
    Route::get('about-us',[
        'uses'=>'HomeController@about_us',
        'as'=>'public.about_us'
    ]);
    Route::get('terms-and-conditions',[
        'uses'=>'HomeController@term_and_condition',
        'as'=>'public.term_and_condition'
    ]);
    Route::get('faqs',[
        'uses'=>'HomeController@faqs',
        'as'=>'public.faqs'
    ]);
    Route::get('privacy-policy',[
        'uses'=>'HomeController@privacy_policy',
        'as'=>'public.privacy_policy'
    ]);
    Route::get('contact-us',[
        'uses'=>'HomeController@contact_us',
        'as'=>'public.contact_us'
    ]);
    Route::post('/contactus', [
        'as' => 'contactus',
        'uses' => 'HomeController@contactus'
    ]);
    Route::get('country/{id}/states', [
      'uses'=>'HomeController@get_state_from_country',
      'as'=>'home.get_state_from_country'
    ]);
    Route::get('state/{id}/cities', [
      'uses'=>'HomeController@get_cities_from_state',
      'as'=>'home.get_cities_from_state'
    ]);
    Route::get('booking/{vslug}/{rslug}/start', [
      'uses'=>'BookingController@bookings_start',
      'as'=>'get_booking_process_start'
    ]);
    Route::get('search', [
      'uses'=>'SearchController@get_index',
      'as'=>'public.get_search'
    ]);
    Route::post('checkAvailabitlity/{vslug}/{rslug}', [
      'uses'=>'BookingController@checkAvailabitlity',
      'as'=>'public.checkAvailabitlity'
    ]);
    Route::get('tourism-areas/{slug}',[
        'uses'=>'HomeController@get_tourism_area',
        'as'=>'public.get_tourism_area'
    ]);
    Route::get('payment-option',[
        'uses'=>'HomeController@payment_option',
        'as'=>'public.payment_option'
    ]);
    Route::get('how-to-book',[
        'uses'=>'HomeController@how_to_book',
        'as'=>'public.how_to_book'
    ]);
    Route::get('list-business',[
        'uses'=>'HomeController@list_business',
        'as'=>'public.list_business'
    ]);

});


Route::group(['prefix'=>'user','middleware'=>'guest'],function(){
	Route::get('register',[
		'uses'=>'User\Auth\RegisterController@getRegister',
		'as'=>'user.getRegister'
	]);
	Route::post('register',[
		'uses'=>'User\Auth\RegisterController@postRegister',
		'as'=>'user.postRegister'
	]);
	Route::get('auth/register/activate/{token}',[
		'uses'=>'User\Auth\LoginController@signupActivate',
		'as'=>'user.signupActivate'
	]);
	Route::get('login',[
		'uses'=>'User\Auth\LoginController@getLogin',
		'as'=>'user.getLogin'
	]);
	Route::post('login',[
		'uses'=>'User\Auth\LoginController@postLogin',
		'as'=>'user.postLogin'
	]);
	Route::get('auth/resend-verification',[
		'as' => 'user.resend_verification',
	    'uses' => 'User\Auth\RegisterController@resend'
	]);
	Route::get('auth/{provider}', 'User\Auth\LoginController@redirect');
	Route::get('auth/{provider}/callback', 'User\Auth\LoginController@callback');
});
Route::group(['prefix'=>'user','middleware'=>['authen','type'],'type'=>['user']],function(){
	Route::get('logout',[
		'uses'=>'User\Auth\LoginController@getLogout',
		'as'=>'user.getLogout'
	]);
	Route::get('profile',[
		'uses'=>'User\DashboardController@index',
		'as'=>'user.profile'
	]);
	Route::post('profile/update',[
		'uses'=>'User\DashboardController@update_profile',
		'as'=>'user.update_profile'
	]);

	Route::post('change-profile-pic',[
		'uses'=>'User\DashboardController@change_profile_pic',
		'as'=>'user.change_profile_pic'
	]);
	Route::post('review/create',[
		'uses'=>'User\ReviewController@store',
		'as'=>'user.add_review'
	]);
	Route::get('reviews',[
		'uses'=>'User\ReviewController@index',
		'as'=>'user.reviews'
	]);
	Route::get('favourites',[
		'uses'=>'User\FavouritesController@index',
		'as'=>'user.favourites'
	]);
	Route::get('favourites/delete/{id}',[
		'uses'=>'User\FavouritesController@destroy',
		'as'=>'user.delete_favourites'
	]);
	Route::post('favourites',[
		'uses'=>'User\FavouritesController@store',
		'as'=>'user.add_to_favourites'
	]);
	Route::get('bookings',[
		'uses'=>'User\BookingsController@index',
		'as'=>'user.bookings'
	]);
	Route::get('bookings/show/{id}',[
		'uses'=>'User\BookingsController@show',
		'as'=>'user.show_bookings'
	]);
	Route::get('booking/{vslug}/{rslug}/step-1', [
	  'uses'=>'BookingController@get_booking_process_start_step_1',
	  'as'=>'get_booking_process_start_step_1'
	]);
	Route::post('apply-coupon',[
		'uses'=>'BookingController@apply_coupon',
		'as'=>'bookings.apply_coupon'
	]);
	Route::post('booking/confirmation',[
		'uses'=>'BookingController@booking_process_start_step_2',
		'as'=>'booking_process_start_step_2'
	]);
	Route::get('booking/invoice/{id}', [
	  'uses'=>'BookingController@get_invoice',
	  'as'=>'get_invoice'
	]);

	Route::get('settings/email-change',[
		'uses'=>'User\SettingController@get_settings_change_email',
		'as'=>'user.get_settings_change_email'
	]);
	Route::post('settings/email-change',[
		'uses'=>'User\SettingController@post_settings_change_email',
		'as'=>'user.post_settings_change_email'
	]);
	Route::get('settings/change-password',[
		'uses'=>'User\SettingController@get_settings_change_password',
		'as'=>'user.get_settings_change_password'
	]);
	Route::post('settings/change-password',[
		'uses'=>'User\SettingController@post_settings_change_password',
		'as'=>'user.post_settings_change_password'
	]);
	Route::post('pay-bill',[
		'uses'=>'BookingController@pay_with_khalti',
		'as'=>'user.pay_with_khalti'
	]);
	Route::get('notify/{id}',[
		'uses'=>'User\DashboardController@get_notification',
		'as'=>'user.get_notification'
	]);
	Route::get('notifications',[
		'uses'=>'User\DashboardController@get_notifications',
		'as'=>'user.get_notifications'
	]);





});
