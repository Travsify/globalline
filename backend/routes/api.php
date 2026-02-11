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
    Route::get('/logistics/rates', [App\Http\Controllers\Api\LogisticsController::class, 'getRates']);
    Route::post('/logistics/shipments', [App\Http\Controllers\Api\LogisticsController::class, 'createShipment']);
    Route::get('/logistics/track/{trackingNumber}', [App\Http\Controllers\Api\LogisticsController::class, 'trackShipment']);

    // Wallet
    Route::get('/wallet/balance', [App\Http\Controllers\Api\WalletController::class, 'getBalance']);
    Route::post('/wallet/fund', [App\Http\Controllers\Api\WalletController::class, 'fundWallet']);

    // Marketplace
    Route::get('/marketplace/products', [App\Http\Controllers\Api\MarketplaceController::class, 'search']);
    Route::get('/marketplace/products/{id}', [App\Http\Controllers\Api\MarketplaceController::class, 'show']);

    // Enterprise v4 Routes
    Route::group(['prefix' => 'enterprise'], function () {
        Route::get('/wallets', [App\Http\Controllers\Api\EnterpriseController::class, 'wallets']);
        Route::get('/consolidations', [App\Http\Controllers\Api\EnterpriseController::class, 'consolidations']);
        Route::post('/sourcing-request', [App\Http\Controllers\Api\EnterpriseController::class, 'storeSourcingRequest']);
    });
});
