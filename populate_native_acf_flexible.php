<?php
/**
 * Clean stale ACF posts and populate Native ACF Flexible Content
 */
define('WP_USE_THEMES', false);
define('WP_ADMIN', true);
require __DIR__ . '/wp/wp-load.php';

global $wpdb;

echo "=== 1. REMOVING OLD DATABASE ACF FIELD GROUPS ===\n";
// Delete old acf-field-group and acf-field posts that were saved as text
$old_groups = $wpdb->get_col("SELECT ID FROM {$wpdb->posts} WHERE post_type IN ('acf-field-group', 'acf-field') AND (post_name LIKE '%daily_home%' OR post_title LIKE '%Trang Chủ%' OR post_name LIKE '%field_daily_home%')");
if (!empty($old_groups)) {
    foreach ($old_groups as $gid) {
        wp_delete_post($gid, true);
        echo " - Deleted old ACF post ID: $gid\n";
    }
} else {
    echo " - No stale ACF DB posts found.\n";
}

echo "\n=== 2. SEEDING NATIVE ACF FLEXIBLE CONTENT ===\n";
require __DIR__ . '/import_and_link_real_images.php';

echo "\n=== 3. VERIFYING LOCAL ACF REGISTRATION ===\n";
if (function_exists('acf_get_field_group')) {
    $g = acf_get_field_group('group_vinacos_home_page');
    echo "Group 'group_vinacos_home_page': " . (!empty($g) ? 'REGISTERED OK' : 'NOT FOUND') . "\n";
    
    $f = acf_get_field('field_vinacos_home_fc');
    echo "Field 'field_vinacos_home_fc' type: " . ($f['type'] ?? 'NONE') . "\n";
    echo "Layouts count: " . count($f['layouts'] ?? []) . "\n";
}

echo "\n=== 4. VERIFYING SEEDED SECTIONS ON PAGE 10 ===\n";
$sections = get_field('home_sections', 10);
echo "Total Sections on Page 10: " . (is_array($sections) ? count($sections) : 'NONE/NOT ARRAY') . "\n";
if (is_array($sections)) {
    foreach ($sections as $idx => $s) {
        echo "   [$idx] Layout: " . ($s['acf_fc_layout'] ?? 'none') . "\n";
    }
}

echo "\nDONE 100%!\n";
