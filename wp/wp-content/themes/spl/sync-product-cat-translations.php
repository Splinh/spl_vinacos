<?php
/**
 * Sync Product Categories for English Products.
 *
 * Usage: php -r "require 'wp/wp-load.php'; require 'wp/wp-content/themes/spl/sync-product-cat-translations.php';"
 */

defined( 'ABSPATH' ) || exit;

echo "=== SYNCING PRODUCT CATEGORIES FOR EN PRODUCTS ===\n";

// Ensure full taxonomy translations seeder is run
require_once __DIR__ . '/populate-full-taxonomy-translations.php';

$vi_products = get_posts( array(
	'post_type'   => 'product',
	'numberposts' => -1,
	'lang'        => 'vi',
	'post_status' => 'publish',
) );

echo "Processing " . count( $vi_products ) . " VI products...\n";

foreach ( $vi_products as $vi_p ) {
	$translations = function_exists( 'pll_get_post_translations' ) ? pll_get_post_translations( $vi_p->ID ) : array();
	$en_id = $translations['en'] ?? 0;

	if ( ! $en_id ) {
		continue;
	}

	// Get VI product_cat terms
	$vi_terms = wp_get_post_terms( $vi_p->ID, 'product_cat' );
	$en_term_ids = array();

	foreach ( $vi_terms as $term ) {
		$term_translations = function_exists( 'pll_get_term_translations' ) ? pll_get_term_translations( $term->term_id ) : array();
		$en_term_id = $term_translations['en'] ?? 0;

		if ( $en_term_id ) {
			$en_term_ids[] = (int) $en_term_id;
		}
	}

	if ( ! empty( $en_term_ids ) ) {
		wp_set_post_terms( $en_id, $en_term_ids, 'product_cat' );
		echo sprintf( "Product VI %d <-> EN %d: set product_cat term IDs [%s]\n", $vi_p->ID, $en_id, implode( ', ', $en_term_ids ) );
	}
}

echo "=== DONE SYNCING PRODUCT CATEGORIES ===\n";
