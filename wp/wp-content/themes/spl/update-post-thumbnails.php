<?php
/**
 * Update featured images for News Posts and ensure VI <-> EN translation alignment.
 *
 * Usage: php -r "require 'wp/wp-load.php'; require 'wp/wp-content/themes/spl/update-post-thumbnails.php';"
 *
 * @package SPL
 */

defined( 'ABSPATH' ) || exit;

echo "=== UPDATING NEWS POST FEATURED IMAGES & BILINGUAL DATA ===\n";

if ( ! function_exists( 'wp_insert_attachment' ) ) {
	require_once ABSPATH . 'wp-admin/includes/image.php';
	require_once ABSPATH . 'wp-admin/includes/file.php';
	require_once ABSPATH . 'wp-admin/includes/media.php';
}

$theme_dir = get_template_directory();

$posts_data = array(
	array(
		'vi_slug'    => 'pilot-batch-trong-san-xuat-my-pham',
		'vi_title'   => 'Pilot Batch trong sản xuất mỹ phẩm: Vì sao nên làm mẫu thử trước khi sản xuất hàng loạt',
		'en_slug'    => 'importance-of-pilot-batch-in-cosmetics-manufacturing',
		'en_title'   => 'Importance of Pilot Batch in OEM Cosmetics Manufacturing',
		'content_vi' => 'Thử nghiệm Pilot Batch giúp đánh giá tính ổn định của công thức, kiểm tra khả năng nâng quy mô sản xuất và giảm thiểu 100% rủi ro khi sản xuất hàng loạt tại VINACOS.',
		'content_en' => 'Pilot Batch testing ensures formula stability, evaluates scalability from lab to factory floor, and eliminates 100% of risk before mass production at VINACOS.',
		'file_path'  => $theme_dir . '/static/img/news/pilot-batch-cosmetics.jpg',
		'file_url'   => get_template_directory_uri() . '/static/img/news/pilot-batch-cosmetics.jpg',
		'filename'   => 'pilot-batch-cosmetics.jpg',
	),
	array(
		'vi_slug'    => 'ung-dung-cong-nghe-nhu-tuong-nano-lipid',
		'vi_title'   => 'Ứng Dụng Công Nghệ Nhũ Tương Nano Lipid Trong Chăm Sóc Da Việt',
		'en_slug'    => 'nano-lipid-emulsion-technology-skincare',
		'en_title'   => 'Application of Nano Lipid Emulsion Technology in Skincare',
		'content_vi' => 'Nghiên cứu ứng dụng nhũ tương nano bọc hoạt chất giúp thẩm thấu sâu, bảo toàn hoạt tính và tối ưu hiệu quả trên làn da.',
		'content_en' => 'Research on nano lipid encapsulation enables deep dermal penetration and active compound stability for high-performance skincare.',
		'file_path'  => $theme_dir . '/static/img/news/nano-lipid-skincare.jpg',
		'file_url'   => get_template_directory_uri() . '/static/img/news/nano-lipid-skincare.jpg',
		'filename'   => 'nano-lipid-skincare.jpg',
	),
);

// Function to upload or get attachment ID for image
function get_or_create_attachment( $file_path, $title ) {
	if ( ! file_exists( $file_path ) ) {
		echo "File not found: {$file_path}\n";
		return 0;
	}

	$filename = basename( $file_path );
	$wp_upload_dir = wp_upload_dir();

	// Check if already in media library
	$existing = get_posts( array(
		'post_type'   => 'attachment',
		'meta_key'    => '_wp_attached_file',
		'meta_value'  => 'news/' . $filename,
		'numberposts' => 1,
	) );

	if ( ! empty( $existing ) ) {
		return $existing[0]->ID;
	}

	// Copy to upload directory under /news/
	$target_dir = $wp_upload_dir['basedir'] . '/news';
	if ( ! file_exists( $target_dir ) ) {
		wp_mkdir_p( $target_dir );
	}
	$target_file = $target_dir . '/' . $filename;
	copy( $file_path, $target_file );

	$filetype = wp_check_filetype( basename( $target_file ), null );

	$attachment = array(
		'guid'           => $wp_upload_dir['baseurl'] . '/news/' . basename( $target_file ),
		'post_mime_type' => $filetype['type'],
		'post_title'     => preg_replace( '/\.[^.]+$/', '', $title ),
		'post_content'   => '',
		'post_status'    => 'inherit',
	);

	$attach_id = wp_insert_attachment( $attachment, $target_file );
	require_once ABSPATH . 'wp-admin/includes/image.php';
	$attach_data = wp_generate_attachment_metadata( $attach_id, $target_file );
	wp_update_attachment_metadata( $attach_id, $attach_data );

	echo "Created attachment ID: {$attach_id} for {$filename}\n";
	return $attach_id;
}

foreach ( $posts_data as $item ) {
	$attach_id = get_or_create_attachment( $item['file_path'], $item['vi_title'] );

	// 1. VI Post
	$vi_p = get_page_by_path( $item['vi_slug'], OBJECT, 'post' );
	if ( ! $vi_p ) {
		$vi_id = wp_insert_post( array(
			'post_title'   => $item['vi_title'],
			'post_name'    => $item['vi_slug'],
			'post_content' => $item['content_vi'],
			'post_status'  => 'publish',
			'post_type'    => 'post',
		) );
	} else {
		$vi_id = $vi_p->ID;
		wp_update_post( array(
			'ID'           => $vi_id,
			'post_title'   => $item['vi_title'],
			'post_content' => $item['content_vi'],
		) );
	}

	if ( function_exists( 'pll_set_post_language' ) ) {
		pll_set_post_language( $vi_id, 'vi' );
	}
	if ( $attach_id ) {
		set_post_thumbnail( $vi_id, $attach_id );
	}
	echo "Updated VI Post ID {$vi_id}: {$item['vi_title']}\n";

	// 2. EN Post
	$en_p = get_page_by_path( $item['en_slug'], OBJECT, 'post' );
	if ( ! $en_p ) {
		$en_id = wp_insert_post( array(
			'post_title'   => $item['en_title'],
			'post_name'    => $item['en_slug'],
			'post_content' => $item['content_en'],
			'post_status'  => 'publish',
			'post_type'    => 'post',
		) );
	} else {
		$en_id = $en_p->ID;
		wp_update_post( array(
			'ID'           => $en_id,
			'post_title'   => $item['en_title'],
			'post_content' => $item['content_en'],
		) );
	}

	if ( function_exists( 'pll_set_post_language' ) ) {
		pll_set_post_language( $en_id, 'en' );
	}
	if ( $attach_id ) {
		set_post_thumbnail( $en_id, $attach_id );
	}
	echo "Updated EN Post ID {$en_id}: {$item['en_title']}\n";

	// Link VI <-> EN in Polylang
	if ( function_exists( 'pll_save_post_translations' ) ) {
		pll_save_post_translations( array(
			'vi' => $vi_id,
			'en' => $en_id,
		) );
		echo "LINKED TRANSLATIONS: VI ({$vi_id}) <-> EN ({$en_id})\n";
	}
}

echo "=== DONE UPDATING FEATURED IMAGES & POSTS ===\n";
