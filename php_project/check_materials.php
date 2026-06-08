<?php
require_once 'includes/db.php';

echo "--- CATEGORY COUNT ---\n";
$cats = $pdo->query("SELECT id, name, slug FROM categories")->fetchAll();
foreach ($cats as $cat) {
    $count = $pdo->prepare("SELECT COUNT(*) FROM materials WHERE category_id = ?");
    $count->execute([$cat['id']]);
    $total = $count->fetchColumn();
    echo "Category: {$cat['name']} ({$cat['slug']}) - Total: {$total}\n";

    if ($total > 0) {
        $files = $pdo->prepare("SELECT file_path FROM materials WHERE category_id = ? LIMIT 3");
        $files->execute([$cat['id']]);
        while ($f = $files->fetch()) {
            $exists = file_exists(__DIR__ . $f['file_path']) ? "OK" : "MISSING";
            echo "  - {$f['file_path']} [$exists]\n";
        }
    }
}
?>