<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/auth/reset-password', [AuthController::class, 'resetPassword']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Profile Management
    Route::put('/user/profile', [App\Http\Controllers\Api\ProfileController::class, 'updateProfile']);
    Route::put('/user/password', [App\Http\Controllers\Api\ProfileController::class, 'changePassword']);

    // Logistics
    Route::get('/logistics', [App\Http\Controllers\Api\LogisticsController::class, 'index']);
    Route::get('/logistics/rates', [App\Http\Controllers\Api\LogisticsController::class, 'getRates']);
    Route::post('/logistics/shipments', [App\Http\Controllers\Api\LogisticsController::class, 'createShipment']);
    Route::get('/logistics/track/{trackingNumber}', [App\Http\Controllers\Api\LogisticsController::class, 'trackShipment']);

    // Wallet
    Route::get('/wallet/balance', [App\Http\Controllers\Api\WalletController::class, 'getBalance']);
    Route::post('/wallet/fund', [App\Http\Controllers\Api\WalletController::class, 'fundWallet']);
    Route::post('/wallet/deduct', [App\Http\Controllers\Api\WalletController::class, 'deduct']);
    Route::post('/pay-supplier', [App\Http\Controllers\Api\PaySupplierController::class, 'store']);

    // Marketplace
    Route::get('/marketplace/products', [App\Http\Controllers\Api\MarketplaceController::class, 'search']);
    Route::get('/marketplace/products/{id}', [App\Http\Controllers\Api\MarketplaceController::class, 'show']);

    // Addresses
    Route::apiResource('addresses', App\Http\Controllers\Api\AddressController::class);

    // Support
    Route::get('/support/tickets', [App\Http\Controllers\Api\SupportTicketController::class, 'index']);
    Route::post('/support/tickets', [App\Http\Controllers\Api\SupportTicketController::class, 'store']);
    Route::get('/support/tickets/{supportTicket}', [App\Http\Controllers\Api\SupportTicketController::class, 'show']);
    Route::post('/support/tickets/{supportTicket}/reply', [App\Http\Controllers\Api\SupportTicketController::class, 'reply']);

    // KYC
    Route::get('/kyc/verifications', [App\Http\Controllers\Api\KycController::class, 'index']);
    Route::post('/kyc/upload', [App\Http\Controllers\Api\KycController::class, 'upload']);
    Route::get('/kyc/status', [App\Http\Controllers\Api\KycController::class, 'status']);

    // Loyalty
    Route::get('/loyalty/stats', [App\Http\Controllers\Api\LoyaltyController::class, 'getStats']);

    // Supplier Payments
    Route::get('/payments', [App\Http\Controllers\Api\SupplierPaymentController::class, 'index']);
    Route::post('/payments', [App\Http\Controllers\Api\SupplierPaymentController::class, 'store']);

    // Payment Gateway
    Route::post('/payment/initialize', [App\Http\Controllers\Api\PaymentController::class, 'initialize']);
    Route::post('/payment/verify', [App\Http\Controllers\Api\PaymentController::class, 'verify']);

    // Virtual Shipping Addresses (Global)
    Route::get('/logistics/virtual-addresses/regions', [App\Http\Controllers\Api\VirtualAddressController::class, 'getRegions']);
    Route::get('/logistics/virtual-addresses/my', [App\Http\Controllers\Api\VirtualAddressController::class, 'myAddresses']);
    Route::post('/logistics/virtual-addresses/request', [App\Http\Controllers\Api\VirtualAddressController::class, 'requestAddress']);

    // Admin Logistics Settings (Monetization & Control)
    Route::group(['middleware' => 'admin', 'prefix' => 'admin/logistics'], function () {
        Route::get('/settings', [App\Http\Controllers\Admin\LogisticsController::class, 'index']);
        Route::post('/settings', [App\Http\Controllers\Admin\LogisticsController::class, 'update']);
    });

    // Enterprise v4 Routes
    Route::group(['prefix' => 'enterprise'], function () {
        Route::get('/wallets', [App\Http\Controllers\Api\EnterpriseController::class, 'wallets']);
        Route::get('/consolidations', [App\Http\Controllers\Api\EnterpriseController::class, 'consolidations']);
        Route::post('/consolidate', [App\Http\Controllers\Api\EnterpriseController::class, 'storeConsolidation']);
        Route::post('/sourcing-request', [App\Http\Controllers\Api\EnterpriseController::class, 'storeSourcingRequest']);
        Route::get('/sourcing-orders', [App\Http\Controllers\Api\EnterpriseController::class, 'sourcingOrders']);
        Route::post('/convert', [App\Http\Controllers\Api\EnterpriseController::class, 'convert']);
        Route::post('/ship-for-me', [App\Http\Controllers\Api\EnterpriseController::class, 'shipForMe']);
    });
});
