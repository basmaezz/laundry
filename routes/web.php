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
use App\Http\Controllers\Customer\itemsController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});
require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('profile', [UserController::class, 'profile'])->name('users.profile');
    Route::patch('updateProfile', [UserController::class, 'updateProfile'])->name('user.updateProfile');
    Route::get('customers', [UserController::class, 'customers'])->name('customers.index');
    Route::get('customerOrder/{id}', [UserController::class, 'customerOrders'])->name('customer.Orders');
    Route::get('delegates', [UserController::class, 'delegates'])->name('delegates.index');
    Route::get('createDelegate', [UserController::class, 'CreateDelegate'])->name('delegate.create');
    Route::post('storeDelegate', [UserController::class, 'storeDelegate'])->name('delegate.store');
    Route::get('showDelegate/{id}', [UserController::class, 'showDelegate'])->name('delegate.show');
    Route::get('deleteDelegate/{id}', [UserController::class, 'deleteDelegate'])->name('delegate.delete');
    Route::get('customerDelete/{id}', [UserController::class, 'customerDelete'])->name('customer.delete');
    Route::get('userView/{id}', [UserController::class, 'show'])->name('user.view');
    Route::get('userCreate', [UserController::class, 'create'])->name('user.create');
    Route::post('userStore', [UserController::class, 'store'])->name('user.store');
    Route::get('userEdit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::patch('userUpdate/{id}', [UserController::class, 'update'])->name('user.update');
    Route::get('userDelete/{id}', [UserController::class, 'destroy'])->name('user.delete');
    Route::post('searchLaundry', [UserController::class, 'destroy'])->name('searchLaundry');

Route::get('laundries',[subCategoryController::class,'index'])->name('laundries.index');
Route::get('laundryCreate',[subCategoryController::class,'create'])->name('laundries.create');
Route::post('laundryStore',[subCategoryController::class,'store'])->name('laundries.store');
Route::get('laundryEdit/{id}',[subCategoryController::class,'edit'])->name('laundries.edit');
Route::post('laundryUpdate/{id}',[subCategoryController::class,'update'])->name('laundries.update');
Route::get('laundryDestroy/{id}',[subCategoryController::class,'destroy'])->name('laundries.destroy');
Route::get('adminLaundries',[subCategoryController::class,'adminLaundries'])->name('laundries.admins');
Route::get('createAdminLaundries',[subCategoryController::class,'createAdmin'])->name('laundries.createAdmin');
Route::post('storeLaundryAdmin',[subCategoryController::class,'storeLaundryAdmin'])->name('laundries.storeAdmin');
Route::get('laundryView/{id}',[subCategoryController::class,'show'])->name('laundries.view');
Route::get('laundryUpdateStats',[subCategoryController::class,'updateStats']);
Route::get('branches/{id}',[subCategoryController::class,'branches'])->name('laundries.branches');
Route::get('createBranch/{id}',[subCategoryController::class,'createBranch'])->name('laundries.branches.create');
Route::post('storeBranch',[subCategoryController::class,'storeBranch'])->name('laundries.storeBranch');
Route::get('mainLaundries',[subCategoryController::class,'mainLaundries'])->name('laundries.mainLaundries');
Route::get('deleteBranch/{id}',[subCategoryController::class,'deleteBranch'])->name('laundries.deleteBranch');


Route::get('CategoriesIndex',[CategoriesController::class,'index'])->name('Categories.index');
Route::get('CategoryEdit/{id}',[CategoriesController::class,'edit'])->name('category.edit');
Route::post('CategoryUpdate/{id}',[CategoriesController::class,'update'])->name('category.update');

Route::get('CategoryItemsIndex/{id}',[CategoryItemController::class,'index'])->name('CategoryItems.index');
Route::get('CategoryItems/{id}',[CategoryItemController::class,'create'])->name('CategoryItems.create');
Route::get('CategoryItemsEdit/{id}',[CategoryItemController::class,'edit'])->name('CategoryItems.edit');
Route::post('CategoryItemsUpdate/{id}',[CategoryItemController::class,'update'])->name('CategoryItems.update');
Route::post('CategoryItemsStore',[CategoryItemController::class,'store'])->name('CategoryItems.store');
Route::get('CategoryItemsDestroy/{id}',[CategoryItemController::class,'destroy'])->name('CategoryItems.destroy');
Route::get('CategoryItemsShow/{id}',[CategoryItemController::class,'show'])->name('CategoryItems.show');

Route::get('productCreate/{id}',[ProductController::class,'create'])->name('product.create');
Route::post('productStore',[ProductController::class,'store'])->name('product.store');
Route::get('productDelete/{id}',[ProductController::class,'destroy'])->name('product.destroy');
Route::get('productView/{id}',[ProductController::class,'view'])->name('product.view');
Route::get('productEdit/{id}',[ProductController::class,'edit'])->name('product.edit');
Route::post('productUpdate',[ProductController::class,'update'])->name('product.update');
Route::get('productAddService/{id}',[ProductController::class,'addService'])->name('product.addService');
Route::post('createProductService',[ProductController::class,'createProductService'])->name('product.createProductService');
Route::get('productServices/{id}',[ProductController::class,'productServices'])->name('product.productServices');
Route::get('deleteProductService/{id}',[ProductController::class,'deleteProductService'])->name('product.deleteProductService');
Route::get('editService/{id}',[ProductController::class,'editService'])->name('product.editService');
Route::post('updateService/{id}',[ProductController::class,'updateService'])->name('product.updateService');

Route::get('coupons',[CouponsController::class,'index'])->name('coupons.index');
Route::get('couponsCreate',[CouponsController::class,'create'])->name('coupon.create');
Route::post('couponsStore',[CouponsController::class,'store'])->name('coupon.store');
Route::get('couponEdit/{id}',[CouponsController::class,'edit'])->name('coupon.edit');
Route::patch('couponUpdate/{id}',[CouponsController::class,'update'])->name('coupon.update');
Route::get('couponDelete/{id}',[CouponsController::class,'destroy'])->name('coupon.destroy');

Route::get('getOrders',[OrderController::class,'index'])->name('Order.index');
Route::get('viewOrder/{id}',[OrderController::class,'show'])->name('Order.show');
Route::get('pendingDeliveryAcceptance',[OrderController::class,'pendingDeliveryAcceptance'])->name('Order.pendingDeliveryAcceptance');
Route::get('DeliveryOnWay',[OrderController::class,'DeliveryOnWay'])->name('Order.DeliveryOnWay');
Route::get('readyPickUp',[OrderController::class,'readyPickUp'])->name('Order.readyPickUp');
Route::get('WayToLaundry',[OrderController::class,'WayToLaundry'])->name('Order.WayToLaundry');
Route::get('DeliveredToLaundry',[OrderController::class,'DeliveredToLaundry'])->name('Order.DeliveredToLaundry');
Route::get('DeliveryOnTheWayToYou',[OrderController::class,'DeliveryOnTheWayToYou'])->name('Order.DeliveryOnTheWayToYou');
Route::get('WaitingForDeliveryToReceiveOrder',[OrderController::class,'WaitingForDeliveryToReceiveOrder'])->name('Order.WaitingForDeliveryToReceiveOrder');
Route::get('completed',[OrderController::class,'completed'])->name('Order.completed');
Route::get('changeStatus/',[OrderController::class,'changeStatus']);

Route::get('Roles',[RoleController::class,'index'])->name('roles.index');
Route::get('RolesCreate',[RoleController::class,'create'])->name('roles.create');
Route::post('RolesStore',[RoleController::class,'store'])->name('roles.store');
Route::get('RolesEdit/{id}',[RoleController::class,'edit'])->name('roles.edit');
Route::post('RolesUpdate/{id}',[RoleController::class,'update'])->name('roles.update');
Route::get('RolesDelete/{id}',[RoleController::class,'destroy'])->name('roles.destroy');

});
#############################

Route::post('customerLogin',[AdminController::class,'customerLogin'])->name('customer.customerLogin');

Route::get('signOut',[AdminController::class,'signOut'])->name('customer.logout');

Route::get('customerLogin',[AdminController::class,'index'])->name('customer.login');
Route::get('aib',[AdminController::class,'main'])->name('customer.index');

Route::get('Items/{id}',[itemsController::class,'index'])->name('Customer.Items.index');
Route::get('createItems/{id}',[itemsController::class,'create'])->name('Customer.Items.create');
Route::post('storeItem/{id}',[itemsController::class,'store'])->name('Customer.Items.store');
Route::get('editItem/{id}',[itemsController::class,'edit'])->name('Customer.Items.edit');
Route::post('updateItem/{id}',[itemsController::class,'update'])->name('updateItem');
Route::get('deleteItem/{id}',[itemsController::class,'destroy'])->name('Customer.Items.delete');

Route::get('Products/{id}',[ProductsController::class,'index'])->name('Customer.Products.index');
Route::get('createProduct/{id}',[ProductsController::class,'create'])->name('Customer.Products.create');
Route::get('editProduct/{id}',[ProductsController::class,'edit'])->name('Customer.Products.edit');
Route::post('updateProduct/{id}',[ProductsController::class,'update'])->name('Customer.Products.update');
Route::post('createProduct',[ProductsController::class,'store'])->name('Customer.Products.store');
Route::get('deleteProduct/{id}',[ProductsController::class,'destroy'])->name('Customer.Products.destroy');
Route::get('viewProductService/{id}',[ProductsController::class,'productServices'])->name('Customer.Products.viewProductServices');
Route::get('addProductService/{id}',[ProductsController::class,'addService'])->name('Customer.Products.addProductService');
Route::post('createService',[ProductsController::class,'createService'])->name('Customer.Products.createService');
Route::get('viewAllServices/{id}',[ProductsController::class,'viewAllServices'])->name('Customer.Products.viewAllServices');
Route::get('deleteService/{id}',[ProductsController::class,'deleteService'])->name('Customer.Products.deleteService');

Route::get('orders/{id}',[OrdersController::class,'index'])->name('Customer.Orders.index');

Route::view('datatable','dashboard.datatable');
Route::view('datatableAr','dashboard.datatableAr');

Route::get('updates',function (){
    DB::table('subcategories')->update(['rate' => 5]);
});

Route::get('updateDB',function (){
    DB::table('subcategories')->where('id',24)->update([
        'lat'=>'30.2984486',
        'lng'=>'31.152275'
    ]);
});
