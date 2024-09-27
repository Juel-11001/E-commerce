<?php

use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AdminListController;
use App\Http\Controllers\Backend\AdminReviewController;
use App\Http\Controllers\Backend\AdminVendorProfileController;
use App\Http\Controllers\Backend\AdvertisementController;
use App\Http\Controllers\Backend\BlogCategoryController;
use App\Http\Controllers\Backend\BlogCommentController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\CodSettingController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\CustomerListController;
use App\Http\Controllers\Backend\FlashSaleController;
use App\Http\Controllers\Backend\FooterGridThreeController;
use App\Http\Controllers\Backend\FooterGridTwoController;
use App\Http\Controllers\Backend\FooterInfoController;
use App\Http\Controllers\Backend\FooterSocialController;
use App\Http\Controllers\Backend\HomePageSettingController;
use App\Http\Controllers\Backend\ManageUserController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\PaymentSettingController;
use App\Http\Controllers\Backend\PaypalSettingController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductImageGalleryController;
use App\Http\Controllers\Backend\ProductVariantController;
use App\Http\Controllers\Backend\ProductVariantItemController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SellerProductController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\ShippingRuleController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\StripeSettingController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\SubscribersController;
use App\Http\Controllers\Backend\TransactionController;
use App\Http\Controllers\Backend\VendorConditionController;
use App\Http\Controllers\Backend\VendorListController;
use App\Http\Controllers\Backend\VendorRequestController;
use App\Http\Controllers\Backend\WithdrawController;
use App\Http\Controllers\Backend\WithdrawMethodController;
use App\Models\ProductVariant;
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

/* Admin Route */
Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

/* Profile routes */
Route::controller(ProfileController::class)->group(function(){
    Route::get('/profile', 'index')->name('profile');
    Route::post('/profile/update', 'updateProfile')->name('profile.update');
    Route::post('/profile/update/password', 'updatePassword')->name('password.update');
});

/* Slider routes */
Route::resource('slider', SliderController::class);

/* Category routes */
Route::put('category/change-status', [CategoryController::class, 'changeStatus'])->name('category.change-status');
Route::resource('category', CategoryController::class);

/* Sub-category routes */
Route::put('subcategory/change-status', [SubCategoryController::class, 'changeStatus'])->name('sub-category.change-status');
Route::resource('sub-category', SubCategoryController::class);

/* Child-category routes */
Route::put('child-category/change-status', [ChildCategoryController::class, 'changeStatus'])->name('child-category.change-status');
Route::get('get-subcategories', [ChildCategoryController::class, 'getSubCategories'])->name('get-subCategories');
Route::resource('child-category', ChildCategoryController::class);

/* Brand routes */
Route::put('brand/change-status', [BrandController::class, 'changeStatus'])->name('brand.change-status');
Route::resource('brand', BrandController::class);

/* Vendor profile routes */
Route::resource('vendor-profile', AdminVendorProfileController::class);

/* Product routes */
Route::put('products/change-status', [ProductController::class, 'changeStatus'])->name('products.change-status');
Route::get('products/get-sub-categories', [ProductController::class, 'getSubCategories'])->name('product.get-sub-categories');
Route::get('products/get-child-categories', [ProductController::class, 'getChildCategories'])->name('product.get-child-categories');
Route::resource('products', ProductController::class);

/* Product Image Gallery routes */
Route::resource('products-image-gallery', ProductImageGalleryController::class);

/* Product Variant routes */
Route::put('product-variant/change-status', [ProductVariantController::class, 'changeStatus'])->name('product-variant.change-status');
Route::resource('product-variant', ProductVariantController::class);

/* Product Variant Item routes */
Route::controller(ProductVariantItemController::class)->group(function(){
    Route::get('products-variant-item/{productId}/{variantId}', 'index')->name('products-variant-item.index');
    Route::get('products-variant-item/create/{productId}/{variantId}', 'create')->name('products-variant-item.create');
    Route::post('products-variant-item', 'store')->name('products-variant-item.store');
    Route::get('products-variant-item-edit/{variantItemId}', 'edit')->name('products-variant-item.edit');
    Route::put('products-variant-item-update/{variantItemId}', 'update')->name('products-variant-item.update');
    Route::delete('products-variant-item/{variantItemId}', 'destroy')->name('products-variant-item.destroy');
    Route::put('products-variant-item-status', 'changeStatus')->name('products-variant-item.change-status');
});

/** reviews route */
Route::get('reviews', [AdminReviewController::class, 'index'])->name('reviews.index');
Route::put('reviews/change-status', [AdminReviewController::class, 'changeStatus'])->name('reviews.change-status');
Route::delete('reviews/{id}', [AdminReviewController::class, 'destroy'])->name('reviews.destroy');

/** Seller Product */
Route::controller(SellerProductController::class)->group(function(){
    Route::get('seller-products', 'index')->name('seller-product.index');
    Route::get('seller-products-pending', 'productsPending')->name('seller-product-pending.index');
    Route::put('change-approve-status', 'changeApproveStatus')->name('change-approve-status');
});

/** Flash Sale */
Route::controller(FlashSaleController::class)->group(function(){
    Route::get('flash-sale', 'index')->name('flash-sale.index');
    Route::put('flash-sale', 'update')->name('flash-sale.update');
    Route::post('flash-sale/add-product', 'addProduct')->name('flash-sale.add-product');
    Route::put('flash-sale/change-status', 'changeStatus')->name('flash-sale.change-status');
    Route::put('flash-sale/show_at_home/change-status', 'ShowAtHomeChangeStatus')->name('flash-sale.show_at_home.change-status');
    Route::delete('flash-sale/{id}', 'destroy')->name('flash-sale.destroy');
});

/** Settings route */
Route::controller(SettingController::class)->group(function(){
    Route::get('settings','index')->name('setting.index');
    Route::put('general-setting','generalSettingUpdate')->name('general-setting.update');
    Route::put('email-configuration-setting','emailConfigurationUpdate')->name('email-configuration-setting.update');
    Route::put('log-setting', 'logSettingUpdate')->name('log-setting.update');
});

/** Coupon route */
Route::put('coupons/change-status', [CouponController::class, 'changeStatus'])->name('coupon.change-status');
Route::resource('coupons', CouponController::class);

/** shipping roule route */
Route::put('shipping-rule/change-status', [ShippingRuleController::class, 'changeStatus'])->name('shipping-rule.change-status');
Route::resource('shipping-rule', ShippingRuleController::class);

/** payment settings route */
Route::get('payment-settings', [PaymentSettingController::class, 'index'])->name('payment-settings.index');
Route::resource('paypal-setting', PaypalSettingController::class);

/** Stripe payment route */
Route::put('stripe-setting/{id}', [StripeSettingController::class, 'update'])->name('stripe-setting.update');

/** Cod payment setting route */
Route::put('cod-setting/{id}', [CodSettingController::class, 'update'])->name('cod-setting.update');

/** Order routes */
Route::controller(OrderController::class)->group(function(){
    Route::get('payment-status', 'changePaymentStatus')->name('payment-status');
    Route::get('order-status', 'changeOrderStatus')->name('order-status');
    Route::get('pending-orders', 'pendingOrders')->name('pending-orders');
    Route::get('processed-orders', 'processedOrders')->name('processed-orders');
    Route::get('dropped-off-orders', 'droppedOffOrders')->name('dropped-off-orders');
    Route::get('shipped-orders', 'shippedOrders')->name('shipped-orders');
    Route::get('out-for-delivery-orders', 'outDeliveryOrders')->name('out-for-delivery-orders');
    Route::get('delivered-orders', 'deliveredOrders')->name('delivered-orders');
    Route::get('cancelled-orders', 'cancelledOrders')->name('cancelled-orders');
});

Route::resource('order', OrderController::class);

/** Order Transaction */
Route::get('transaction', [TransactionController::class, 'index'])->name('transaction');

/** Home page setting  */
Route::controller(HomePageSettingController::class)->group(function(){
    Route::get('home-page-setting', 'index')->name('home-page-setting.index');
    Route::put('popular-category-section', 'updatePopularCategorySection')->name('popular-category-section');
    Route::put('product-slider-section-one', 'updateProductSliderSectionOne')->name('product-slider-section-one');
    Route::put('product-slider-section-two', 'updateProductSliderSectionTwo')->name('product-slider-section-two');
    Route::put('product-slider-section-three', 'updateProductSliderSectionThree')->name('product-slider-section-three');
});

/** Footer routes */
Route::resource('footer-info', FooterInfoController::class);

/** Footer social routes */
Route::put('footer-social/change-status', [FooterSocialController::class, 'changeStatus'])->name('footer-social.change-status');
Route::resource('footer-socials', FooterSocialController::class);

/** Footer Grid Two routes */
Route::put('footer-grid-two/change-status', [FooterGridTwoController::class, 'changeStatus'])->name('footer-grid-two.change-status');
Route::put('footer-grid-two/change-title', [FooterGridTwoController::class, 'changeTitle'])->name('footer-grid-two.change-title');
Route::resource('footer-grid-two', FooterGridTwoController::class);

/** Footer Grid three routes */
Route::put('footer-grid-three/change-status', [FooterGridThreeController::class, 'changeStatus'])->name('footer-grid-three.change-status');
Route::put('footer-grid-three/change-title', [FooterGridThreeController::class, 'changeTitle'])->name('footer-grid-three.change-title');
Route::resource('footer-grid-three', FooterGridThreeController::class);

/** subscribers route */
Route::get('subscribers', [SubscribersController::class, 'index'])->name('subscribers.index');
Route::delete('subscribers/{id}', [SubscribersController::class, 'destroy'])->name('subscribers.destroy');
Route::post('subscribers/send-mail', [SubscribersController::class, 'sendMail'])->name('subscribers.send-mail');

/* adverisement route */
Route::prefix('advertisement')
    ->name('adv.')
    ->controller(AdvertisementController::class)
    ->group(function() {
        Route::get('/', 'index')->name('index');
        Route::put('/homepage-banner-section-one', 'homepageBannerSectionOne')->name('homepage-banner-section-one');
        Route::put('/homepage-banner-section-two', 'homepageBannerSectionTwo')->name('homepage-banner-section-two');
        Route::put('/homepage-banner-section-three', 'homepageBannerSectionThree')->name('homepage-banner-section-three');
        Route::put('/homepage-banner-section-four', 'homepageBannerSectionFour')->name('homepage-banner-section-four');
        Route::put('/product-page-banner', 'productPageBanner')->name('product-page-banner');
        Route::put('/cartpage-banner-section', 'cartpageBannerSection')->name('cartpage-banner-section');
    });
/** vendor Request route */
Route::prefix('vendor-request')->name('vendor-request.')->controller(VendorRequestController::class)->group(function(){
    Route::get('/', 'index')->name('index');
    Route::get('/{id}/show', 'show')->name('show');
    Route::put('/{id}/change-status', 'changeStatus')->name('change-status');
});

/** customer list route */
Route::prefix('customer')->name('customer.')->controller(CustomerListController::class)->group(function(){
    Route::get('/', 'index')->name('index');
    Route::put('/change-status', 'changeStatus')->name('change-status');
});
/** vendor list route */
Route::prefix('vendor')->name('vendor.')->controller(VendorListController::class)->group(function(){
    Route::get('/', 'index')->name('index');
    Route::put('/change-status', 'changeStatus')->name('change-status');
});

/** admin list route */
Route::prefix('admin')->name('admin-list.')->controller(AdminListController::class)->group(function(){
    Route::get('/', 'index')->name('index');
    Route::put('/change-status', 'changeStatus')->name('change-status');
    Route::delete('/{id}/destroy', 'destroy')->name('destroy');
});

/** vendor condition route */
Route::prefix('vendor-condition')->name('vendor-condition.')->controller(VendorConditionController::class)->group(function(){
    Route::get('/', 'index')->name('index');
    Route::put('/update', 'update')->name('update');
});

/** about route and terms and condition route */
Route::controller(PageController::class)->group(function(){
    Route::get('/about', 'about')->name('about');
    Route::put('/about/update', 'aboutUpdate')->name('about.update');
    Route::get('/terms-and-condition', 'termsAndCondition')->name('terms-and-condition');
    Route::put('/terms-and-condition/update', 'termsAndConditionUpdate')->name('terms-and-condition.update');
});

/** manage user route */
Route::get('manage-user', [ManageUserController::class, 'index'])->name('manage-user.index');
Route::post('manage-user', [ManageUserController::class, 'create'])->name('manage-user.create');

/** blog category route */
Route::put('blog-category/change-status', [BlogCategoryController::class, 'changeStatus'])->name('blog-category.change-status');
Route::resource('blog-category', BlogCategoryController::class);

/** blog route */
Route::put('blog/change-status', [BlogController::class, 'changeStatus'])->name('blog.change-status');
Route::resource('blog', BlogController::class);

/**blog comment */
Route::get('blog-comment', [BlogCommentController::class, 'index'])->name('blog-comment.index');
Route::delete('blog-comment/{id}', [BlogCommentController::class, 'destroy'])->name('blog-comment.destroy');

/** withdraw payment method */

Route::resource('withdraw-method', WithdrawMethodController::class);

/** get withdraw request list */
Route::get('withdraw-list', [WithdrawController::class, 'index'])->name('withdraw.index');
Route::get('withdraw/{id}/show', [WithdrawController::class, 'show'])->name('withdraw.show');
Route::put('withdraw/{id}', [WithdrawController::class, 'update'])->name('withdraw.update');
