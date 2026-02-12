<?php
echo "=== GlobalLine Diagnostic (v2) ===\n";
echo "Date: " . date('Y-m-d H:i:s') . "\n";

echo "\n=== Loaded Apache Modules ===\n";
if (function_exists('apache_get_modules')) {
    $mods = apache_get_modules();
    sort($mods);
    foreach ($mods as $m) {
        echo "- $m\n";
    }
} else {
    echo "apache_get_modules() not available.\n";
}

echo "\n=== Request Details ===\n";
echo "URI: " . $_SERVER['REQUEST_URI'] . "\n";
echo "Script: " . $_SERVER['SCRIPT_NAME'] . "\n";
echo "DocRoot: " . $_SERVER['DOCUMENT_ROOT'] . "\n";
