<?php
require_once '../includes/db.php';
require_once '../includes/auth.php';

header('Content-Type: application/json');

if (!is_authenticated()) {
    echo json_encode(['error' => 'not_authenticated']);
    exit;
}

$data = json_decode(file_get_contents('php_project://input'), true);
$material_id = $data['material_id'] ?? null;
$user_id = get_user_id();

if (!$material_id) {
    echo json_encode(['error' => 'missing_id']);
    exit;
}

// Check if already liked
$stmt = $pdo->prepare("SELECT 1 FROM material_likes WHERE user_id = ? AND material_id = ?");
$stmt->execute([$user_id, $material_id]);

if ($stmt->fetch()) {
    // Unlike
    $stmt = $pdo->prepare("DELETE FROM material_likes WHERE user_id = ? AND material_id = ?");
    $stmt->execute([$user_id, $material_id]);
    $liked = false;
} else {
    // Like
    $stmt = $pdo->prepare("INSERT INTO material_likes (user_id, material_id) VALUES (?, ?)");
    $stmt->execute([$user_id, $material_id]);
    $liked = true;
}

// Count total likes
$stmt = $pdo->prepare("SELECT COUNT(*) FROM material_likes WHERE material_id = ?");
$stmt->execute([$material_id]);
$count = $stmt->fetchColumn();

echo json_encode(['liked' => $liked, 'count' => $count]);
?>