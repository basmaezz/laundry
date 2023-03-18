<?php

use App\Http\Controllers\Customer\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\subCategoryController;
use App\Http\Controllers\Admin\CategoryItemController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CouponsController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Customer\ItemsController;
use App\Http\Controllers\Customer\ProductsController;
use App\Http\Controllers\Customer\OrdersController;
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
    return view('auth.login');
});
Route::post('adminLogin',[UserController::class,'adminLogin'])->name('adminLogin');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('users', [UserController::class, 'index'])->name('users.index');
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
    Route::get('editDelegate/{id}', [UserController::class, 'editDelegate'])->name('delegate.edit');
    Route::post('updateDelegate/{id}', [UserController::class, 'updateDelegate'])->name('delegate.update');
    Route::get('changeDelegateStatus/{id}', [UserController::class, 'changeDelegateStatus'])->name('delegate.changeDelegateStatus');
    Route::get('acceptRegister/{id}', [UserController::class, 'acceptRegister'])->name('delegate.acceptRegister');
    Route::get('deleteDelegate/{id}', [UserController::class, 'deleteDelegate'])->name('delegate.delete');
    Route::get('registrationRequests', [UserController::class, 'getRegistrationRequests'])->name('delegate.registrationRequests');
    Route::get('addRejectReason/{id}', [UserController::class, 'addRejectReason'])->name('delegate.addRejectReason');
    Route::post('storeRejectReason/{id}', [UserController::class, 'storeRejectReason'])->name('delegate.storeRejectReason');
    Route::get('rejectionRequests', [UserController::class, 'rejectionRequests'])->name('delegate.rejectionRequests');
    Route::get('customerDelete/{id}', [UserController::class, 'customerDelete'])->name('customer.delete');
    Route::get('customerWallet/{id}', [UserController::class, 'customerWallet'])->name('customer.wallet');
    Route::post('increaseWallet/{id}', [UserController::class, 'increaseWallet'])->name('customer.wallet.increase');
    Route::get('userView/{id}', [UserController::class, 'show'])->name('user.view');
    Route::get('userCreate', [UserController::class, 'create'])->name('user.create');
    Route::post('userStore', [UserController::class, 'store'])->name('user.store');
    Route::get('userEdit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('userUpdate/{id}', [UserController::class, 'update'])->name('user.update');
    Route::get('userDelete/{id}', [UserController::class, 'destroy'])->name('user.delete');
    Route::post('searchLaundry', [UserController::class, 'destroy'])->name('searchLaundry');

    Route::get('laundries', [subCategoryController::class, 'index'])->name('laundries.index');
    Route::get('laundryCreate', [subCategoryController::class, 'create'])->name('laundries.create');
    Route::post('laundryStore', [subCategoryController::class, 'store'])->name('laundries.store');
    Route::get('laundryEdit/{id}', [subCategoryController::class, 'edit'])->name('laundries.edit');
    Route::post('laundryUpdate/{id}', [subCategoryController::class, 'update'])->name('laundries.update');
    Route::get('laundryDestroy/{id}', [subCategoryController::class, 'destroy'])->name('laundries.destroy');
    Route::get('adminLaundries', [subCategoryController::class, 'adminLaundries'])->name('laundries.admins');
    Route::get('createAdminLaundries', [subCategoryController::class, 'createAdmin'])->name('laundries.createAdmin');
    Route::post('storeLaundryAdmin', [subCategoryController::class, 'storeLaundryAdmin'])->name('laundries.storeAdmin');
    Route::get('laundryView/{id}', [subCategoryController::class, 'show'])->name('laundries.view');
    Route::get('laundryUpdateStats', [subCategoryController::class, 'updateStats']);
    Route::get('branches/{id}', [subCategoryController::class, 'branches'])->name('laundries.branches');
    Route::get('createBranch/{id}', [subCategoryController::class, 'createBranch'])->name('laundries.branches.create');
    Route::post('storeBranch', [subCategoryController::class, 'storeBranch'])->name('laundries.storeBranch');
    Route::get('editBranch/{id}', [subCategoryController::class, 'editBranch'])->name('laundries.editBranch');
    Route::get('mainLaundries', [subCategoryController::class, 'mainLaundries'])->name('laundries.mainLaundries');
    Route::get('deleteBranch/{id}', [subCategoryController::class, 'deleteBranch'])->name('laundries.deleteBranch');


    Route::get('CategoriesIndex', [CategoriesController::class, 'index'])->name('Categories.index');
    Route::get('CategoryEdit/{id}', [CategoriesController::class, 'edit'])->name('category.edit');
    Route::post('CategoryUpdate/{id}', [CategoriesController::class, 'update'])->name('category.update');

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

    Route::get('Roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('RolesCreate', [RoleController::class, 'create'])->name('roles.create');
    Route::post('RolesStore', [RoleController::class, 'store'])->name('roles.store');
    Route::get('RolesEdit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
    Route::post('RolesUpdate/{id}', [RoleController::class, 'update'])->name('roles.update');
    Route::get('RolesDelete/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');
});
#############################

Route::post('customerLogin', [AdminController::class, 'customerLogin'])->name('customer.customerLogin');

Route::get('signOut', [AdminController::class, 'signOut'])->name('customer.logout');

Route::get('customerLogin', [AdminController::class, 'index'])->name('customer.login');
Route::get('aib', [AdminController::class, 'main'])->name('customer.index');

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
Route::get('changeStatus', [OrdersController::class,'changeStatus']);
Route::get('canceledOrder/{id}', [OrdersController::class, 'canceledOrder'])->name('Customer.Orders.canceledOrder');
Route::get('finishedOrder/{id}', [OrdersController::class, 'finishedOrder'])->name('Customer.Orders.finishedOrder');

Route::view('datatable', 'dashboard.datatable');
Route::view('datatableAr', 'dashboard.datatableAr');

Route::get('updates', function () {
    DB::table('subcategories')->update(['rate' => 5]);
});

Route::get('updateDB', function () {
    DB::table('subcategories')->where('id', 24)->update([
        'lat' => '30.2984486',
        'lng' => '31.152275'
    ]);
});

Route::get('updateUser',function (){
    DB::table('users')->where('id',9)->update([
        'password'=>'$2y$10$GUwYIski.LTiYK/qV.rUVOjI5c0ZXqHwswJ2aUynEK8YnJMslcYKK'
    ]);
    $user=\App\Models\User::where('id',9)->get();
    return $user;
});

Route::get('getData', function () {
    \App\Models\City::truncate();
    //   \App\Models\OrderTable::truncate();
    //   \App\Models\OrderStatusHistory::truncate();
    //   \App\Models\OrderAdditional::truncate();
    //   $orders=\App\Models\OrderDetails::all();
    //    dd($orders);
    //    $users=\App\Models\AppUser::all();
});
Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});

Route::get('updateAll', function () {
    $subcategories = DB::table('subcategories')->whereNull('city_id')->update(['city_id' => 1]);
});
Route::get('updateOrder', function () {
    $ordersTable = DB::table('order_tables')->where('id',26)->update(['status'=>'تم الأنتهاء من الغسيل']);
});

Route::get('usersGet', function () {
    $users = \App\Models\User::all();
    return $users;
});
Route::get('getDelegates', function () {
    $delegates = \App\Models\Delegate::all();
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
//    \App\Models\OrderTable::truncate();
//    \App\Models\OrderDetails::truncate();
//    \App\Models\Address::truncate();
    \App\Models\City::truncate();
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

Route::get('ordersTable',function (){
    $orders=\App\Models\OrderTable::all();
    return $orders;
});
Route::get('notifications',function (){
    $notifications=\App\Models\Notifications::all();
    return $notifications;
});

Route::get('Alter',function (){
    \DB::statement('ALTER TABLE order_tables ENGINE = InnoDB');
});
Route::get('updateCustomers', function () {
    $ordersTable = DB::table('app_users')->update(['city_id' => 1]);
});

Route::get('allCities',function (){
    $cities=\App\Models\City::all();
    return $cities;
});

Route::get('getCars',function (){
    $cars=\App\Models\CarType::all();
    return $cars;
});
