<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Logistics
    Route::get('/logistics', [App\Http\Controllers\Api\LogisticsController::class, 'index']);
    Route::get('/logistics/rates', [App\Http\Controllers\Api\LogisticsController::class, 'getRates']);
    Route::post('/logistics/shipments', [App\Http\Controllers\Api\LogisticsController::class, 'createShipment']);
    Route::get('/logistics/track/{trackingNumber}', [App\Http\Controllers\Api\LogisticsController::class, 'trackShipment']);

    // Wallet
    Route::get('/wallet/balance', [App\Http\Controllers\Api\WalletController::class, 'getBalance']);
    Route::post('/wallet/fund', [App\Http\Controllers\Api\WalletController::class, 'fundWallet']);

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
