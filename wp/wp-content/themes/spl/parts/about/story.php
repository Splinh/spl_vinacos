<?php
/**
 * About — Story section (Nghiên cứu sản xuất mỹ phẩm).
 *
 * Exact 1:1 match with Canva design:
 * - Left: Full-bleed blue shape card from top to bottom with bold white uppercase title.
 * - Right: Clean editorial layout with "Dẫn đầu", "Thấu hiểu", dividers, and exact typography.
 *
 * @package SPL
 */

defined( 'ABSPATH' ) || exit;

$is_en     = function_exists( 'pll_current_language' ) && 'en' === pll_current_language();
$section   = $args ?? array();
$raw_title = $section['title'] ?? '';
$title     = ! empty( $raw_title ) ? $raw_title : ( $is_en ? 'COSMETICS <br/> R&D & <br/> MANUFACTURING' : 'NGHIÊN CỨU <br/> SẢN XUẤT <br/> MỸ PHẨM' );

$bg_image = get_template_directory_uri() . '/static/img/bg-story-shape.png';
?>

<section class="about-story-section" id="story">
	<div class="about-story-grid">
		<!-- LEFT: Full-bleed Blue Shape with Title -->
		<div class="about-story-shape-col" data-aos="fade-right" data-aos-duration="700">
			<div class="about-story-shape-card" style="background-image: url('<?php echo esc_url( $bg_image ); ?>');">
				<h2 class="about-story-shape-title">
					<?php echo wp_kses_post( $title ); ?>
				</h2>
			</div>
		</div>

		<!-- RIGHT: Content Matching Canva 100% -->
		<div class="about-story-content-col" data-aos="fade-left" data-aos-duration="700" data-aos-delay="200">
			<div class="about-story-content-inner">
				<p class="about-story-headline">
					<?php echo $is_en ? 'VINACOS – Driving a Clean Beauty Era from Vietnamese Botanical Resources.' : 'VINACOS – Hành động vì một kỷ nguyên mỹ phẩm sạch từ nguồn lực Việt.'; ?>
				</p>

				<!-- Block 1: Dẫn đầu -->
				<div class="about-story-block">
					<h3 class="about-story-block-title">
						<?php echo $is_en ? 'Pioneering Leadership' : 'Dẫn đầu'; ?>
					</h3>
					<p class="about-story-text">
						<?php echo $is_en ? 'VINACOS is a science & technology enterprise pioneering clean cosmetics formulation and cGMP/FDA production in Vietnam.' : 'VINACOS là doanh nghiệp khoa học &amp; công nghệ tiên phong trong nghiên cứu và sản xuất mỹ phẩm sạch tại Việt Nam.'; ?>
					</p>
					<p class="about-story-text">
						<?php echo $is_en ? 'We dedicate our heart to human talent, laboratory equipment, and quality control to ensure every formula delivered to brand partners excels in safety, efficacy, and commercial readiness. Anticipating global trends, VINACOS establishes new benchmarks, proving that Vietnamese cosmetics can stand shoulder-to-shoulder internationally.' : 'Chúng tôi đặt tâm huyết vào con người, thiết bị và quy trình để mỗi sản phẩm đến tay đối tác đều được đảm bảo chất lượng. Dẫn đầu với VINACOS là đặt ra tiêu chuẩn mới, góp phần chứng minh mỹ phẩm Việt hoàn toàn có thể sánh ngang thế giới.'; ?>
					</p>
				</div>

				<hr class="about-story-hr">

				<!-- Block 2: Thấu hiểu -->
				<div class="about-story-block">
					<h3 class="about-story-block-title">
						<?php echo $is_en ? 'Deep Empathy & Co-Creation' : 'Thấu hiểu'; ?>
					</h3>
					<p class="about-story-text">
						<?php echo $is_en ? 'We partner with beauty brands, leveraging R&D science to create gentle, effective formulations tailored for modern consumers.' : 'VINACOS đồng hành cùng các thương hiệu Việt, dùng nghiên cứu khoa học và sản xuất tạo ra những sản phẩm lành tính xứng đáng với làn da Việt.'; ?>
					</p>
					<p class="about-story-text">
						<?php echo $is_en ? 'We understand that Vietnamese consumers deserve skincare made with genuine safety. And brands seeking that vision require a partner who not only manufactures, but actively listens, consults, and co-shapes the product from the very beginning.' : 'Chúng tôi hiểu rằng người Việt xứng đáng được chăm sóc bằng những gì thực sự an toàn. Và các thương hiệu muốn làm điều đó cần một đối tác không chỉ biết sản xuất, mà còn biết lắng nghe, tư vấn và cùng định hình sản phẩm từ đầu.'; ?>
					</p>
				</div>

				<hr class="about-story-hr">

				<!-- Block 3 -->
				<div class="about-story-block">
					<p class="about-story-text">
						<?php echo $is_en ? 'You can select "No camera" option and only record your voice.' : 'Bạn có thể chọn tùy chọn <strong>\'Không camera\'</strong> và chỉ ghi âm giọng nói của mình.'; ?>
					</p>
				</div>

				<hr class="about-story-hr">
			</div>
		</div>
	</div>
</section>
