<?php
/**
 * CLI Seeder — Polylang Complete Taxonomy (Product Cats & Post Cats) & Items Seeder.
 *
 * Usage: php -r "require 'wp/wp-load.php'; require 'wp/wp-content/themes/spl/populate-full-taxonomy-translations.php';"
 *
 * @package SPL
 */

defined( 'ABSPATH' ) || exit;

echo "=== VINACOS FULL TAXONOMY & ITEMS BILINGUAL SEEDER ===\n";

if ( ! function_exists( 'pll_save_term_translations' ) ) {
	echo "ERROR: Polylang API functions not available!\n";
	return;
}

// 1. Product Categories Mappings (VI Slug => EN Specs)
$product_cat_mappings = array(
	'cham-soc-da-mat'    => array(
		'en_name' => 'Facial Care',
		'en_slug' => 'facial-care',
	),
	'cham-soc-co-the'    => array(
		'en_name' => 'Body Care',
		'en_slug' => 'body-care',
	),
	'tinh-dau'           => array(
		'en_name' => 'Essential Oils',
		'en_slug' => 'essential-oils',
	),
	'dau-nen'            => array(
		'en_name' => 'Carrier Oils',
		'en_slug' => 'carrier-oils',
	),
	'bot-nguyen-lieu'    => array(
		'en_name' => 'Raw Cosmetic Powders',
		'en_slug' => 'raw-cosmetic-powders',
	),
	'cham-soc-me-bim'    => array(
		'en_name' => 'Mother & Baby Care',
		'en_slug' => 'mother-baby-care',
	),
	'san-pham-cho-nam'   => array(
		'en_name' => 'Men Skincare & Grooming',
		'en_slug' => 'men-grooming',
	),
	'san-pham-gia-dung'  => array(
		'en_name' => 'Home Care & Cleansing',
		'en_slug' => 'home-care-cleansing',
	),
	'best-seller'        => array(
		'en_name' => 'Best Sellers',
		'en_slug' => 'best-sellers',
	),
	'uncategorised'      => array(
		'en_name' => 'Uncategorized Products',
		'en_slug' => 'uncategorized-products',
	),
);

foreach ( $product_cat_mappings as $vi_slug => $en_specs ) {
	$vi_term = get_term_by( 'slug', $vi_slug, 'product_cat' );
	if ( ! $vi_term ) {
		echo "Skipping product_cat {$vi_slug}: term not found.\n";
		continue;
	}

	$vi_id = $vi_term->term_id;
	pll_set_term_language( $vi_id, 'vi' );

	$en_term = get_term_by( 'slug', $en_specs['en_slug'], 'product_cat' );
	if ( ! $en_term ) {
		$new_term = wp_insert_term(
			$en_specs['en_name'],
			'product_cat',
			array(
				'slug' => $en_specs['en_slug'],
			)
		);
		if ( ! is_wp_error( $new_term ) ) {
			$en_id = $new_term['term_id'];
			echo "CREATED EN product_cat '{$en_specs['en_name']}' (ID: {$en_id})\n";
		} else {
			echo "Error inserting term {$en_specs['en_name']}: " . $new_term->get_error_message() . "\n";
			continue;
		}
	} else {
		$en_id = $en_term->term_id;
		echo "FOUND EN product_cat '{$en_specs['en_name']}' (ID: {$en_id})\n";
	}

	if ( $en_id ) {
		pll_set_term_language( $en_id, 'en' );
		pll_save_term_translations(
			array(
				'vi' => $vi_id,
				'en' => $en_id,
			)
		);
		echo "LINKED product_cat: VI (ID {$vi_id}) <-> EN (ID {$en_id})\n";
	}
}

// 2. Post Categories Mappings (VI Slug => EN Specs)
$post_cat_mappings = array(
	'tin-tuc'                  => array(
		'en_name' => 'News & Industry Trends',
		'en_slug' => 'news-industry-trends',
	),
	'blog'                     => array(
		'en_name' => 'Beauty & Skincare Blog',
		'en_slug' => 'beauty-skincare-blog',
	),
	'dich-vu-xe-dien'          => array(
		'en_name' => 'OEM/ODM Manufacturing Insights',
		'en_slug' => 'oem-odm-insights',
	),
	'kinh-nghiem-danh-gia'     => array(
		'en_name' => 'R&D Guides & Formulation Tips',
		'en_slug' => 'rd-formulation-guides',
	),
	'khuyen-mai'               => array(
		'en_name' => 'Promotions & Announcements',
		'en_slug' => 'promotions-announcements',
	),
	'su-kien'                  => array(
		'en_name' => 'Corporate Events',
		'en_slug' => 'corporate-events',
	),
	'tin-tuc-ve-dai-ly-xe-dien' => array(
		'en_name' => 'Company News & Milestones',
		'en_slug' => 'company-news-milestones',
	),
	'tin-thi-truong-xe-dien'   => array(
		'en_name' => 'Market Research & Intelligence',
		'en_slug' => 'market-research-intelligence',
	),
);

foreach ( $post_cat_mappings as $vi_slug => $en_specs ) {
	$vi_term = get_category_by_slug( $vi_slug );
	if ( ! $vi_term ) {
		echo "Skipping category {$vi_slug}: term not found.\n";
		continue;
	}

	$vi_id = $vi_term->term_id;
	pll_set_term_language( $vi_id, 'vi' );

	$en_term = get_category_by_slug( $en_specs['en_slug'] );
	if ( ! $en_term ) {
		$new_term = wp_insert_term(
			$en_specs['en_name'],
			'category',
			array(
				'slug' => $en_specs['en_slug'],
			)
		);
		if ( ! is_wp_error( $new_term ) ) {
			$en_id = $new_term['term_id'];
			echo "CREATED EN category '{$en_specs['en_name']}' (ID: {$en_id})\n";
		} else {
			echo "Error inserting category {$en_specs['en_name']}: " . $new_term->get_error_message() . "\n";
			continue;
		}
	} else {
		$en_id = $en_term->term_id;
		echo "FOUND EN category '{$en_specs['en_name']}' (ID: {$en_id})\n";
	}

	if ( $en_id ) {
		pll_set_term_language( $en_id, 'en' );
		pll_save_term_translations(
			array(
				'vi' => $vi_id,
				'en' => $en_id,
			)
		);
		echo "LINKED category: VI (ID {$vi_id}) <-> EN (ID {$en_id})\n";
	}
}

flush_rewrite_rules();
echo "=== FULL TAXONOMY TRANSLATIONS COMPLETED SUCCESSFULLY ===\n";
