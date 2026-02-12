<?php
echo "=== GlobalLine Deep Diagnostic ===\n";
echo "Date: " . date('Y-m-d H:i:s') . "\n";
echo "User: " . execute_command('whoami') . "\n";

function execute_command($cmd) {
    return shell_exec($cmd);
}

echo "\n=== Permissions Check ===\n";
$target = __DIR__ . '/index.php';
if (file_exists($target)) {
    $perms = substr(sprintf('%o', fileperms($target)), -4);
    $owner = posix_getpwuid(fileowner($target));
    echo "index.php Perms: $perms\n";
    echo "index.php Owner: " . $owner['name'] . "\n";
    echo "Readable: " . (is_readable($target) ? "YES" : "NO") . "\n";
} else {
    echo "index.php MISSING\n";
    exit("Fatal: index.php not found.");
}

echo "\n=== Inclusion Test (Bootstrapping Laravel) ===\n";
echo "Attempting to require index.php...\n";
echo "------------------------------------------------\n";

// We want to capture the output of index.php to see if it renders
ob_start();
try {
    require_once $target;
} catch (Throwable $e) {
    echo "\n[EXCEPTION] " . $e->getMessage() . "\n";
    echo $e->getTraceAsString();
}
$output = ob_get_clean();

echo substr($output, 0, 500); // Show first 500 chars
echo "\n------------------------------------------------\n";
echo "Test Complete.\n";
