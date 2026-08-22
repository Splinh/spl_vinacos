<?php
/**
 * Auto-Sync ACF JSON into Database & Seed Homepage Content
 */
define('WP_USE_THEMES', false);
define('WP_ADMIN', true);
require __DIR__ . '/wp/wp-load.php';

echo "=== 1. SYNCING ACF FIELD GROUPS FROM JSON TO DATABASE ===\n";

if (function_exists('acf_get_field_groups')) {
    $json_file = __DIR__ . '/wp/wp-content/themes/spl/acf-json/group_daily_home.json';
    if (file_exists($json_file)) {
        $group_data = json_decode(file_get_contents($json_file), true);
        if ($group_data && function_exists('acf_import_field_group')) {
            $imported = acf_import_field_group($group_data);
            echo " - Successfully imported/synced '{$group_data['title']}' (Key: {$group_data['key']}) into Database!\n";
        }
    }
}

echo "\n=== 2. SEEDING HOMEPAGE SECTIONS ===\n";
require __DIR__ . '/seed_all_local_data.php';

echo "\n=== 3. VERIFYING HOMEPAGE OUTPUT ===\n";
$front_page_id = (int) get_option('page_on_front') ?: 10;
$sections = get_field('home_sections', $front_page_id);
echo " - Front Page ID: $front_page_id\n";
echo " - Total Sections in DB: " . (is_array($sections) ? count($sections) : 'NONE') . "\n";
if (is_array($sections)) {
    foreach ($sections as $idx => $s) {
        $layout = $s['acf_fc_layout'] ?? 'unknown';
        echo "   [$idx] Layout: $layout | Title: " . ($s['title'] ?? 'N/A') . "\n";
    }
}

echo "\nACF SYNC & SEED COMPLETED SUCCESSFULLY!\n";
