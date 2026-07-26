<?php
/**
 * Partners Section (ĐỐI TÁC NGUYÊN LIỆU & NGHIÊN CỨU)
 *
 * @package SPL
 */

defined( 'ABSPATH' ) || exit;

$section        = $args ?? array();
$watermark      = $section['watermark'] ?? 'VINACOS';
$watermark_img  = is_array( $section['watermark_image'] ?? null ) ? ( $section['watermark_image']['url'] ?? '' ) : ( is_numeric( $section['watermark_image'] ?? null ) ? wp_get_attachment_url( $section['watermark_image'] ) : ( $section['watermark_image'] ?? '' ) );
$left_title     = $section['left_title'] ?? 'ĐỐI TÁC <br/> NGUYÊN LIỆU';
$right_title    = $section['right_title'] ?? 'ĐỐI TÁC <br/> NGHIÊN CỨU';
$left_partners  = $section['left_partners'] ?? array();
$right_partners = $section['right_partners'] ?? array();

if ( empty( $watermark_img ) ) {
	$watermark_img = 'https://unila.com.vn/wp-content/uploads/2026/03/LO-2.png';
}

if ( empty( $left_partners ) ) {
	$left_partners = array(
		array( 'name' => 'Behn Meyer', 'logo' => 'https://unila.com.vn/wp-content/uploads/2026/03/BM.png' ),
		array( 'name' => 'CIDOLS', 'logo' => 'https://unila.com.vn/wp-content/uploads/2026/03/CIDOLS.png' ),
		array( 'name' => 'Clariant', 'logo' => 'https://unila.com.vn/wp-content/uploads/2026/03/CLARIANT.png' ),
		array( 'name' => 'DSM', 'logo' => 'https://unila.com.vn/wp-content/uploads/2026/03/DSM.png' ),
		array( 'name' => 'Oillio', 'logo' => 'https://unila.com.vn/wp-content/uploads/2026/03/OILLIO.png' ),
		array( 'name' => 'NOF', 'logo' => 'https://unila.com.vn/wp-content/uploads/2026/03/NOF.png' ),
		array( 'name' => 'Seppic', 'logo' => 'https://unila.com.vn/wp-content/uploads/2026/03/SEPPIC.png' ),
		array( 'name' => 'Solabia', 'logo' => 'https://unila.com.vn/wp-content/uploads/2026/03/SOLABIA.png' ),
	);
}

if ( empty( $right_partners ) ) {
	$right_partners = array(
		array( 'name' => 'Đại Học Công Thương', 'logo' => 'https://unila.com.vn/wp-content/uploads/2026/03/Cong-thuong.jpeg' ),
	);
}
?>

<section class="home-8-section section-small" id="partners">
	<div class="box-home-8 bg-neutral-50">
		<div class="container">
			<div class="top">
				<div class="center-content" data-aos="fade-up" data-aos-duration="700" data-aos-delay="300">
					<div class="watermark">
						<?php echo esc_html( $watermark ); ?>
					</div>
					<div class="image-preview img-contain">
						<img class="lozad" src="<?php echo esc_url( $watermark_img ); ?>" data-src="<?php echo esc_url( $watermark_img ); ?>" loading="lazy" alt="VINACOS VIỆT NAM" width="300" height="300">
					</div>
				</div>

				<!-- Left Slider: Raw Material Partners -->
				<div class="swiper-relative is-page one-slider left-slider no-dynamic-bullets" data-aos="fade-right" data-aos-duration="700" data-aos-delay="600">
					<h2 class="site-title">
						<?php echo wp_kses_post( $left_title ); ?>
					</h2>
					<div class="swiper mt-10">
						<div class="swiper-wrapper">
							<?php foreach ( $left_partners as $partner ) : 
								$logo_url = is_array( $partner['logo'] ?? null ) ? ( $partner['logo']['url'] ?? '' ) : ( is_numeric( $partner['logo'] ?? null ) ? wp_get_attachment_url( $partner['logo'] ) : ( $partner['logo'] ?? '' ) );
							?>
								<div class="swiper-slide">
									<div class="customer-item">
										<div class="head">
											<div class="avatar img-cover">
												<img class="lozad" src="<?php echo esc_url( $logo_url ); ?>" data-src="<?php echo esc_url( $logo_url ); ?>" loading="lazy" alt="<?php echo esc_attr( $partner['name'] ?? '' ); ?>" width="120" height="120">
											</div>
											<div class="caption">
												<h3 class="name">
													<?php echo esc_html( $partner['name'] ?? '' ); ?>
												</h3>
											</div>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
					<div class="swiper-pagination"></div>
				</div>

				<!-- Right Slider: Research Partners -->
				<div class="swiper-relative is-page one-slider right-slider no-dynamic-bullets" data-aos="fade-left" data-aos-duration="700" data-aos-delay="600">
					<h2 class="site-title">
						<?php echo wp_kses_post( $right_title ); ?>
					</h2>
					<div class="swiper mt-10">
						<div class="swiper-wrapper">
							<?php foreach ( $right_partners as $partner ) : 
								$logo_url = is_array( $partner['logo'] ?? null ) ? ( $partner['logo']['url'] ?? '' ) : ( is_numeric( $partner['logo'] ?? null ) ? wp_get_attachment_url( $partner['logo'] ) : ( $partner['logo'] ?? '' ) );
							?>
								<div class="swiper-slide">
									<div class="brand-company-item">
										<div class="logo">
											<img class="lozad" src="<?php echo esc_url( $logo_url ); ?>" data-src="<?php echo esc_url( $logo_url ); ?>" loading="lazy" alt="<?php echo esc_attr( $partner['name'] ?? '' ); ?>" width="120" height="120">
										</div>
										<h3 class="title">
											<?php echo esc_html( $partner['name'] ?? '' ); ?>
										</h3>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
					<div class="swiper-pagination"></div>
				</div>
			</div>
		</div>
	</div>
</section>
