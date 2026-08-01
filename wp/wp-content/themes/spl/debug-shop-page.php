<?php
/**
 * Debug Shop / Products Page permalinks, Polylang mappings and WooCommerce options.
 *
 * Usage: php -r "require 'wp/wp-load.php'; require 'wp/wp-content/themes/spl/debug-shop-page.php';"
 */

defined( 'ABSPATH' ) || exit;

echo "=== DEBUG SHOP / PRODUCTS PAGES & POLYLANG MAPPING ===\n";

$wc_shop_page_id = get_option( 'woocommerce_shop_page_id' );
echo "WooCommerce Shop Page ID (option): {$wc_shop_page_id}\n";
if ( $wc_shop_page_id ) {
	$shop_p = get_post( $wc_shop_page_id );
	echo " -> Shop Page Title: " . ( $shop_p ? $shop_p->post_title : 'NULL' ) . " | Slug: " . ( $shop_p ? $shop_p->post_name : 'NULL' ) . "\n";
	echo " -> Shop Page Link: " . get_permalink( $wc_shop_page_id ) . "\n";
	if ( function_exists( 'pll_get_post_translations' ) ) {
		echo " -> Shop Page Translations: " . json_encode( pll_get_post_translations( $wc_shop_page_id ) ) . "\n";
	}
}

// Check 'san-pham-gia-cong-unila-viet-nam'
$vi_p = get_page_by_path( 'san-pham-gia-cong-unila-viet-nam', OBJECT, 'page' );
echo "\nVI Custom Page 'san-pham-gia-cong-unila-viet-nam': " . ( $vi_p ? "ID {$vi_p->ID}" : 'NOT FOUND' ) . "\n";
if ( $vi_p ) {
	echo " -> Link: " . get_permalink( $vi_p->ID ) . "\n";
	echo " -> Template: " . get_post_meta( $vi_p->ID, '_wp_page_template', true ) . "\n";
	if ( function_exists( 'pll_get_post_translations' ) ) {
		echo " -> Translations: " . json_encode( pll_get_post_translations( $vi_p->ID ) ) . "\n";
	}
}

// Check 'products' page
$en_p = get_page_by_path( 'products', OBJECT, 'page' );
echo "\nEN Custom Page 'products': " . ( $en_p ? "ID {$en_p->ID}" : 'NOT FOUND' ) . "\n";
if ( $en_p ) {
	echo " -> Link: " . get_permalink( $en_p->ID ) . "\n";
	echo " -> Template: " . get_post_meta( $en_p->ID, '_wp_page_template', true ) . "\n";
	if ( function_exists( 'pll_get_post_translations' ) ) {
		echo " -> Translations: " . json_encode( pll_get_post_translations( $en_p->ID ) ) . "\n";
	}
}

// Check all pages with 'product' or 'san-pham' in slug
$all_pages = get_posts( array(
	'post_type'   => 'page',
	'numberposts' => -1,
	'post_status' => 'any',
) );
echo "\nAll Pages in DB (" . count( $all_pages ) . "): \n";
foreach ( $all_pages as $p ) {
	$lang = function_exists( 'pll_get_post_language' ) ? pll_get_post_language( $p->ID ) : '';
	$tpl  = get_post_meta( $p->ID, '_wp_page_template', true );
	echo sprintf( " -> Page ID %d | Lang: %s | Slug: %s | Title: %s | Template: %s\n", $p->ID, $lang, $p->post_name, $p->post_title, $tpl );
}

echo "=== END DEBUG ===\n";
