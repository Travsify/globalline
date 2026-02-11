<?php

/**
 * Laravel Migration Helper for Shared Hosting
 * 
 * Usage:
 * 1. Upload this file to your public_html folder.
 * 2. Access it via yourbrowser.com/migrate.php
 * 3. DELETE THE FILE IMMEDIATELY AFTER USE.
 */

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

// 1. Load Laravel
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';

// 2. Wrap in a simple auth or secret key check if desired
$secret = $_GET['secret'] ?? '';
if ($secret !== 'your_secret_password') {
    die('Unauthorized access. Please provide the correct secret key.');
}

// 3. Run Migrations
try {
    echo "Running migrations...<br>";
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $status = $kernel->call('migrate', ['--force' => true]);
    
    echo "Migration status: " . $status . "<br>";
    echo "Output: <br><pre>" . Artisan::output() . "</pre>";
    echo "<b>IMPORTANT: Delete this file now!</b>";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}
