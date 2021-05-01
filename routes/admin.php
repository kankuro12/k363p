<?php
use Illuminate\Support\Facades\Route;

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
Route::get('requests', [
    'uses'=>'Admin\DashboardController@requests',
    'as'=>'admin.requests'
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
Route::get('singlevendor/{slug}', [
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
Route::match(['get', 'post'], '/package/edit/{slug}', [
    'uses'=>'Admin\VendorsControllers@packageEdit',
    'as'=>'admin.edit_package'
]);
Route::get('packages/{id}/amenities/edit/',[
    'uses'=>'Vendor\RoomsController@edit_amenities',
    'as'=>'admin.get_edit_amenities_rooms'
]);
Route::post('packages/{id}/amenities/edit/',[
    'uses'=>'Vendor\RoomsController@post_edit_amenities',
    'as'=>'admin.post_edit_amenities_rooms'
]);
Route::post('packages/{id}/amenities/delete/',[
    'uses'=>'Vendor\RoomsController@delete_amenities_rooms',
    'as'=>'admin.delete_amenities_rooms'
]);
Route::post('packages/{id}/amenities/update/',[
    'uses'=>'Vendor\RoomsController@update_amenities_rooms',
    'as'=>'admin.update_amenities_rooms'
]);
Route::get('packages/{id}/photos/edit/',[
    'uses'=>'Vendor\RoomsController@edit_photos',
    'as'=>'admin.get_edit_photos_rooms'
]);
Route::post('packages/{id}/photos/delete/',[
    'uses'=>'Vendor\RoomsController@delete_photos',
    'as'=>'admin.get_delete_photos_rooms'
]);
Route::post('packages/{id}/bed/delete/',[
    'uses'=>'Vendor\RoomsController@delete_bed',
    'as'=>'admin..get_delete_bed_rooms'
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

Route::get('state/{id}/cities', [
    'uses'=>'Admin\CityController@get_city_from_state',
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
