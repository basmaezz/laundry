<?php

use Illuminate\Support\Facades\Route;

// Route::get('/load-users', 'Admin\UsersController@loadUsers')->name('api.load-users');

//** Start AuthController**//

Route::group(['middleware' => ['language'], 'namespace' => 'API'], function () {

    //  Register And Login
    Route::post('register', 'AuthController@signUp');
    Route::post('checkEmail', 'AuthController@checkEmail');
    Route::post('checkMobile', 'AuthController@checkMobile');
    Route::post('login', 'AuthController@signIn');
    Route::get('cities', 'SettingController@cities');
    Route::get('regions/{id}', 'SettingController@regions');
    Route::post('sign-up-delegate', 'AuthController@sign_up_delegate');
    Route::any('forget-password', 'AuthController@forget_password');

    //  Home app
    Route::get('getCategories/{id}', 'CategoryController@getShowSubCategories');
    Route::get('getCategories', 'CategoryController@getCategories');
    Route::get('search/{name}', 'CategoryController@search');
//    Route::any('getFavoriteSubCategories', 'UsersController@getFavoriteSubCategories');
    Route::get('getSubCategoriesProduct/{id}', 'CategoryController@getSubCategoriesProducts');
    Route::get('delete/reasons','UsersController@delete_reason');
    Route::get('getFaqs','FaqController@getFaqs');

    Route::get('bank','BankController@index');
    Route::get('car_type','CarTypeController@index');


});

Route::group(['middleware' => ['jwt', 'language'], 'namespace' => 'API'], function () {
    Route::post('addToFavorite/{id}', 'UsersController@addToFavorite');
    Route::post('removeFromFavorite/{id}', 'UsersController@removeFromFavorite');
    Route::get('getMyFavorites', 'UsersController@getMyFavorites');
    Route::post('addToSearch/{id}', 'UsersController@addTosearch');
    Route::get('getHistory', 'UsersController@getHistory');
    Route::get('clearSearchHistory', 'UsersController@clearSearchHistory');
    Route::get('clearSearchHistoryById/{id}', 'UsersController@clearSearchHistorybyId');
    //Start In Order
    Route::post('addOrder', 'OrderController@addOrderTable');
    Route::get('Orders', 'OrderController@OrdersTable');
    Route::post('OrdersAfterCoupon', 'UsersController@OrdersAfterCoupon');
    Route::any('checkCoupon', 'OrderController@checkCoupon');
    Route::post('ordersFees', 'OrderController@ordersFees');
    Route::post('UpdateStatus', 'OrderController@UpdateStatus');
    Route::post('UpdateDeliveryType', 'OrderController@updateDeliveryType');
    Route::get('getOrder/{order}', 'OrderController@getOrder');
    Route::get('getActiveOrder', 'OrderController@getActiveOrder');

    Route::get('getNotification','UsersController@getNotification');
    Route::get('makeNotificationRead','UsersController@makeNotificationRead');
    Route::post('account/delete','UsersController@deleteAccount');
    Route::post('laundry/rate','CategoryController@rate');
    //Route::get('delete/reasons','UsersController@delete_reason');

});


//**    HomeApp    **//
Route::group(['middleware' => ['jwt', 'language'], 'namespace' => 'API'], function () {

    Route::any('edit-profile-provider', 'AuthController@edit_profile_provider');
    Route::any('switch-notification', 'AuthController@switch_notification');
    Route::any('delete-notification', 'UsersController@delete_notification');
    Route::any('count-notification', 'UsersController@count_notification');
    Route::any('update-password', 'AuthController@update_password');
    Route::any('reset-password', 'AuthController@reset_password');
    Route::any('edit-password', 'AuthController@edit_password');
    Route::any('notifications', 'UsersController@notifications');
    Route::any('editProfile', 'AuthController@editProfile');
    Route::post('editProfile-delegate', 'AuthController@editProfileDelegate');
    Route::post('delegate-status', 'AuthController@delegateStatus');
    Route::any('editAvatar', 'AuthController@editAvatar');
    Route::any('resend-code', 'AuthController@resend_code');
    Route::any('check-code', 'AuthController@check_code');
    Route::get('profile', 'AuthController@profile');
    Route::any('log-out', 'AuthController@log_out');

    //******************************  User App *************************************//

    Route::any('category-additionals', 'UsersController@category_additionals');
    Route::any('user-details-order', 'UsersController@user_details_order');
    Route::any('request-delivery', 'UsersController@request_delivery');
    Route::any('package-payment', 'UsersController@package_payment');
    Route::any('bank-transfers', 'UsersController@bank_transfers');
    Route::any('user-addresses', 'UsersController@user_addresses');
    Route::any('delete-address', 'UsersController@delete_address');
    Route::any('discount-code', 'UsersController@discount_code');
    Route::any('order-details', 'UsersController@order_details');
    Route::any('payment-order', 'UsersController@payment_order');
    Route::any('payment-delivery', 'UsersController@payment_delivery');
    Route::any('my-favorites', 'UsersController@my_favorites');
    Route::any('delete-order', 'UsersController@delete_order');
    Route::any('add-address', 'UsersController@add_address');
    Route::any('user-orders', 'UsersController@user_orders');
    Route::any('add-order', 'UsersController@add_order');
    Route::any('favorite', 'UsersController@favorite');
    Route::any('my-dates', 'UsersController@my_dates');
    Route::any('add-rate', 'UsersController@add_rate');
    Route::any('add-date', 'UsersController@add_date');
    Route::any('costs', 'UsersController@costs');

    //***************************  User App *************************************//

    //************************** Delegate App ***********************************//

    Route::get('delegate-orders', 'DelegatesController@delegate_orders');
    Route::get('delegate-order-details/{order_id}', 'DelegatesController@delegate_order_details');
    Route::any('delegate-order-status', 'DelegatesController@delegate_order_status');
    Route::any('edit-product-service', 'DelegatesController@edit_product_service');


    Route::post('delegate-order-accept/{order_id}', 'DelegatesController@accept_order');
    Route::post('delegate-order-reject/{order_id}', 'DelegatesController@reject_order');
    Route::get('delegate_rejection_reason', 'DelegatesController@rejection_reason');
    Route::get('delegate_history', 'DelegatesController@order_history');
    Route::get('delegate_has_order', 'DelegatesController@delegate_has_order');

    //************************** Delegate App ************************************//

});


//**    information menu dashboard  **//
Route::group(['middleware' => ['jwt', 'language'], 'namespace' => 'API'], function () {

    Route::any('main-user', 'UsersController@main_user');
    Route::any('category-products', 'UsersController@category_products');
    Route::any('product-details', 'UsersController@product_details');
    Route::any('add-to-cart', 'UsersController@add_to_cart');
    Route::any('product-services', 'UsersController@product_services');
    Route::any('delete-service-cart', 'UsersController@delete_service_cart');
    Route::any('packages', 'UsersController@packages');
    Route::any('category-providers', 'UsersController@category_providers');

    Route::any('register-delegate', 'SettingController@register_delegate');
    Route::any('terms', 'SettingController@terms');
    Route::any('about', 'SettingController@about');
    Route::any('contact-us', 'SettingController@contact_us');
    Route::any('complaints', 'SettingController@complaints');
    Route::any('calendar', 'SettingController@calendar');
});
