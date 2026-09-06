<?php
/**
 * Hero Banner Slider — 100% Unila HTML structure & VINACOS titles.
 *
 * @package SPL
 */

defined( 'ABSPATH' ) || exit;

$is_en   = function_exists( 'pll_current_language' ) && 'en' === pll_current_language();
$section = $args ?? array();
$slides  = $section['slides'] ?? array();

$default_vinacos_slides = $is_en ? array(
	array(
		'title_lines' => array( 'PIONEERING CLEAN BEAUTY', 'SCIENTIFIC FORMULATION', 'OEM/ODM EXCELLENCE' ),
		'desc'        => 'VINACOS pioneers scientific research & clean cosmetics manufacturing in Vietnam, setting new standards for international beauty brands.',
		'btn_text'    => 'Explore More',
		'btn_link'    => home_url( '/en/partner-mindset-about/' ),
	),
	array(
		'title_lines' => array( 'DERMATOLOGY SCIENCE', 'TAILORED FOR SKIN', 'TRUSTED BRAND PARTNER' ),
		'desc'        => 'VINACOS delivers safe, efficacious, and medically verified cosmetics formulas tailored for global market standards.',
		'btn_text'    => 'Explore More',
		'btn_link'    => home_url( '/en/cosmetics-oem-products/' ),
	),
	array(
		'title_lines' => array( '0% HARMFUL SUBSTANCES', '100% VERIFIED FORMULAS', 'FULL REGULATORY FILINGS' ),
		'desc'        => 'VINACOS prioritizes formula transparency & efficacy: 0% illegal actives, 100% stability tested, full A-Z legal compliance.',
		'btn_text'    => 'Explore More',
		'btn_link'    => home_url( '/en/oem-odm-cosmetics-manufacturing/' ),
	),
	array(
		'title_lines' => array( 'PROVEN R&D CAPACITY', '300+ EXCLUSIVE FORMULAS', 'FULL CLINICAL TRIALS' ),
		'desc'        => '300+ exclusive formulations. 10+ years R&D excellence. Behind every product is solid scientific data and clinical testing.',
		'btn_text'    => 'Explore More',
		'btn_link'    => home_url( '/en/cosmetics-oem-products/' ),
	),
) : array(
	array(
		'title_lines' => array( 'MỞ LỐI KỶ NGUYÊN', 'MỸ PHẨM VIỆT', 'CHUẨN KHOA HỌC' ),
		'desc'        => 'VINACOS là đơn vị tiên phong ứng dụng khoa học vào nghiên cứu và gia công mỹ phẩm sạch. Dẫn đầu để đặt ra tiêu chuẩn mới cho thương hiệu mỹ phẩm Việt.',
		'btn_text'    => 'Xem thêm',
		'btn_link'    => home_url( '/ve-chung-toi/' ),
	),
	array(
		'title_lines' => array( 'HIỂU LÀN DA VIỆT', 'ĐỒNG HÀNH', 'THƯƠNG HIỆU VIỆT' ),
		'desc'        => 'VINACOS tin rằng người Việt xứng đáng được chăm sóc bằng những công thức an toàn, lành tính, chuẩn y khoa.',
		'btn_text'    => 'Xem thêm',
		'btn_link'    => home_url( '/san-pham-gia-cong-unila-viet-nam/' ),
	),
	array(
		'title_lines' => array( 'RỦI RO LỚN NHẤT', 'LÀ SAI TỪ CÔNG THỨC' ),
		'desc'        => 'VINACOS đặt sự an toàn và tính minh bạch lên hàng đầu: 0% sai sót về hoạt chất cấm – 100% kiểm nghiệm công thức – Hồ sơ pháp lý A-Z.',
		'btn_text'    => 'Xem thêm',
		'btn_link'    => home_url( '/oem-odm-gia-cong-unila-viet-nam/' ),
	),
	array(
		'title_lines' => array( 'SỨC MẠNH', 'TỪ HỆ THỐNG R&D' ),
		'desc'        => '300+ công thức độc quyền. 10+ năm kinh nghiệm R&D. Đằng sau mỗi sản phẩm là dữ liệu khoa học & kiểm định lâm sàng.',
		'btn_text'    => 'Xem thêm',
		'btn_link'    => home_url( '/san-pham-gia-cong-unila-viet-nam/' ),
	),
);

$img_base = get_template_directory_uri() . '/static/img/banner';
?>

<section class="home-banner one-scroll">
	<div class="banner-slider">
		<div class="swiper key-visual-swiper start">
			<div class="swiper-wrapper key-visual-wrapper">
				<?php for ( $i = 0; $i < 4; $i++ ) : 
					$s = $slides[ $i ] ?? array();
					$v = $default_vinacos_slides[ $i ];

					$raw_desk = ! empty( $s['bg_image'] ) ? $s['bg_image'] : ( ! empty( $s['desktop_image'] ) ? $s['desktop_image'] : ( ! empty( $s['image'] ) ? $s['image'] : '' ) );
					$raw_mobi = ! empty( $s['bg_image_mobile'] ) ? $s['bg_image_mobile'] : ( ! empty( $s['mobile_image'] ) ? $s['mobile_image'] : '' );

					$desktop_img = function_exists( 'spl_get_image_url' ) ? spl_get_image_url( $raw_desk, $img_base . '/slide' . ( $i + 1 ) . '-desktop.jpg' ) : ( $img_base . '/slide' . ( $i + 1 ) . '-desktop.jpg' );
					$mobile_img  = function_exists( 'spl_get_image_url' ) ? spl_get_image_url( $raw_mobi, $img_base . '/slide' . ( $i + 1 ) . '-mobile.jpg' ) : ( $img_base . '/slide' . ( $i + 1 ) . '-mobile.jpg' );

					if ( 0 === $i ) {
						if ( empty( $raw_desk ) || false !== strpos( (string) $desktop_img, 'slide1-desktop.jpg' ) ) {
							$desktop_img = $img_base . '/slide1-desktop.webp';
						}
						if ( empty( $raw_mobi ) || false !== strpos( (string) $mobile_img, 'slide1-mobile.jpg' ) ) {
							$mobile_img  = $img_base . '/slide1-mobile.webp';
						}
					}

					$title_lines = array();
					if ( ! empty( $s['title_line_1'] ) ) { $title_lines[] = $s['title_line_1']; }
					if ( ! empty( $s['title_line_2'] ) ) { $title_lines[] = $s['title_line_2']; }
					if ( ! empty( $s['title_line_3'] ) ) { $title_lines[] = $s['title_line_3']; }
					if ( empty( $title_lines ) && ! empty( $s['title'] ) ) {
						$title_lines = is_array( $s['title'] ) ? $s['title'] : explode( "\n", (string) $s['title'] );
					}
					if ( empty( $title_lines ) ) {
						$title_lines = (array) ( $v['title_lines'] ?? array() );
					}
					$title_lines = array_filter( array_map( 'trim', (array) $title_lines ) );
					if ( empty( $title_lines ) ) {
						$title_lines = (array) ( $v['title_lines'] ?? array( 'VINACOS' ) );
					}

					$desc     = ! empty( $s['description'] ) ? $s['description'] : $v['desc'];
					$btn_text = ! empty( $s['button_text'] ) ? $s['button_text'] : $v['btn_text'];
					$raw_url  = ! empty( $s['button_url'] ) ? $s['button_url'] : ( ! empty( $s['btn_link'] ) ? $s['btn_link'] : $v['btn_link'] );
					$btn_url  = function_exists( 'spl_fix_dynamic_url' ) ? spl_fix_dynamic_url( $raw_url ) : $raw_url;
				?>
				<div class="swiper-slide key-visual-slide" data-swiper-autoplay="2999">
					<div class="caption container">
						<div class="content">
							<div class="banner-title">
								<?php foreach ( $title_lines as $line ) : ?>
								<div class="split-parent"><strong><?php echo esc_html( $line ); ?></strong></div>
								<?php endforeach; ?>
							</div>
							<?php if ( ! empty( $desc ) ) : ?>
							<div class="desc">
								<p><?php echo esc_html( $desc ); ?></p>
							</div>
							<?php endif; ?>
						</div>
						<?php if ( ! empty( $btn_text ) && ( 0 !== $i || ! empty( $s['button_text'] ) ) ) : ?>
						<div class="button mt-4 xl:mt-6">
							<a class="btn-lined" href="<?php echo esc_url( $btn_url ); ?>" title="<?php echo esc_attr( $btn_text ); ?>">
								<span><?php echo esc_html( $btn_text ); ?></span>
								<?= spl_icon( 'plus', '', 16 ) ?>
							</a>
						</div>
						<?php endif; ?>
					</div>
					<div class="image key-img-box">
						<div class="key-img-inner">
							<img class="mb" src="<?php echo esc_url( $mobile_img ); ?>" alt="">
							<img class="desk" src="<?php echo esc_url( $desktop_img ); ?>" alt="<?php echo esc_attr( $title_lines[0] ?? '' ); ?>">
							<?php if ( 0 === $i ) : ?>
							<a href="<?php echo esc_url( get_template_directory_uri() . '/static/video/intro-vinacos.mp4' ); ?>" class="banner-play-btn" data-fx-lightbox data-video="<?php echo esc_url( get_template_directory_uri() . '/static/video/intro-vinacos.mp4' ); ?>" aria-label="Xem video giới thiệu">
								<svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><polygon points="7 4 19 12 7 20 7 4"/></svg>
							</a>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<?php endfor; ?>
			</div>
			<div class="swiper-pagination container"></div>
		</div>
	</div>
</section>
