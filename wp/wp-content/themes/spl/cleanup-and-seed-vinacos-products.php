<?php
/**
 * CLI Seeder — Cleanup Non-Cosmetics Products & Seed Pure VINACOS Cosmetics Portfolio (VI <-> EN).
 *
 * 1. Permanently deletes all deprecated vehicle / non-cosmetics products in VI & EN.
 * 2. Seeds standard VINACOS cosmetics products with titles, short descriptions, content & categories in both VI & EN.
 * 3. Links VI <-> EN products via Polylang.
 *
 * Usage: php wp/wp-content/themes/spl/cleanup-and-seed-vinacos-products.php
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

echo "=== VINACOS PRODUCT CLEANUP & BILINGUAL SEEDER ===\n";

// 1. DELETE NON-COSMETICS / VEHICLE PRODUCTS
$all_products = get_posts( array(
	'post_type'   => 'product',
	'numberposts' => -1,
	'lang'        => '',
	'post_status' => 'any',
) );

$delete_keywords = array(
	'xe', '50cc', 'ba gác', 'đẩy', 'đạp', 'máy điện', 'vespa', 'vinfast',
	'dibao', 'yadea', 'aie', 'bluera', 'pega', 'xmen', 'crea', 'halim',
	'giant', 'eagle', 'rocket', 'lumi', 'scooter', 'bike', 'motor',
);

$deleted_count = 0;
foreach ( $all_products as $p ) {
	$title_lower = mb_strtolower( $p->post_title );
	$should_delete = false;

	foreach ( $delete_keywords as $kw ) {
		if ( false !== mb_strpos( $title_lower, $kw ) ) {
			$should_delete = true;
			break;
		}
	}

	if ( $should_delete ) {
		wp_delete_post( $p->ID, true ); // Force delete permanently
		$deleted_count++;
	}
}

echo "Permanently deleted {$deleted_count} non-cosmetics products.\n\n";

require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/media.php';
require_once ABSPATH . 'wp-admin/includes/image.php';

function vinacos_sideload_product_image( $url, $post_id ) {
	if ( empty( $url ) || ! $post_id ) {
		return 0;
	}
	$tmp = download_url( $url );
	if ( is_wp_error( $tmp ) ) {
		return 0;
	}
	$file = array(
		'name'     => 'vinacos-prod-' . $post_id . '-' . substr( md5( $url ), 0, 6 ) . '.jpg',
		'tmp_name' => $tmp,
	);
	$id = media_handle_sideload( $file, $post_id );
	if ( is_wp_error( $id ) ) {
		@unlink( $tmp );
		return 0;
	}
	return (int) $id;
}

// 3. DEFINE VINACOS COSMETICS PRODUCTS CATALOGUE WITH REAL LABCOS IMAGES
$vinacos_catalogue = array(
	array(
		'cat_slug_vi' => 'cham-soc-da-mat',
		'vi_title'    => 'Serum Dưỡng Trắng & Mờ Thâm Niacinamide 10% B3',
		'en_title'    => '10% Niacinamide B3 Brightening & Spot Correcting Serum',
		'vi_excerpt'  => 'Công thức gia công chuẩn y khoa kết hợp Niacinamide 10% và Alpha Arbutin giúp làm sáng da, mờ thâm mụn và thu nhỏ lỗ chân lông.',
		'en_excerpt'  => 'Medical-grade OEM/ODM formulation blending 10% Niacinamide & Alpha Arbutin to visibly brighten skin tone, correct dark spots, and refine pores.',
		'vi_content'  => '<p>Serum Niacinamide 10% B3 VINACOS là dòng sản phẩm gia công chủ lực được nghiên cứu bởi hệ thống R&D chuẩn cGMP. Sản phẩm giúp phục hồi hàng rào bảo vệ da, làm đều màu da và hỗ trợ kiểm soát bã nhờn tối ưu.</p><h4>Ưu Điểm Công Thức OEM/ODM</h4><ul><li>0% Hoạt chất cấm - 100% Kiểm nghiệm lâm sàng</li><li>Thẩm thấu nhanh, không bết dính, phù hợp khí hậu Việt Nam</li><li>Đầy đủ hồ sơ công bố pháp lý A-Z</li></ul>',
		'en_content'  => '<p>VINACOS 10% Niacinamide B3 Serum is a flagship OEM/ODM formulation developed in cGMP certified laboratories. It rebuilds the skin moisture barrier, evens out discoloration, and balances sebum production.</p><h4>OEM/ODM Key Advantages</h4><ul><li>0% Illegal Active Ingredients — 100% Dermatologically Tested</li><li>Fast-absorbing non-sticky texture tailored for global skin types</li><li>Complete Regulatory Dossiers & Legal Filings Support (A-Z)</li></ul>',
		'price'       => '350000',
		'image_url'   => 'https://labcos.com.vn/wp-content/uploads/SP-NEN-TRANG-DAU-TAY-TRANG-XANH.jpg',
	),
	array(
		'cat_slug_vi' => 'cham-soc-da-mat',
		'vi_title'    => 'Kem Dưỡng Phục Hồi Màng Lipids Skin Barrier Recovery',
		'en_title'    => 'Skin Barrier Recovery & Ceramides Deep Repair Cream',
		'vi_excerpt'  => 'Bổ sung 5 loại Ceramides & Hyaluronic Acid giúp phục hồi da tổn thương, làm dịu da nhạy cảm sau peel hoặc laser.',
		'en_excerpt'  => 'Enriched with 5 Essential Ceramides & Multi-molecular HA to restore compromised skin barriers and calm post-treatment sensitivity.',
		'vi_content'  => '<p>Kem phục hồi màng Lipids VINACOS giúp tái tạo tế bào da bị tổn thương, củng cố hàng rào bảo vệ tự nhiên và ngăn ngừa mất nước xuyến biểu bì (TEWL).</p>',
		'en_content'  => '<p>VINACOS Barrier Repair Cream reinforces the skin moisture barrier, accelerates cellular recovery, and prevents Transepidermal Water Loss (TEWL).</p>',
		'price'       => '420000',
		'image_url'   => 'https://labcos.com.vn/wp-content/uploads/SP-NEN-TRANG-KEM-DUONG-XANH-1.jpg',
	),
	array(
		'cat_slug_vi' => 'cham-soc-da-mat',
		'vi_title'    => 'Tẩy Trang Dạng Nước Micellar Cleansing Water Dịu Nhẹ',
		'en_title'    => 'Gentle Soothing Micellar Cleansing Water',
		'vi_excerpt'  => 'Công nghệ Micellar làm sạch sâu bụi mịn, mồ hôi và lớp trang điểm mà không làm khô da hay gây rát da.',
		'en_excerpt'  => 'Advanced micellar technology effectively removes PM2.5 pollutants, excess sebum, and waterproof makeup without disrupting skin pH.',
		'vi_content'  => '<p>Nước tẩy trang Micellar VINACOS dịu nhẹ, cân bằng độ pH 5.5, an toàn tuyệt đối cho mọi làn da nhạy cảm nhất.</p>',
		'en_content'  => '<p>VINACOS Micellar Water provides ultra-gentle cleansing with pH 5.5 balance, suitable for highly sensitive skin types.</p>',
		'price'       => '180000',
		'image_url'   => 'https://labcos.com.vn/wp-content/uploads/SP-NEN-TRANG-MAT-NA-GIAY-XANH-1.jpg',
	),
	array(
		'cat_slug_vi' => 'cham-soc-da-mat',
		'vi_title'    => 'Kem Chống Nắng Phổ Rộng Broad Spectrum SPF50+ PA++++',
		'en_title'    => 'Broad Spectrum Invisible Sunscreen SPF50+ PA++++',
		'vi_excerpt'  => 'Màng lọc chống nắng thế hệ mới bảo vệ da khỏi tia UVA, UVB và ánh sáng xanh, kết cấu mỏng nhẹ không nâng tông dư thừa.',
		'en_excerpt'  => 'Next-gen UV filters providing complete protection against UVA, UVB, and High Energy Visible (HEV) blue light with a featherlight finish.',
		'vi_content'  => '<p>Kem chống nắng phổ rộng VINACOS ứng dụng màng lọc chống nắng thế hệ mới từ Châu Âu, bảo vệ toàn diện làn da trước tác hại môi trường.</p>',
		'en_content'  => '<p>VINACOS Broad Spectrum Sunscreen utilizes advanced European UV filters to ensure comprehensive daily skin protection.</p>',
		'price'       => '380000',
		'image_url'   => 'https://labcos.com.vn/wp-content/uploads/DANH-MU%CC%A3C-CHA%CC%86M-SO%CC%81C-DA-MA%CC%86T.jpg',
	),
	array(
		'cat_slug_vi' => 'cham-soc-co-the',
		'vi_title'    => 'Sữa Tắm Thảo Dược Ép Lạnh Dưỡng Ẩm & Kháng Khuẩn',
		'en_title'    => 'Cold-Pressed Herbal Body Wash & Hydration',
		'vi_excerpt'  => 'Chiết xuất thảo mộc thiên nhiên làm sạch dịu nhẹ, cân bằng độ ẩm và hỗ trợ giảm mụn lưng hiệu quả.',
		'en_excerpt'  => 'Infused with cold-pressed natural botanicals to gently cleanse, rebalance skin hydration, and reduce body acne.',
		'vi_content'  => '<p>Sữa tắm thảo dược VINACOS dưỡng ẩm sâu, lưu hương thiên nhiên thư giãn và hỗ trợ giảm viêm nang lông.</p>',
		'en_content'  => '<p>VINACOS Herbal Body Wash deeply hydrates skin while soothing irritation and nourishing body contours.</p>',
		'price'       => '250000',
		'image_url'   => 'https://labcos.com.vn/wp-content/uploads/SP-NEN-TRANG-BODYMIST-2.jpg',
	),
	array(
		'cat_slug_vi' => 'cham-soc-co-the',
		'vi_title'    => 'Kem Dưỡng Thể Dưỡng Trắng Niacinamide & Vitamin C',
		'en_title'    => 'Niacinamide & Vitamin C Radiance Body Lotion',
		'vi_excerpt'  => 'Dưỡng thể làm sáng da toàn thân, chất kem mỏng nhẹ thấm nhanh không bết dính.',
		'en_excerpt'  => 'Fast-absorbing body lotion designed to illuminate dull skin tone and improve texture without greasy residue.',
		'vi_content'  => '<p>Kem dưỡng thể VINACOS kết hợp Niacinamide & Vitamin C giúp cải thiện da xỉn màu, cấp ẩm cho làn da mịn màng.</p>',
		'en_content'  => '<p>VINACOS Body Lotion merges Niacinamide and Vitamin C to enhance radiance and refine skin feel.</p>',
		'price'       => '290000',
		'image_url'   => 'https://labcos.com.vn/wp-content/uploads/SP-NEN-TRANG-BODY-OIL-2.jpg',
	),
	array(
		'cat_slug_vi' => 'tinh-dau',
		'vi_title'    => 'Tinh Dầu Bưởi Nguyên Chất Pure Grapefruit Oil',
		'en_title'    => '100% Pure Organic Grapefruit Essential Oil',
		'vi_excerpt'  => 'Tinh dầu bưởi ép lạnh nguyên chất giúp kích thích mọc tóc, giảm gãy rụng và nuôi dưỡng da đầu.',
		'en_excerpt'  => '100% pure cold-pressed grapefruit oil known for stimulating hair follicle growth and strengthening root resilience.',
		'vi_content'  => '<p>Tinh dầu bưởi VINACOS được chiết xuất từ vỏ bưởi tươi ép lạnh, nuôi dưỡng mái tóc chắc khỏe từ gốc đến ngọn.</p>',
		'en_content'  => '<p>VINACOS Pure Grapefruit Oil nourishes scalp health and promotes fuller, stronger hair development.</p>',
		'price'       => '220000',
		'image_url'   => 'https://labcos.com.vn/wp-content/uploads/DANH-MUC-CHAM-SOC-TOC.jpg',
	),
	array(
		'cat_slug_vi' => 'cham-soc-me-bim',
		'vi_title'    => 'Sữa Tắm Gội 2 Trong 1 Dịu Nhẹ Cho Bé Gentle Baby Wash',
		'en_title'    => 'Gentle 2-in-1 Baby Head-to-Toe Wash',
		'vi_excerpt'  => 'Công thức không cay mắt, độ pH 5.5 an toàn tuyệt đối cho làn da nhạy cảm của trẻ sơ sinh.',
		'en_excerpt'  => 'Tear-free, pH 5.5 balanced formula dermatologically tested for ultra-sensitive newborn skin.',
		'vi_content'  => '<p>Sữa tắm gội em bé VINACOS không chứa paraben, xà phòng hay hương liệu nhân tạo, nâng niu làn da bé yêu.</p>',
		'en_content'  => '<p>VINACOS Baby Wash is completely free from parabens, sulfates, and synthetic dyes, protecting tender baby skin.</p>',
		'price'       => '195000',
		'image_url'   => 'https://labcos.com.vn/wp-content/uploads/DANH-MU%CC%A3C-BABY-CARE.jpg',
	),
	array(
		'cat_slug_vi' => 'san-pham-cho-nam',
		'vi_title'    => 'Sữa Rửa Mặt Nam Giới Kiểm Soát Dầu 2 Trong 1',
		'en_title'    => 'Men\'s 2-in-1 Oil Control & Deep Cleansing Face Wash',
		'vi_excerpt'  => 'Bột than hoạt tính kết hợp BHA giúp làm sạch sâu bã nhờn, ngăn ngừa mụn cám và mụn đầu đen.',
		'en_excerpt'  => 'Formulated with Activated Charcoal & Salicylic Acid to absorb excess oil and prevent clogged pores.',
		'vi_content'  => '<p>Sữa rửa mặt nam VINACOS làm sạch sâu, cuốn trôi bã nhờn dư thừa và mang lại cảm giác sảng khoái suốt cả ngày.</p>',
		'en_content'  => '<p>VINACOS Men\'s Face Wash provides deep pore cleansing and long-lasting oil control for active men.</p>',
		'price'       => '170000',
		'image_url'   => 'https://labcos.com.vn/wp-content/uploads/DANH-MU%CC%A3C-CHA%CC%86M-SO%CC%81C-MEN.jpg',
	),
);

// Collect all allowed official titles
$allowed_titles = array();
foreach ( $vinacos_catalogue as $item ) {
	$allowed_titles[] = mb_strtolower( trim( $item['vi_title'] ) );
	$allowed_titles[] = mb_strtolower( trim( $item['en_title'] ) );
}

// Delete any products not in official catalogue list
$existing_all = get_posts( array(
	'post_type'   => 'product',
	'numberposts' => -1,
	'lang'        => '',
	'post_status' => 'any',
) );

$purged = 0;
foreach ( $existing_all as $ep ) {
	if ( ! in_array( mb_strtolower( trim( $ep->post_title ) ), $allowed_titles, true ) ) {
		wp_delete_post( $ep->ID, true );
		$purged++;
	}
}
if ( $purged > 0 ) {
	echo "Purged {$purged} leftover non-official products.\n\n";
}

// 4. SEED CLEAN COSMETICS PRODUCTS (VI & EN)
foreach ( $vinacos_catalogue as $item ) {
	// Find or create VI product
	$vi_p = get_page_by_title( $item['vi_title'], OBJECT, 'product' );
	if ( ! $vi_p ) {
		$vi_id = wp_insert_post( array(
			'post_title'   => $item['vi_title'],
			'post_excerpt' => $item['vi_excerpt'],
			'post_content' => $item['vi_content'],
			'post_status'  => 'publish',
			'post_type'    => 'product',
		) );
		echo "CREATED VI Product: '{$item['vi_title']}' (ID: {$vi_id})\n";
	} else {
		$vi_id = $vi_p->ID;
		wp_update_post( array(
			'ID'           => $vi_id,
			'post_excerpt' => $item['vi_excerpt'],
			'post_content' => $item['vi_content'],
		) );
		echo "EXISTING VI Product: '{$item['vi_title']}' (ID: {$vi_id})\n";
	}
	pll_set_post_language( $vi_id, 'vi' );
	update_post_meta( $vi_id, '_regular_price', $item['price'] );
	update_post_meta( $vi_id, '_price', $item['price'] );
	update_post_meta( $vi_id, '_stock_status', 'instock' );

	// Force attach featured image from Labcos URL
	$thumb_id = get_post_thumbnail_id( $vi_id );
	if ( $thumb_id ) {
		$img_url = wp_get_attachment_url( $thumb_id );
		if ( false !== stripos( (string) $img_url, 'logo' ) ) {
			wp_delete_attachment( $thumb_id, true );
			$thumb_id = 0;
		}
	}
	if ( ! $thumb_id && ! empty( $item['image_url'] ) ) {
		$thumb_id = vinacos_sideload_product_image( $item['image_url'], $vi_id );
		if ( $thumb_id ) {
			echo "ATTACHED Featured Image (ID {$thumb_id}) to VI Product ID {$vi_id}\n";
		}
	}
	if ( $thumb_id ) {
		set_post_thumbnail( $vi_id, $thumb_id );
	}

	// Assign VI category
	$vi_cat = get_term_by( 'slug', $item['cat_slug_vi'], 'product_cat' );
	if ( $vi_cat ) {
		wp_set_post_terms( $vi_id, array( (int) $vi_cat->term_id ), 'product_cat' );
	}

	// Find or create EN product
	$en_p = get_page_by_title( $item['en_title'], OBJECT, 'product' );
	if ( ! $en_p ) {
		$en_id = wp_insert_post( array(
			'post_title'   => $item['en_title'],
			'post_excerpt' => $item['en_excerpt'],
			'post_content' => $item['en_content'],
			'post_status'  => 'publish',
			'post_type'    => 'product',
		) );
		echo "CREATED EN Product: '{$item['en_title']}' (ID: {$en_id})\n";
	} else {
		$en_id = $en_p->ID;
		wp_update_post( array(
			'ID'           => $en_id,
			'post_excerpt' => $item['en_excerpt'],
			'post_content' => $item['en_content'],
		) );
		echo "EXISTING EN Product: '{$item['en_title']}' (ID: {$en_id})\n";
	}
	pll_set_post_language( $en_id, 'en' );
	update_post_meta( $en_id, '_regular_price', $item['price'] );
	update_post_meta( $en_id, '_price', $item['price'] );
	update_post_meta( $en_id, '_stock_status', 'instock' );

	// Attach same featured image to EN product
	if ( $thumb_id ) {
		set_post_thumbnail( $en_id, $thumb_id );
	}

	// Assign EN category
	if ( $vi_cat ) {
		$term_trans = function_exists( 'pll_get_term_translations' ) ? pll_get_term_translations( $vi_cat->term_id ) : array();
		if ( ! empty( $term_trans['en'] ) ) {
			wp_set_post_terms( $en_id, array( (int) $term_trans['en'] ), 'product_cat' );
		}
	}

	// Link VI <-> EN via Polylang
	pll_save_post_translations( array(
		'vi' => $vi_id,
		'en' => $en_id,
	) );
	echo "LINKED: VI (ID {$vi_id}) <-> EN (ID {$en_id})\n\n";
}

flush_rewrite_rules();
echo "=== VINACOS PRODUCT SEEDER COMPLETED SUCCESSFULLY ===\n";

flush_rewrite_rules();
echo "=== VINACOS PRODUCT SEEDER COMPLETED SUCCESSFULLY ===\n";
