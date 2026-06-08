<?php
require_once 'includes/db.php';

header('Content-Type: text/plain');
echo "--- DATABASE DIAGNOSTIC ---\n\n";

if (!$pdo) {
    die("Error: No database connection.");
}

echo "1. Testing CATEGORIES table:\n";
try {
    $stmt = $pdo->query("SELECT * FROM categories");
    $cats = $stmt->fetchAll();
    if (empty($cats)) {
        echo "   [!] Table 'categories' is EMPTY.\n";
    } else {
        echo "   [OK] Found " . count($cats) . " categories:\n";
        foreach ($cats as $c) {
            echo "   - ID: " . $c['id'] . " | Name: " . $c['name'] . " | Slug: " . $c['slug'] . "\n";
        }
    }
} catch (Exception $e) {
    echo "   [ERROR] Categories table error: " . $e->getMessage() . "\n";
}

echo "\n2. Testing MATERIALS table:\n";
try {
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM materials");
    $count = $stmt->fetch();
    echo "   [OK] Total materials in DB: " . $count['total'] . "\n";

    if ($count['total'] > 0) {
        echo "   Sample materials (first 5):\n";
        $stmt = $pdo->query("SELECT m.*, c.name as category_name FROM materials m LEFT JOIN categories c ON m.category_id = c.id LIMIT 5");
        while ($m = $stmt->fetch()) {
            echo "   - " . $m['name'] . " (Category: " . ($m['category_name'] ?? 'NULL') . ")\n";
        }
    }
} catch (Exception $e) {
    echo "   [ERROR] Materials table error: " . $e->getMessage() . "\n";
}

echo "\n--- END OF DIAGNOSTIC ---\n";
?>