<?php
/**
 * CLI Seeder — VINACOS catalog: Serum / Kem / Gel (VI <-> EN via Polylang).
 *
 * - Creates 3 product categories (VI + EN) and links them via Polylang.
 * - Creates 20 simple products (VI + EN), assigns categories, links translations.
 * - Idempotent & non-destructive: existing terms/products (matched by slug/title)
 *   are reused, never overwritten or deleted.
 *
 * Usage (from project root): php wp/wp-content/themes/spl/tools/seed-serum-kem-gel-catalog.php
 *
 * @package SPL
 */

if ( PHP_SAPI !== 'cli' ) {
	http_response_code( 403 );
	exit;
}

require_once dirname( __DIR__, 4 ) . '/wp-load.php';

if ( ! class_exists( 'WC_Product_Simple' ) ) {
	fwrite( STDERR, "ERROR: WooCommerce is not active.\n" );
	exit( 1 );
}

$has_pll = function_exists( 'pll_set_term_language' ) && function_exists( 'pll_save_post_translations' );
if ( ! $has_pll ) {
	echo "WARNING: Polylang not active — creating VI data only.\n";
}

/**
 * Category map: key => [ vi_name, vi_slug, en_name, en_slug ].
 */
$categories = array(
	'serum' => array( 'Serum', 'serum', 'Serums', 'serums' ),
	'kem'   => array( 'Kem', 'kem', 'Creams', 'creams' ),
	'gel'   => array( 'Gel', 'gel', 'Gels & Cleansers', 'gels-cleansers' ),
);

/**
 * Products: [ category key, VI title, EN title ].
 */
$products = array(
	array( 'serum', 'Serum Mụn', 'Acne Serum' ),
	array( 'serum', 'Serum Phục Hồi', 'Repair Serum' ),
	array( 'serum', 'Serum Tảo Enzyme', 'Algae Enzyme Serum' ),
	array( 'serum', 'Serum Trị Sẹo', 'Scar Treatment Serum' ),
	array( 'serum', 'Serum Tan Nám', 'Melasma Fading Serum' ),
	array( 'serum', 'Serum Tế Bào Gốc', 'Stem Cell Serum' ),
	array( 'serum', 'Tinh Chất Phục Hồi', 'Repair Essence' ),

	array( 'kem', 'Kem Chấm Nám Chuyên Sâu', 'Intensive Melasma Spot Cream' ),
	array( 'kem', 'Kem Ức Chế Nám', 'Melasma Inhibiting Cream' ),
	array( 'kem', 'Bộ Làm Mờ Nám', 'Melasma Fading Set' ),
	array( 'kem', 'Bộ Kem Nám Da - Tăng Sắc Tố', 'Melasma & Hyperpigmentation Cream Set' ),
	array( 'kem', 'Kem Nám Đêm', 'Night Melasma Cream' ),
	array( 'kem', 'Kem Dưỡng Phục Hồi', 'Repair Moisturizing Cream' ),
	array( 'kem', 'Kem Sẹo Đa Năng', 'Multi-Purpose Scar Cream' ),
	array( 'kem', 'Kem Thải Độc Đông Y', 'Herbal Detox Cream' ),
	array( 'kem', 'Kem Bạch Ngọc', 'Pearl White Brightening Cream' ),
	array( 'kem', 'Kem Chống Nắng', 'Sunscreen Cream' ),
	array( 'kem', 'Kem Dưỡng Trắng', 'Whitening Cream' ),

	array( 'gel', 'Gel Rửa Mặt', 'Facial Cleansing Gel' ),
	array( 'gel', 'Sữa Rửa Mặt Bạc Hà', 'Mint Facial Cleanser' ),
);

/**
 * Find or create a product_cat term by slug. Returns term ID or 0.
 */
function spl_seed_ensure_term( string $name, string $slug, string $lang, bool $has_pll ): int {
	$found = term_exists( $slug, 'product_cat' );
	if ( $found ) {
		$term_id = (int) ( is_array( $found ) ? $found['term_id'] : $found );
		echo "  = term '{$name}' exists (#{$term_id})\n";
	} else {
		$res = wp_insert_term( $name, 'product_cat', array( 'slug' => $slug ) );
		if ( is_wp_error( $res ) ) {
			echo "  ! term '{$name}' failed: {$res->get_error_message()}\n";
			return 0;
		}
		$term_id = (int) $res['term_id'];
		echo "  + term '{$name}' created (#{$term_id})\n";
	}

	// Polylang auto-assigns the default language on insert; force target lang
	// only for orphan terms (not yet part of a translation group).
	if ( $has_pll && pll_get_term_language( $term_id ) !== $lang && count( pll_get_term_translations( $term_id ) ) <= 1 ) {
		pll_set_term_language( $term_id, $lang );
	}

	return $term_id;
}

/**
 * Find a non-trashed product by exact title (raw or kses-encoded '&'). Returns post ID or 0.
 */
function spl_seed_find_product( string $title ): int {
	global $wpdb;

	return (int) $wpdb->get_var(
		$wpdb->prepare(
			"SELECT ID FROM {$wpdb->posts}
			 WHERE post_type = 'product' AND post_title IN ( %s, %s )
			   AND post_status NOT IN ( 'trash', 'auto-draft' )
			 ORDER BY ID ASC LIMIT 1",
			$title,
			str_replace( '&', '&amp;', $title )
		)
	);
}

/**
 * Ensure product has its own-language category and not the other-language counterpart.
 * Other categories on the product are left untouched.
 */
function spl_seed_fix_product_cat( int $product_id, int $keep_term, int $drop_term ): void {
	if ( ! $product_id || ! $keep_term ) {
		return;
	}
	wp_set_post_terms( $product_id, array( $keep_term ), 'product_cat', true );
	if ( $drop_term && has_term( $drop_term, 'product_cat', $product_id ) ) {
		wp_remove_object_terms( $product_id, $drop_term, 'product_cat' );
	}
}

/**
 * Find or create a simple product; appends the category without touching other data.
 */
function spl_seed_ensure_product( string $title, int $cat_id, string $lang, bool $has_pll ): int {
	$product_id = spl_seed_find_product( $title );

	if ( $product_id ) {
		if ( $cat_id ) {
			wp_set_post_terms( $product_id, array( $cat_id ), 'product_cat', true );
		}
		echo "  = product '{$title}' exists (#{$product_id})\n";
	} else {
		$product = new WC_Product_Simple();
		$product->set_name( $title );
		$product->set_status( 'publish' );
		$product->set_catalog_visibility( 'visible' );
		$product->set_stock_status( 'instock' );
		if ( $cat_id ) {
			$product->set_category_ids( array( $cat_id ) );
		}
		$product_id = (int) $product->save();
		echo "  + product '{$title}' created (#{$product_id})\n";
	}

	if ( $has_pll && $product_id && pll_get_post_language( $product_id ) !== $lang && count( pll_get_post_translations( $product_id ) ) <= 1 ) {
		pll_set_post_language( $product_id, $lang );
	}

	return $product_id;
}

echo "=== VINACOS SEED: SERUM / KEM / GEL ===\n\n";

// 1. Categories.
echo "[1] Categories\n";
$term_ids = array();
foreach ( $categories as $key => [ $vi_name, $vi_slug, $en_name, $en_slug ] ) {
	$vi_id = spl_seed_ensure_term( $vi_name, $vi_slug, 'vi', $has_pll );
	$en_id = $has_pll ? spl_seed_ensure_term( $en_name, $en_slug, 'en', $has_pll ) : 0;

	if ( $has_pll && $vi_id && $en_id ) {
		pll_save_term_translations( array( 'vi' => $vi_id, 'en' => $en_id ) );
	}

	$term_ids[ $key ] = array( 'vi' => $vi_id, 'en' => $en_id );
}

// 2. Products.
echo "\n[2] Products\n";
$created = 0;
foreach ( $products as [ $cat_key, $vi_title, $en_title ] ) {
	$before = spl_seed_find_product( $vi_title );
	$vi_id  = spl_seed_ensure_product( $vi_title, $term_ids[ $cat_key ]['vi'], 'vi', $has_pll );
	$created += $before ? 0 : 1;

	if ( ! $has_pll || ! $vi_id ) {
		continue;
	}

	$en_id = spl_seed_ensure_product( $en_title, $term_ids[ $cat_key ]['en'], 'en', $has_pll );
	if ( $en_id ) {
		pll_save_post_translations( array( 'vi' => $vi_id, 'en' => $en_id ) );

		// Polylang taxonomy sync may copy terms across languages; enforce per language.
		spl_seed_fix_product_cat( $vi_id, $term_ids[ $cat_key ]['vi'], $term_ids[ $cat_key ]['en'] );
		spl_seed_fix_product_cat( $en_id, $term_ids[ $cat_key ]['en'], $term_ids[ $cat_key ]['vi'] );
	}
}

// 3. Caches.
delete_transient( 'spl_product_cats_top' );
delete_option( 'spl_product_cats_top' );
if ( function_exists( 'wc_delete_product_transients' ) ) {
	wc_delete_product_transients();
}
wp_cache_flush();

echo "\nDONE. New VI products: {$created}/" . count( $products ) . "\n";
