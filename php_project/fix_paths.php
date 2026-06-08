<?php
require_once 'includes/db.php';
header('Content-Type: text/plain');

echo "--- STARTING AUTO-FIX (v2 - Case Insensitive) ---\n\n";

// 1. Map folder names to Category IKEA Slugs/Names
$folder_to_slug = [
    'Bounce' => 'bounce-objects',
    'CTA' => 'cta-elements',
    'Motion' => 'motion-objects',
    'Стрелки' => 'arrows-lines',
    'Цифровые' => 'digital-elements',
    'Платформ' => 'platform-icons',
    'Неоновые' => 'neon-icons',
    'Наложения' => 'overlays',
    'Пнг' => 'png-objects',
    'Рамки' => 'text-frames',
    'transitions' => 'transitions',
    'backgrounds' => 'backgrounds'
];

// Fetch categories and map slug -> ID
$stmt = $pdo->query("SELECT id, slug FROM categories");
$slug_to_id = [];
while ($row = $stmt->fetch()) {
    $slug_to_id[$row['slug']] = $row['id'];
}

// Function to normalize string for comparison
function normalize($str)
{
    $str = mb_strtolower($str, 'UTF-8');
    $str = str_replace([' ', '-', '_'], '', $str); // Remove spaces/hyphens for robustness
    return $str;
}

// Recursive function to find file
function find_file_path($filename, $search_dir)
{
    if (!is_dir($search_dir))
        return null;
    $norm_target = normalize($filename);

    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($search_dir));
    foreach ($iterator as $file) {
        if ($file->isFile()) {
            $norm_found = normalize($file->getFilename());
            if ($norm_found === $norm_target) {
                // Found it! Convert to root-relative path
                $full_path = str_replace('\\', '/', $file->getPathname());
                $doc_root = str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']);
                return str_replace($doc_root, '', $full_path);
            }
        }
    }
    return null;
}

// Get all materials
$materials = $pdo->query("SELECT id, name, image_url, category_id FROM materials")->fetchAll();

$fixed_count = 0;
$not_found_count = 0;

foreach ($materials as $m) {
    $basename = basename($m['image_url']);
    echo "Processing: {$m['name']} (Target: $basename)...\n";

    $new_path = find_file_path($basename, $_SERVER['DOCUMENT_ROOT'] . '/static/materials');

    if ($new_path) {
        echo "  - FOUND at: $new_path\n";

        // Determine category from path
        $matched_id = $m['category_id'];
        foreach ($folder_to_slug as $keyword => $slug) {
            if (mb_stripos($new_path, $keyword) !== false) {
                if (isset($slug_to_id[$slug])) {
                    $matched_id = $slug_to_id[$slug];
                    echo "  - Matched Category: $slug (ID: $matched_id)\n";
                    break;
                }
            }
        }

        // Update DB
        $update = $pdo->prepare("UPDATE materials SET image_url = ?, file_path = ?, category_id = ? WHERE id = ?");
        $update->execute([$new_path, $new_path, $matched_id, $m['id']]);
        $fixed_count++;
    } else {
        echo "  - [!] NOT FOUND on server.\n";
        $not_found_count++;
    }
}

echo "\n--- SUMMARY ---\n";
echo "Total materials processed: " . count($materials) . "\n";
echo "Successfully fixed: $fixed_count\n";
echo "Not found on server: $not_found_count\n";
echo "--- END ---";
?>