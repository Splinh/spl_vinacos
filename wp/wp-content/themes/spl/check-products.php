<?php
/**
 * Check EN products status and archive-product query behavior.
 *
 * Usage: php -r "require 'wp/wp-load.php'; require 'wp/wp-content/themes/spl/check-products.php';"
 */

defined( 'ABSPATH' ) || exit;

echo "=== CHECKING EN PRODUCTS & QUERY BEHAVIOR ===\n";

$en_ids = array( 1075, 1076, 1077, 1078, 1079, 1080, 1081, 1082, 1083, 1084, 1085, 1086, 1087, 1088, 1089, 1090, 1091, 1092, 1093, 1094, 1095, 1096, 1097, 1098 );

foreach ( $en_ids as $id ) {
	$p = get_post( $id );
	if ( $p ) {
		$lang = function_exists( 'pll_get_post_language' ) ? pll_get_post_language( $id ) : 'none';
		$cats = wp_get_post_terms( $id, 'product_cat', array( 'fields' => 'names' ) );
		echo sprintf(
			"ID: %d | Status: %s | Title: %s | Lang: %s | Categories: %s\n",
			$id,
			$p->post_status,
			$p->post_title,
			$lang,
			implode( ', ', $cats )
		);
	} else {
		echo "ID: {$id} NOT FOUND\n";
	}
}

// Test WP_Query for EN products
if ( function_exists( 'pll_current_language' ) ) {
	// Set Polylang language to 'en'
	Polylang()->curlang = Polylang()->model->get_language( 'en' );
}

$query = new WP_Query( array(
	'post_type'      => 'product',
	'post_status'    => 'publish',
	'posts_per_page' => 12,
	'lang'           => 'en',
) );

echo "\nWP_Query test for lang=en: Found " . count( $query->posts ) . " posts\n";
foreach ( $query->posts as $p ) {
	echo " -> ID {$p->ID}: {$p->post_title}\n";
}

echo "=== END TEST ===\n";
