<?php

use App\Http\Controllers\Api\Customer\CustomerController;
use App\Http\Controllers\Base\AddressController;
use App\Http\Controllers\Base\BannerController;
use App\Http\Controllers\Base\CartController;
use App\Http\Controllers\Base\CartItemController;
use App\Http\Controllers\Base\CategoryController;
use App\Http\Controllers\Base\CouponController;
use App\Http\Controllers\Base\CouponUsageController;
use App\Http\Controllers\Base\FaqController;
use App\Http\Controllers\Base\ItemAdditionController;
use App\Http\Controllers\Base\ItemAdditionOptionController;
use App\Http\Controllers\Base\ItemController;
use App\Http\Controllers\Base\OrderTimeController;
use App\Http\Controllers\Base\PrivacyPolicyController;
use App\Http\Controllers\Base\RateController;
use App\Http\Controllers\Base\RegionController;
use App\Http\Controllers\Base\RestaurantController;
use App\Http\Controllers\Base\SectionController;
use App\Http\Controllers\Base\WorkingHourController;
use App\Http\Controllers\Webhook\PaymentWebhookController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    // lookups
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('sections', SectionController::class);
    Route::apiResource('regions', RegionController::class);
    Route::apiResource('order-times', OrderTimeController::class);
    Route::apiResource('addresses', AddressController::class);
    Route::apiResource('banners', BannerController::class);
    Route::apiResource('restaurants', RestaurantController::class);
    Route::apiResource('working-hours', WorkingHourController::class);
    Route::apiResource('items', ItemController::class);
    Route::apiResource('item-additions', ItemAdditionController::class);
    Route::apiResource('item-addition-options', ItemAdditionOptionController::class);
    Route::apiResource('carts', CartController::class);
    Route::apiResource('cart-items', CartItemController::class);
    Route::apiResource('coupons', CouponController::class);
    Route::apiResource('coupon-usages', CouponUsageController::class);
    Route::apiResource('faqs', FaqController::class);
    Route::apiResource('privacy-policies', PrivacyPolicyController::class);
    Route::apiResource('rates', RateController::class);
    Route::apiResource('customers', CustomerController::class);

    Route::post('regions/check-point', [RegionController::class, 'checkPoint']);
    Route::post('carts/add-to-cart', [CartController::class, 'addToCart']);

    Route::post('/webhook/payment', [PaymentWebhookController::class, 'handle'])
        ->name('webhook.payment');
});
