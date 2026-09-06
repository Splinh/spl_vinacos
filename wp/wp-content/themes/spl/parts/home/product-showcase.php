<?php
/**
 * Product Showcase Section (DANH MỤC SẢN PHẨM VINACOS)
 *
 * @package SPL
 */

defined( 'ABSPATH' ) || exit;

$is_en   = function_exists( 'pll_current_language' ) && 'en' === pll_current_language();
$section = $args ?? array();
$title   = $section['title'] ?? ( $is_en ? 'Featured Product Portfolio' : 'Danh mục sản phẩm tiêu biểu' );
$items   = $section['items'] ?? array();

$img_base = get_template_directory_uri() . '/static/img/products/';
if ( empty( $items ) ) {
	$items = $is_en ? array(
		array(
			'title'       => 'Silicone-Free Water-Droplet Cream Base',
			'description' => 'Cooling water-burst texture engineered without silicone, 100% lipid-friendly & safe for delicate sensitive skin.',
			'btn_text'    => 'Learn More',
			'btn_link'    => home_url( '/en/cosmetics-oem-products/' ),
			'image'       => $img_base . 'product1.jpg',
		),
		array(
			'title'       => 'Detoxifying Green Tea Mineral Clay Mask',
			'description' => 'Absorbs excess sebum & impurities with natural mineral clay complex while preserving skin moisture barrier.',
			'btn_text'    => 'Learn More',
			'btn_link'    => home_url( '/en/cosmetics-oem-products/' ),
			'image'       => $img_base . 'product2.jpg',
		),
		array(
			'title'       => 'Natural Rice Husk Silica Exfoliator',
			'description' => 'Bio-sustainable scrubbing system using upcycled rice husk silica, replacing microplastics with spherical bio-particles.',
			'btn_text'    => 'Learn More',
			'btn_link'    => home_url( '/en/cosmetics-oem-products/' ),
			'image'       => $img_base . 'product3.jpg',
		),
		array(
			'title'       => 'Chamomile Soothing & Recovery Mud Mask',
			'description' => 'Combines natural mineral mud with standardized Chamomile extract for instant redness relief & skin barrier repair.',
			'btn_text'    => 'Learn More',
			'btn_link'    => home_url( '/en/cosmetics-oem-products/' ),
			'image'       => $img_base . 'product4.jpg',
		),
	) : array(
		array(
			'title'       => 'Nền kem vỡ nước - Không Silicone',
			'description' => 'Hiệu ứng “vỡ nước” tươi mát khi thoa vốn thường chỉ đạt được nhờ hệ nhũ water-in-silicone. VINACOS nghiên cứu thành công nền công thức tương đương hoàn toàn không chứa silicone, an toàn tuyệt đối cho làn da nhạy cảm.',
			'btn_text'    => 'Xem thêm',
			'btn_link'    => home_url( '/san-pham-gia-cong-unila-viet-nam/' ),
			'image'       => $img_base . 'product1.jpg',
		),
		array(
			'title'       => 'Mặt nạ đất sét trà xanh Detox',
			'description' => 'Ứng dụng hệ đất sét khoáng tự nhiên hấp thụ bã nhờn và độc tố hiệu quả, làm sạch sâu lỗ chân lông mà vẫn duy trì độ ẩm tự nhiên cho da.',
			'btn_text'    => 'Xem thêm',
			'btn_link'    => home_url( '/san-pham-gia-cong-unila-viet-nam/' ),
			'image'       => $img_base . 'product2.jpg',
		),
		array(
			'title'       => 'Tẩy tế bào chết Silica từ vỏ trấu Việt Nam',
			'description' => 'Giải pháp thay thế vi nhựa và silica công nghiệp bằng silica sinh học chiết xuất từ vỏ trấu Việt Nam. Tẩy da chết nhẹ nhàng, tự phân hủy sinh học, bảo vệ môi trường.',
			'btn_text'    => 'Xem thêm',
			'btn_link'    => home_url( '/san-pham-gia-cong-unila-viet-nam/' ),
			'image'       => $img_base . 'product3.jpg',
		),
		array(
			'title'       => 'Mặt nạ bùn Cúc La Mã làm dịu & phục hồi',
			'description' => 'Kết hợp bùn khoáng thiên nhiên với chiết xuất Cúc La Mã chuẩn hóa, giúp làm dịu tức thì làn da kích ứng và củng cố hàng rào bảo vệ da.',
			'btn_text'    => 'Xem thêm',
			'btn_link'    => home_url( '/san-pham-gia-cong-unila-viet-nam/' ),
			'image'       => $img_base . 'product4.jpg',
		),
	);
}
?>

<section class="home-5-section" id="products">
	<div class="block-content">
		<h2 class="site-title" data-aos="fade-up" data-aos-duration="700">
			<?php echo esc_html( $title ); ?>
		</h2>
		<div class="swiper-relative is-page mt-10">
			<div class="swiper home-5-caption">
				<div class="swiper-wrapper">
					<?php foreach ( $items as $item ) : 
						$btn_url  = is_array( $item['btn_link'] ?? null ) ? ( $item['btn_link']['url'] ?? '#' ) : ( $item['btn_link'] ?? '#' );
						$btn_text = $item['btn_text'] ?? ( $is_en ? 'Learn More' : 'Xem thêm' );
					?>
						<div class="swiper-slide">
							<div class="home-5-item">
								<h3 class="title" data-aos="fade-up" data-aos-duration="700">
									<?php echo esc_html( $item['title'] ?? '' ); ?>
								</h3>
								<div class="desc mt-5" data-aos="fade-up" data-aos-duration="700" data-aos-delay="300">
									<?php echo esc_html( $item['description'] ?? '' ); ?>
								</div>
								<div class="button mt-5" data-aos="fade-up" data-aos-duration="700" data-aos-delay="600">
									<a class="btn-lined" href="<?php echo esc_url( $btn_url ); ?>" title="<?php echo esc_attr( $btn_text ); ?>">
										<span><?php echo esc_html( $btn_text ); ?></span>
										<?= spl_icon( 'plus', '', 16 ) ?>
									</a>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="swiper home-5-image mt-6 xl:mt-16" data-aos="fade-up" data-aos-duration="700" data-aos-delay="300">
				<div class="swiper-wrapper">
					<?php foreach ( $items as $item ) : 
						$img_url = is_array( $item['image'] ?? null ) ? ( $item['image']['url'] ?? '' ) : ( is_numeric( $item['image'] ?? null ) ? wp_get_attachment_url( $item['image'] ) : ( $item['image'] ?? '' ) );
					?>
						<div class="swiper-slide">
							<div class="image img-cover">
								<img class="lozad" src="<?php echo esc_url( $img_url ); ?>" data-src="<?php echo esc_url( $img_url ); ?>" loading="lazy" alt="<?php echo esc_attr( $item['title'] ?? '' ); ?>" width="800" height="600">
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="home-5-controller" data-aos="fade-right" data-aos-duration="700" data-aos-delay="300">
		<div class="swiper home-5-preview">
			<div class="swiper-wrapper">
				<?php foreach ( $items as $item ) : 
					$img_url = is_array( $item['image'] ?? null ) ? ( $item['image']['url'] ?? '' ) : ( is_numeric( $item['image'] ?? null ) ? wp_get_attachment_url( $item['image'] ) : ( $item['image'] ?? '' ) );
				?>
					<div class="swiper-slide">
						<div class="image img-cover">
							<img class="lozad" src="<?php echo esc_url( $img_url ); ?>" data-src="<?php echo esc_url( $img_url ); ?>" loading="lazy" alt="<?php echo esc_attr( $item['title'] ?? '' ); ?>" width="200" height="150">
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
