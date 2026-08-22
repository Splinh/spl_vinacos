<?php
/**
 * Diagnostic tool for WordPress Media Library & ACF on VPS
 */
define('WP_USE_THEMES', false);
define('WP_ADMIN', true);
define('DOING_AJAX', true);
require __DIR__ . '/wp/wp-load.php';

echo "\n=======================================================\n";
echo "       VINACOS MEDIA & ACF VPS DIAGNOSTIC REPORT       \n";
echo "=======================================================\n\n";

// 1. PHP & Server Environment
echo "1. SERVER ENVIRONMENT:\n";
echo " - PHP Version: " . PHP_VERSION . "\n";
echo " - Server Software: " . ($_SERVER['SERVER_SOFTWARE'] ?? php_uname('s')) . "\n";
echo " - Current System User: " . (function_exists('posix_getpwuid') ? posix_getpwuid(posix_geteuid())['name'] : get_current_user()) . "\n";
echo " - Memory Limit: " . ini_get('memory_limit') . "\n";
echo " - Max Upload Size: " . ini_get('upload_max_filesize') . "\n";
echo " - Post Max Size: " . ini_get('post_max_size') . "\n\n";

// 2. Uploads Directory Check
echo "2. UPLOADS DIRECTORY:\n";
$upload_dir = wp_upload_dir();
echo " - Uploads Base Directory: " . $upload_dir['basedir'] . "\n";
echo " - Directory Exists: " . (file_exists($upload_dir['basedir']) ? 'YES' : 'NO') . "\n";
echo " - Directory Writable: " . (is_writable($upload_dir['basedir']) ? 'YES (Writable)' : 'NO (Read-only!)') . "\n";
$test_file = $upload_dir['basedir'] . '/.write_test_' . time();
$write_ok = @file_put_contents($test_file, 'test');
if ($write_ok) {
    echo " - Write Test: SUCCESS (File created and deleted)\n";
    @unlink($test_file);
} else {
    echo " - Write Test: FAILED (Cannot write test file to uploads!)\n";
}
echo "\n";

// 3. User Capabilities
echo "3. USER CAPABILITIES:\n";
$admin = get_user_by('login', 'quantri') ?: (get_users(['role' => 'administrator', 'number' => 1])[0] ?? null);
if ($admin) {
    wp_set_current_user($admin->ID);
    echo " - Logged in as: {$admin->user_login} (ID: {$admin->ID})\n";
    echo " - Role(s): " . implode(', ', $admin->roles) . "\n";
    echo " - Can upload_files: " . (current_user_can('upload_files') ? 'YES' : 'NO') . "\n";
    echo " - Can edit_posts: " . (current_user_can('edit_posts') ? 'YES' : 'NO') . "\n";
    echo " - Can manage_options: " . (current_user_can('manage_options') ? 'YES' : 'NO') . "\n";
} else {
    echo " - Administrator user NOT found!\n";
}
echo "\n";

// 4. Database Attachments
echo "4. DATABASE ATTACHMENTS:\n";
global $wpdb;
$total_attachments = (int) $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->posts} WHERE post_type = 'attachment'");
$image_attachments = (int) $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->posts} WHERE post_type = 'attachment' AND post_mime_type LIKE 'image/%'");
echo " - Total Attachments: $total_attachments\n";
echo " - Total Image Attachments: $image_attachments\n\n";

// 5. Query Attachments Emulation
echo "5. AJAX QUERY ATTACHMENTS TEST:\n";
$query_args = [
    'post_type'      => 'attachment',
    'post_status'    => 'inherit,private',
    'posts_per_page' => 10,
    'post_mime_type' => 'image',
    'paged'          => 1,
];
$query_args = apply_filters('ajax_query_attachments_args', $query_args);
echo " - Filtered Query Args: " . json_encode($query_args) . "\n";

$query = new WP_Query($query_args);
echo " - Query Found Posts: " . $query->found_posts . "\n";

$prepared_count = 0;
foreach ($query->posts as $post) {
    $prepared = wp_prepare_attachment_for_js($post);
    if ($prepared) {
        $prepared_count++;
        if ($prepared_count <= 3) {
            echo "   • [ID: {$post->ID}] {$post->post_title} -> {$prepared['url']}\n";
        }
    }
}
echo " - Prepared for JS Count: $prepared_count / " . count($query->posts) . "\n\n";

// 6. Media Scripts & L10n Data
echo "6. WORDPRESS MEDIA ASSETS & L10N REGISTRATION:\n";
if (function_exists('wp_enqueue_media')) {
    wp_enqueue_media();
}
global $wp_scripts, $wp_styles;
echo " - Script 'media-views' registered: " . (isset($wp_scripts->registered['media-views']) ? 'YES' : 'NO') . "\n";
echo " - Script 'wp-plupload' registered: " . (isset($wp_scripts->registered['wp-plupload']) ? 'YES' : 'NO') . "\n";
echo " - Script 'media-models' registered: " . (isset($wp_scripts->registered['media-models']) ? 'YES' : 'NO') . "\n";
echo " - Style 'media-views' registered: " . (isset($wp_styles->registered['media-views']) ? 'YES' : 'NO') . "\n";

$media_views_l10n = $wp_scripts->get_data('media-views', 'data');
echo " - _wpMediaViewsL10n Data String Length: " . strlen((string)$media_views_l10n) . " bytes\n";
echo "\n=======================================================\n";
echo "DIAGNOSTIC COMPLETE. All core components checked.\n";
echo "=======================================================\n";
