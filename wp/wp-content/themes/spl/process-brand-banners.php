<?php
/**
 * Process and resize Brand Banner images using imagecreatefromstring to exact 1920x600 banner dimensions.
 *
 * Usage: php -r "require 'wp/wp-load.php'; require 'wp/wp-content/themes/spl/process-brand-banners.php';"
 */

defined( 'ABSPATH' ) || exit;

echo "=== PROCESSING BRAND BANNERS TO EXACT 1920x600 DIMENSIONS ===\n";

$src_vi = 'C:/Users/MSI/.gemini/antigravity-ide/brain/7df3c5d1-c15c-4c54-8b46-66ffd70f1bcf/brand_banner_vi_wide_1785553993958.png';
$src_en = 'C:/Users/MSI/.gemini/antigravity-ide/brain/7df3c5d1-c15c-4c54-8b46-66ffd70f1bcf/brand_banner_en_wide_1785554006873.png';

$target_w = 1920;
$target_h = 600;

function create_exact_banner( $src_file, $dest_basename ) {
	global $target_w, $target_h;

	if ( ! file_exists( $src_file ) ) {
		echo "File not found: {$src_file}\n";
		return;
	}

	$theme_dir = get_template_directory();
	$dest_jpg_static = $theme_dir . '/static/img/banner/' . $dest_basename . '.jpg';
	$dest_png_static = $theme_dir . '/static/img/banner/' . $dest_basename . '.png';
	$dest_jpg_assets = $theme_dir . '/assets/img/banner/' . $dest_basename . '.jpg';
	$dest_png_assets = $theme_dir . '/assets/img/banner/' . $dest_basename . '.png';

	$content = file_get_contents( $src_file );
	$img_src = imagecreatefromstring( $content );
	if ( ! $img_src ) {
		echo "Failed to load source image: {$src_file}\n";
		return;
	}

	$src_w = imagesx( $img_src );
	$src_h = imagesy( $img_src );

	$canvas = imagecreatetruecolor( $target_w, $target_h );

	// Calculate cover crop coordinates
	$src_ratio = $src_w / $src_h;
	$target_ratio = $target_w / $target_h;

	if ( $src_ratio > $target_ratio ) {
		$crop_h = $src_h;
		$crop_w = (int) ( $src_h * $target_ratio );
		$crop_x = (int) ( ( $src_w - $crop_w ) / 2 );
		$crop_y = 0;
	} else {
		$crop_w = $src_w;
		$crop_h = (int) ( $src_w / $target_ratio );
		$crop_x = 0;
		$crop_y = (int) ( ( $src_h - $crop_h ) / 2 );
	}

	imagecopyresampled( $canvas, $img_src, 0, 0, $crop_x, $crop_y, $target_w, $target_h, $crop_w, $crop_h );

	// Save JPG and PNG
	imagejpeg( $canvas, $dest_jpg_static, 95 );
	imagejpeg( $canvas, $dest_jpg_assets, 95 );
	imagepng( $canvas, $dest_png_static, 6 );
	imagepng( $canvas, $dest_png_assets, 6 );

	imagedestroy( $img_src );
	imagedestroy( $canvas );

	echo "Saved exact 1920x600 banner: {$dest_basename} (.jpg & .png)\n";
}

create_exact_banner( $src_vi, 'brand-banner-vi' );
create_exact_banner( $src_en, 'brand-banner-en' );

echo "=== DONE PROCESSING BANNERS ===\n";
