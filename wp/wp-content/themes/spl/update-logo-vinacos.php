<?php
/**
 * Update logo script for VINACOS.
 * Run via CLI: php update-logo-vinacos.php
 */

define( 'WP_USE_THEMES', false );
require_once __DIR__ . '/../../../wp-load.php';
require_once ABSPATH . 'wp-admin/includes/image.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/media.php';

$logo_path = 'd:/laragon/www/vinacos/logo.png';

if ( ! file_exists( $logo_path ) ) {
	echo "Logo file not found at $logo_path\n";
	exit(1);
}

// Check if attachment already exists or create new
$file_array = [
	'name'     => 'logo-vinacos.png',
	'tmp_name' => $logo_path,
];

// Copy to temp for sideload
$tmp = wp_tempnam( 'logo-vinacos' );
copy( $logo_path, $tmp );

$file_array = [
	'name'     => 'logo-vinacos.png',
	'tmp_name' => $tmp,
];

$attachment_id = media_handle_sideload( $file_array, 0, 'Logo VINACOS' );

if ( is_wp_error( $attachment_id ) ) {
	echo 'Error importing logo: ' . $attachment_id->get_error_message() . "\n";
	@unlink( $tmp );
	exit(1);
}

// Set theme mod custom_logo
set_theme_mod( 'custom_logo', $attachment_id );
update_option( 'site_logo', $attachment_id );

echo "Successfully updated VINACOS custom_logo option to Attachment ID: {$attachment_id}\n";
echo "Theme static logo files synced to static/img/logo.png and assets/img/logo.png\n";
