<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckOutController;
use App\Http\Controllers\Frontend\FlashSaleController;
use App\Http\Controllers\Frontend\FrontendProductController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\NewsletterController;
use App\Http\Controllers\Frontend\PageController as FrontendPageController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\ProductTrackController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\Frontend\UserAddressController;
use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\Frontend\UserOrderController;
use App\Http\Controllers\Frontend\UserProfileController;
use App\Http\Controllers\Frontend\UserVendorRequestController;
use App\Http\Controllers\Frontend\WishListController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', [HomeController::class, 'index'])->name('fronted.home');

// Route::get('/dashboard', function () {
//     return view('frontend.dashboard.dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
/** flash-sale */
Route::get('flash-sale', [FlashSaleController::class, 'index'])->name('flash-sale');

/** Product Detail */
Route::get('product-detail/{slug}', [FrontendProductController::class, 'productDetail'])->name('product-detail');
/** Product Route */
Route::get('products', [FrontendProductController::class, 'productsIndex'])->name('products.inex');
Route::get('change-product-list-view', [FrontendProductController::class, 'changeListView'])->name('change-product-list-view');

Route::controller(CartController::class)->group(function(){
    /** Cart route */
    Route::post('add-to-cart', 'addToCart')->name('add-to-cart');
    /** Add to Cart */
    Route::get('cart-details', 'cartDetails')->name('cart-details');
    /** Update product quantity */
    Route::post('cart/update-quantity', 'updateProductQuantity')->name('cart.update-product-quantity');
    /** Clear Cart */
    Route::get('clear-cart', 'clearCart')->name('clear.cart');
    /** Remove product from cart */
    Route::get('cart/remove-product/{rowId}', 'removeProductFromCart')->name('cart.remove-product');
    /** get cart count */
    Route::get('cart-count', 'getCartCount')->name('cart.count');
    /** cart sidebar all products  */
    Route::get('cart-products', 'getCartProduct')->name('cart-products');
    /** remove sidebar product */
    Route::post('cart/remove-sidebar-product', 'removeSidebarProduct')->name('cart.remove-sidebar-product');
    /** sidebar product total */
    Route::get('cart/sidebar-product-total', 'cartTotal')->name('cart.sidebar-product-total');
    /** coupon apply */
    Route::get('cart/apply-coupon', 'applyCoupon')->name('cart.apply-coupon');
    /** calculate discount coupon */
    Route::get('coupon-calculation', 'couponCalculation')->name('coupon.calculation');

});

Route::group(['middleware'=>['auth', 'verified'], 'prefix'=>'user', 'as'=>'user.' ], function(){
    /** user dashboard */
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

    /** user profile route */
    Route::controller(UserProfileController::class)->group(function(){
        Route::get('/profile', 'index')->name('profile');
        Route::put('/profile', 'updateProfile')->name('profile.update');
        Route::post('/update/password', 'updatePassword')->name('profile.update.password');
    });

    /** user address route */
    Route::resource('address', UserAddressController::class);

     /**checkout routes */
    Route::controller(CheckOutController::class)->group(function(){
     Route::get('checkout',  'index')->name('checkout');
     Route::post('checkout/address',  'createAddress')->name('checkout.create-address');
     Route::post('checkout/form-submit', 'checkOutFormSubmit')->name('checkout-form-submit');
    });

     /** payment routes */
     Route::controller(PaymentController::class)->group(function(){

         Route::get('payment', 'index')->name('payment');
         Route::get('payment/success','paymentSuccess')->name('payment.success');

         /** Paypal Payment routes */
         Route::get('paypal/payment', 'payWithPaypal')->name('paypal-payment');
         Route::get('paypal/success', 'paypalSuccess')->name('paypal-success');
         Route::get('paypal/cancel', 'paypalCancel')->name('paypal-cancel');

         /** Stripe Payment routes */
         Route::post('stripe/payment', 'payWithStripe')->name('stripe-payment');

         /** cod payment route */
         Route::get('cod-payment', 'payWithCod')->name('cod-payment');
     });

     /** order routes */
     Route::controller(UserOrderController::class)->group(function(){
         Route::get('orders', 'index')->name('orders.index');
         Route::get('order-details/{id}', 'show')->name('order-details');
     });
     /** wishlist routes */
     Route::get('wish-list', [WishListController::class, 'index'])->name('wish-list.index');

     Route::get('wishlist/destroy/{id}', [WishListController::class, 'destroy'])->name('wishlist.destroy');

     /** Review routes */
     Route::post('review', [ReviewController::class, 'create'])->name('review.create');
     Route::get('review', [ReviewController::class, 'index'])->name('review.index');

     /** vendor request route */
     Route::prefix('vendor-request')->name('vendor-request.')->controller(UserVendorRequestController::class)->group(function(){
         Route::get('/', 'index')->name('index');
         Route::post('/create', [UserVendorRequestController::class, 'create'])->name('create');
     });

     /** blog comment route */
     Route::post('blog/comment', [BlogController::class, 'comment'])->name('blog.comment');
});
/** wishlist add*/
Route::get('wishlist/add-product', [WishListController::class, 'addProductToWishList'])->name('wishlist.add-product');

/** news letter route */
Route::post('newsletter-request', [NewsletterController::class, 'newsLetterRequest'])->name('newsletter.request');
Route::get('newsletter-verify/{token}', [NewsletterController::class, 'newsLetterEmailVerify'])->name('newsletter.verify');

/** vendor page routes */
Route::prefix('vendor')->name('vendor.')->controller(HomeController::class)->group(function(){
    Route::get('/',  'vendorPage')->name('index');
    Route::get('/product/{id}','vendorProductPage')->name('products');
});

/** about and terms and condition routes */
Route::controller(FrontendPageController::class)->group(function(){
    Route::get('/about', 'about')->name('about');
    Route::get('/terms-and-conditions', 'termsAndCondition')->name('terms-and-conditions');
    Route::get('/contact', 'contact')->name('contact');
    Route::post('/contact', 'handleContactForm')->name('contact-form.submit');
});

/** product track route */
Route::get('product-tracking', [ProductTrackController::class, 'index'])->name('product-track.index');

/** blog detail route */
Route::get('blog-details/{slug}', [BlogController::class, 'blogDetails'])->name('blog-details');
Route::get('blog', [BlogController::class, 'blog'])->name('blog');

/** product model view route */
Route::get('show-product-model/{id}', [HomeController::class, 'showProductModel'])->name('show-product-model');
