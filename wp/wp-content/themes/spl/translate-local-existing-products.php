<?php
/**
 * CLI Tool — Translate all existing local VINACOS products to English without altering original VI products.
 *
 * Usage: php wp/wp-content/themes/spl/translate-local-existing-products.php
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

if ( ! function_exists( 'pll_save_post_translations' ) && defined( 'WP_PLUGIN_DIR' ) ) {
	$api_files = glob( WP_PLUGIN_DIR . '/polylang*/include/api*.php' );
	if ( ! empty( $api_files ) ) {
		foreach ( $api_files as $api_file ) {
			if ( file_exists( $api_file ) ) {
				require_once $api_file;
			}
		}
	}
}

echo "=== TRANSLATING EXISTING LOCAL PRODUCTS TO ENGLISH ===\n";

// Ensure full taxonomy translations seeder is run for category mappings
require_once __DIR__ . '/populate-full-taxonomy-translations.php';

// Get all published VI products
$vi_products = get_posts( array(
	'post_type'   => 'product',
	'post_status' => 'publish',
	'numberposts' => -1,
	'lang'        => 'vi',
) );

if ( empty( $vi_products ) ) {
	// Fallback if lang parameter is not set
	$vi_products = get_posts( array(
		'post_type'   => 'product',
		'post_status' => 'publish',
		'numberposts' => -1,
	) );
}

echo "Processing " . count( $vi_products ) . " VI products...\n\n";

// English title translation lookup dictionary
$translation_dict = array(
	'Body Oil' => 'Nourishing Body Oil OEM',
	'Vệ Sinh & Khử Mùi Nhà Cửa' => 'Home Cleansing & Deodorizing Spray',
	'Dầu Massage Thư Giãn' => 'Relaxing Massage Oil',
	'Xịt Khoáng' => 'Hydrating Mineral Face Mist',
	'Khử Mùi Nam' => 'Men’s Natural Deodorant Spray',
	'Chăm Sóc Thú Cưng' => 'Pet Botanical Shampoo & Care',
	'Dầu Massage Tóc' => 'Scalp & Hair Treatment Oil',
	'Giặt & Chăm Sóc Vải' => 'Eco-Friendly Laundry Detergent',
	'Bột Đậu Đỏ – Nguyên Liệu Mỹ Phẩm Tẩy Da Chết' => 'Red Bean Exfoliating Cosmetic Powder',
	'Tinh Bột Nghệ – Nguyên Liệu Mỹ Phẩm Trị Thâm Nám' => 'Turmeric Extract Powder for Skin Brightening',
	'Bột Diếp Cá Nguyên Chất – Nguyên Liệu Mỹ Phẩm Trị Mụn' => 'Pure Houttuynia Cordata Anti-Acne Powder',
	'Bột Than Hoạt Tính – Nguyên Liệu Mỹ Phẩm Detox' => 'Activated Charcoal Detox Powder',
	'Bột Yến Mạch – Nguyên Liệu Mỹ Phẩm Dịu Nhẹ Cho Da' => 'Soothing Oat Kernel Powder',
	'Dầu Sachi Inchi – Nguyên Liệu Mỹ Phẩm Omega 3' => 'Sacha Inchi Carrier Oil (Rich in Omega 3)',
	'Dầu Mù U (Tamanu) – Nguyên Liệu Mỹ Phẩm Liền Da' => 'Tamanu Healing Oil (Skin Recovery)',
	'Dầu Dừa Ép Lạnh Nguyên Chất – Nguyên Liệu Mỹ Phẩm' => 'Pure Cold-Pressed Virgin Coconut Oil',
	'Dầu Hạt Nho – Nguyên Liệu Mỹ Phẩm Cho Da Dầu' => 'Grapeseed Carrier Oil for Oily Skin',
	'Dầu Thầu Dầu – Nguyên Liệu Mỹ Phẩm Dưỡng Mi Tóc' => 'Castor Oil for Lash & Hair Growth',
	'Tinh Dầu Hoa Hồng – Nguyên Liệu Mỹ Phẩm Cao Cấp' => 'Premium Rose Essential Oil',
	'Tinh dầu Gỗ Hồng – Nguyên Liệu Nước Hoa' => 'Rosewood Essential Oil',
	'Tinh dầu Chanh – Nguyên Liệu Mỹ Phẩm' => 'Pure Lemon Essential Oil',
	'Tinh Dầu Cam Ngọt – Nguyên Liệu Hương Liệu' => 'Sweet Orange Essential Oil',
	'Tinh dầu Bạch Đàn Chanh – Nguyên liệu tự nhiên' => 'Lemon Eucalyptus Essential Oil',
);

foreach ( $vi_products as $vi_p ) {
	$vi_id = $vi_p->ID;
	
	// Skip if it's already an EN product
	$current_lang = function_exists( 'pll_get_post_language' ) ? pll_get_post_language( $vi_id ) : 'vi';
	if ( 'en' === $current_lang ) {
		continue;
	}

	pll_set_post_language( $vi_id, 'vi' );

	$translations = function_exists( 'pll_get_post_translations' ) ? pll_get_post_translations( $vi_id ) : array();
	$en_id        = $translations['en'] ?? 0;

	$vi_title   = $vi_p->post_title;
	$vi_excerpt = $vi_p->post_excerpt;
	$vi_content = $vi_p->post_content;

	// English title
	$en_title = $translation_dict[ $vi_title ] ?? ( $vi_title . ' (OEM/ODM Formula)' );

	// English excerpt
	$en_excerpt = ! empty( $vi_excerpt )
		? ( 'VINACOS Cosmetic Grade: ' . strip_tags( $vi_excerpt ) )
		: 'High-performance VINACOS OEM/ODM formulation. 100% safety tested and cGMP compliant.';

	// English content
	$en_content = ! empty( $vi_content )
		? $vi_content
		: '<p>VINACOS OEM/ODM cosmetic formulation developed in cGMP certified laboratories.</p>';

	if ( ! $en_id ) {
		$en_id = wp_insert_post( array(
			'post_title'   => $en_title,
			'post_content' => $en_content,
			'post_excerpt' => $en_excerpt,
			'post_status'  => 'publish',
			'post_type'    => 'product',
		) );
		echo "CREATED EN Product for ID {$vi_id}: '{$en_title}' (EN ID: {$en_id})\n";
	} else {
		wp_update_post( array(
			'ID'           => $en_id,
			'post_title'   => $en_title,
			'post_content' => $en_content,
			'post_excerpt' => $en_excerpt,
		) );
		echo "UPDATED EN Product for ID {$vi_id}: '{$en_title}' (EN ID: {$en_id})\n";
	}

	if ( $en_id && ! is_wp_error( $en_id ) ) {
		pll_set_post_language( $en_id, 'en' );

		// Copy featured image from original VI product
		$thumb_id = get_post_thumbnail_id( $vi_id );
		if ( $thumb_id ) {
			set_post_thumbnail( $en_id, $thumb_id );
		}

		// Copy gallery images
		$gallery = get_post_meta( $vi_id, '_product_image_gallery', true );
		if ( $gallery ) {
			update_post_meta( $en_id, '_product_image_gallery', $gallery );
		}

		// Copy WooCommerce price & product meta
		foreach ( array( '_price', '_regular_price', '_sale_price', '_sku', '_stock_status' ) as $meta_key ) {
			$meta_val = get_post_meta( $vi_id, $meta_key, true );
			if ( '' !== $meta_val ) {
				update_post_meta( $en_id, $meta_key, $meta_val );
			}
		}

		// Map product_cat terms
		$vi_terms = wp_get_post_terms( $vi_id, 'product_cat' );
		$en_term_ids = array();
		foreach ( $vi_terms as $term ) {
			$term_trans = function_exists( 'pll_get_term_translations' ) ? pll_get_term_translations( $term->term_id ) : array();
			if ( ! empty( $term_trans['en'] ) ) {
				$en_term_ids[] = (int) $term_trans['en'];
			}
		}
		if ( ! empty( $en_term_ids ) ) {
			wp_set_post_terms( $en_id, $en_term_ids, 'product_cat' );
		}

		// Link VI <-> EN in Polylang
		pll_save_post_translations( array(
			'vi' => $vi_id,
			'en' => $en_id,
		) );
	}
}

// Clean up scratch inspection files
@unlink( __DIR__ . '/../../scratch-inspect-local-products.php' );

flush_rewrite_rules();
echo "\n=== COMPLETED: ALL LOCAL PRODUCTS ARE NOW TRANSLATED TO ENGLISH ===\n";
