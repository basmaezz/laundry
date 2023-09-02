<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Customer\AdminController;
use App\Http\Controllers\languageController;
use App\Http\Controllers\ProfileController;
use App\Models\AppUser;
use App\Models\SiteSetting;
use App\Models\Subcategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\subCategoryController;
use App\Http\Controllers\Admin\CategoryItemController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CouponsController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\faqsController;
use App\Http\Controllers\Customer\ItemsController;
use App\Http\Controllers\Customer\ProductsController;
use App\Http\Controllers\Customer\OrdersController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\BankController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\NotificationController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
    //    return view('auth.login');
});
Route::get('/admin', function () {
    return view('auth.login');
});
Route::post('adminLogin', [UserController::class, 'adminLogin'])->name('adminLogin');
Route::get('/dashboard', [AdminDashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__ . '/auth.php';

Route::middleware(['auth', 'IsAdmin'])->group(function () {
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('getUsers', [UserController::class, 'getUsers'])->name('users.getUsers');
    Route::get('TrashedUsers', [UserController::class, 'adminTrashed'])->name('users.adminTrashed');
    Route::get('forceDelete', [UserController::class, 'forceDelete'])->name('users.forceDelete');
    Route::get('restoreDeletedAdmins/{id}', [UserController::class, 'restoreDeletedAdmins'])->name('users.restoreDeletedAdmins');
    Route::get('profile', [UserController::class, 'profile'])->name('users.profile');
    Route::get('editPassword', [UserController::class, 'editPassword'])->name('users.editPassword');
    Route::post('updatePassword', [UserController::class, 'updatePassword'])->name('user.updatePassword');
    Route::patch('updateProfile', [UserController::class, 'updateProfile'])->name('user.updateProfile');
    Route::get('customers', [UserController::class, 'customers'])->name('customers.index');
    Route::get('customerOrder/{id}', [UserController::class, 'customerOrders'])->name('customer.Orders');
    Route::get('delegates', [UserController::class, 'delegates'])->name('delegates.index');
    Route::get('createDelegate', [UserController::class, 'CreateDelegate'])->name('delegate.create');
    Route::post('storeDelegate', [UserController::class, 'storeDelegate'])->name('delegate.store');
    Route::get('showDelegate/{id}', [UserController::class, 'showDelegate'])->name('delegate.show');
    Route::get('restoreDeletedDelegates/{id}', [UserController::class, 'restoreDeletedDelegates'])->name('delegate.restoreDeletedDelegates');
    Route::get('editDelegate/{id}', [UserController::class, 'editDelegate'])->name('delegate.edit');
    Route::post('updateDelegate/{id}', [UserController::class, 'updateDelegate'])->name('delegate.update');
    Route::get('changeDelegateStatus/{id}', [UserController::class, 'changeDelegateStatus'])->name('delegate.changeDelegateStatus');
    Route::get('acceptRegister/{id}', [UserController::class, 'acceptRegister'])->name('delegate.acceptRegister');
    Route::get('deleteDelegate', [UserController::class, 'deleteDelegate'])->name('delete.delegate');
    Route::get('trashedDelegates', [UserController::class, 'trashedDelegates'])->name('delegate.trashedDelegates');
    Route::get('registrationRequests', [UserController::class, 'getRegistrationRequests'])->name('delegate.registrationRequests');
    Route::get('addRejectReason/{id}', [UserController::class, 'addRejectReason'])->name('delegate.addRejectReason');
    Route::post('storeRejectReason/{id}', [UserController::class, 'storeRejectReason'])->name('delegate.storeRejectReason');
    Route::get('rejectionRequests', [UserController::class, 'rejectionRequests'])->name('delegate.rejectionRequests');
    Route::get('customerDelete', [UserController::class, 'customerDelete'])->name('customer.delete');
    Route::get('customerWallet/{id}', [UserController::class, 'customerWallet'])->name('customer.wallet');
    Route::post('increaseWallet/{id}', [UserController::class, 'increaseWallet'])->name('customer.wallet.increase');
    Route::get('userView/{id}', [UserController::class, 'show'])->name('user.view');
    Route::get('userCreate', [UserController::class, 'create'])->name('user.create');
    Route::post('userStore', [UserController::class, 'store'])->name('user.store');
    Route::get('userEdit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('userUpdate/{id}', [UserController::class, 'update'])->name('user.update');
    Route::get('userDelete', [UserController::class, 'destroy'])->name('user.delete');
    Route::post('searchLaundry', [UserController::class, 'destroy'])->name('searchLaundry');

    Route::get('laundries', [subCategoryController::class, 'index'])->name('laundries.index');
    Route::get('laundryCreate', [subCategoryController::class, 'create'])->name('laundries.create');
    Route::post('laundryStore', [subCategoryController::class, 'store'])->name('laundries.store');
    Route::get('laundryEdit/{id}', [subCategoryController::class, 'edit'])->name('laundries.edit');
    Route::post('laundryUpdate/{id}', [subCategoryController::class, 'update'])->name('laundries.update');
    Route::get('laundryDestroy', [subCategoryController::class, 'destroy'])->name('laundries.destroy');
    Route::get('adminLaundries', [subCategoryController::class, 'adminLaundries'])->name('laundries.admins');
    Route::get('createAdminLaundries', [subCategoryController::class, 'createAdmin'])->name('laundries.createAdmin');
    Route::post('storeLaundryAdmin', [subCategoryController::class, 'storeLaundryAdmin'])->name('laundries.storeAdmin');
    Route::get('laundryView/{id}', [subCategoryController::class, 'show'])->name('laundries.view');
    Route::get('laundryOrders/{id}', [subCategoryController::class, 'getOrders'])->name('laundries.orders');
    Route::get('laundryUpdateStats', [subCategoryController::class, 'updateStats']);
    Route::get('branches/{id}', [subCategoryController::class, 'branches'])->name('laundries.branches');
    Route::get('createBranch/{id}', [subCategoryController::class, 'createBranch'])->name('laundries.branches.create');
    Route::post('storeBranch', [subCategoryController::class, 'storeBranch'])->name('laundries.storeBranch');
    Route::get('editBranch/{id}', [subCategoryController::class, 'editBranch'])->name('laundries.editBranch');
    Route::get('mainLaundries', [subCategoryController::class, 'mainLaundries'])->name('laundries.mainLaundries');
    Route::get('deleteBranch/{id}', [subCategoryController::class, 'deleteBranch'])->name('laundries.deleteBranch');
    Route::get('viewTrashedLaundries', [subCategoryController::class, 'viewTrashedLaundries'])->name('laundries.viewTrashedLaundries');
    Route::get('restoreDeleted', [subCategoryController::class, 'restoreDeleted'])->name('laundries.restoreDeleted');
    Route::get('CategoriesIndex', [CategoriesController::class, 'index'])->name('Categories.index');
    Route::get('CategoryEdit/{id}', [CategoriesController::class, 'edit'])->name('category.edit');
    Route::post('CategoryUpdate/{id}', [CategoriesController::class, 'update'])->name('category.update');
    Route::get('CategoryDelete/{id}', [CategoriesController::class, 'destroy'])->name('category.destroy');
    Route::get('CategoryItemsIndex/{id}', [CategoryItemController::class, 'index'])->name('CategoryItems.index');
    Route::get('CategoryItems/{id}', [CategoryItemController::class, 'create'])->name('CategoryItems.create');
    Route::get('CategoryItemsEdit/{id}', [CategoryItemController::class, 'edit'])->name('CategoryItems.edit');
    Route::post('CategoryItemsUpdate/{id}', [CategoryItemController::class, 'update'])->name('CategoryItems.update');
    Route::post('CategoryItemsStore', [CategoryItemController::class, 'store'])->name('CategoryItems.store');
    Route::get('CategoryItemsDestroy/{id}', [CategoryItemController::class, 'destroy'])->name('CategoryItems.destroy');
    Route::get('CategoryItemsShow/{id}', [CategoryItemController::class, 'show'])->name('CategoryItems.show');

    Route::get('productCreate/{id}', [ProductController::class, 'create'])->name('product.create');
    Route::post('productStore', [ProductController::class, 'store'])->name('product.store');
    Route::get('productDelete/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::get('productView/{id}', [ProductController::class, 'view'])->name('product.view');
    Route::get('productEdit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('productUpdate', [ProductController::class, 'update'])->name('product.update');
    Route::get('productAddService/{id}', [ProductController::class, 'addService'])->name('product.addService');
    Route::post('createProductService', [ProductController::class, 'createProductService'])->name('product.createProductService');
    Route::get('productServices/{id}', [ProductController::class, 'productServices'])->name('product.productServices');
    Route::get('deleteProductService/{id}', [ProductController::class, 'deleteProductService'])->name('product.deleteProductService');
    Route::get('editService/{id}', [ProductController::class, 'editService'])->name('product.editService');
    Route::post('updateService/{id}', [ProductController::class, 'updateService'])->name('product.updateService');

    Route::get('coupons', [CouponsController::class, 'index'])->name('coupons.index');
    Route::get('couponsCreate', [CouponsController::class, 'create'])->name('coupon.create');
    Route::post('couponsStore', [CouponsController::class, 'store'])->name('coupon.store');
    Route::get('couponEdit/{id}', [CouponsController::class, 'edit'])->name('coupon.edit');
    Route::patch('couponUpdate/{id}', [CouponsController::class, 'update'])->name('coupon.update');
    Route::get('couponDelete/{id}', [CouponsController::class, 'destroy'])->name('coupon.destroy');
    Route::get('changeStatus/{id}', [CouponsController::class, 'changeStatus'])->name('coupon.changeStatus');

    Route::get('getOrders', [OrderController::class, 'index'])->name('Order.index');
    Route::get('viewOrder/{id}', [OrderController::class, 'show'])->name('Order.show');
    Route::get('pendingDeliveryAcceptance', [OrderController::class, 'pendingDeliveryAcceptance'])->name('Order.pendingDeliveryAcceptance');
    Route::get('DeliveryOnWay', [OrderController::class, 'DeliveryOnWay'])->name('Order.DeliveryOnWay');
    Route::get('readyPickUp', [OrderController::class, 'readyPickUp'])->name('Order.readyPickUp');
    Route::get('WayToLaundry', [OrderController::class, 'WayToLaundry'])->name('Order.WayToLaundry');
    Route::get('DeliveredToLaundry', [OrderController::class, 'DeliveredToLaundry'])->name('Order.DeliveredToLaundry');
    Route::get('DeliveryOnTheWayToYou', [OrderController::class, 'DeliveryOnTheWayToYou'])->name('Order.DeliveryOnTheWayToYou');
    Route::get('WaitingForDeliveryToReceiveOrder', [OrderController::class, 'WaitingForDeliveryToReceiveOrder'])->name('Order.WaitingForDeliveryToReceiveOrder');
    Route::get('completed', [OrderController::class, 'completed'])->name('Order.completed');
    Route::get('changeStatus/', [OrderController::class, 'changeStatus']);
    Route::get('delegateOrders/{id}', [OrderController::class, 'delegateOrders'])->name('Order.delegateOrders');


    Route::get('Roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('RolesCreate', [RoleController::class, 'create'])->name('roles.create');
    Route::post('RolesStore', [RoleController::class, 'store'])->name('roles.store');
    Route::get('RolesEdit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
    Route::post('RolesUpdate/{id}', [RoleController::class, 'update'])->name('roles.update');
    Route::get('RolesDelete/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');

    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::get('addSettings', [SettingController::class, 'create'])->name('settings.create');
    Route::post('storeSettings', [SettingController::class, 'store'])->name('settings.store');
    Route::get('editSettings', [SettingController::class, 'edit'])->name('settings.edit');
    Route::post('updateSettings', [SettingController::class, 'update'])->name('settings.update');

    Route::get('banks', [BankController::class, 'index'])->name('banks.index');
    Route::get('bankCreate', [BankController::class, 'create'])->name('bank.create');
    Route::post('bankStore', [BankController::class, 'store'])->name('bank.store');
    Route::get('bankEdit/{id}', [BankController::class, 'edit'])->name('bank.edit');
    Route::post('bankUpdate/{id}', [BankController::class, 'update'])->name('bank.update');
    Route::get('bankDelete/{id}', [BankController::class, 'destroy'])->name('bank.destroy');


    Route::get('cars', [CarController::class, 'index'])->name('cars.index');
    Route::get('carCreate', [CarController::class, 'create'])->name('car.create');
    Route::post('carStore', [CarController::class, 'store'])->name('car.store');
    Route::get('carEdit/{id}', [CarController::class, 'edit'])->name('car.edit');
    Route::post('carUpdate/{id}', [CarController::class, 'update'])->name('car.update');
    Route::get('carDelete', [CarController::class, 'destroy'])->name('car.destroy');


    Route::get('cities', [CityController::class, 'index'])->name('cities.index');
    Route::get('cityCreate', [CityController::class, 'create'])->name('city.create');
    Route::post('cityStore', [CityController::class, 'store'])->name('city.store');
    Route::get('cityEdit/{id}', [CityController::class, 'edit'])->name('city.edit');
    Route::post('cityUpdate/{id}', [CityController::class, 'update'])->name('city.update');
    Route::get('cityDelete', [CityController::class, 'destroy'])->name('city.destroy');

    Route::get('faqs', [faqsController::class, 'index'])->name('faqs.index');
    Route::get('faqCreate', [faqsController::class, 'create'])->name('faq.create');
    Route::post('faqStore', [faqsController::class, 'store'])->name('faq.store');
    Route::get('faqEdit/{id}', [faqsController::class, 'edit'])->name('faq.edit');
    Route::post('faqUpdate/{id}', [faqsController::class, 'update'])->name('faq.update');
    Route::get('faqDelete/{id}', [faqsController::class, 'destroy'])->name('faq.destroy');


    Route::get('Notification', [NotificationController::class, 'create'])->name('notification.create');
    Route::post('sendNotification', [NotificationController::class, 'sendNotification'])->name('notification.send');
});
#############################
Route::get('Lang/{lang}', [languageController::class, 'index']);

Route::get('store', [AdminController::class, 'index'])->name('customer.laundryLogin');
Route::post('customerLogin', [AdminController::class, 'customerLogin'])->name('customer.customerLogin');

Route::get('signOut', [AdminController::class, 'signOut'])->name('customer.logout');
Route::middleware(['auth', 'laundryAdmin'])->group(function () {

    Route::get('main', [AdminController::class, 'main'])->name('customer.index');
    Route::get('Items/{id}', [ItemsController::class, 'index'])->name('Customer.Items.index');
    Route::get('createItems/{id}', [ItemsController::class, 'create'])->name('Customer.Items.create');
    Route::post('storeItem/{id}', [ItemsController::class, 'store'])->name('Customer.Items.store');
    Route::get('editItem/{id}', [ItemsController::class, 'edit'])->name('Customer.Items.edit');
    Route::post('updateItem/{id}', [ItemsController::class, 'update'])->name('updateItem');
    Route::get('deleteItem/{id}', [ItemsController::class, 'destroy'])->name('Customer.Items.delete');

    Route::get('Products/{id}', [ProductsController::class, 'index'])->name('Customer.Products.index');
    Route::get('createProduct/{id}', [ProductsController::class, 'create'])->name('Customer.Products.create');
    Route::get('editProduct/{id}', [ProductsController::class, 'edit'])->name('Customer.Products.edit');
    Route::post('updateProduct/{id}', [ProductsController::class, 'update'])->name('Customer.Products.update');
    Route::post('createProduct', [ProductsController::class, 'store'])->name('Customer.Products.store');
    Route::get('deleteProduct/{id}', [ProductsController::class, 'destroy'])->name('Customer.Products.destroy');
    Route::get('viewProductService/{id}', [ProductsController::class, 'productServices'])->name('Customer.Products.viewProductServices');
    Route::get('addProductService/{id}', [ProductsController::class, 'addService'])->name('Customer.Products.addProductService');
    Route::post('createService', [ProductsController::class, 'createService'])->name('Customer.Products.createService');
    Route::get('viewAllServices/{id}', [ProductsController::class, 'viewAllServices'])->name('Customer.Products.viewAllServices');
    Route::get('deleteService/{id}', [ProductsController::class, 'deleteService'])->name('Customer.Products.deleteService');

    Route::get('orders/{id}', [OrdersController::class, 'index'])->name('Customer.Orders.index');
    Route::get('ordersInProgress/{id}', [OrdersController::class, 'inProgress'])->name('Customer.Orders.inProgress');
    Route::get('ordersCompleted/{id}', [OrdersController::class, 'completed'])->name('Customer.Orders.completed');
    Route::get('changeStatus', [OrdersController::class, 'changeStatus']);
    Route::get('incomingOrder/{id}', [OrdersController::class, 'incomingOrder'])->name('Customer.Orders.incomingOrder');
    Route::get('canceledOrder/{id}', [OrdersController::class, 'canceledOrder'])->name('Customer.Orders.canceledOrder');
    Route::get('finishedOrder/{id}', [OrdersController::class, 'finishedOrder'])->name('Customer.Orders.finishedOrder');
    Route::get('orderDetails/{id}', [OrdersController::class, 'orderDetails'])->name('Customer.Orders.orderDetails');
});


Route::view('datatable', 'dashboard.datatable');
Route::view('datatableAr', 'dashboard.datatableAr');

Route::get('updates', function () {
    DB::table('subcategories')->update(['rate' => 5]);
});

Route::get('updateDB', function () {
    DB::table('subcategories')->where('id', 14)->update([
        'lat' => '30.3158798',
        'lng' => '31.1422192'
    ]);
});
Route::get('updateDBٍSecond', function () {
    DB::table('subcategories')->where('id', 15)->update([
        'lat' => '30.2810324',
        'lng' => '31.1429209'
    ]);
});
Route::get('updateLanduary', function () {
    DB::table('subcategories')->where('id', 18)->update([
        'lat' => '26.3384526',
        'lng' => '50.1547065'
    ]);
});

Route::get('updateDBLaundry', function () {
    DB::table('subcategories')->where('id', 16)->update([
        'lat' => '30.2180806',
        'lng' => '31.133635'
    ]);
});

Route::get('updateUser', function () {
    DB::table('users')->where('id', 9)->update([
        'password' => '$2y$10$GUwYIski.LTiYK/qV.rUVOjI5c0ZXqHwswJ2aUynEK8YnJMslcYKK'
    ]);
    $user = \App\Models\User::where('id', 9)->get();
    return $user;
});

Route::get('getData', function () {
    \App\Models\City::truncate();
});
Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});

Route::get('updateAll', function () {
    $subcategories = DB::table('subcategories')->whereNull('city_id')->update(['city_id' => 1]);
});
Route::get('updateOrder', function () {
    $ordersTable = DB::table('order_tables')->where('id', 26)->update(['status' => 'تم الأنتهاء من الغسيل']);
});

Route::get('usersGet', function () {
    $users = \App\Models\User::all();
    return $users;
});
Route::get('getDelegates', function () {
    $delegates = \App\Models\Delegate::with('appUserTrashed')->get();
    return $delegates;
});
Route::get('getAppUsers', function () {
    $appUsers = \App\Models\AppUser::all();
    return $appUsers;
});

Route::get('drop', function () {
    Schema::drop('cities');
});

Route::get('truncateData', function () {
    \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    \App\Models\OrderTable::truncate();
    \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
});

Route::get('columns', function () {
    $address = new \App\Models\Address();
    $columns = $address->getTableColumns();
    print_r($columns);
});

Route::get('addresses', function () {
    $addresses = \App\Models\Address::all();
    return $addresses;
});

Route::get('ordersTable', function () {
    $orders = \App\Models\OrderTable::all();
    dd($orders);
});
Route::get('getorderDetails', function () {
    $orderDetails = \App\Models\OrderDetails::all();
    return $orderDetails;
});

Route::get('notifications', function () {
    $notifications = \App\Models\Notifications::all();
    return $notifications;
});

Route::get('Alter', function () {
    \DB::statement('ALTER TABLE order_tables ENGINE = InnoDB');
});
Route::get('updateCustomers', function () {
    $ordersTable = DB::table('app_users')->update(['city_id' => 1]);
});

Route::get('allCities', function () {
    $cities = \App\Models\City::all();
    return $cities;
});

Route::get('getCars', function () {
    $cars = \App\Models\CarType::all();
    return $cars;
});
//Route::get('updateDelegate', function () {
//    $ordersTable = \App\Models\Delegate::where('id',18)->update(['registered' => 2]);
//});
Route::post('logoutLaundryAdmin', [AdminController::class, 'destroyLaundryAdmin'])
    ->name('logoutLaundryAdmin');

Route::get('customerProfile', [AdminController::class, 'profile'])
    ->name('profile');

Route::get('getOnLineUsers', function () {
    $users = AppUser::where([
        'status' => 'active',
        'user_type' => 'delivery',
        'available' => '1'
    ])->get();
    return $users;
});


Route::get('histories', function () {
    $histories = \App\Models\OrderStatusHistory::all();
    return $histories;
});

Route::get('getUser', function () {
    $appUser = AppUser::where('mobile', '966566666222')->get();
    return $appUser;
});
Route::get('locations', function () {
    $user = AppUser::where('id', 2)->first();
    dd($user);
});

Route::get('setting', function () {
    $settings = SiteSetting::first();
    dd($settings);

    dd($settings->distance_delegates);
});
Route::get('getCategories', function () {
    $categories = \App\Models\Category::all();
    return $categories;
});

Route::get('updateCategory', function () {
    $ordersTable = DB::table('app_users')->update(['city_id' => 1]);
});

Route::get('updateOrders', function () {
    DB::table('order_tables')->where('id', 68)->update([
        'status_id' => '4',
    ]);
    DB::table('order_tables')->where('id', 69)->update([
        'status_id' => '4',
    ]);
    DB::table('order_tables')->where('id', 70)->update([
        'status_id' => '4',
    ]);
    DB::table('order_tables')->where('id', 115)->update([
        'status_id' => '4',
    ]);
    DB::table('order_tables')->where('id', 116)->update([
        'status_id' => '4',
    ]);
    DB::table('order_tables')->where('id', 117)->update([
        'status_id' => '4',
    ]);   DB::table('order_tables')->where('id', 118)->update([
        'status_id' => '4',
    ]);   DB::table('order_tables')->where('id', 119)->update([
        'status_id' => '4',
    ]);   DB::table('order_tables')->where('id', 120)->update([
        'status_id' => '4',
    ]);
});

Route::get('updateAdmin', function () {
    DB::table('users')->where('id', 33)->update([
        'subCategory_id' => 28
    ]);
});

Route::view('testView', 'dashboard.test');

Route::get('getDelivery', function () {
    $delivery = DB::table('app_users')->where('user_type', 'delivery')->get();
    return $delivery;
});

Route::get('getPone', function () {
    $phone = DB::table('app_users')->where('mobile', 966542882969)->delete();
    return 'deleted';
});

Route::get('getLaundry', function () {
    $laundry = subCategory::where('id', 24)->get();
    return $laundry;
});

Route::get('getDeliverys', function () {
    $users = AppUser::where([
        'status' => 'active',
        'user_type' => 'delivery',
        'available' => '1'
    ])->get();
    dd($users);
});

//Route::view('landing','index');

Route::view('formView', 'customers.backEnd.orders.orderDetails');

Route::get('lastest', function () {
    return DB::table('order_tables')->orderBy('id', 'desc')->first();
});
Route::get('updateServicesID', function () {

    DB::table('product_services')->where('id', 131)->update([
        'subCategory_id' => '28',
    ]);
    DB::table('product_services')->where('id', 132)->update([
        'subCategory_id' => '28',
    ]);
    DB::table('product_services')->where('id', 133)->update([
        'subCategory_id' => '28',
    ]);

});
