<?php
Route::group(['prefix'=>'admin','middleware'=>'admin_auth'],function(){

	Route::post('/image_upload', function() {
	    $CKEditor = $request->input('CKEditor');
	    $funcNum = $request->input('CKEditorFuncNum');
	    $message = $url = '';
	    if (Input::hasFile('upload')) {
	        $file = Input::file('upload');
	        if ($file->isValid()) {
	            $filename = $file->getClientOriginalName();
	            $file->move(public_path().'/images/', $filename);
	            $url = URL::to('/images/'.$filename);
	            
	        } else {
	            $message = 'An error occured while uploading the file.';
	        }
	    } else {
	        $message = 'No file uploaded.';
	    }
	    return '<script>window.parent.CKEDITOR.tools.callFunction('.$funcNum.', "'.$url.'", "'.$message.'")</script>';
	});


	Route::get('logout',[
		'as'=>'admin.logout'
		,'uses'=>'Admin\Auth\LoginController@logout'
	]);
	Route::get('dashboard', [
		'uses'=>'Admin\DashboardController@index',
		'as'=>'admin.dashboard'
	]);

	Route::get('categories', [
		'uses'=>'Admin\CategoriesController@index',
		'as'=>'admin.categories'
	]);

	Route::get('categories/create', [
		'uses'=>'Admin\CategoriesController@create',
		'as'=>'admin.get_create_categories'
	]);

	Route::post('categories/create', [
		'uses'=>'Admin\CategoriesController@store',
		'as'=>'admin.post_create_categories'
	]);

	Route::get('categories/{slug}', [
		'uses'=>'Admin\CategoriesController@edit',
		'as'=>'admin.get_edit_categories'
	]);
	Route::post('categories/{slug}', [
		'uses'=>'Admin\CategoriesController@update',
		'as'=>'admin.post_edit_categories'
	]);
	Route::get('categories/delete/{slug}', [
		'uses'=>'Admin\CategoriesController@destroy',
		'as'=>'admin.delete_categories'
	]);

	Route::get('amenities', [
		'uses'=>'Admin\AmenitiesController@index',
		'as'=>'admin.amenities'
	]);
	
	Route::get('amenities/create', [
		'uses'=>'Admin\AmenitiesController@create',
		'as'=>'admin.get_create_amenities'
	]);
	Route::post('amenities/create', [
		'uses'=>'Admin\AmenitiesController@store',
		'as'=>'admin.post_create_amenities'
	]);
	Route::get('amenities/{slug}', [
		'uses'=>'Admin\AmenitiesController@edit',
		'as'=>'admin.get_edit_amenities'
	]);
	Route::post('amenities/{slug}', [
		'uses'=>'Admin\AmenitiesController@update',
		'as'=>'admin.edit_post_amenities'
	]);
	Route::get('amenities/delete/{slug}', [
		'uses'=>'Admin\AmenitiesController@destroy',
		'as'=>'admin.get_delete_amenities'
	]);
	Route::get('vendors', [
		'uses'=>'Admin\VendorsControllers@index',
		'as'=>'admin.vendors'
	]);
	Route::get('vendors/create', [
		'uses'=>'Admin\VendorsControllers@create',
		'as'=>'admin.get_create_vendor'
	]);
	Route::post('vendors/create', [
		'uses'=>'Admin\VendorsControllers@store',
		'as'=>'admin.post_create_vendor'
	]);
	Route::get('vendors/{slug}', [
		'uses'=>'Admin\VendorsControllers@show',
		'as'=>'admin.vendor'
	]);
	Route::get('vendors/edit/{slug}', [
		'uses'=>'Admin\VendorsControllers@edit',
		'as'=>'admin.get_edit_vendor'
	]);
	Route::post('vendors/edit/{slug}', [
		'uses'=>'Admin\VendorsControllers@update',
		'as'=>'admin.post_edit_vendor'
	]);
	Route::get('vendors/delete/{slug}', [
		'uses'=>'Admin\VendorsControllers@destroy',
		'as'=>'admin.get_delete_vendor'
	]);
	Route::get('vendors/{slug}/photogallery', [
		'uses'=>'Admin\GalleriesController@index',
		'as'=>'admin.get_vendor_photo'
	]);
	Route::post('vendors/{slug}/photogallery/add', [
		'uses'=>'Admin\GalleriesController@store',
		'as'=>'admin.post_add_vendor_photo'
	]);
	Route::post('vendors/{slug}/photogallery/delete/', [
		'uses'=>'Admin\GalleriesController@destroy',
		'as'=>'admin.get_delete_vendor_photo'
	]);
	Route::get('vendors/{slug}/photogallery/edit', [
		'uses'=>'Admin\GalleriesController@edit',
		'as'=>'admin.get_edit_vendor_photo'
	]);
	Route::post('vendors/{slug}/photogallery/edit', [
		'uses'=>'Admin\GalleriesController@update',
		'as'=>'admin.post_edit_vendor_photo'
	]);
	Route::post('vendors/change-featured', [
		'uses'=>'Admin\VendorsControllers@change_featured',
		'as'=>'admin.vendor.change_featured'
	]);
	Route::post('vendors/change-verified', [
		'uses'=>'Admin\VendorsControllers@change_verified',
		'as'=>'admin.vendor.change_verified'
	]);
	Route::get('package-type', [
		'uses'=>'Admin\RoomTypesController@index',
		'as'=>'admin.get_room_type'
	]);
	Route::get('package-type/create', [
		'uses'=>'Admin\RoomTypesController@create',
		'as'=>'admin.get_create_room_type'
	]);
	Route::post('package-type/create', [
		'uses'=>'Admin\RoomTypesController@store',
		'as'=>'admin.post_create_room_type'
	]);
	Route::get('package-type/edit/{slug}', [
		'uses'=>'Admin\RoomTypesController@edit',
		'as'=>'admin.get_edit_room_type'
	]);
	Route::post('package-type/edit/{slug}', [
		'uses'=>'Admin\RoomTypesController@update',
		'as'=>'admin.post_edit_room_type'
	]);
	Route::get('package-type/delete/{slug}', [
		'uses'=>'Admin\RoomTypesController@destroy',
		'as'=>'admin.get_delete_room_type'
	]);
	Route::get('bed-type', [
		'uses'=>'Admin\BedTypesController@index',
		'as'=>'admin.get_bed_type'
	]);
	Route::get('bed-type/create', [
		'uses'=>'Admin\BedTypesController@create',
		'as'=>'admin.get_create_bed_type'
	]);
	Route::post('bed-type/create', [
		'uses'=>'Admin\BedTypesController@store',
		'as'=>'admin.post_create_bed_type'
	]);
	Route::get('bed-type/edit/{slug}', [
		'uses'=>'Admin\BedTypesController@edit',
		'as'=>'admin.get_edit_bed_type'
	]);
	Route::post('bed-type/edit/{slug}', [
		'uses'=>'Admin\BedTypesController@update',
		'as'=>'admin.post_edit_bed_type'
	]);
	Route::get('bed-type/delete/{slug}', [
		'uses'=>'Admin\BedTypesController@destroy',
		'as'=>'admin.get_delete_bed_type'
	]);
	Route::get('reviews', [
		'uses'=>'Admin\ReviewController@index',
		'as'=>'admin.get_reviews'
	]);
	Route::get('reviews/show/{id}', [
		'uses'=>'Admin\ReviewController@show',
		'as'=>'admin.show_reviews'
	]);
	Route::post('reviews/change-status', [
		'uses'=>'Admin\ReviewController@change_status',
		'as'=>'admin.change_review_status'
	]);
	Route::get('users', [
		'uses'=>'Admin\VendorUserController@index',
		'as'=>'admin.get_users'
	]);
	Route::get('users/show/{id}', [
		'uses'=>'Admin\VendorUserController@show',
		'as'=>'admin.show_user'
	]);
	Route::get('tourism-areas', [
		'uses'=>'Admin\TourismAreaController@index',
		'as'=>'admin.get_tourisam_areas'
	]);
	Route::get('tourism-areas/create', [
		'uses'=>'Admin\TourismAreaController@create',
		'as'=>'admin.get_tourisam_areas_create'
	]);
	Route::get('tourism-areas/edit/{id}', [
		'uses'=>'Admin\TourismAreaController@edit',
		'as'=>'admin.get_tourisam_areas_edit'
	]);
	Route::post('tourism-areas/edit/{id}', [
		'uses'=>'Admin\TourismAreaController@update',
		'as'=>'admin.post_tourisam_areas_edit'
	]);
	Route::post('tourism-areas/store', [
		'uses'=>'Admin\TourismAreaController@store',
		'as'=>'admin.post_tourisam_areas_create'
	]);
	Route::get('tourism-areas/delete/{id}', [
		'uses'=>'Admin\TourismAreaController@destroy',
		'as'=>'admin.delete_tourisam_area'
	]);
	Route::post('tourism-areas/photos/create', [
		'uses'=>'Admin\TourismAreaController@add_photos',
		'as'=>'admin.add_photos_to_tourisam_areas'
	]);
	Route::get('enquiries', [
		'uses'=>'Admin\DashboardController@get_enquiries',
		'as'=>'admin.get_enquiries'
	]);
	Route::get('countries', [
	  'uses'=>'Admin\CountryController@index',
	  'as'=>'admin.countries'
	]);
	Route::get('countries/create', [
	  'uses'=>'Admin\CountryController@create',
	  'as'=>'admin.get_create_country'
	]);
	Route::post('countries/create', [
	  'uses'=>'Admin\CountryController@store',
	  'as'=>'admin.post_create_country'
	]);
	Route::get('countries/edit/{id}', [
	  'uses'=>'Admin\CountryController@edit',
	  'as'=>'admin.get_edit_country'
	]);
	Route::post('countries/edit/{id}', [
	  'uses'=>'Admin\CountryController@update',
	  'as'=>'admin.post_edit_country'
	]);
	Route::get('countries/delete/{id}', [
	  'uses'=>'Admin\CountryController@destroy',
	  'as'=>'admin.delete_country'
	]);

	Route::get('states', [
	  'uses'=>'Admin\StateController@index',
	  'as'=>'admin.states'
	]);
	Route::get('states/create', [
	  'uses'=>'Admin\StateController@create',
	  'as'=>'admin.get_create_state'
	]);
	Route::post('states/create', [
	  'uses'=>'Admin\StateController@store',
	  'as'=>'admin.post_create_state'
	]);
	Route::get('states/edit/{id}', [
	  'uses'=>'Admin\StateController@edit',
	  'as'=>'admin.get_edit_state'
	]);
	Route::post('states/edit/{id}', [
	  'uses'=>'Admin\StateController@update',
	  'as'=>'admin.post_edit_state'
	]);
	Route::get('states/delete/{id}', [
	  'uses'=>'Admin\StateController@destroy',
	  'as'=>'admin.delete_state'
	]);

	Route::get('city', [
	  'uses'=>'Admin\CityController@index',
	  'as'=>'admin.city'
	]);
	Route::get('city/create', [
	  'uses'=>'Admin\CityController@create',
	  'as'=>'admin.get_create_city'
	]);
	Route::post('city/create', [
	  'uses'=>'Admin\CityController@store',
	  'as'=>'admin.post_create_city'
	]);
	Route::get('city/edit/{id}', [
	  'uses'=>'Admin\CityController@edit',
	  'as'=>'admin.get_edit_city'
	]);
	Route::post('city/edit/{id}', [
	  'uses'=>'Admin\CityController@update',
	  'as'=>'admin.post_edit_city'
	]);
	Route::get('city/delete/{id}', [
	  'uses'=>'Admin\CityController@destroy',
	  'as'=>'admin.delete_city'
	]);
	Route::get('country/{id}/states', [
	  'uses'=>'Admin\StateController@get_state_from_country',
	  'as'=>'admin.get_state_from_country'
	]);
	Route::match(['get', 'post'], '/manage-coupon', [
        'as' => 'admin.manage-coupon',
        'uses' => 'Admin\CouponController@manageCoupon'
    ]);
    Route::match(['get', 'post'], '/add-coupon', [
        'as' => 'admin.add-coupon',
        'uses' => 'Admin\CouponController@addCoupon'
    ]);
    Route::match(['get', 'post'], '/insert-coupon', [
        'as' => 'admin.insert-coupon',
        'uses' => 'Admin\CouponController@insertCoupon'
    ]);
    Route::get('members',[
    	'uses'=>'Admin\UsersController@index',
    	'as'=>'admin.members',
    ]);
    Route::get('members/create',[
    	'uses'=>'Admin\UsersController@create',
    	'as'=>'admin.get_create_members',
    ]);
    Route::post('members/create',[
    	'uses'=>'Admin\UsersController@store',
    	'as'=>'admin.post_create_members',
    ]);
    Route::get('members/edit/{id}',[
    	'uses'=>'Admin\UsersController@edit',
    	'as'=>'admin.get_edit_members',
    ]);
    Route::post('members/edit/{id}',[
    	'uses'=>'Admin\UsersController@update',
    	'as'=>'admin.post_edit_members',
    ]);
    Route::get('bookings',[
    	'uses'=>'Admin\BookingController@index',
    	'as'=>'admin.bookings',
    ]);
    Route::get('bookings/{id}',[
    	'uses'=>'Admin\BookingController@show',
    	'as'=>'admin.invoice',
    ]);
    Route::get('collections',[
    	'uses'=>'Admin\CollectionController@index',
    	'as'=>'admin.collections',
    ]);
    Route::get('collections/create',[
    	'uses'=>'Admin\CollectionController@create',
    	'as'=>'admin.get_create_collections',
    ]);
    Route::post('collections/create',[
    	'uses'=>'Admin\CollectionController@store',
    	'as'=>'admin.post_create_collections',
    ]);
    Route::get('collections/delete/{id}',[
    	'uses'=>'Admin\CollectionController@destroy',
    	'as'=>'admin.get_destroy_collections',
    ]);
    Route::get('collections/edit/{id}',[
    	'uses'=>'Admin\CollectionController@edit',
    	'as'=>'admin.get_edit_collections',
    ]);
    Route::post('collections/update/{id}',[
    	'uses'=>'Admin\CollectionController@update',
    	'as'=>'admin.post_edit_collections',
    ]);
    Route::get('collections/{id}/manage-product',[
    	'uses'=>'Admin\CollectionController@manage_product',
    	'as'=>'admin.get_manage_product',
    ]);
    Route::post('collections/{id}/manage-product',[
    	'uses'=>'Admin\CollectionController@post_manage_product',
    	'as'=>'admin.post_manage_product',
    ]);
    Route::get('collections/{id}/delete-product',[
    	'uses'=>'Admin\CollectionController@delete_product',
    	'as'=>'admin.get_delete_product',
    ]);
    Route::get('payment-modes',[
    	'uses'=>'Admin\PaymentMethodController@index',
    	'as'=>'admin.get_payment_mode',
    ]);
    Route::get('payment-modes/create',[
    	'uses'=>'Admin\PaymentMethodController@create',
    	'as'=>'admin.get_create_payment_mode',
    ]);
    Route::post('payment-modes/createstore',[
    	'uses'=>'Admin\PaymentMethodController@store',
    	'as'=>'admin.post_store_payment_mode',
    ]);
    Route::get('payment-modes/delete/{id}',[
    	'uses'=>'Admin\PaymentMethodController@destroy',
    	'as'=>'admin.get_delete_payment_mode',
    ]);
    Route::get('payment-modes/edit/{id}',[
    	'uses'=>'Admin\PaymentMethodController@edit',
    	'as'=>'admin.get_edit_payment_mode',
    ]);
    Route::get('payment-modes/show/{id}',[
    	'uses'=>'Admin\PaymentMethodController@show',
    	'as'=>'admin.get_show_payment_mode',
    ]);
    Route::post('payment-modes/update/{id}',[
    	'uses'=>'Admin\PaymentMethodController@update',
    	'as'=>'admin.post_update_payment_mode',
    ]);
    Route::get('accounts',[
    	'uses'=>'Admin\AccountController@index',
    	'as'=>'admin.get_accounts',
    ]);
    Route::get('accounts/create',[
    	'uses'=>'Admin\AccountController@create',
    	'as'=>'admin.get_create_accounts',
    ]);
    Route::post('accounts/store',[
    	'uses'=>'Admin\AccountController@store',
    	'as'=>'admin.post_store_accounts',
    ]);
    Route::get('accounts/delete/{id}',[
    	'uses'=>'Admin\AccountController@destroy',
    	'as'=>'admin.delete_accounts',
    ]);
    Route::get('accounts/edit/{id}',[
    	'uses'=>'Admin\AccountController@edit',
    	'as'=>'admin.get_edit_accounts',
    ]);
    Route::post('accounts/update/{id}',[
    	'uses'=>'Admin\AccountController@update',
    	'as'=>'admin.post_update_accounts',
    ]);
    Route::get('accounts/show/{id}',[
    	'uses'=>'Admin\AccountController@show',
    	'as'=>'admin.get_show_accounts',
    ]);
    
    
    


	
	
});

Route::group(['prefix'=>'admin','middleware'=>'guest'],function(){
	// Authentication Routes...  
	Route::get('login',[
		'as'=>'admin.getlogin',
		'uses'=>'Admin\Auth\LoginController@showLoginForm'  
	]);   

	Route::post('login', [
	    'as' => 'admin.postlogin',
	    'uses' => 'Admin\Auth\LoginController@login'
	]);  

	//Password reset routes
	Route::get('password/reset', [
	  'uses'=>'Admin\Auth\ForgotPasswordController@showLinkRequestForm',
	  'as'=>'adminpassword.resetform'
	]);
	Route::post('password/email', [
	  'uses'=>'Admin\Auth\ForgotPasswordController@sendResetLinkEmail',
	  'as'=>'adminpassword.reset'
	]);
	Route::get('passwords/reset/{token}', [
	  'uses'=>'Admin\Auth\ResetPasswordController@showResetForm',
	  'as'=>'apassword.reset'
	]);
	Route::post('password/reset', [
	  'uses'=>'Admin\Auth\ResetPasswordController@reset',
	  'as'=>'adminpasswordreset'
	]);

	
	
});




Route::group(['prefix'=>'vendor','middleware'=>'guest'],function(){
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

//Password reset routes
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('fpass');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

//***********************
Route::get('/',[
	'uses'=>'HomeController@home',
	'as'=>'public.home'
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




Route::get('test',function(){
	$str="https://www.google.com/maps/place/Need+Technosoft+Pvt+Ltd/@26.4809638,87.2742021,17z/data=!3m1!4b1!4m5!3m4!1s0x39ef75d4df1dda71:0x7a5c0791724d0c90!8m2!3d26.480959!4d87.2763908";
	$data=parse_url($str);
	dd($data);
});

Route::get('sms/show','MockSmsController@show');