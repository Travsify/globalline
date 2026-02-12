<?php
echo "=== GlobalLine Diagnostic ===\n";
echo "Timestamp: " . date('Y-m-d H:i:s') . "\n";
echo "PHP Version: " . phpversion() . "\n\n";

echo "=== Request Info ===\n";
echo "REQUEST_URI: " . ($_SERVER['REQUEST_URI'] ?? 'N/A') . "\n";
echo "SCRIPT_NAME: " . ($_SERVER['SCRIPT_NAME'] ?? 'N/A') . "\n";
echo "DOCUMENT_ROOT: " . ($_SERVER['DOCUMENT_ROOT'] ?? 'N/A') . "\n";

echo "\n=== File Check ===\n";
$critical = ['index.php', '.htaccess', '../vendor/autoload.php'];
foreach ($critical as $f) {
    echo "$f: " . (file_exists(__DIR__ . '/' . $f) ? "EXISTS" : "MISSING") . "\n";
}

echo "\n=== Server Vars ===\n";
print_r($_SERVER);
