<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\subCategoryController;
use App\Http\Controllers\Admin\CategoryItemController;
use App\Http\Controllers\Admin\ProductController;
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
    return view('welcome');
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

Route::view('laundries','dashboard.laundries.create');


Route::get('laundries',[subCategoryController::class,'index'])->name('laundries.index');
Route::get('laundryCreate',[subCategoryController::class,'create'])->name('laundries.create');
Route::post('laundryStore',[subCategoryController::class,'store'])->name('laundries.store');
Route::get('laundryDestroy/{id}',[subCategoryController::class,'destroy'])->name('laundries.destroy');
Route::get('adminLaundries',[subCategoryController::class,'adminLaundries'])->name('laundries.admins');
Route::get('createAdminLaundries',[subCategoryController::class,'createAdmin'])->name('laundries.createAdmin');
Route::post('storeLaundryAdmin',[subCategoryController::class,'storeLaundryAdmin'])->name('laundries.storeAdmin');
Route::get('laundryView/{id}',[subCategoryController::class,'show'])->name('laundries.view');

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
