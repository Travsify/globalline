use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PortalController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GlobalMarketplaceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public Routes
Route::get('/ping', fn() => 'GlobalLine Terminal: Online');
Route::get('/', [HomeController::class, 'index'])->name('welcome');
Route::get('/marketplace', [GlobalMarketplaceController::class, 'index'])->name('marketplace.index');
Route::post('/marketplace/add', [GlobalMarketplaceController::class, 'addToCollective'])->name('marketplace.add');

Route::get('/services', fn() => view('services'))->name('services');

Route::get('/about', function () {
    return view('about');
});

Route::get('/how-it-works', function () {
    return view('how-it-works');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/faq', function () {
    return view('faq');
});

Route::get('/tracking', function () {
    return view('tracking_public');
})->name('tracking');

// Auth Routes (Web)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/forgot-password', function () { return view('auth.forgot-password'); })->name('password.request');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Portal Routes
Route::middleware('auth')->prefix('portal')->name('portal.')->group(function () {
    Route::get('/dashboard', [PortalController::class, 'dashboard'])->name('dashboard');
    Route::get('/shipments', [PortalController::class, 'shipments'])->name('shipments');
    Route::get('/marketplace', [PortalController::class, 'marketplace'])->name('marketplace');
    Route::get('/sourcing', [PortalController::class, 'sourcing'])->name('sourcing');
    Route::get('/payments', [PortalController::class, 'payments'])->name('payments');
    Route::get('/wallet', [PortalController::class, 'wallet'])->name('wallet');
    Route::post('/wallet/convert', [PortalController::class, 'convertCurrency'])->name('wallet.convert');
    Route::post('/ship-for-me', [PortalController::class, 'shipForMe'])->name('ship-for-me');
    Route::post('/payments', [PortalController::class, 'storePayment'])->name('payments');
    Route::get('/addresses', [PortalController::class, 'addresses'])->name('addresses');
    Route::post('/addresses', [PortalController::class, 'storeAddress'])->name('addresses.store');
    Route::get('/notifications', [PortalController::class, 'notifications'])->name('notifications');
    Route::get('/tracking', [PortalController::class, 'tracking'])->name('tracking');
    Route::get('/consolidation', [PortalController::class, 'consolidation'])->name('consolidation');
    Route::post('/consolidation', [PortalController::class, 'storeConsolidation'])->name('consolidation.store');
    Route::post('/sourcing-request', [PortalController::class, 'storeSourcingRequest'])->name('sourcing-request.store');
    Route::get('/kyc', [PortalController::class, 'kyc'])->name('kyc');
    Route::post('/kyc', [PortalController::class, 'storeKyc'])->name('kyc.store');
    Route::get('/settings', [PortalController::class, 'settings'])->name('settings');

    // Support System
    Route::get('/support', [\App\Http\Controllers\SupportController::class, 'index'])->name('support.index');
    Route::get('/support/create', [\App\Http\Controllers\SupportController::class, 'create'])->name('support.create');
    Route::post('/support', [\App\Http\Controllers\SupportController::class, 'store'])->name('support.store');
    Route::get('/support/{id}', [\App\Http\Controllers\SupportController::class, 'show'])->name('support.show');
    Route::post('/support/{id}/reply', [\App\Http\Controllers\SupportController::class, 'reply'])->name('support.reply');
});
