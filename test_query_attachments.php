<?php
define('WP_USE_THEMES', false);
define('WP_ADMIN', true);
define('DOING_AJAX', true);
require __DIR__ . '/wp/wp-load.php';

// Set current user as admin
$admin_user = get_user_by('login', 'quantri') ?: get_users(['role' => 'administrator', 'number' => 1])[0] ?? null;
if ($admin_user) {
    wp_set_current_user($admin_user->ID);
}

$_REQUEST['action'] = 'query-attachments';
$_REQUEST['query'] = [
    'posts_per_page' => 10,
    'paged' => 1,
    'post_mime_type' => 'image',
    'post_type' => 'attachment',
    'post_status' => 'inherit'
];

echo "CAN UPLOAD FILES: " . (current_user_can('upload_files') ? 'YES' : 'NO') . "\n";

$query = new WP_Query([
    'post_type' => 'attachment',
    'post_status' => 'inherit,private',
    'posts_per_page' => 10,
    'post_mime_type' => 'image'
]);

echo "FOUND ATTACHMENTS: " . $query->found_posts . "\n";
foreach ($query->posts as $post) {
    $prepared = wp_prepare_attachment_for_js($post);
    echo " - ID: {$post->ID} | Title: {$post->post_title} | Prepared: " . ($prepared ? 'OK' : 'FAIL') . " | URL: " . ($prepared['url'] ?? 'none') . "\n";
}
