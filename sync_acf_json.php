<?php
define('WP_USE_THEMES', false);
define('WP_ADMIN', true);
require __DIR__ . '/wp/wp-load.php';

// Remove legacy conflicting JSON files
$legacy_files = [
    __DIR__ . '/wp/wp-content/themes/spl/acf-json/group_daily_home.json',
    __DIR__ . '/wp/wp-content/themes/spl/acf-json/group_daily_about.json',
    __DIR__ . '/wp/wp-content/themes/spl/acf-json/group_daily_cooperation.json',
];
foreach ($legacy_files as $f) {
    if (file_exists($f)) {
        unlink($f);
        echo "Deleted legacy " . basename($f) . "\n";
    }
}

// Ensure PHP field groups are loaded
require_once __DIR__ . '/wp/wp-content/themes/spl/inc/acf-page-fields.php';
if (function_exists('spl_register_all_vinacos_page_acf_fields')) {
    spl_register_all_vinacos_page_acf_fields();
}

$field_groups = [
    'group_vinacos_home_page' => 'group_vinacos_home.json',
    'group_vinacos_about_page' => 'group_vinacos_about.json',
    'group_vinacos_cooperation_page' => 'group_vinacos_coop.json',
];

$json_dir = __DIR__ . '/wp/wp-content/themes/spl/acf-json';
if (!is_dir($json_dir)) {
    mkdir($json_dir, 0755, true);
}

foreach ($field_groups as $group_key => $filename) {
    $group = acf_get_field_group($group_key);
    if ($group) {
        $group['fields'] = acf_get_fields($group_key);
        $json_path = $json_dir . '/' . $filename;
        file_put_contents($json_path, json_encode($group, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        echo "Exported {$group_key} -> {$filename} (" . count($group['fields']) . " fields)\n";
    } else {
        echo "WARNING: Could not find group {$group_key}\n";
    }
}

// Clear ACF cache
if (function_exists('acf_get_store')) {
    acf_get_store('field-groups')->reset();
    acf_get_store('fields')->reset();
}
wp_cache_flush();

echo "\nACF Local JSON sync completed!\n";
