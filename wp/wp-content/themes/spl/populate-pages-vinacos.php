<?php
/**
 * CLI Seeder — Converts all 6 target pages to 'page' post type with exact template mappings.
 *
 * @package SPL
 */

defined( 'ABSPATH' ) || exit;

echo "=== VINACOS PERMALINK & PAGE CONVERTER ===\n";

$target_pages = array(
	array(
		'title'    => 'Liên hệ',
		'slug'     => 'lien-he',
		'template' => 'templates/template-page-contact.php',
	),
	array(
		'title'    => 'Tin tức',
		'slug'     => 'tin-tuc-unila-viet-nam',
		'template' => 'home.php',
	),
	array(
		'title'    => 'Hệ thống R&D & Gia công OEM/ODM',
		'slug'     => 'oem-odm-gia-cong-unila-viet-nam',
		'template' => 'templates/template-page-cooperation.php',
	),
	array(
		'title'    => 'Sản phẩm gia công VINACOS',
		'slug'     => 'san-pham-gia-cong-unila-viet-nam',
		'template' => 'archive-product.php',
	),
	array(
		'title'    => 'Gia công Sữa Rửa Mặt Dạng Kem VINACOS',
		'slug'     => 'san-pham-sua-rua-mat-dang-kem-unila',
		'template' => 'single-product.php',
	),
	array(
		'title'    => 'Tầm Quan Trọng Của Pilot Batch Trong Sản Xuất Mỹ Phẩm',
		'slug'     => 'pilot-batch-trong-san-xuat-my-pham',
		'template' => 'single.php',
	),
);

foreach ( $target_pages as $tp ) {
	$existing = get_page_by_path( $tp['slug'], OBJECT, array( 'page', 'post', 'product' ) );
	if ( $existing ) {
		// Convert to page post type so permalink is http://vinacos.test/slug/ directly with 0 redirects!
		wp_update_post(
			array(
				'ID'        => $existing->ID,
				'post_type' => 'page',
			)
		);
		update_post_meta( $existing->ID, '_wp_page_template', $tp['template'] );
		echo "CONVERTED '{$tp['slug']}' to PAGE (ID: {$existing->ID}, Template: {$tp['template']})\n";
	} else {
		$page_id = wp_insert_post(
			array(
				'post_title'   => $tp['title'],
				'post_name'    => $tp['slug'],
				'post_status'  => 'publish',
				'post_type'    => 'page',
				'post_content' => 'VINACOS ' . $tp['title'],
			)
		);
		if ( $page_id && ! is_wp_error( $page_id ) ) {
			update_post_meta( $page_id, '_wp_page_template', $tp['template'] );
			echo "CREATED PAGE '{$tp['slug']}' (ID: {$page_id}, Template: {$tp['template']})\n";
		}
	}
}

flush_rewrite_rules();
echo "FLUSHED REWRITE RULES CLEANLY!\n";
