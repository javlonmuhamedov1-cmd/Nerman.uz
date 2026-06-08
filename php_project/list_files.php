<?php
header('Content-Type: text/plain');
echo "--- DIRECTORY LISTING ---\n\n";

$path = $_SERVER['DOCUMENT_ROOT'] . '/static/materials';

function list_files($dir, $level = 0)
{
    if (!is_dir($dir))
        return;
    $files = scandir($dir);
    foreach ($files as $file) {
        if ($file == '.' || $file == '..')
            continue;
        echo str_repeat('  ', $level) . $file . (is_dir($dir . '/' . $file) ? '/' : '') . "\n";
        if (is_dir($dir . '/' . $file) && $level < 2) {
            list_files($dir . '/' . $file, $level + 1);
        }
    }
}

if (is_dir($path)) {
    echo "Found materials folder at: $path\n";
    list_files($path);
} else {
    echo "ERROR: materials folder NOT FOUND at $path\n";
    echo "Checking /public_html/static/materials ...\n";
    $alt_path = '/home/user/public_html/static/materials'; // Just an example
    if (is_dir($alt_path)) {
        echo "Found at alternative path.\n";
    }
}

echo "\n--- END ---";
?>