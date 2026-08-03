<?php
/**
 * Single Product Detail Template — Dynamic WordPress Product rendering with Polylang translation support.
 *
 * @package SPL
 */

defined( 'ABSPATH' ) || exit;

get_header();

$current_lang = function_exists( 'pll_current_language' ) ? pll_current_language() : 'vi';

// Labels according to language
$is_en = ( 'en' === $current_lang );
$lbl_home            = $is_en ? 'Home' : 'Trang chủ';
$lbl_products        = $is_en ? 'Products' : 'Sản phẩm';
$lbl_register_sample = $is_en ? 'Request Sample' : 'Đăng ký nhận mẫu';
$lbl_prod_info       = $is_en ? 'Product Information' : 'Thông tin sản phẩm';
$lbl_prod_intro      = $is_en ? '1. Product Overview' : '1. Giới thiệu sản phẩm';
$lbl_oem_advantages  = $is_en ? '2. VINACOS OEM/ODM Advantages' : '2. Ưu điểm dịch vụ gia công mỹ phẩm tại VINACOS';

$lbl_origin_key      = $is_en ? 'Origin:' : 'Xuất xứ:';
$lbl_origin_val      = $is_en ? 'VINACOS Cosmetics Co., Ltd' : 'Công ty TNHH VINACOS';

// Post details
$prod_title   = get_the_title();
$prod_excerpt = get_the_excerpt();
$prod_content = get_the_content();

// Product images
$thumb_id   = get_post_thumbnail_id();
$thumb_url  = $thumb_id ? wp_get_attachment_url( $thumb_id ) : 'https://unila.com.vn/wp-content/uploads/2024/07/SUA-RUA-MAT-DANG-KEM-H1.png';
$gallery_ids = get_post_meta( get_the_ID(), '_product_image_gallery', true );
$gallery_arr = ! empty( $gallery_ids ) ? explode( ',', $gallery_ids ) : array();

$all_images = array( $thumb_url );
foreach ( $gallery_arr as $g_id ) {
	$g_url = wp_get_attachment_url( (int) trim( $g_id ) );
	if ( $g_url ) {
		$all_images[] = $g_url;
	}
}

$contact_url  = function_exists( 'pll_home_url' ) ? pll_home_url( $current_lang ) . 'lien-he/' : home_url( '/lien-he/' );
$products_url = function_exists( 'pll_home_url' ) ? pll_home_url( $current_lang ) . 'san-pham/' : home_url( '/san-pham/' );
?>

<section class="global-breadcrumb">
	<div class="container">
		<nav aria-label="breadcrumbs" class="rank-math-breadcrumb">
			<p>
				<a href="<?php echo esc_url( function_exists( 'pll_home_url' ) ? pll_home_url() : home_url( '/' ) ); ?>"><?php echo esc_html( $lbl_home ); ?></a>
				<span class="separator"> - </span>
				<a href="<?php echo esc_url( spl_fix_dynamic_url( $products_url ) ); ?>"><?php echo esc_html( $lbl_products ); ?></a>
				<span class="separator"> - </span>
				<span class="last"><?php echo esc_html( $prod_title ); ?></span>
			</p>
		</nav>
	</div>
</section>

<section class="product-detail-section section-large">
	<div class="container">
		<div class="row -mt-10">
			<div class="col w-full mt-10 lg:w-1/2">
				<div class="product-gallery">
					<div class="product-top">
						<div class="swiper product-preview">
							<div class="swiper-wrapper">
								<?php foreach ( $all_images as $img_item ) : ?>
									<div class="swiper-slide">
										<div class="image img-cover">
											<img class="lozad" src="<?php echo esc_url( $img_item ); ?>" data-src="<?php echo esc_url( $img_item ); ?>" alt="<?php echo esc_attr( $prod_title ); ?>">
										</div>
									</div>
								<?php endforeach; ?>
							</div>
							<?php if ( count( $all_images ) > 1 ) : ?>
								<div class="swiper-button">
									<div class="button-prev"><?= spl_icon( 'chevron-left', '', 20 ) ?></div>
									<div class="button-next"><?= spl_icon( 'chevron-right', '', 20 ) ?></div>
								</div>
							<?php endif; ?>
						</div>
						<?php if ( count( $all_images ) > 1 ) : ?>
							<div class="swiper product-thumbs mt-4">
								<div class="swiper-wrapper">
									<?php foreach ( $all_images as $img_item ) : ?>
										<div class="swiper-slide">
											<div class="image img-cover">
												<img class="lozad" src="<?php echo esc_url( $img_item ); ?>" data-src="<?php echo esc_url( $img_item ); ?>" alt="<?php echo esc_attr( $prod_title ); ?>">
											</div>
										</div>
									<?php endforeach; ?>
								</div>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<div class="col w-full mt-10 lg:w-1/2">
				<div class="block-content">
					<h1 class="product-detail-title site-sub-title"><?php echo esc_html( $prod_title ); ?></h1>
					<div class="site-desc mt-3 space-y-3">
						<?php if ( ! empty( $prod_excerpt ) ) : ?>
							<?php echo wp_kses_post( wpautop( $prod_excerpt ) ); ?>
						<?php else : ?>
							<p><?php echo esc_html( $is_en ? 'High quality OEM/ODM cosmetic formulation by VINACOS.' : 'Dòng sản phẩm gia công mỹ phẩm chuẩn y khoa nghiên cứu bởi VINACOS.' ); ?></p>
						<?php endif; ?>
						<p><strong><?php echo esc_html( $lbl_origin_key ); ?></strong> <?php echo esc_html( $lbl_origin_val ); ?></p>
					</div>
					<div class="button mt-10">
						<a class="btn-lined" href="<?php echo esc_url( spl_fix_dynamic_url( $contact_url ) ); ?>" title="<?php echo esc_attr( $lbl_register_sample ); ?>">
							<span><?php echo esc_html( $lbl_register_sample ); ?></span>
							<?= spl_icon( 'phone', '', 16 ) ?>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="product-accordion-section section-large bg-neutral-50">
	<div class="container">
		<h2 class="site-sub-title text-center"><?php echo esc_html( $lbl_prod_info ); ?></h2>
		<div class="accordion-list mt-10">
			<div class="accordion-item active">
				<div class="accordion-head">
					<h3 class="accordion-title"><?php echo esc_html( $lbl_prod_intro ); ?></h3>
					<i class="accordion-icon"></i>
				</div>
				<div class="accordion-content" style="display: block;">
					<div class="full-content space-y-4 text-neutral-700">
						<?php if ( ! empty( $prod_content ) ) : ?>
							<?php echo apply_filters( 'the_content', $prod_content ); ?>
						<?php else : ?>
							<p><?php echo esc_html( $is_en ? 'Complete product details and OEM/ODM manufacturing specifications.' : 'Thông tin chi tiết về sản phẩm và quy trình gia công mỹ phẩm.' ); ?></p>
						<?php endif; ?>
					</div>
				</div>
			</div>

			<div class="accordion-item">
				<div class="accordion-head">
					<h3 class="accordion-title"><?php echo esc_html( $lbl_oem_advantages ); ?></h3>
					<i class="accordion-icon"></i>
				</div>
				<div class="accordion-content">
					<div class="full-content space-y-3 text-neutral-700">
						<?php if ( $is_en ) : ?>
							<p>• High-level R&D team offering custom formula development aligned with brand positioning.</p>
							<p>• cGMP & FDA certified manufacturing facilities ensuring thousands of units daily output.</p>
							<p>• End-to-end legal & compliance support: Quality testing reports, Ministry of Health filings (A-Z).</p>
						<?php else : ?>
							<p>• Đội ngũ R&D trình độ cao hỗ trợ tùy chỉnh công thức theo định vị thương hiệu đối tác.</p>
							<p>• Nhà máy sản xuất chuẩn cGMP & FDA đảm bảo năng suất hàng nghìn sản phẩm/ngày.</p>
							<p>• Hỗ trợ trọn gói thủ tục pháp lý A-Z: Phiếu kiểm nghiệm, hồ sơ công bố Y tế.</p>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();
