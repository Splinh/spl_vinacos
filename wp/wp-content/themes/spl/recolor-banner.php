<?php
/**
 * Color-shift the original WEB-BIA.jpg banner from crimson red to navy blue,
 * keeping all text, geometric patterns, and layout intact.
 *
 * Usage: php -r "require 'wp/wp-load.php'; require 'wp/wp-content/themes/spl/recolor-banner.php';"
 */

defined( 'ABSPATH' ) || exit;

echo "=== RECOLORING WEB-BIA.jpg: RED → NAVY BLUE ===\n";

$theme_dir = get_template_directory();
$src_file  = $theme_dir . '/static/img/banner/WEB-BIA.jpg';

if ( ! file_exists( $src_file ) ) {
	echo "ERROR: WEB-BIA.jpg not found!\n";
	return;
}

$img = imagecreatefromjpeg( $src_file );
if ( ! $img ) {
	echo "ERROR: Failed to load WEB-BIA.jpg\n";
	return;
}

$w = imagesx( $img );
$h = imagesy( $img );
echo "Source: {$w}x{$h}\n";

/**
 * Convert RGB to HSL.
 */
function rgb_to_hsl( int $r, int $g, int $b ): array {
	$r /= 255; $g /= 255; $b /= 255;
	$max = max( $r, $g, $b );
	$min = min( $r, $g, $b );
	$l   = ( $max + $min ) / 2;
	if ( $max === $min ) {
		return array( 0, 0, $l );
	}
	$d = $max - $min;
	$s = $l > 0.5 ? $d / ( 2 - $max - $min ) : $d / ( $max + $min );
	if ( $max === $r ) {
		$h = ( $g - $b ) / $d + ( $g < $b ? 6 : 0 );
	} elseif ( $max === $g ) {
		$h = ( $b - $r ) / $d + 2;
	} else {
		$h = ( $r - $g ) / $d + 4;
	}
	$h /= 6;
	return array( $h, $s, $l );
}

/**
 * Convert HSL to RGB.
 */
function hsl_to_rgb( float $h, float $s, float $l ): array {
	if ( $s == 0 ) {
		$v = (int) round( $l * 255 );
		return array( $v, $v, $v );
	}
	$q = $l < 0.5 ? $l * ( 1 + $s ) : $l + $s - $l * $s;
	$p = 2 * $l - $q;
	$r = hue_to_rgb( $p, $q, $h + 1 / 3 );
	$g = hue_to_rgb( $p, $q, $h );
	$b = hue_to_rgb( $p, $q, $h - 1 / 3 );
	return array(
		(int) round( $r * 255 ),
		(int) round( $g * 255 ),
		(int) round( $b * 255 ),
	);
}

function hue_to_rgb( float $p, float $q, float $t ): float {
	if ( $t < 0 ) $t += 1;
	if ( $t > 1 ) $t -= 1;
	if ( $t < 1 / 6 ) return $p + ( $q - $p ) * 6 * $t;
	if ( $t < 1 / 2 ) return $q;
	if ( $t < 2 / 3 ) return $p + ( $q - $p ) * ( 2 / 3 - $t ) * 6;
	return $p;
}

// Target navy blue hue: ~220° = 220/360 ≈ 0.611
$target_hue = 220 / 360;

for ( $y = 0; $y < $h; $y++ ) {
	for ( $x = 0; $x < $w; $x++ ) {
		$rgb = imagecolorat( $img, $x, $y );
		$r   = ( $rgb >> 16 ) & 0xFF;
		$g   = ( $rgb >> 8 ) & 0xFF;
		$b   = $rgb & 0xFF;

		list( $hue, $sat, $lum ) = rgb_to_hsl( $r, $g, $b );

		// Convert hue from 0-1 to degrees 0-360
		$hue_deg = $hue * 360;

		// Shift red-ish hues (roughly 330°-30° range) to navy blue
		// Also catch dark reds / maroons which might have low saturation
		$is_reddish = ( $hue_deg >= 330 || $hue_deg <= 30 ) && $sat > 0.10;

		if ( $is_reddish ) {
			// Shift hue to navy blue, slightly reduce saturation for natural look
			$new_hue = $target_hue;
			$new_sat = min( $sat * 0.7, 0.6 ); // Desaturate slightly for navy tone
			$new_lum = $lum * 0.85; // Slightly darken for deeper navy

			list( $nr, $ng, $nb ) = hsl_to_rgb( $new_hue, $new_sat, $new_lum );
			$new_color = imagecolorallocate( $img, $nr, $ng, $nb );
			imagesetpixel( $img, $x, $y, $new_color );
		}
		// Non-red pixels (white text, blue shapes, etc.) remain unchanged
	}
}

// Save VI version (original text is Vietnamese)
$dest_vi_jpg = $theme_dir . '/static/img/banner/brand-banner-vi.jpg';
$dest_vi_png = $theme_dir . '/static/img/banner/brand-banner-vi.png';
$dest_vi_jpg_a = $theme_dir . '/assets/img/banner/brand-banner-vi.jpg';
$dest_vi_png_a = $theme_dir . '/assets/img/banner/brand-banner-vi.png';

imagejpeg( $img, $dest_vi_jpg, 95 );
imagejpeg( $img, $dest_vi_jpg_a, 95 );
imagepng( $img, $dest_vi_png, 6 );
imagepng( $img, $dest_vi_png_a, 6 );

echo "Saved brand-banner-vi (.jpg & .png) — {$w}x{$h}\n";

// For EN version, we need to use the same recolored background
// Copy VI as EN for now (same design, text overlay via CSS if needed)
imagejpeg( $img, $theme_dir . '/static/img/banner/brand-banner-en.jpg', 95 );
imagejpeg( $img, $theme_dir . '/assets/img/banner/brand-banner-en.jpg', 95 );
imagepng( $img, $theme_dir . '/static/img/banner/brand-banner-en.png', 6 );
imagepng( $img, $theme_dir . '/assets/img/banner/brand-banner-en.png', 6 );

echo "Saved brand-banner-en (.jpg & .png) — {$w}x{$h}\n";

imagedestroy( $img );

echo "=== DONE: Original design preserved, only color shifted RED → NAVY BLUE ===\n";
