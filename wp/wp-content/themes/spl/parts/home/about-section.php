<?php
/**
 * About Section (TÂM THẾ CỘNG SỰ - Vision & Mission)
 *
 * @package SPL
 */

defined( 'ABSPATH' ) || exit;

$is_en = function_exists( 'pll_current_language' ) && 'en' === pll_current_language();

$section  = $args ?? array();
$title    = $section['title'] ?? ( $is_en ? 'PARTNER <br/> MINDSET' : 'TÂM THẾ <br/> CỘNG SỰ' );
$content  = $section['content'] ?? '';
$btn_text = $section['btn_text'] ?? ( $is_en ? 'About Us' : 'Về chúng tôi' );
$btn_url  = is_array( $section['btn_link'] ?? null ) ? ( $section['btn_link']['url'] ?? '#about' ) : ( $section['btn_link'] ?? ( $is_en ? home_url( '/en/about-us/' ) : home_url( '/ve-chung-toi/' ) ) );
if ( is_string( $btn_url ) && ( false !== strpos( $btn_url, 'tam-the-cong-su' ) || '#about' === $btn_url ) ) {
	$btn_url = $is_en ? home_url( '/en/about-us/' ) : home_url( '/ve-chung-toi/' );
}

// Image: Ưu tiên ảnh từ ACF, fallback về ảnh mới tam-the-cong-su-home.webp
$raw_image = $section['image'] ?? null;
$image     = '';
if ( ! empty( $raw_image ) ) {
	$image = is_numeric( $raw_image ) ? wp_get_attachment_image_url( (int) $raw_image, 'full' ) : (string) $raw_image;
}
if ( empty( $image ) || false !== strpos( $image, 'tam-the-cong-su' ) ) {
	$image = get_template_directory_uri() . '/static/img/vinacos/tam-the-cong-su-home.webp';
}

if ( empty( $content ) ) {
	if ( $is_en ) {
		$content = '<h3><strong>Pioneering Vision</strong></h3>
<p><em>B&B VINACOS is a science & technology pioneer in clean cosmetics formulation research and cGMP/FDA OEM manufacturing in Vietnam.</em></p>
<p>We invest heavily in human capital, international-standard cleanrooms, and automated processing lines to ensure every formula delivered to client brands is thoroughly tested, stable, and compliant.</p>
<h3><strong>Empathetic Mission</strong></h3>
<p><em>VINACOS accompanies client brands through turnkey OEM/ODM solutions, turning formula concepts into market success.</em></p>
<p>We listen, consult, and co-create from raw ingredient selection to legal MoH notification, guaranteeing maximum brand protection and competitive edge.</p>';
	} else {
		$content = '<h3><strong>Dẫn đầu (Tầm nhìn)</strong></h3>
<p><em>VINACOS là doanh nghiệp khoa học & công nghệ tiên phong trong nghiên cứu và sản xuất gia công mỹ phẩm sạch tại Việt Nam.</em></p>
<p>Chúng tôi đặt tâm huyết vào con người, thiết bị phòng Lab hiện đại đạt chuẩn FDA và quy trình chuẩn GMP để mỗi sản phẩm đến tay đối tác đều được kiểm chứng nghiêm túc, chất lượng rõ ràng, pháp lý minh bạch. Dẫn đầu với VINACOS là đặt ra tiêu chuẩn mới, góp phần chứng minh mỹ phẩm Việt hoàn toàn có thể sánh ngang thế giới.</p>
<h3><strong>Thấu hiểu (Sứ mệnh)</strong></h3>
<p><em>VINACOS đồng hành cùng các thương hiệu Việt, dùng nghiên cứu khoa học và công nghệ tạo ra những sản phẩm an toàn trọn gói xứng đáng với làn da Việt.</em></p>
<p>Chúng tôi hiểu rằng các thương hiệu mỹ phẩm cần một đối tác không chỉ biết sản xuất OEM/ODM, mà còn biết lắng nghe, tham vấn và cùng định hình sản phẩm từ gốc. VINACOS ở đây để cùng bạn đi từ ý tưởng đến thành công trên thị trường.</p>';
	}
}
?>

<section class="about-1-section about-home-section" id="about-us">
	<div class="about-container">
		<div class="about-grid">
			<!-- LEFT: Collage Multi-Photo Image (Full bleed bên trái) -->
			<div class="about-col-image" data-aos="fade-right" data-aos-duration="700">
				<div class="about-image">
					<img class="lozad" src="<?php echo esc_url( $image ); ?>" data-src="<?php echo esc_url( $image ); ?>" loading="lazy" alt="VINACOS - TÂM THẾ CỘNG SỰ" width="866" height="1482">
				</div>
			</div>
			<!-- RIGHT: Content Block -->
			<div class="about-col-content" data-aos="fade-left" data-aos-duration="700" data-aos-delay="200">
				<div class="about-content">
					<h2 class="site-title">
						<?php echo wp_kses_post( $title ); ?>
					</h2>
					<div class="site-desc mt-6">
						<?php echo wp_kses_post( $content ); ?>
					</div>
					<div class="button mt-8">
						<a class="btn-lined" href="<?php echo esc_url( $btn_url ); ?>" title="<?php echo esc_attr( $btn_text ); ?>">
							<span><?php echo esc_html( $btn_text ); ?></span>
							<?= spl_icon( 'plus', '', 16 ) ?>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
