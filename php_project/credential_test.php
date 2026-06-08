<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Detailed Credential Test</h1>";

// These are the values from your db.php
$host = '127.0.0.1';
$db = '69a598a3943d8_nerman';
$user = '69a598a3943d8_nerman';
$pass = 'Nerman7771'; // Or whatever you changed it to

echo "<b>Testing with:</b><br>";
echo "Host: [$host]<br>";
echo "Database: [$db]<br>";
echo "User: [$user]<br>";
echo "Password Length: " . strlen($pass) . " characters<br><br>";

$hosts_to_test = ['127.0.0.1', 'localhost'];

foreach ($hosts_to_test as $t_host) {
    echo "--- Testing Host: $t_host ---<br>";
    try {
        $dsn = "mysql:host=$t_host;dbname=$db;charset=utf8mb4";
        $pdo = new PDO($dsn, $user, $pass);
        echo "✅ SUCCESS! Connected to $t_host<br>";

        $stmt = $pdo->query("SELECT DATABASE()");
        echo "Current DB: " . $stmt->fetchColumn() . "<br>";

        break;
    } catch (PDOException $e) {
        echo "❌ FAILED on $t_host: " . $e->getMessage() . "<br>";
    }
}

echo "<h2>Suggested checks:</h2>";
echo "1. Is the database name exactly <b>$db</b> in ISPmanager?<br>";
echo "2. Is the user <b>$user</b> assigned to this database with ALL privileges?<br>";
echo "3. Did you click 'Save' after changing the password in ISPmanager?<br>";
?>