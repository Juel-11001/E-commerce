<?php

use App\DataTables\VendorWithdrawDataTable;
use App\Http\Controllers\Backend\ProductVariantController;
use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Backend\VendorOrderController;
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\Backend\VendorProductImageGalleryController;
use App\Http\Controllers\Backend\VendorProductReviewController;
use App\Http\Controllers\Backend\VendorProductVariantController;
use App\Http\Controllers\Backend\VendorProductVariantItemController;
use App\Http\Controllers\Backend\VendorProfileController;
use App\Http\Controllers\Backend\VendorWithdrawController;
use App\Http\Controllers\Backend\VendorShopProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* Vendor Route */
Route::get('dashboard', [VendorController::class, 'dashboard'])->name('dashboard');

Route::controller(VendorProfileController::class)->group(function(){
    Route::get('profile','index')->name('profile');
    Route::put('profile','updateProfile')->name('profile.update');
    Route::post('update/password', 'updatePassword')->name('profile.update.password');

});
/**Vendor Shop Profile Route */
Route::resource('shop-profile', VendorShopProfileController::class);

/** Vendor Product Route */
Route::put('change-status', [VendorProductController::class, 'changeStatus'])->name('products.change-status');
Route::get('products/get-sub-categories', [VendorProductController::class, 'getSubCategories'])->name('product.get-sub-categories');
Route::get('products/get-child-categories', [VendorProductController::class, 'getChildCategories'])->name('product.get-child-categories');

Route::resource('products', VendorProductController::class);

/** Vendor product image gallery Route End */
Route::resource('products-image-gallery', VendorProductImageGalleryController::class);

/* Product Variant routes */
Route::put('products-variant/change-status', [VendorProductVariantController::class, 'changeStatus'])->name('products-variant.change-status');
Route::resource('products-variant', VendorProductVariantController::class);

/* Product Variant Item routes */
Route::controller(VendorProductVariantItemController::class)->group(function(){
    Route::get('products-variant-item/{productId}/{variantId}', 'index')->name('products-variant-item.index');
    Route::get('products-variant-item/create/{productId}/{variantId}', 'create')->name('products-variant-item.create');
    Route::post('products-variant-item', 'store')->name('products-variant-item.store');
    Route::get('products-variant-item-edit/{variantItemId}', 'edit')->name('products-variant-item.edit');
    Route::put('products-variant-item-update/{variantItemId}', 'update')->name('products-variant-item.update');
    Route::delete('products-variant-item/{variantItemId}', 'destroy')->name('products-variant-item.destroy');
    Route::put('products-variant-item-status', 'changeStatus')->name('products-variant-item.change-status');
});

/** Order routes */
Route::controller(VendorOrderController::class)->group(function(){
    Route::get('orders', 'index')->name('orders.index');
    Route::get('orders/show/{id}','show')->name('orders.show');
    Route::get('order/status/{id}','updateStatus')->name('orders.status');
});

/** product reviews route */
Route::get('reviews', [VendorProductReviewController::class, 'index'])->name('reviews.index');

/** withdraw route */
Route::get('withdraw-request/{id}', [VendorWithdrawController::class, 'withdrawRequest'])->name('withdraw-request.show');
Route::resource('withdraw', VendorWithdrawController::class);
