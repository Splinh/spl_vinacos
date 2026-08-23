<?php
/**
 * R&D System Section (HỆ THỐNG R&D)
 *
 * Full-bleed 50/50 split layout matching 'Tâm Thế Cộng Sự' editorial structure,
 * with structured informative text on the LEFT and big full-bleed image on the RIGHT.
 *
 * @package SPL
 */

defined( 'ABSPATH' ) || exit;

$is_en   = function_exists( 'pll_current_language' ) && 'en' === pll_current_language();
$section = $args ?? array();

$title    = $section['title'] ?? ( $is_en ? 'R&D <br/> SYSTEM' : 'HỆ THỐNG <br/> R&D' );
$content  = $section['content'] ?? '';
$btn_text = $section['btn_text'] ?? ( $is_en ? 'Learn More' : 'Tìm hiểu thêm' );
$btn_url  = is_array( $section['btn_link'] ?? null ) ? ( $section['btn_link']['url'] ?? '#' ) : ( $section['btn_link'] ?? ( $is_en ? home_url( '/en/oem-odm-cosmetics-manufacturing/' ) : home_url( '/oem-odm-gia-cong-unila-viet-nam/' ) ) );

$raw_image = $section['image'] ?? ( $section['items'][0]['image'] ?? null );
$image     = function_exists( 'spl_get_valid_image_url' ) ? spl_get_valid_image_url( $raw_image, 'static/img/story-vinacos.jpg' ) : ( get_template_directory_uri() . '/static/img/story-vinacos.jpg' );

if ( empty( $content ) ) {
	$items = $section['items'] ?? array();
	if ( ! empty( $items ) && is_array( $items ) ) {
		$content = '';
		foreach ( $items as $item ) {
			$item_title = $item['title'] ?? '';
			$item_desc  = $item['desc'] ?? '';
			if ( $item_title ) {
				$content .= '<h3><strong>' . esc_html( $item_title ) . '</strong></h3>';
			}
			if ( $item_desc ) {
				$content .= '<p>' . nl2br( esc_html( $item_desc ) ) . '</p>';
			}
		}
	} else {
		if ( $is_en ) {
			$content = '<h3><strong>Formula & Raw Ingredient Research</strong></h3>
<p><em>VINACOS R&D Center focuses on active raw material extraction, bio-analysis, and turn-key OEM/ODM cosmetic formulation engineering.</em></p>
<p>We ensure optimal efficacy, stability, and sensory texture, ready for automated commercial scale-up production.</p>
<h3><strong>Scientific Papers & Innovations</strong></h3>
<p><em>Applying lipid nano-emulsion and bio-encapsulation in active skincare for targeted transdermal absorption.</em></p>
<p>Our research breakthroughs ensure active ingredients penetrate deeper, maximizing stability and efficacy for Asian skin.</p>';
		} else {
			$content = '<h3><strong>Năng lực nghiên cứu sản xuất</strong></h3>
<p><em>VINACOS tập trung khai thác và đánh giá các nguồn nguyên liệu tiềm năng, từ tách chiết, phân tích hoạt chất đến thử nghiệm độ ổn định.</em></p>
<p>Chúng tôi phát triển công thức mỹ phẩm hoàn chỉnh OEM/ODM, đảm bảo hiệu quả, cảm quan cao cấp, sẵn sàng chuyển giao và sản xuất hàng loạt.</p>
<h3><strong>Các bài báo & Công trình khoa học</strong></h3>
<p><em>Ứng dụng hệ thống nhũ tương nano lipid và màng bao sinh học bọc hoạt chất tiên tiến trong mỹ phẩm chăm sóc da.</em></p>
<p>Công trình nghiên cứu ứng dụng công nghệ hiện đại giúp hoạt chất thẩm thấu sâu và bảo toàn hiệu quả tối đa trên làn da người Việt.</p>';
		}
	}
}
?>

<section class="home-3-section" id="rd-system">
	<!-- LEFT: Content Block (Giống Tâm Thế Cộng Sự) -->
	<div class="block-content">
		<div class="about-content">
			<h2 class="site-title" data-aos="fade-up" data-aos-duration="700">
				<?php echo wp_kses_post( $title ); ?>
			</h2>
			<div class="site-desc mt-6" data-aos="fade-up" data-aos-duration="700" data-aos-delay="200">
				<?php echo wp_kses_post( $content ); ?>
			</div>
			<div class="button mt-8" data-aos="fade-up" data-aos-duration="700" data-aos-delay="400">
				<a class="btn-lined" href="<?php echo esc_url( $btn_url ); ?>" title="<?php echo esc_attr( $btn_text ); ?>">
					<span><?php echo esc_html( $btn_text ); ?></span>
					<?= spl_icon( 'plus', '', 16 ) ?>
				</a>
			</div>
		</div>
	</div>

	<!-- RIGHT: Big Full-Bleed Showcase Image -->
	<div class="home-3-controller" data-aos="fade-left" data-aos-duration="700" data-aos-delay="200">
		<div class="image img-cover">
			<img class="lozad" src="<?php echo esc_url( $image ); ?>" data-src="<?php echo esc_url( $image ); ?>" loading="lazy" alt="VINACOS R&D CENTER" width="1200" height="900">
		</div>
	</div>
</section>
