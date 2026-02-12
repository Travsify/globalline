<?php
header('Content-Type: text/plain');

echo "=== System Diagnostics ===\n";
echo "Web Root: " . __DIR__ . "\n";
echo "Document Root: " . $_SERVER['DOCUMENT_ROOT'] . "\n";

$files = [
    'index.php',
    '../vendor/autoload.php',
    '../bootstrap/app.php',
    '../storage/logs/laravel.log'
];

echo "\n=== File Checks ===\n";
foreach ($files as $file) {
    if (file_exists(__DIR__ . '/' . $file)) {
        echo "[OK] Found: $file\n";
    } else {
        echo "[ERROR] Missing: $file\n";
    }
}

echo "\n=== Apache Modules ===\n";
if (function_exists('apache_get_modules')) {
    $modules = apache_get_modules();
    $relevant = array_filter($modules, fn($m) => in_array($m, ['mod_rewrite', 'mod_dir', 'mod_alias']));
    print_r($relevant);
} else {
    echo "apache_get_modules() not available (likely PHP-FPM or distinct process).\n";
}

echo "\n=== PHP Info ===\n";
echo "PHP Version: " . phpversion() . "\n";
