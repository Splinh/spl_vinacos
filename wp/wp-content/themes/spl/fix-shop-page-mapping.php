<?php
/**
 * Fix WooCommerce Shop Page Option & Polylang Translations Mapping.
 *
 * Usage: php -r "require 'wp/wp-load.php'; require 'wp/wp-content/themes/spl/fix-shop-page-mapping.php';"
 */

defined( 'ABSPATH' ) || exit;

echo "=== FIXING WOOCOMMERCE SHOP PAGE & POLYLANG MAPPING ===\n";

$vi_page = get_page_by_path( 'san-pham-gia-cong-unila-viet-nam', OBJECT, 'page' );
$en_page = get_page_by_path( 'products', OBJECT, 'page' );

if ( ! $vi_page ) {
	echo "ERROR: VI product page 'san-pham-gia-cong-unila-viet-nam' not found!\n";
	return;
}

$vi_id = $vi_page->ID;

// Create EN page if missing
if ( ! $en_page ) {
	$en_id = wp_insert_post( array(
		'post_title'   => 'Cosmetics Products Portfolio',
		'post_name'    => 'products',
		'post_status'  => 'publish',
		'post_type'    => 'page',
		'post_content' => 'VINACOS Cosmetics Products Portfolio',
	) );
	echo "Created EN page ID {$en_id}\n";
} else {
	$en_id = $en_page->ID;
	echo "Found EN page ID {$en_id}\n";
}

// Update templates
update_post_meta( $vi_id, '_wp_page_template', 'archive-product.php' );
update_post_meta( $en_id, '_wp_page_template', 'archive-product.php' );

// Set languages
if ( function_exists( 'pll_set_post_language' ) ) {
	pll_set_post_language( $vi_id, 'vi' );
	pll_set_post_language( $en_id, 'en' );
}

// Save Polylang post translations
if ( function_exists( 'pll_save_post_translations' ) ) {
	pll_save_post_translations( array(
		'vi' => $vi_id,
		'en' => $en_id,
	) );
	echo "LINKED POLYLANG SHOP PAGES: VI ({$vi_id}) <-> EN ({$en_id})\n";
}

// Set woocommerce_shop_page_id to $vi_id
update_option( 'woocommerce_shop_page_id', $vi_id );
echo "Updated woocommerce_shop_page_id to {$vi_id}\n";

// Flush rewrite rules
flush_rewrite_rules();
echo "Flushed rewrite rules.\n";

echo "=== SHOP PAGE FIX COMPLETE ===\n";
