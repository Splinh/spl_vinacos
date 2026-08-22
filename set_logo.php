<?php
define('WP_USE_THEMES', false);
define('WP_ADMIN', true);
require __DIR__ . '/wp/wp-load.php';

global $wpdb;
$attachment_id = $wpdb->get_var("SELECT ID FROM {$wpdb->posts} WHERE post_type = 'attachment' AND (post_title LIKE '%logo%' OR guid LIKE '%logo%') ORDER BY ID DESC LIMIT 1");

if ($attachment_id) {
    update_option('options_logo', (int)$attachment_id);
    set_theme_mod('custom_logo', (int)$attachment_id);
    $url = wp_get_attachment_image_url($attachment_id, 'full');
    echo "SUCCESS: Logo has been set to Attachment [ID $attachment_id] URL: $url\n";
} else {
    echo "ERROR: No logo attachment found in DB.\n";
}
