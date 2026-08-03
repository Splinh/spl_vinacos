<?php
/**
 * Fix EN page templates to match their VI counterparts.
 *
 * Usage: php -r "require 'wp/wp-load.php'; require 'wp/wp-content/themes/spl/fix-en-page-templates.php';"
 */

defined( 'ABSPATH' ) || exit;

echo "=== FIXING EN PAGE TEMPLATES ===\n";

// Define VI -> EN page mappings with correct templates
$pages = array(
	array(
		'vi_slug'  => 'tam-the-cong-su-unila-viet-nam',
		'en_slug'  => 'partner-mindset-about',
		'template' => 'templates/template-page-about.php',
		'label'    => 'About / Partner Mindset',
	),
	array(
		'vi_slug'  => 'oem-odm-gia-cong-unila-viet-nam',
		'en_slug'  => 'rd-system-oem-odm',
		'template' => 'templates/template-page-cooperation.php',
		'label'    => 'R&D / OEM-ODM',
	),
	array(
		'vi_slug'  => 'lien-he',
		'en_slug'  => 'contact-us',
		'template' => 'templates/template-page-contact.php',
		'label'    => 'Contact',
	),
	array(
		'vi_slug'  => 'san-pham-gia-cong-unila-viet-nam',
		'en_slug'  => 'products',
		'template' => 'archive-product.php',
		'label'    => 'Products',
	),
);

foreach ( $pages as $p ) {
	$en_page = get_page_by_path( $p['en_slug'], OBJECT, 'page' );
	if ( ! $en_page ) {
		echo "SKIP: EN page '{$p['en_slug']}' not found.\n";
		continue;
	}

	$current_tpl = get_post_meta( $en_page->ID, '_wp_page_template', true );
	if ( $current_tpl === $p['template'] ) {
		echo "OK: {$p['label']} (ID {$en_page->ID}) already has correct template.\n";
		continue;
	}

	update_post_meta( $en_page->ID, '_wp_page_template', $p['template'] );
	echo "FIXED: {$p['label']} (ID {$en_page->ID}) template changed from '{$current_tpl}' → '{$p['template']}'\n";

	// Also ensure Polylang language is set correctly
	if ( function_exists( 'pll_set_post_language' ) ) {
		pll_set_post_language( $en_page->ID, 'en' );
	}

	// Ensure VI <-> EN translation link
	$vi_page = get_page_by_path( $p['vi_slug'], OBJECT, 'page' );
	if ( $vi_page && function_exists( 'pll_save_post_translations' ) ) {
		pll_save_post_translations( array(
			'vi' => $vi_page->ID,
			'en' => $en_page->ID,
		) );
		echo "  LINKED: VI (ID {$vi_page->ID}) <-> EN (ID {$en_page->ID})\n";
	}
}

// Flush rewrite rules
flush_rewrite_rules();
echo "\nFlushed rewrite rules.\n";

echo "=== EN PAGE TEMPLATE FIX COMPLETE ===\n";
