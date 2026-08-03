<?php
/**
 * CLI Seeder — Polylang Bilingual (VI <-> EN) Pages, Posts & Products Seeder.
 *
 * Usage: php -r "require 'wp/wp-load.php'; require 'wp/wp-content/themes/spl/populate-bilingual-vinacos.php';"
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

echo "=== VINACOS BILINGUAL SEEDER (VI <-> EN) ===\n";

if ( ! function_exists( 'pll_save_post_translations' ) ) {
	echo "ERROR: Polylang API functions not available!\n";
	return;
}

// 1. Target pages mapping (VI Slug => EN Page Specs)
$page_mappings = array(
	'trang-chu'                         => array(
		'en_title'    => 'Home - VINACOS',
		'en_slug'     => 'home',
		'template'    => 'templates/template-page-home.php',
		'copy_acf'    => true,
	),
	'tam-the-cong-su-unila-viet-nam'   => array(
		'en_title'    => 'Partner Mindset & About Us',
		'en_slug'     => 'partner-mindset-about',
		'template'    => 'templates/template-page-home.php',
	),
	'oem-odm-gia-cong-unila-viet-nam' => array(
		'en_title'    => 'R&D System & OEM/ODM Manufacturing',
		'en_slug'     => 'rd-system-oem-odm',
		'template'    => 'templates/template-page-cooperation.php',
	),
	'san-pham-gia-cong-unila-viet-nam' => array(
		'en_title'    => 'Cosmetics Products Portfolio',
		'en_slug'     => 'products',
		'template'    => 'archive-product.php',
	),
	'tin-tuc'                          => array(
		'en_title'    => 'Latest News & Scientific Insights',
		'en_slug'     => 'news',
		'template'    => 'home.php',
	),
	'lien-he'                          => array(
		'en_title'    => 'Contact Us',
		'en_slug'     => 'contact-us',
		'template'    => 'templates/template-page-contact.php',
	),
);

foreach ( $page_mappings as $vi_slug => $en_specs ) {
	$vi_page = get_page_by_path( $vi_slug, OBJECT, array( 'page', 'post' ) );
	if ( ! $vi_page ) {
		echo "Skipping {$vi_slug}: VI page not found.\n";
		continue;
	}

	$vi_id = $vi_page->ID;
	pll_set_post_language( $vi_id, 'vi' );

	// Check if EN page exists
	$en_page = get_page_by_path( $en_specs['en_slug'], OBJECT, 'page' );
	if ( ! $en_page ) {
		$en_id = wp_insert_post(
			array(
				'post_title'   => $en_specs['en_title'],
				'post_name'    => $en_specs['en_slug'],
				'post_status'  => 'publish',
				'post_type'    => 'page',
				'post_content' => 'VINACOS ' . $en_specs['en_title'],
			)
		);
		echo "CREATED EN Page '{$en_specs['en_slug']}' (ID: {$en_id})\n";
	} else {
		$en_id = $en_page->ID;
		echo "FOUND EN Page '{$en_specs['en_slug']}' (ID: {$en_id})\n";
	}

	if ( $en_id && ! is_wp_error( $en_id ) ) {
		pll_set_post_language( $en_id, 'en' );
		update_post_meta( $en_id, '_wp_page_template', $en_specs['template'] );

		// Copy ACF home_sections if applicable
		if ( ! empty( $en_specs['copy_acf'] ) ) {
			$sections = get_field( 'home_sections', $vi_id );
			if ( $sections ) {
				update_field( 'home_sections', $sections, $en_id );
			}
		}

		// Link VI and EN in Polylang
		pll_save_post_translations(
			array(
				'vi' => $vi_id,
				'en' => $en_id,
			)
		);
		echo "LINKED TRANSLATIONS: VI (ID {$vi_id}) <-> EN (ID {$en_id})\n";
	}
}

// 2. Seed News Posts & Link VI <-> EN
$sample_posts = array(
	array(
		'vi_title'   => 'Pilot Batch trong sản xuất mỹ phẩm: Vì sao nên làm mẫu thử trước khi sản xuất hàng loạt',
		'vi_slug'    => 'pilot-batch-trong-san-xuat-my-pham',
		'en_title'   => 'Importance of Pilot Batch in OEM Cosmetics Manufacturing',
		'en_slug'    => 'importance-of-pilot-batch-in-cosmetics-manufacturing',
		'content_vi' => 'Thử nghiệm Pilot Batch giúp đánh giá tính ổn định của công thức, kiểm tra khả năng nâng quy mô sản xuất và giảm thiểu 100% rủi ro khi sản xuất hàng loạt.',
		'content_en' => 'Pilot Batch testing ensures formula stability, evaluates scalability from lab to factory floor, and eliminates 100% of risk before mass production.',
		'image'      => get_template_directory_uri() . '/static/img/news/pilot-batch-cosmetics.jpg',
	),
	array(
		'vi_title'   => 'Ứng Dụng Công Nghệ Nhũ Tương Nano Lipid Trong Chăm Sóc Da Việt',
		'vi_slug'    => 'ung-dung-cong-nghe-nhu-tuong-nano-lipid',
		'en_title'   => 'Application of Nano Lipid Emulsion Technology in Skincare',
		'en_slug'    => 'nano-lipid-emulsion-technology-skincare',
		'content_vi' => 'Nghiên cứu ứng dụng nhũ tương nano bọc hoạt chất giúp thẩm thấu sâu, bảo toàn hoạt tính và tối ưu hiệu quả trên làn da.',
		'content_en' => 'Research on nano lipid encapsulation enables deep dermal penetration and active compound stability for high-performance skincare.',
		'image'      => get_template_directory_uri() . '/static/img/news/nano-lipid-skincare.jpg',
	),
);

foreach ( $sample_posts as $p ) {
	$vi_p = get_page_by_path( $p['vi_slug'], OBJECT, 'post' );
	if ( ! $vi_p ) {
		$vi_id = wp_insert_post(
			array(
				'post_title'   => $p['vi_title'],
				'post_name'    => $p['vi_slug'],
				'post_content' => $p['content_vi'],
				'post_status'  => 'publish',
				'post_type'    => 'post',
			)
		);
	} else {
		$vi_id = $vi_p->ID;
	}
	pll_set_post_language( $vi_id, 'vi' );

	$en_p = get_page_by_path( $p['en_slug'], OBJECT, 'post' );
	if ( ! $en_p ) {
		$en_id = wp_insert_post(
			array(
				'post_title'   => $p['en_title'],
				'post_name'    => $p['en_slug'],
				'post_content' => $p['content_en'],
				'post_status'  => 'publish',
				'post_type'    => 'post',
			)
		);
	} else {
		$en_id = $en_p->ID;
	}
	pll_set_post_language( $en_id, 'en' );

	pll_save_post_translations(
		array(
			'vi' => $vi_id,
			'en' => $en_id,
		)
	);
	echo "LINKED POST TRANSLATIONS: VI (ID {$vi_id}) <-> EN (ID {$en_id})\n";
}

flush_rewrite_rules();
echo "=== BILINGUAL SEEDER FINISHED SUCCESSFULLY ===\n";
