<?php
/**
 * Check dimensions of images in static/img/banner/
 *
 * Usage: php -r "require 'wp/wp-load.php'; require 'wp/wp-content/themes/spl/check-image-sizes.php';"
 */

defined( 'ABSPATH' ) || exit;

$banner_dir = get_template_directory() . '/static/img/banner';
$files = glob( $banner_dir . '/*.*' );

echo "=== BANNER IMAGE DIMENSIONS ===\n";
foreach ( $files as $f ) {
	$info = @getimagesize( $f );
	if ( $info ) {
		echo sprintf( "%s => %dx%d (%s)\n", basename( $f ), $info[0], $info[1], $info['mime'] );
	}
}
echo "=== END ===\n";
