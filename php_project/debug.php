<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h1>Debug Mode</h1>";

echo "Testing session_start()...<br>";
session_start();
echo "✅ Session started.<br>";

echo "Testing include/db.php...<br>";
try {
    require_once 'includes/db.php';
    echo "✅ db.php included.<br>";
    if (isset($pdo)) {
        echo "✅ PDO object exists.<br>";
    } else {
        echo "❌ PDO object is NULL. Error: " . ($db_error ?? 'Unknown error') . "<br>";
    }
} catch (Exception $e) {
    echo "❌ Exception including db.php: " . $e->getMessage() . "<br>";
} catch (Error $e) {
    echo "❌ Error including db.php: " . $e->getMessage() . "<br>";
}

echo "Testing include/auth.php...<br>";
try {
    require_once 'includes/auth.php';
    echo "✅ auth.php included.<br>";
} catch (Throwable $e) {
    echo "❌ Throwable including auth.php: " . $e->getMessage() . "<br>";
}

echo "Testing is_authenticated()...<br>";
if (function_exists('is_authenticated')) {
    echo "✅ is_authenticated() exists. Result: " . (is_authenticated() ? 'Yes' : 'No') . "<br>";
} else {
    echo "❌ is_authenticated() NOT found.<br>";
}

echo "<h1>End of diagnostic</h1>";
?>