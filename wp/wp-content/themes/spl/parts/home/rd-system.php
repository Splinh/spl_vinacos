<?php
/**
 * R&D System Section (HỆ THỐNG R&D)
 *
 * @package SPL
 */

defined( 'ABSPATH' ) || exit;

$is_en   = function_exists( 'pll_current_language' ) && 'en' === pll_current_language();
$section = $args ?? array();
$items   = $section['items'] ?? array();

if ( empty( $items ) ) {
	$items = $is_en ? array(
		array(
			'label'    => 'R&D System',
			'title'    => 'Formula & Raw Ingredient Research',
			'desc'     => 'VINACOS R&D Center focuses on active raw material extraction and turn-key OEM/ODM cosmetic formulation engineering, ensuring stability, efficacy, and automated scale-up production.',
			'btn_text' => 'Learn More',
			'btn_link' => home_url( '/en/oem-odm-cosmetics-manufacturing/' ),
			'image'    => 'https://unila.com.vn/wp-content/uploads/2026/04/HE-THONG-RD-2.1.jpg',
		),
		array(
			'label'    => 'R&D System',
			'title'    => 'Scientific Papers & Innovations',
			'desc'     => 'Applying lipid nano-emulsion and bio-encapsulation in active skincare: Scientific breakthroughs delivering targeted transdermal absorption and active preservation.',
			'btn_text' => 'Learn More',
			'btn_link' => home_url( '/en/oem-odm-cosmetics-manufacturing/' ),
			'image'    => 'https://unila.com.vn/wp-content/uploads/2026/03/HE-THONG-RD-2.jpg',
		),
	) : array(
		array(
			'label'    => 'Hệ thống R&D',
			'title'    => 'Năng lực nghiên cứu sản xuất',
			'desc'     => 'VINACOS tập trung vào hai hướng nghiên cứu cốt lõi. Về nguyên liệu, chúng tôi khai thác và đánh giá các nguồn nguyên liệu tiềm năng, từ tách chiết, phân tích hoạt chất đến thử nghiệm độ ổn định. Về sản phẩm, chúng tôi phát triển công thức mỹ phẩm hoàn chỉnh OEM/ODM, đảm bảo hiệu quả, cảm quan cao cấp, sẵn sàng sản xuất hàng loạt.',
			'btn_text' => 'Tìm hiểu thêm',
			'btn_link' => home_url( '/oem-odm-gia-cong-unila-viet-nam/' ),
			'image'    => 'https://unila.com.vn/wp-content/uploads/2026/04/HE-THONG-RD-2.1.jpg',
		),
		array(
			'label'    => 'Hệ thống R&D',
			'title'    => 'Các bài báo & Công trình khoa học',
			'desc'     => 'Ứng dụng hệ thống nhũ tương nano lipid và màng bao sinh học bọc hoạt chất trong mỹ phẩm chăm sóc da: Công trình nghiên cứu ứng dụng công nghệ hiện đại giúp hoạt chất thẩm thấu sâu và bảo toàn hiệu quả trên làn da người Việt.',
			'btn_text' => 'Tìm hiểu thêm',
			'btn_link' => home_url( '/oem-odm-gia-cong-unila-viet-nam/' ),
			'image'    => 'https://unila.com.vn/wp-content/uploads/2026/03/HE-THONG-RD-2.jpg',
		),
	);
}
?>

<section class="home-3-section section-small" id="rd-system">
	<div class="container">
		<div class="swiper-relative is-page">
			<div class="swiper home-3-top">
				<div class="swiper-wrapper">
					<?php foreach ( $items as $item ) : 
						$item_img = is_array( $item['image'] ?? null ) ? ( $item['image']['url'] ?? '' ) : ( is_numeric( $item['image'] ?? null ) ? wp_get_attachment_url( $item['image'] ) : ( $item['image'] ?? '' ) );
						$btn_url  = is_array( $item['btn_link'] ?? null ) ? ( $item['btn_link']['url'] ?? '#' ) : ( $item['btn_link'] ?? '#' );
						$btn_text = $item['btn_text'] ?? ( $is_en ? 'Learn More' : 'Tìm hiểu thêm' );
					?>
						<div class="swiper-slide">
							<div class="home-3-item" data-aos="fade-right" data-aos-duration="700">
								<div class="caption">
									<p class="site-title"><?php echo esc_html( $item['label'] ?? ( $is_en ? 'R&D System' : 'Hệ thống R&D' ) ); ?></p>
									<h3 class="title mt-3"><?php echo esc_html( $item['title'] ?? '' ); ?></h3>
									<div class="desc mt-3"><?php echo esc_html( $item['desc'] ?? '' ); ?></div>
									<div class="button mt-10">
										<a class="btn-lined" href="<?php echo esc_url( $btn_url ); ?>" title="<?php echo esc_attr( $btn_text ); ?>">
											<span><?php echo esc_html( $btn_text ); ?></span>
											<?= spl_icon( 'plus', '', 16 ) ?>
										</a>
									</div>
								</div>
								<div class="image img-contain" data-aos="fade-left" data-aos-duration="700">
									<img class="lozad" src="<?php echo esc_url( $item_img ); ?>" data-src="<?php echo esc_url( $item_img ); ?>" loading="lazy" alt="<?php echo esc_attr( $item['title'] ?? '' ); ?>" width="600" height="400">
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="swiper home-3-thumbs mt-6" data-aos="fade-up" data-aos-duration="700">
				<div class="swiper-wrapper">
					<?php foreach ( $items as $idx => $item ) : ?>
						<div class="swiper-slide">
							<div class="home-3-title">
								0<?php echo ( $idx + 1 ); ?>. <?php echo esc_html( $item['title'] ?? '' ); ?>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</section>
