<?php
/**
 * High quality GD script to generate 1920x500 brand banner images matching exact brand design.
 *
 * Usage: php -r "require 'wp/wp-load.php'; require 'wp/wp-content/themes/spl/generate-brand-banner-gd.php';"
 */

defined( 'ABSPATH' ) || exit;

echo "=== GENERATING CRISP 1920x500 BRAND BANNERS WITH GD ===\n";

$width  = 1920;
$height = 520;

// Try finding system font
$font_bold  = 'C:/Windows/Fonts/arialbd.ttf';
$font_reg   = 'C:/Windows/Fonts/arial.ttf';
if ( ! file_exists( $font_bold ) ) {
	$font_bold = 'C:/Windows/Fonts/tahomabd.ttf';
	$font_reg  = 'C:/Windows/Fonts/tahoma.ttf';
}

function draw_brand_banner( $dest_filename, $subtitle, $title_line1, $title_line2 = '' ) {
	global $width, $height, $font_bold, $font_reg;

	$im = imagecreatetruecolor( $width, $height );

	// Gradient background
	for ( $y = 0; $y < $height; $y++ ) {
		$r = (int) ( 144 - ( $y / $height ) * 35 );
		$g = 0;
		$b = (int) ( 10 - ( $y / $height ) * 5 );
		$color = imagecolorallocate( $im, max(0, $r), max(0, $g), max(0, $b) );
		imageline( $im, 0, $y, $width, $y, $color );
	}

	// Colors
	$white     = imagecolorallocate( $im, 255, 255, 255 );
	$blue      = imagecolorallocate( $im, 0, 60, 180 );
	$terracotta= imagecolorallocate( $im, 160, 60, 30 );
	$dark_blue = imagecolorallocate( $im, 0, 35, 120 );

	// 1. Draw Corner Decorative Patterns
	// Top-Left corner shapes
	imagefilledellipse( $im, 40, 40, 60, 60, $blue );
	imagefilledellipse( $im, 40, 40, 30, 30, $white );
	imagefilledrectangle( $im, 80, 20, 140, 80, $dark_blue );
	imagefilledellipse( $im, 110, 50, 40, 40, $terracotta );
	imagefilledrectangle( $im, 150, 20, 210, 80, $blue );

	// Top-Right corner shapes
	imagefilledrectangle( $im, $width - 210, 20, $width - 150, 80, $blue );
	imagefilledellipse( $im, $width - 110, 50, 40, 40, $terracotta );
	imagefilledrectangle( $im, $width - 140, 20, $width - 80, 80, $dark_blue );
	imagefilledellipse( $im, $width - 40, 40, 60, 60, $blue );
	imagefilledellipse( $im, $width - 40, 40, 30, 30, $white );

	// Bottom-Left corner shapes
	imagefilledrectangle( $im, 10, $height - 90, 70, $height - 10, $blue );
	imagefilledellipse( $im, 40, $height - 50, 30, 30, $white );
	imagefilledrectangle( $im, 80, $height - 90, 140, $height - 10, $terracotta );
	imagefilledellipse( $im, 110, $height - 50, 40, 40, $dark_blue );
	imagefilledrectangle( $im, 150, $height - 90, 210, $height - 10, $blue );

	// Bottom-Right corner shapes
	imagefilledrectangle( $im, $width - 210, $height - 90, $width - 150, $height - 10, $blue );
	imagefilledrectangle( $im, $width - 140, $height - 90, $width - 80, $height - 10, $terracotta );
	imagefilledellipse( $im, $width - 110, $height - 50, 40, 40, $dark_blue );
	imagefilledrectangle( $im, $width - 70, $height - 90, $width - 10, $height - 10, $blue );
	imagefilledellipse( $im, $width - 40, $height - 50, 30, 30, $white );

	// 2. Draw Center Text
	// Subtitle
	$sub_size = 20;
	$sub_box  = imagettfbbox( $sub_size, 0, $font_reg, $subtitle );
	$sub_w    = abs( $sub_box[4] - $sub_box[0] );
	$sub_x    = (int) ( ( $width - $sub_w ) / 2 );
	$sub_y    = (int) ( $height / 2 - 40 );

	imagettftext( $im, $sub_size, 0, $sub_x, $sub_y, $white, $font_reg, $subtitle );

	// Main Title Line 1
	$title_size = 46;
	$t1_box  = imagettfbbox( $title_size, 0, $font_bold, $title_line1 );
	$t1_w    = abs( $t1_box[4] - $t1_box[0] );
	$t1_x    = (int) ( ( $width - $t1_w ) / 2 );
	$t1_y    = $title_line2 ? (int) ( $height / 2 + 30 ) : (int) ( $height / 2 + 45 );

	imagettftext( $im, $title_size, 0, $t1_x, $t1_y, $white, $font_bold, $title_line1 );

	// Main Title Line 2 (if any)
	if ( $title_line2 ) {
		$t2_box  = imagettfbbox( $title_size, 0, $font_bold, $title_line2 );
		$t2_w    = abs( $t2_box[4] - $t2_box[0] );
		$t2_x    = (int) ( ( $width - $t2_w ) / 2 );
		$t2_y    = (int) ( $height / 2 + 95 );

		imagettftext( $im, $title_size, 0, $t2_x, $t2_y, $white, $font_bold, $title_line2 );
	}

	$theme_dir = get_template_directory();
	$dest_jpg_static = $theme_dir . '/static/img/banner/' . $dest_filename . '.jpg';
	$dest_png_static = $theme_dir . '/static/img/banner/' . $dest_filename . '.png';
	$dest_jpg_assets = $theme_dir . '/assets/img/banner/' . $dest_filename . '.jpg';
	$dest_png_assets = $theme_dir . '/assets/img/banner/' . $dest_filename . '.png';

	imagejpeg( $im, $dest_jpg_static, 95 );
	imagejpeg( $im, $dest_jpg_assets, 95 );
	imagepng( $im, $dest_png_static, 6 );
	imagepng( $im, $dest_png_assets, 6 );

	imagedestroy( $im );
	echo "Generated banner: {$dest_filename} (1920x520)\n";
}

draw_brand_banner( 'brand-banner-vi', 'HANH DONG VI MOT KY NGUYEN MY PHAM SACH', 'TU NGUON LUC VIET' );
draw_brand_banner( 'brand-banner-en', 'ACTING FOR AN ERA OF CLEAN COSMETICS', 'POWERED BY VIETNAMESE RESOURCES' );

echo "=== DONE GENERATING CRISP BANNERS ===\n";
