<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\carpetCategoryController;
use App\Http\Controllers\Admin\carpetLaundryController;
use App\Http\Controllers\Admin\carLaundryController;
use App\Http\Controllers\Admin\carServicesController;
use App\Http\Controllers\Admin\carpetLaundryTimeController;
use App\Http\Controllers\Customer\AdminController;
use App\Http\Controllers\languageController;
use App\Http\Controllers\ProfileController;
use App\Models\AppUser;
use App\Models\SiteSetting;
use App\Models\Subcategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\carDelegatesController;
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
Route::view('privacy', 'privacy');

Route::get('/admin', function () {
    return view('auth.login');
});
Route::post('adminLogin',  [UserController::class,'adminLogin'])->name('adminLogin');
Route::get('/dashboard', [AdminDashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__ . '/auth.php';

Route::middleware(['auth', 'IsAdmin'])->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('users',  'index')->name('users.index');
        Route::get('getUsers',  'getUsers')->name('users.getUsers');
        Route::get('TrashedUsers',  'adminTrashed')->name('users.adminTrashed');
        Route::get('forceDelete', 'forceDelete')->name('users.forceDelete');
        Route::get('restoreDeletedAdmins/{id}', 'restoreDeletedAdmins')->name('users.restoreDeletedAdmins');
        Route::get('profile',  'profile')->name('users.profile');
        Route::get('editPassword',  'editPassword')->name('users.editPassword');
        Route::post('updatePassword',  'updatePassword')->name('user.updatePassword');
        Route::patch('updateProfile',  'updateProfile')->name('user.updateProfile');
        Route::get('customers', 'customers')->name('customers.index');
        Route::get('customersExport', 'customerExport')->name('customers.export');
        Route::get('delegatesExport',  'delegatesExport')->name('delegates.export');
        Route::get('customerOrder/{id}', 'customerOrders')->name('customer.Orders');
        Route::get('delegates',  'delegates')->name('delegates.index');
        Route::get('createDelegate', 'CreateDelegate')->name('delegate.create');
        Route::post('storeDelegate', 'storeDelegate')->name('delegate.store');
        Route::get('showDelegate/{id}',  'showDelegate')->name('delegate.show');
        Route::get('restoreDeletedDelegates/{id}', 'restoreDeletedDelegates')->name('delegate.restoreDeletedDelegates');
        Route::get('editDelegate/{id}',  'editDelegate')->name('delegate.edit');
        Route::post('updateDelegate/{id}', 'updateDelegate')->name('delegate.update');
        Route::get('changeDelegateStatus/{id}', 'changeDelegateStatus')->name('delegate.changeDelegateStatus');
        Route::get('acceptRegister/{id}', 'acceptRegister')->name('delegate.acceptRegister');
        Route::get('deleteDelegate', 'deleteDelegate')->name('delete.delegate');
        Route::get('trashedDelegates', 'trashedDelegates')->name('delegate.trashedDelegates');
        Route::get('registrationRequests',  'getRegistrationRequests')->name('delegate.registrationRequests');
        Route::get('addRejectReason/{id}', 'addRejectReason')->name('delegate.addRejectReason');
        Route::post('storeRejectReason/{id}',  'storeRejectReason')->name('delegate.storeRejectReason');
        Route::get('rejectionRequests',  'rejectionRequests')->name('delegate.rejectionRequests');
        Route::get('customerDelete', 'customerDelete')->name('customer.delete');
        Route::get('customerWallet/{id}', 'customerWallet')->name('customer.wallet');
        Route::get('clearWallet', 'clearWallet')->name('delegate.clearWallet');
        Route::post('increaseWallet/{id}',  'increaseWallet')->name('customer.wallet.increase');
        Route::get('userView/{id}',  'show')->name('user.view');
        Route::get('userCreate',  'create')->name('user.create');
        Route::post('userStore',  'store')->name('user.store');
        Route::get('userEdit/{id}',  'edit')->name('user.edit');
        Route::post('userUpdate/{id}',  'update')->name('user.update');
        Route::get('userDelete',  'destroy')->name('user.delete');
        Route::post('searchLaundry',  'destroy')->name('searchLaundry');
    });


          Route::controller(carDelegatesController::class)->group(function(){
             Route::get('carDelegates', 'index')->name('carDelegates.index');
                 Route::get('createCarDelegates', 'create')->name('carDelegates.create');
                 Route::post('storeCarDelegates', 'store')->name('carDelegates.store');
                 Route::get('showCarDelegates/{id}', 'show')->name('carDelegates.show');
                 Route::get('editCarDelegates/{id}', 'edit')->name('carDelegates.edit');
                 Route::post('updateCarDelegates/{id}', 'update')->name('carDelegates.update');
                 Route::get('destroyCarDelegates', 'destroy')->name('carDelegates.destroy');
                 Route::get('delegateOrders/{id}',  'delegateOrders')->name('carDelegates.delegateOrders');
          });
     Route::controller(subCategoryController::class)->group(function () {

         Route::get('laundries', 'index')->name('laundries.index');
         Route::get('laundryCreate',  'create')->name('laundries.create');
         Route::post('laundryStore',  'store')->name('laundries.store');
         Route::get('laundryEdit/{id}','edit')->name('laundries.edit');
         Route::post('laundryUpdate/{id}', 'update')->name('laundries.update');
         Route::get('laundryDestroy',  'destroy')->name('laundries.destroy');
         Route::get('adminLaundries',  'adminLaundries')->name('laundries.admins');
         Route::get('createAdminLaundries',  'createAdmin')->name('laundries.createAdmin');
         Route::post('storeLaundryAdmin',  'storeLaundryAdmin')->name('laundries.storeAdmin');
         Route::get('laundryView/{id}',  'show')->name('laundries.view');
         Route::get('laundryOrders/{id}',  'getOrders')->name('laundries.orders');
         Route::get('laundryUpdateStats', 'updateStats');
         Route::get('branches/{id}',  'branches')->name('laundries.branches');
         Route::get('createBranch/{id}', 'createBranch')->name('laundries.branches.create');
         Route::post('storeBranch', 'storeBranch')->name('laundries.storeBranch');
         Route::get('editBranch/{id}',  'editBranch')->name('laundries.editBranch');
         Route::get('mainLaundries', 'mainLaundries')->name('laundries.mainLaundries');
         Route::get('deleteBranch/{id}',  'deleteBranch')->name('laundries.deleteBranch');
         Route::get('viewTrashedLaundries',  'viewTrashedLaundries')->name('laundries.viewTrashedLaundries');
         Route::get('restoreDeleted',  'restoreDeleted')->name('laundries.restoreDeleted');
         Route::get('subCategories/export', 'export')->name('laundries.export');
         Route::get('copyLaundry/{id}', 'copyLaundry')->name('laundries.copyLaundry');
     });

     Route::controller(carpetLaundryController::class)->group(function(){
         Route::get('carpetLaundries','index')->name('carpetLaundries.index');
         Route::get('carpetLaundryCreate',  'create')->name('carpetLaundries.create');
         Route::post('carpetLaundryStore',  'store')->name('carpetLaundries.store');
         Route::get('carpetLaundryEdit/{id}',  'edit')->name('carpetLaundries.edit');
         Route::post('carpetLaundryUpdate/{id}',  'update')->name('carpetLaundries.update');
         Route::get('carpetLaundryDestroy',  'destroy')->name('carpetLaundries.destroy');
     });
    Route::controller(carpetCategoryController::class)->group(function(){
        Route::get('carpetCategories/{id}','index')->name('carpetCategories.index');
        Route::get('carpetCategoryCreate/{id}',  'create')->name('carpetCategories.create');
        Route::post('carpetCategoryStore',  'store')->name('carpetCategories.store');
        Route::get('carpetCategoryEdit/{id}',  'edit')->name('carpetCategories.edit');
    });

     Route::controller(carLaundryController::class)->group(function(){
         Route::get('carLaundries','index')->name('carLaundries.index');
         Route::get('carLaundryCreate',  'create')->name('carLaundries.create');
         Route::post('carLaundryStore',  'store')->name('carLaundries.store');
         Route::get('carLaundryEdit/{id}',  'edit')->name('carLaundries.edit');
         Route::post('carLaundryUpdate/{id}',  'update')->name('carLaundries.update');
         Route::get('carLaundryDestroy',  'destroy')->name('carLaundries.destroy');

     });
     Route::controller(carServicesController::class)->group(function(){
         Route::get('carServices/{id}','index')->name('carServices.index');
         Route::get('carServiceCreate/{id}',  'create')->name('carServices.create');
         Route::post('carServiceStore',  'store')->name('carServices.store');
         Route::get('carServiceEdit/{id}',  'edit')->name('carServices.edit');
         Route::post('carServiceUpdate/{id}',  'update')->name('carServices.update');
         Route::get('carServiceDestroy',  'destroy')->name('carServices.destroy');
     });


     Route::controller(carpetLaundryTimeController::class)->group(function(){
         Route::get('carpetLaundryTimes/{id}','index')->name('carpetLaundryTimes.index');
         Route::get('carpetLaundryTimeCreate/{id}',  'create')->name('carpetLaundryTimes.create');
         Route::get('createDeliveredTimes/{id}',  'createDeliveredTimes')->name('createDeliveredTimes.create');
         Route::post('carpetLaundryTimeStore',  'store')->name('carpetLaundryTimes.store');
         Route::get('carpetLaundryTimeEdit/{id}',  'edit')->name('carpetLaundryTimes.edit');
         Route::post('carpetLaundryTimeUpdate/{id}',  'update')->name('carpetLaundryTimes.update');
         Route::get('carpetLaundryTimeDestroy/{id}',  'destroy')->name('carpetLaundryTimes.destroy');
     });

 Route::controller(CategoriesController::class)->group(function () {
     Route::get('CategoriesIndex',  'index')->name('Categories.index');
     Route::get('CategoryCreate',  'create')->name('category.create');
     Route::post('CategoryStore',  'store')->name('category.store');
     Route::get('CategoryEdit/{id}',  'edit')->name('category.edit');
     Route::post('CategoryUpdate/{id}',  'update')->name('category.update');
     Route::get('CategoryDelete/{id}' , 'destroy')->name('category.destroy');
 });
 Route::controller(CategoryItemController::class)->group(function () {
     Route::get('CategoryItemsIndex/{id}',  'index')->name('CategoryItems.index');
     Route::get('CategoryItems/{id}',  'create')->name('CategoryItems.create');
     Route::get('CategoryItemsEdit/{id}',  'edit')->name('CategoryItems.edit');
     Route::post('CategoryItemsUpdate/{id}', 'update')->name('CategoryItems.update');
     Route::post('CategoryItemsStore',  'store')->name('CategoryItems.store');
     Route::get('CategoryItemsDestroy/{id}',  'destroy')->name('CategoryItems.destroy');
     Route::get('CategoryItemsShow/{id}',  'show')->name('CategoryItems.show');
 });

    Route::controller(ProductController::class)->group(function () {
        Route::get('productCreate/{id}',  'create')->name('product.create');
        Route::post('productStore',  'store')->name('product.store');
        Route::get('productDelete/{id}',  'destroy')->name('product.destroy');
        Route::get('productView/{id}',  'view')->name('product.view');
        Route::get('productEdit/{id}',  'edit')->name('product.edit');
        Route::post('productUpdate',  'update')->name('product.update');
        Route::get('productAddService/{id}',  'addService')->name('product.addService');
        Route::post('createProductService',  'createProductService')->name('product.createProductService');
        Route::get('productServices/{id}', 'productServices')->name('product.productServices');
        Route::get('deleteProductService/{id}',  'deleteProductService')->name('product.deleteProductService');
        Route::get('editService/{id}',  'editService')->name('product.editService');
        Route::post('updateService/{id}',  'updateService')->name('product.updateService');
    });


    Route::controller(CouponsController::class)->group(function () {
            Route::get('coupons','index')->name('coupons.index');
    Route::get('couponsCreate',  'create')->name('coupon.create');
    Route::post('couponsStore',  'store')->name('coupon.store');
    Route::get('couponEdit/{id}',  'edit')->name('coupon.edit');
    Route::patch('couponUpdate/{id}',  'update')->name('coupon.update');
    Route::get('couponDelete',  'destroy')->name('coupon.destroy');
    Route::get('changeStatus/{id}',  'changeStatus')->name('coupon.changeStatus');
    });

    Route::controller(OrderController::class)->group(function (){
    Route::get('getOrders', 'index')->name('Order.index');
    Route::get('exportOrders',  'export')->name('Orders.export');
    Route::get('exportDelegateOrders',  'exportDelegateOrders')->name('Orders.exportDelegateOrders');
    Route::get('viewOrder/{id}',  'show')->name('Order.show');
    Route::get('pendingDeliveryAcceptance',  'pendingDeliveryAcceptance')->name('Order.pendingDeliveryAcceptance');
    Route::get('DeliveryOnWay',  'DeliveryOnWay')->name('Order.DeliveryOnWay');
    Route::get('readyPickUp',  'readyPickUp')->name('Order.readyPickUp');
    Route::get('WayToLaundry',  'WayToLaundry')->name('Order.WayToLaundry');
    Route::get('DeliveredToLaundry',  'DeliveredToLaundry')->name('Order.DeliveredToLaundry');
    Route::get('DeliveryOnTheWayToYou',  'DeliveryOnTheWayToYou')->name('Order.DeliveryOnTheWayToYou');
    Route::get('WaitingForDeliveryToReceiveOrder',  'WaitingForDeliveryToReceiveOrder')->name('Order.WaitingForDeliveryToReceiveOrder');
    Route::get('completed',  'completed')->name('Order.completed');
    Route::get('changeStatus/',  'changeStatus');
    Route::get('delegateOrders/{id}',  'delegateOrders')->name('Order.delegateOrders');
    Route::get('cancelOrder',  'cancelOrder')->name('Order.cancelOrder');
    Route::get('carpetOrders',  'carpetOrders')->name('Order.carpetOrders');
    Route::get('pendingCarpetDeliveryAcceptance',  'pendingCarpetDeliveryAcceptance')->name('Order.pendingCarpetDeliveryAcceptance');
    Route::get('carpetDeliveryOnWay',  'carpetDeliveryOnWay')->name('Order.carpetDeliveryOnWay');
    Route::get('carpetDeliveryWayToLaundry',  'carpetDeliveryWayToLaundry')->name('Order.carpetDeliveryWayToLaundry');
    Route::get('carpetsDeliveredToLaundry',  'carpetsDeliveredToLaundry')->name('Order.carpetsDeliveredToLaundry');
    Route::get('WaitingForCarpetDeliveryToReceiveOrder',  'WaitingForCarpetDeliveryToReceiveOrder')->name('Order.WaitingForCarpetDeliveryToReceiveOrder');
    Route::get('carpetDeliveryOnTheWayToYou',  'carpetDeliveryOnTheWayToYou')->name('Order.carpetDeliveryOnTheWayToYou');
    Route::get('carpetOrdersCompleted',  'carpetOrdersCompleted')->name('Order.carpetOrdersCompleted');
    Route::get('completeOrder/{id}',  'completeOrder')->name('Order.completeOrder');


    });
    Route::controller(RoleController::class)->group(function () {
    Route::get('Roles', 'index')->name('roles.index');
    Route::get('RolesCreate', 'create')->name('roles.create');
    Route::post('RolesStore', 'store')->name('roles.store');
    Route::get('RolesEdit/{id}', 'edit')->name('roles.edit');
    Route::post('RolesUpdate/{id}', 'update')->name('roles.update');
    Route::get('RolesDelete/{id}', 'destroy')->name('roles.destroy');
    });

    Route::controller(SettingController::class)->group(function () {
        Route::get('settings', 'index')->name('settings.index');
        Route::get('addSettings', 'create')->name('settings.create');
        Route::post('storeSettings', 'store')->name('settings.store');
        Route::get('editSettings', 'edit')->name('settings.edit');
        Route::post('updateSettings', 'update')->name('settings.update');
    });

    Route::controller(BankController::class)->group(function () {
        Route::get('banks',  'index')->name('banks.index');
        Route::get('bankCreate',  'create')->name('bank.create');
        Route::post('bankStore',  'store')->name('bank.store');
        Route::get('bankEdit/{id}',  'edit')->name('bank.edit');
        Route::post('bankUpdate/{id}',  'update')->name('bank.update');
        Route::get('bankDelete/{id}',  'destroy')->name('bank.destroy');
    });

    Route::controller(CarController::class)->group(function () {
        Route::get('cars',  'index')->name('cars.index');
        Route::get('carCreate',  'create')->name('car.create');
        Route::post('carStore',  'store')->name('car.store');
        Route::get('carEdit/{id}',  'edit')->name('car.edit');
        Route::post('carUpdate/{id}',  'update')->name('car.update');
        Route::get('carDelete',  'destroy')->name('car.destroy');
    });


    Route::controller(CityController::class)->group(function () {
        Route::get('cities', 'index')->name('cities.index');
        Route::get('cityCreate', 'create')->name('city.create');
        Route::post('cityStore', 'store')->name('city.store');
        Route::get('cityEdit/{id}', 'edit')->name('city.edit');
        Route::post('cityUpdate/{id}', 'update')->name('city.update');
        Route::get('cityDelete', 'destroy')->name('city.destroy');
    });

    Route::controller(faqsController::class)->group(function () {
        Route::get('faqs', 'index')->name('faqs.index');
        Route::get('faqCreate', 'create')->name('faq.create');
        Route::post('faqStore', 'store')->name('faq.store');
        Route::get('faqEdit/{id}', 'edit')->name('faq.edit');
        Route::post('faqUpdate/{id}', 'update')->name('faq.update');
        Route::get('faqDelete/{id}', 'destroy')->name('faq.destroy');
    });
    Route::controller(NotificationController::class)->group(function () {
        Route::get('Notifications',  'index')->name('notification.index');
        Route::get('Notification',  'create')->name('notification.create');
        Route::get('customerNotification',  'customerNotification')->name('notification.customerNotification');
        Route::post('sendNotification',  'sendNotification')->name('notification.send');
        Route::post('storeNotification',  'store')->name('notification.store');
        Route::post('storeCustomerNotification',  'storeCustomerNotification')->name('notification.storeCustomerNotification');
    });
});
#############################
Route::get('Lang/{lang}', [languageController::class, 'index']);

Route::get('store', [AdminController::class, 'index'])->name('customer.laundryLogin');
Route::post('customerLogin', [AdminController::class, 'customerLogin'])->name('customer.customerLogin');

Route::get('signOut', [AdminController::class, 'signOut'])->name('customer.logout');
Route::middleware(['auth', 'laundryAdmin'])->group(function () {

    Route::get('main', [AdminController::class, 'main'])->name('customer.index');

    Route::controller(ItemsController::class)->group(function () {
        Route::get('Items/{id}',  'index')->name('Customer.Items.index');
        Route::get('createItems/{id}',  'create')->name('Customer.Items.create');
        Route::post('storeItem/{id}',  'store')->name('Customer.Items.store');
        Route::get('editItem/{id}',  'edit')->name('Customer.Items.edit');
        Route::post('updateItem/{id}',  'update')->name('updateItem');
        Route::get('deleteItem/{id}',  'destroy')->name('Customer.Items.delete');
    });

    Route::controller(ProductsController::class)->group(function () {
        Route::get('Products/{id}',  'index')->name('Customer.Products.index');
        Route::get('createProduct/{id}',  'create')->name('Customer.Products.create');
        Route::get('editProduct/{id}',  'edit')->name('Customer.Products.edit');
        Route::post('updateProduct/{id}',  'update')->name('Customer.Products.update');
        Route::post('createProduct',  'store')->name('Customer.Products.store');
        Route::get('deleteProduct/{id}',  'destroy')->name('Customer.Products.destroy');
        Route::get('viewProductService/{id}',  'productServices')->name('Customer.Products.viewProductServices');
        Route::get('addProductService/{id}',  'addService')->name('Customer.Products.addProductService');
        Route::post('createService',  'createService')->name('Customer.Products.createService');
        Route::get('viewAllServices/{id}',  'viewAllServices')->name('Customer.Products.viewAllServices');
        Route::get('deleteService/{id}',  'deleteService')->name('Customer.Products.deleteService');
    });

    Route::controller(OrdersController::class)->group(function () {
        Route::get('orders/{id}',  'index')->name('Customer.Orders.index');
        Route::get('ordersInProgress/{id}', 'inProgress')->name('Customer.Orders.inProgress');
        Route::get('ordersCompleted/{id}', 'completed')->name('Customer.Orders.completed');
        Route::get('changeStatus', 'changeStatus');
        Route::get('incomingOrder/{id}', 'incomingOrder')->name('Customer.Orders.incomingOrder');
        Route::get('canceledOrder/{id}', 'canceledOrder')->name('Customer.Orders.canceledOrder');
        Route::get('finishedOrder/{id}', 'finishedOrder')->name('Customer.Orders.finishedOrder');
        Route::get('orderDetails/{id}', 'orderDetails')->name('Customer.Orders.orderDetails');
    });

});

//test Routes
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
Route::get('getNotifications',function(){
    return DB::table('notifications')->latest('created_at')->first();
});

Route::view('dark','customers.layouts.dark');
Route::view('darkEn','customers.layouts.darkEn');
Route::view('pricing','customers.backEnd.pricing');

Route::get('copyNames',function(){
    // dd($items);
    $piece=DB::table('product_services')->where('id',2652)->first();
    $items=DB::table('product_services')->where('services','كوي')->update([
        'services_en' => $piece->services_en,
        'services_franco' => $piece->services_franco,
    ]);
    // dd($items);
    // foreach($items as $item){
    //     $item->update([
    //         'name_franco' => $piece->name_franco,
    //     'urgentWash' => $piece->urgentWash,
    //     ]);
    // }
    //     return $item;
    // DB::table('products')->where('id',1142)->update([
    //     'name_franco' => $item->name_franco,
    //     'urgentWash' => $item->urgentWash,
    // ]);
    // DB::table('products')->where('id',1266)->update([
    //     'name_franco' => $item->name_franco,
    //     'urgentWash' => $item->urgentWash,
    // ]);
    // DB::table('products')->where('id',1328)->update([
    //     'name_franco' => $item->name_franco,
    //     'urgentWash' => $item->urgentWash,
    // ]);
    // DB::table('products')->where('id',1390)->update([
    //     'name_franco' => $item->name_franco,
    //     'urgentWash' => $item->urgentWash,
    // ]);
    // DB::table('products')->where('id',1452)->update([
    //     'name_franco' => $item->name_franco,
    //     'urgentWash' => $item->urgentWash,
    // ]);
    // DB::table('products')->where('id',1514)->update([
    //     'name_franco' => $item->name_franco,
    //     'urgentWash' => $item->urgentWash,
    // ]);
    // DB::table('products')->where('id',1576)->update([
    //     'name_franco' => $item->name_franco,
    //     'urgentWash' => $item->urgentWash,
    // ]);
    // DB::table('products')->where('id',1638)->update([
    //     'name_franco' => $item->name_franco,
    //     'urgentWash' => $item->urgentWash,
    // ]);
    // DB::table('products')->where('id',1762)->update([
    //     'name_franco' => $item->name_franco,
    //     'urgentWash' => $item->urgentWash,
    // ]);

    // DB::table('category_item')->where('id',156)->update([
    //     'category_type_en' => $item->category_type_en,
    //     'category_type_franco' => $item->category_type_franco,
    // ]);



});

