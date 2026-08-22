<?php
define('WP_USE_THEMES', false);
define('WP_ADMIN', true);
require __DIR__ . '/wp/wp-load.php';

echo "=== DIAGNOSTIC REPORT ===\n";
echo "1. WordPress Version: " . get_bloginfo('version') . "\n";
echo "2. WP_HOME: " . get_option('home') . "\n";
echo "3. WP_SITEURL: " . get_option('siteurl') . "\n";

$upload_dir = wp_upload_dir();
echo "4. Upload Dir: " . $upload_dir['basedir'] . "\n";
echo "5. Upload Dir Exists: " . (file_exists($upload_dir['basedir']) ? 'YES' : 'NO') . "\n";
echo "6. Upload Dir Writable: " . (is_writable($upload_dir['basedir']) ? 'YES' : 'NO') . "\n";
echo "7. Upload URL: " . $upload_dir['baseurl'] . "\n";

$user = get_user_by('login', 'quantri');
if ($user) {
    echo "8. User quantri ID: " . $user->ID . "\n";
    echo "9. User quantri Roles: " . implode(', ', $user->roles) . "\n";
    wp_set_current_user($user->ID);
    echo "10. User Can upload_files: " . (current_user_can('upload_files') ? 'YES' : 'NO') . "\n";
    echo "11. User Can edit_theme_options: " . (current_user_can('edit_theme_options') ? 'YES' : 'NO') . "\n";
} else {
    echo "8. User quantri: NOT FOUND\n";
}

$attachments = get_posts([
    'post_type' => 'attachment',
    'posts_per_page' => 10,
    'post_status' => 'any'
]);
echo "12. Attachment Count in DB: " . count($attachments) . "\n";
foreach ($attachments as $att) {
    echo "   - [ID {$att->ID}] {$att->post_title} ({$att->post_mime_type})\n";
}

echo "=== END REPORT ===\n";
