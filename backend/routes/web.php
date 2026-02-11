<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Portal Routes
Route::prefix('portal')->name('portal.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\PortalController::class, 'dashboard'])->name('dashboard');
    Route::get('/shipments', [App\Http\Controllers\PortalController::class, 'shipments'])->name('shipments');
    Route::get('/marketplace', [App\Http\Controllers\PortalController::class, 'marketplace'])->name('marketplace');
    Route::get('/sourcing', [App\Http\Controllers\PortalController::class, 'sourcing'])->name('sourcing');
    Route::get('/payments', [App\Http\Controllers\PortalController::class, 'payments'])->name('payments');
    Route::get('/wallet', [App\Http\Controllers\PortalController::class, 'wallet'])->name('wallet');
    Route::post('/ship-for-me', [App\Http\Controllers\PortalController::class, 'shipForMe'])->name('ship-for-me');
    Route::post('/payments', [App\Http\Controllers\PortalController::class, 'storePayment'])->name('payments');
    Route::get('/addresses', [App\Http\Controllers\PortalController::class, 'addresses'])->name('addresses');
    Route::post('/addresses', [App\Http\Controllers\PortalController::class, 'storeAddress'])->name('addresses.store');
    Route::get('/notifications', [App\Http\Controllers\PortalController::class, 'notifications'])->name('notifications');
});
