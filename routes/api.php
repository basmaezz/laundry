<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BankController;
use App\Http\Controllers\API\CarTypeController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\DelegatesController;
use App\Http\Controllers\API\FaqController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\SettingController;
use App\Http\Controllers\API\UsersController;
use App\Http\Controllers\API\WalletController;
use App\Http\Controllers\API\AddressController;
use App\Http\Controllers\API\YearController;
use App\Http\Controllers\API\PaymentController;
use App\Http\Controllers\API\NationalityController;
use Illuminate\Support\Facades\Route;


// Route::get('/load-users', 'Admin\UsersController@loadUsers')->name('api.load-users');

//** Start AuthController**//

Route::group(['middleware' => ['language'], 'namespace' => 'App\Http\Controllers\API'], function () {

    //  Register And Login
    Route::post('register', [AuthController::class, 'signUp']);
    Route::post('checkEmail', [AuthController::class, 'checkEmail']);
    Route::post('checkMobile', [AuthController::class, 'checkMobile']);
    Route::post('login', [AuthController::class, 'signIn']);
    Route::get('cities', [SettingController::class, 'cities']);
    Route::get('regions/{id}', [SettingController::class, 'regions']);
    Route::post('sign-up-delegate', [AuthController::class, 'sign_up_delegate']);
    Route::any('forget-password', [AuthController::class, 'forget_password']);

    //  Home app
    Route::get('getCategories/{id}', [CategoryController::class, 'getShowSubCategories']);
    Route::get('getCategories', [CategoryController::class, 'getCategories']);
    Route::get('search/{name}', [CategoryController::class, 'search']);
    Route::get('getSubCategoriesProduct/{id}/{urgent}', [CategoryController::class, 'getSubCategoriesProducts']);
    Route::get('getCarpetLaundryTimes/{id}', [CategoryController::class, 'getCarpetLaundryTimes']);
    Route::get('delete/reasons', [UsersController::class, 'delete_reason']);
    Route::get('getFaqs', [FaqController::class, 'getFaqs']);

    Route::get('bank', [BankController::class, 'index']);
    Route::get('car_type', [CarTypeController::class, 'index']);
    Route::get('years', [YearController::class, 'index']);
    Route::get('nationalities', [NationalityController::class, 'index']);
    Route::post('nationality/store', [NationalityController::class, 'store']);
});
Route::get('test-login', function () {
    //    return 'ok';
    //    return \Illuminate\Support\Facades\Hash::make('password');
    $user = \App\Models\AppUser::first();
    //        dd($user);

    //        return $user;
    $user->update([
        'password' => \Illuminate\Support\Facades\Hash::make('password')
    ]);
    $credentials = [
        'email' => $user->email,
        'password' => 'password'
    ];
    if (!$token = auth('app_users_api')->attempt($credentials)) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    return $token;
});
//Route::group(['middleware' => ['jwt', 'language'], 'namespace' => 'API'], function () {
//    Route::resource('address', AddressController::class);
//});
Route::group(['middleware' => ['jwt', 'language'], 'namespace' => 'API'], function () {
    // Payment gateway API
    Route::post('payment/request', [PaymentController::class, 'request']);
    Route::post('payment/status', [PaymentController::class, 'paymentStatus']);
    Route::post('payment/payByRegistration', [PaymentController::class, 'payByRegistration']);
    Route::post('payment/getStoreCards', [PaymentController::class, 'getStoreCards']);
    Route::post('payment/remove_card/{id}', [PaymentController::class, 'remove_registered_card']);

    Route::post('addToFavorite/{id}', [UsersController::class, 'addToFavorite']);
    Route::post('removeFromFavorite/{id}', [UsersController::class, 'removeFromFavorite']);
    Route::get('getMyFavorites', [UsersController::class, 'getMyFavorites']);
    Route::post('addToSearch/{id}', [UsersController::class, 'addTosearch']);
    Route::get('getHistory', [UsersController::class, 'getHistory']);
    Route::get('clearSearchHistory', [UsersController::class, 'clearSearchHistory']);
    Route::get('clearSearchHistoryById/{id}', [UsersController::class, 'clearSearchHistorybyId']);
    //Start In Order
    Route::post('addOrder', [OrderController::class, 'addOrderTable']);
    Route::get('Orders', [OrderController::class, 'OrdersTable']);
    Route::post('OrdersAfterCoupon', [UsersController::class, 'OrdersAfterCoupon']);
    Route::any('checkCoupon', [OrderController::class, 'checkCoupon']);
    Route::post('ordersFees', [OrderController::class, 'ordersFees']);
    Route::post('UpdateStatus', [OrderController::class, 'UpdateStatus']);
    Route::post('UpdateDeliveryType', [OrderController::class, 'updateDeliveryType']);
    Route::get('getOrder/{order}', [OrderController::class, 'getOrder']);
    Route::get('getActiveOrder', [OrderController::class, 'getActiveOrder']);

    Route::get('getNotification', [UsersController::class, 'getNotification']);
    Route::get('makeNotificationRead', [UsersController::class, 'makeNotificationRead']);
    Route::post('account/delete', [UsersController::class, 'deleteAccount']);
    Route::post('laundry/rate', [CategoryController::class, 'rate']);
    Route::get('carpetLaundries',[CategoryController::class,'getCarpetLaundries']);

    //Route::get('delete/reasons',[UsersController::class,'delete_reason']);

    Route::post('wallet/decrease', [WalletController::class, 'decrease']);
    Route::post('wallet/increase', [WalletController::class, 'increase']);
    Route::get('wallet', [WalletController::class, 'transactions']);
    Route::get('wallet/last', [WalletController::class, 'last_transaction']);
    Route::get('address', [AddressController::class, 'index']);
    Route::any('address/store', [AddressController::class, 'store']);
    Route::any('address/update/{id}', [AddressController::class, 'update']);
    Route::any('updateAddress/{id}', [AddressController::class, 'updateAddress']);
    Route::any('address/delete/{id}', [AddressController::class, 'destroy']);


    //**    HomeApp    **//


    Route::any('edit-profile-provider', [AuthController::class, 'edit_profile_provider']);
    Route::any('switch-notification', [AuthController::class, 'switch_notification']);
    Route::any('delete-notification', [UsersController::class, 'delete_notification']);
    Route::any('count-notification', [UsersController::class, 'count_notification']);
    Route::any('update-password', [AuthController::class, 'update_password']);
    Route::any('reset-password', [AuthController::class, 'reset_password']);
    Route::any('checkAvailable', [AuthController::class, 'checkAvailable']);
    Route::any('changeAvailable', [AuthController::class, 'changeAvailable']);
    Route::any('edit-password', [AuthController::class, 'edit_password']);
    Route::any('notifications', [UsersController::class, 'notifications']);
    Route::any('editProfile', [AuthController::class, 'editProfile']);
    Route::post('editProfile-delegate', [AuthController::class, 'editProfileDelegate']);
    Route::post('delegate-status', [AuthController::class, 'delegateStatus']);
    Route::any('editAvatar', [AuthController::class, 'editAvatar']);
    Route::any('resend-code', [AuthController::class, 'resend_code']);
    Route::any('check-code', [AuthController::class, 'check_code']);
    Route::get('profile', [AuthController::class, 'profile']);
    Route::any('log-out', [AuthController::class, 'log_out']);

    //******************************  User App *************************************//

    Route::any('category-additionals', [UsersController::class, 'category_additionals']);
    Route::any('user-details-order', [UsersController::class, 'user_details_order']);
    Route::any('request-delivery', [UsersController::class, 'request_delivery']);
    Route::any('package-payment', [UsersController::class, 'package_payment']);
    Route::any('bank-transfers', [UsersController::class, 'bank_transfers']);
    Route::any('user-addresses', [UsersController::class, 'user_addresses']);
    Route::any('delete-address', [UsersController::class, 'delete_address']);
    Route::any('discount-code', [UsersController::class, 'discount_code']);
    Route::any('order-details', [UsersController::class, 'order_details']);
    Route::any('payment-order', [UsersController::class, 'payment_order']);
    Route::any('payment-delivery', [UsersController::class, 'payment_delivery']);
    Route::any('my-favorites', [UsersController::class, 'my_favorites']);
    Route::any('delete-order', [UsersController::class, 'delete_order']);
    Route::any('add-address', [UsersController::class, 'add_address']);
    Route::any('user-orders', [UsersController::class, 'user_orders']);
    Route::any('add-order', [UsersController::class, 'add_order']);
    Route::any('favorite', [UsersController::class, 'favorite']);
    Route::any('my-dates', [UsersController::class, 'my_dates']);
    Route::any('add-rate', [UsersController::class, 'add_rate']);
    Route::any('add-date', [UsersController::class, 'add_date']);
    Route::any('costs', [UsersController::class, 'costs']);
    Route::post('updateDelegateLocation', [UsersController::class, 'updateDelegateLocation']);
    Route::post('updateDelegateToken', [UsersController::class, 'updateDelegateToken']);
    Route::post('token/check', [UsersController::class, 'checkToken']);
    Route::post('token/refresh', [UsersController::class, 'refreshToken']);



    Route::get('delegate-orders', [DelegatesController::class, 'delegate_orders']);
    Route::get('delegate-order-details/{order_id}', [DelegatesController::class, 'delegate_order_details']);
    Route::any('delegate-order-status', [DelegatesController::class, 'delegate_order_status']);
    Route::any('edit-product-service', [DelegatesController::class, 'edit_product_service']);
    Route::any('getDelegateWallet/{id}', [DelegatesController::class, 'getDelegateWallet']);



    Route::post('delegate-order-accept/{order_id}', [DelegatesController::class, 'accept_order']);
    Route::post('delegate-order-reject/{order_id}', [DelegatesController::class, 'reject_order']);
    Route::get('delegate_rejection_reason', [DelegatesController::class, 'rejection_reason']);
    Route::get('delegate_history', [DelegatesController::class, 'order_history']);
    Route::get('delegate_has_order', [DelegatesController::class, 'delegate_has_order']);

    Route::any('main-user', [UsersController::class, 'main_user']);
    Route::any('category-products', [UsersController::class, 'category_products']);
    Route::any('product-details', [UsersController::class, 'product_details']);
    Route::any('add-to-cart', [UsersController::class, 'add_to_cart']);
    Route::any('product-services', [UsersController::class, 'product_services']);
    Route::any('delete-service-cart', [UsersController::class, 'delete_service_cart']);
    Route::any('packages', [UsersController::class, 'packages']);
    Route::any('category-providers', [UsersController::class, 'category_providers']);

    Route::any('register-delegate', [SettingController::class, 'register_delegate']);
    Route::any('terms', [SettingController::class, 'terms']);
    Route::any('about', [SettingController::class, 'about']);
    Route::any('contact-us', [SettingController::class, 'contact_us']);
    Route::any('complaints', [SettingController::class, 'complaints']);
    Route::any('calendar', [SettingController::class, 'calendar']);
    Route::any('calendar', [SettingController::class, 'calendar']);
});
