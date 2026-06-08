<?php
require_once 'includes/db.php';

header('Content-Type: text/plain');
echo "--- PATH DIAGNOSTIC ---\n\n";

$stmt = $pdo->query("SELECT m.*, c.slug as cat_slug FROM materials m JOIN categories c ON m.category_id = c.id LIMIT 10");
while ($row = $stmt->fetch()) {
    echo "Material: " . $row['name'] . "\n";
    echo "DB image_url: " . $row['image_url'] . "\n";

    // Check various combinations
    $paths_to_check = [
        $_SERVER['DOCUMENT_ROOT'] . $row['image_url'],
        $_SERVER['DOCUMENT_ROOT'] . '/' . ltrim($row['image_url'], '/')
    ];

    $found = false;
    foreach ($paths_to_check as $p) {
        if (file_exists($p)) {
            echo "✅ FOUND at: $p\n";
            $found = true;
            break;
        }
    }

    if (!$found) {
        echo "❌ NOT FOUND on server.\n";
        echo "   Checked path: " . $paths_to_check[0] . "\n";
    }
    echo "---------------------------\n";
}

echo "\nServer DOCUMENT_ROOT: " . $_SERVER['DOCUMENT_ROOT'] . "\n";
?>