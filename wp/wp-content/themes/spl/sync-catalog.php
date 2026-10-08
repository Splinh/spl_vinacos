<?php
/**
 * Master One-Click Catalog Deployment & Sync Tool for VINACOS.
 *
 * Can be run via CLI:
 *   php wp/wp-content/themes/spl/tools/sync-catalog-vps.php
 * Or via browser:
 *   https://vinacos.splworks.com/wp-content/themes/spl/sync-catalog.php
 *
 * @package SPL
 */

// 1. Bootstrap WordPress
if ( ! defined( 'ABSPATH' ) ) {
	$wp_load_paths = array(
		dirname( __DIR__, 3 ) . '/wp-load.php',
		dirname( __DIR__, 4 ) . '/wp/wp-load.php',
		__DIR__ . '/wp-load.php',
		__DIR__ . '/../../../wp-load.php',
		__DIR__ . '/../../../../wp-load.php',
		dirname( __DIR__, 4 ) . '/wp-load.php',
		dirname( __DIR__, 2 ) . '/wp-load.php',
	);
	foreach ( $wp_load_paths as $p ) {
		if ( file_exists( $p ) ) {
			require_once $p;
			break;
		}
	}
}

if ( ! defined( 'ABSPATH' ) ) {
	die( "ERROR: Could not locate wp-load.php!\n" );
}

if ( ! did_action( 'init' ) ) {
	do_action( 'init' );
}

require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/media.php';
require_once ABSPATH . 'wp-admin/includes/image.php';

// Polylang API discovery
if ( ! function_exists( 'pll_save_post_translations' ) && defined( 'WP_PLUGIN_DIR' ) ) {
	$api_files = glob( WP_PLUGIN_DIR . '/polylang*/include/api*.php' );
	if ( ! empty( $api_files ) ) {
		foreach ( $api_files as $f ) {
			if ( file_exists( $f ) ) {
				require_once $f;
			}
		}
	}
}

$has_pll = function_exists( 'pll_set_term_language' ) && function_exists( 'pll_save_post_translations' );

$is_cli = ( PHP_SAPI === 'cli' );

function spl_log( $msg ) {
	global $is_cli;
	if ( $is_cli ) {
		echo $msg . "\n";
	} else {
		echo htmlspecialchars( $msg, ENT_QUOTES, 'UTF-8' ) . "<br>\n";
		flush();
	}
}

if ( ! $is_cli ) {
?>
<!DOCTYPE html>
<html lang="vi">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>VINACOS - Đồng Bộ Danh Mục & Sản Phẩm VPS</title>
	<style>
		body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; background: #0f172a; color: #e2e8f0; padding: 30px 20px; line-height: 1.6; }
		.card { max-width: 800px; margin: 0 auto; background: #1e293b; border-radius: 12px; padding: 24px; box-shadow: 0 10px 25px rgba(0,0,0,0.5); border: 1px solid #334155; }
		h1 { color: #38bdf8; font-size: 20px; margin-top: 0; border-bottom: 1px solid #334155; padding-bottom: 12px; }
		.console { background: #020617; color: #4ade80; font-family: Consolas, monospace; font-size: 13px; padding: 16px; border-radius: 8px; max-height: 500px; overflow-y: auto; }
		.btn { display: inline-block; margin-top: 16px; background: #0284c7; color: #fff; padding: 10px 20px; border-radius: 6px; text-decoration: none; font-weight: bold; }
	</style>
</head>
<body>
<div class="card">
	<h1>VINACOS - Triển Khai Danh Mục & Sản Phẩm VPS</h1>
	<div class="console">
<?php
}

spl_log( "=== BẮT ĐẦU ĐỒNG BỘ DANH MỤC & SẢN PHẨM VINACOS ===" );

// --------------------------------------------------
// 1. XOÁ CÁC DANH MỤC & SẢN PHẨM CŨ (LEGACY)
// --------------------------------------------------
spl_log( "\n[1] Dọn dẹp danh mục & sản phẩm cũ..." );

$keep_slugs    = array( 'serum', 'serums', 'kem', 'creams', 'gel', 'gels-cleansers' );
$default_cat   = (int) get_option( 'default_product_cat' );
$protected_cat = array( $default_cat );
if ( $default_cat && function_exists( 'pll_get_term_translations' ) ) {
	$protected_cat = array_merge( $protected_cat, array_map( 'intval', pll_get_term_translations( $default_cat ) ) );
}

// Xoá danh mục cũ không thuộc 3 danh mục mới
$terms = get_terms( array( 'taxonomy' => 'product_cat', 'hide_empty' => false, 'lang' => '' ) );
$del_terms_count = 0;
foreach ( $terms as $t ) {
	if ( in_array( $t->slug, $keep_slugs, true ) || in_array( (int) $t->term_id, $protected_cat, true ) ) {
		continue;
	}
	wp_delete_term( $t->term_id, 'product_cat' );
	spl_log( "  - Đã xoá danh mục cũ: #{$t->term_id} '{$t->name}' ({$t->slug})" );
	$del_terms_count++;
}
spl_log( "  -> Đã dọn {$del_terms_count} danh mục cũ." );

// --------------------------------------------------
// 2. TẠO & LIÊN KẾT 3 DANH MỤC (VI <-> EN)
// --------------------------------------------------
spl_log( "\n[2] Thiết lập 3 danh mục chính (VI & EN)..." );

$categories = array(
	'serum' => array( 'Serum', 'serum', 'Serums', 'serums' ),
	'kem'   => array( 'Kem', 'kem', 'Creams', 'creams' ),
	'gel'   => array( 'Gel', 'gel', 'Gels & Cleansers', 'gels-cleansers' ),
);

function spl_ensure_cat( $name, $slug, $lang, $has_pll ) {
	$found = term_exists( $slug, 'product_cat' );
	if ( $found ) {
		$term_id = (int) ( is_array( $found ) ? $found['term_id'] : $found );
	} else {
		$res = wp_insert_term( $name, 'product_cat', array( 'slug' => $slug ) );
		if ( is_wp_error( $res ) ) {
			return 0;
		}
		$term_id = (int) $res['term_id'];
	}
	if ( $has_pll && pll_get_term_language( $term_id ) !== $lang && count( pll_get_term_translations( $term_id ) ) <= 1 ) {
		pll_set_term_language( $term_id, $lang );
	}
	return $term_id;
}

$term_ids = array();
foreach ( $categories as $key => [ $vi_name, $vi_slug, $en_name, $en_slug ] ) {
	$vi_id = spl_ensure_cat( $vi_name, $vi_slug, 'vi', $has_pll );
	$en_id = $has_pll ? spl_ensure_cat( $en_name, $en_slug, 'en', $has_pll ) : 0;
	if ( $has_pll && $vi_id && $en_id ) {
		pll_save_term_translations( array( 'vi' => $vi_id, 'en' => $en_id ) );
	}
	$term_ids[ $key ] = array( 'vi' => $vi_id, 'en' => $en_id );
	spl_log( "  ✓ Danh mục '{$vi_name}' (#{$vi_id}) <-> '{$en_name}' (#{$en_id})" );
}

// --------------------------------------------------
// 3. DANH SÁCH 20 SẢN PHẨM & ẢNH BRANDING
// --------------------------------------------------
spl_log( "\n[3] Thiết lập 20 sản phẩm và gắn ảnh demo branding..." );

$products_catalog = array(
	array( 'serum', 'Serum Mụn', 'Acne Serum', 'vinacos-serum-mun.jpg' ),
	array( 'serum', 'Serum Phục Hồi', 'Repair Serum', 'vinacos-serum-phuc-hoi.jpg' ),
	array( 'serum', 'Serum Tảo Enzyme', 'Algae Enzyme Serum', 'vinacos-serum-tao-enzyme.jpg' ),
	array( 'serum', 'Serum Trị Sẹo', 'Scar Treatment Serum', 'vinacos-serum-tri-seo.jpg' ),
	array( 'serum', 'Serum Tan Nám', 'Melasma Fading Serum', 'vinacos-serum-tan-nam.jpg' ),
	array( 'serum', 'Serum Tế Bào Gốc', 'Stem Cell Serum', 'vinacos-serum-te-bao-goc.jpg' ),
	array( 'serum', 'Tinh Chất Phục Hồi', 'Repair Essence', 'vinacos-tinh-chat-phuc-hoi.jpg' ),

	array( 'kem', 'Kem Chấm Nám Chuyên Sâu', 'Intensive Melasma Spot Cream', 'vinacos-kem-cham-nam.jpg' ),
	array( 'kem', 'Kem Ức Chế Nám', 'Melasma Inhibiting Cream', 'vinacos-kem-uc-che-nam.jpg' ),
	array( 'kem', 'Bộ Làm Mờ Nám', 'Melasma Fading Set', 'vinacos-bo-lam-mo-nam.jpg' ),
	array( 'kem', 'Bộ Kem Nám Da - Tăng Sắc Tố', 'Melasma & Hyperpigmentation Cream Set', 'vinacos-bo-kem-nam-da.jpg' ),
	array( 'kem', 'Kem Nám Đêm', 'Night Melasma Cream', 'vinacos-kem-nam-dem.jpg' ),
	array( 'kem', 'Kem Dưỡng Phục Hồi', 'Repair Moisturizing Cream', 'vinacos-kem-duong-phuc-hoi.jpg' ),
	array( 'kem', 'Kem Sẹo Đa Năng', 'Multi-Purpose Scar Cream', 'vinacos-kem-seo-da-nang.jpg' ),
	array( 'kem', 'Kem Thải Độc Đông Y', 'Herbal Detox Cream', 'vinacos-kem-thai-doc-dong-y.jpg' ),
	array( 'kem', 'Kem Bạch Ngọc', 'Pearl White Brightening Cream', 'vinacos-kem-bach-ngoc.jpg' ),
	array( 'kem', 'Kem Chống Nắng', 'Sunscreen Cream', 'vinacos-kem-chong-nang.jpg' ),
	array( 'kem', 'Kem Dưỡng Trắng', 'Whitening Cream', 'vinacos-kem-duong-trang.jpg' ),

	array( 'gel', 'Gel Rửa Mặt', 'Facial Cleansing Gel', 'vinacos-gel-rua-mat.jpg' ),
	array( 'gel', 'Sữa Rửa Mặt Bạc Hà', 'Mint Facial Cleanser', 'vinacos-sua-rua-mat-bac-ha.jpg' ),
);

// Đường dẫn thư mục ảnh trong theme
$demo_img_dir = get_template_directory() . '/static/img/catalog-demo';
if ( ! is_dir( $demo_img_dir ) ) {
	$demo_img_dir = get_template_directory() . '/assets/img/catalog-demo';
}

function spl_find_product( $title ) {
	global $wpdb;
	return (int) $wpdb->get_var( $wpdb->prepare(
		"SELECT ID FROM {$wpdb->posts} WHERE post_type = 'product' AND post_title IN (%s, %s)
		 AND post_status NOT IN ('trash', 'auto-draft') ORDER BY ID ASC LIMIT 1",
		$title,
		str_replace( '&', '&amp;', $title )
	) );
}

function spl_ensure_product_item( $title, $cat_id, $lang, $has_pll ) {
	$pid = spl_find_product( $title );
	if ( ! $pid ) {
		$p = new WC_Product_Simple();
		$p->set_name( $title );
		$p->set_status( 'publish' );
		$p->set_catalog_visibility( 'visible' );
		$p->set_stock_status( 'instock' );
		if ( $cat_id ) {
			$p->set_category_ids( array( $cat_id ) );
		}
		$pid = (int) $p->save();
	} else {
		if ( $cat_id ) {
			wp_set_post_terms( $pid, array( $cat_id ), 'product_cat', true );
		}
	}
	if ( $has_pll && $pid && pll_get_post_language( $pid ) !== $lang && count( pll_get_post_translations( $pid ) ) <= 1 ) {
		pll_set_post_language( $pid, $lang );
	}
	return $pid;
}

// Xoá các sản phẩm không thuộc danh mục mới
$allowed_titles = array();
foreach ( $products_catalog as $item ) {
	$allowed_titles[] = mb_strtolower( trim( $item[1] ) );
	$allowed_titles[] = mb_strtolower( trim( $item[2] ) );
}
$all_prods = get_posts( array( 'post_type' => 'product', 'numberposts' => -1, 'post_status' => 'any', 'lang' => '', 'fields' => 'ids' ) );
$purged_count = 0;
foreach ( $all_prods as $pid ) {
	$title = mb_strtolower( trim( html_entity_decode( get_the_title( $pid ) ) ) );
	if ( ! in_array( $title, $allowed_titles, true ) ) {
		wp_delete_post( $pid, true );
		$purged_count++;
	}
}
$trashed_prods = get_posts( array( 'post_type' => 'product', 'numberposts' => -1, 'post_status' => 'trash', 'lang' => '', 'fields' => 'ids' ) );
foreach ( $trashed_prods as $tpid ) {
	wp_delete_post( $tpid, true );
	$purged_count++;
}
if ( $purged_count > 0 ) {
	spl_log( "  -> Đã xoá {$purged_count} sản phẩm cũ còn sót lại." );
}

// Tạo / cập nhật 20 sản phẩm và đính kèm ảnh
foreach ( $products_catalog as [ $cat_key, $vi_title, $en_title, $img_name ] ) {
	$vi_cat = $term_ids[ $cat_key ]['vi'];
	$en_cat = $term_ids[ $cat_key ]['en'];

	$vi_id = spl_ensure_product_item( $vi_title, $vi_cat, 'vi', $has_pll );
	$en_id = $has_pll ? spl_ensure_product_item( $en_title, $en_cat, 'en', $has_pll ) : 0;

	if ( $has_pll && $vi_id && $en_id ) {
		pll_save_post_translations( array( 'vi' => $vi_id, 'en' => $en_id ) );
		// Đảm bảo không bị Polylang sao chép chéo danh mục
		wp_set_post_terms( $vi_id, array( $vi_cat ), 'product_cat', false );
		wp_set_post_terms( $en_id, array( $en_cat ), 'product_cat', false );
	}

	// Đính kèm ảnh nếu chưa có hoặc cập nhật
	$thumb_id = (int) get_post_thumbnail_id( $vi_id );
	$img_file = $demo_img_dir . '/' . $img_name;

	if ( ( ! $thumb_id || isset( $_GET['force_images'] ) ) && file_exists( $img_file ) ) {
		$tmp = wp_tempnam( $img_name );
		copy( $img_file, $tmp );
		$new_thumb = media_handle_sideload(
			array( 'name' => $img_name, 'tmp_name' => $tmp ),
			$vi_id,
			$vi_title
		);
		if ( ! is_wp_error( $new_thumb ) ) {
			$thumb_id = (int) $new_thumb;
			set_post_thumbnail( $vi_id, $thumb_id );
			if ( $en_id ) {
				set_post_thumbnail( $en_id, $thumb_id );
			}
			spl_log( "  + Đính kèm ảnh cho: '{$vi_title}' (#{$thumb_id})" );
		}
	} else {
		if ( $en_id && $thumb_id && ! get_post_thumbnail_id( $en_id ) ) {
			set_post_thumbnail( $en_id, $thumb_id );
		}
	}

	spl_log( "  ✓ #{$vi_id} [VI] {$vi_title} <-> #{$en_id} [EN] {$en_title}" );
}

// --------------------------------------------------
// 4. CẬP NHẬT ẢNH ĐẠI DIỆN CHO DANH MỤC
// --------------------------------------------------
spl_log( "\n[4] Cập nhật ảnh đại diện cho các danh mục..." );
foreach ( array( 'serum', 'serums', 'kem', 'creams', 'gel', 'gels-cleansers' ) as $slug ) {
	$t = term_exists( $slug, 'product_cat' );
	if ( ! $t ) {
		continue;
	}
	$tid = (int) ( is_array( $t ) ? $t['term_id'] : $t );
	$first = get_posts( array(
		'post_type'   => 'product',
		'numberposts' => 1,
		'lang'        => '',
		'fields'      => 'ids',
		'tax_query'   => array( array( 'taxonomy' => 'product_cat', 'field' => 'term_id', 'terms' => $tid ) ),
	) );
	if ( $first ) {
		$thumb = (int) get_post_thumbnail_id( $first[0] );
		if ( $thumb ) {
			update_term_meta( $tid, 'thumbnail_id', $thumb );
			spl_log( "  ✓ Thumbnail danh mục '{$slug}' <- attachment #{$thumb}" );
		}
	}
}

// --------------------------------------------------
// 5. XÓA CACHE & TRANSIENTS
// --------------------------------------------------
spl_log( "\n[5] Làm mới cache..." );
delete_transient( 'spl_product_cats_top' );
delete_option( 'spl_product_cats_top' );
if ( function_exists( 'wc_delete_product_transients' ) ) {
	wc_delete_product_transients();
}
wp_cache_flush();
flush_rewrite_rules();

spl_log( "\n=== HOÀN TẤT ĐỒNG BỘ TOÀN BỘ DANH MỤC & SẢN PHẨM THÀNH CÔNG! ===" );

if ( ! $is_cli ) {
?>
	</div>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn">← Quay Về Trang Chủ</a>
</div>
</body>
</html>
<?php
}
