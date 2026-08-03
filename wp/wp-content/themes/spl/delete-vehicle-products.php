<?php
/**
 * CLI Tool — Delete all vehicle & non-VINACOS products and categories from WordPress DB.
 *
 * Usage: php wp/wp-content/themes/spl/delete-vehicle-products.php
 *
 * @package SPL
 */

if ( ! defined( 'ABSPATH' ) ) {
	$wp_load_paths = array(
		__DIR__ . '/../../../wp-load.php',
		__DIR__ . '/../../../../wp-load.php',
		dirname( __DIR__, 3 ) . '/wp-load.php',
		dirname( __DIR__, 2 ) . '/wp-load.php',
	);
	foreach ( $wp_load_paths as $path ) {
		if ( file_exists( $path ) ) {
			require_once $path;
			break;
		}
	}
}

if ( ! defined( 'ABSPATH' ) ) {
	die( "ERROR: Could not locate wp-load.php!\n" );
}

echo "=== DELETE ALL VEHICLE PRODUCTS & CATEGORIES ===\n";

// 1. Delete vehicle product categories
$vehicle_cat_slugs = array(
	'xe-50cc', 'xe-dien', 'xe-may-dien', 'xe-ba-gac-dien', 'xe-ba-gac-dien-bluera',
	'xe-dap-dien', 'xe-dap-dien-ai-ebike', 'san-pham-moi', 'giam-gia-dac-biet',
	'special-offers', 'new-arrivals', 'xe-3-banh', 'phu-kien',
);

$deleted_cats = 0;
foreach ( $vehicle_cat_slugs as $slug ) {
	$term = get_term_by( 'slug', $slug, 'product_cat' );
	if ( $term && ! is_wp_error( $term ) ) {
		wp_delete_term( $term->term_id, 'product_cat' );
		$deleted_cats++;
		echo "Deleted product_cat: '{$slug}' (ID: {$term->term_id})\n";
	}
}

// 2. Delete vehicle products by title keywords or category association
$all_products = get_posts( array(
	'post_type'   => 'product',
	'numberposts' => -1,
	'lang'        => '',
	'post_status' => 'any',
) );

$delete_keywords = array(
	'xe', '50cc', 'ba gác', 'đẩy', 'đạp', 'máy điện', 'vespa', 'vinfast',
	'dibao', 'yadea', 'aie', 'bluera', 'pega', 'xmen', 'crea', 'halim',
	'giant', 'eagle', 'rocket', 'lumi', 'scooter', 'bike', 'motor',
);

$deleted_prods = 0;
foreach ( $all_products as $p ) {
	$title_lower = mb_strtolower( $p->post_title );
	$should_delete = false;

	foreach ( $delete_keywords as $kw ) {
		if ( false !== mb_strpos( $title_lower, $kw ) ) {
			$should_delete = true;
			break;
		}
	}

	if ( $should_delete ) {
		// Delete featured image if exclusive
		$thumb_id = get_post_thumbnail_id( $p->ID );
		if ( $thumb_id ) {
			wp_delete_attachment( $thumb_id, true );
		}

		wp_delete_post( $p->ID, true );
		$deleted_prods++;
		echo "Permanently deleted vehicle product: '{$p->post_title}' (ID: {$p->ID})\n";
	}
}

delete_transient( 'spl_product_cats_top' );
delete_option( 'spl_product_cats_top' );
flush_rewrite_rules();
wp_cache_flush();

echo "\nCompleted: Deleted {$deleted_cats} categories and {$deleted_prods} vehicle products.\n";
