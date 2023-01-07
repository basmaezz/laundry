<?php

use App\Http\Controllers\Customer\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\subCategoryController;
use App\Http\Controllers\Admin\CategoryItemController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CouponsController;
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


Route::get('users',[UserController::class,'index'])->name('users.index');
Route::get('userView/{id}',[UserController::class,'show'])->name('user.view');
Route::get('userCreate',[UserController::class,'create'])->name('user.create');
Route::post('userStore',[UserController::class,'store'])->name('user.store');
Route::get('userEdit/{id}',[UserController::class,'edit'])->name('user.edit');
Route::post('userUpdate/{id}',[UserController::class,'update']);
Route::get('userDelete/{id}',[UserController::class,'destroy'])->name('user.delete');
Route::post('searchLaundry',[UserController::class,'destroy'])->name('searchLaundry');



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
Route::get('laundryUpdateStats/{id}',[subCategoryController::class,'updateStats']);


Route::get('CategoryItemsIndex/{id}',[CategoryItemController::class,'index'])->name('CategoryItems.index');
Route::get('CategoryItems/{id}',[CategoryItemController::class,'create'])->name('CategoryItems.create');
Route::get('CategoryItemsEdit/{id}',[CategoryItemController::class,'edit'])->name('CategoryItems.edit');
Route::post('CategoryItemsUpdate/{id}',[CategoryItemController::class,'update'])->name('CategoryItems.update');
Route::post('CategoryItemsStore',[CategoryItemController::class,'store'])->name('CategoryItems.store');
Route::get('CategoryItemsDestroy/{id}',[CategoryItemController::class,'destroy'])->name('CategoryItems.destroy');
Route::get('CategoryItemsShow/{id}',[CategoryItemController::class,'show'])->name('CategoryItems.show');
//Route::get('productList/{id}',[CategoryItemController::class,'productList'])->name('productList.show');

Route::get('productCreate/{id}',[ProductController::class,'create'])->name('product.create');
Route::post('productStore',[ProductController::class,'store'])->name('product.store');
Route::get('productDelete/{id}',[ProductController::class,'destroy'])->name('product.destroy');
Route::get('productView/{id}',[ProductController::class,'view'])->name('product.view');
Route::get('productEdit/{id}',[ProductController::class,'edit'])->name('product.edit');
Route::post('productUpdate',[ProductController::class,'update'])->name('product.update');
Route::get('productAddService/{id}',[ProductController::class,'addService'])->name('product.addService');
Route::post('createService',[ProductController::class,'createService'])->name('product.createService');
Route::get('productServices/{id}',[ProductController::class,'productServices'])->name('product.productServices');
Route::get('deleteService/{id}',[ProductController::class,'deleteService'])->name('product.deleteService');
Route::get('editService/{id}',[ProductController::class,'editService'])->name('product.editService');
Route::post('updateService/{id}',[ProductController::class,'updateService'])->name('product.updateService');

Route::get('coupons',[CouponsController::class,'index'])->name('coupons.index');
Route::get('couponsCreate',[CouponsController::class,'create'])->name('coupon.create');
Route::post('couponsStore',[CouponsController::class,'store'])->name('coupon.store');
//Route::get('couponsShow/{id}',[CouponsController::class,'show'])->name('coupon.show');
Route::get('couponEdit/{id}',[CouponsController::class,'edit'])->name('coupon.edit');
Route::post('couponUpdate/{id}',[CouponsController::class,'update'])->name('coupon.update');
Route::get('couponDelete/{id}',[CouponsController::class,'destroy'])->name('coupon.destroy');


#############################

Route::post('customLogin',[AdminController::class,'customLogin'])->name('customer.customLogin');

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




