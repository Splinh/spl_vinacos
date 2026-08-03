<?php
/**
 * About — Factory & Process (about-6-section 100% Unila HTML).
 *
 * @package SPL
 */

defined( 'ABSPATH' ) || exit;

$is_en   = function_exists( 'pll_current_language' ) && 'en' === pll_current_language();
$section = $args ?? array();
$title   = $is_en ? 'International cGMP/FDA Cleanroom Facilities' : 'Nhà máy & Quy trình sản xuất chuẩn quốc tế';
?>
<section class="about-6-section section-large">
	<div class="container">
		<div class="about-6-wrap">
			<div class="right">
				<h2 class="site-title" data-aos="fade-up" data-aos-duration="700" data-aos-delay="300">
					<?php echo esc_html( $title ); ?>
				</h2>
				<div class="swiper-relative mt-10 is-page">
					<div class="swiper about-6-image" data-aos="fade-up" data-aos-duration="700" data-aos-delay="800">
						<div class="swiper-wrapper">
							<div class="swiper-slide">
<?php $img_dir = get_template_directory_uri() . '/static/img/vinacos/'; ?>
								<div class="image img-cover">
									<img class="lozad" src="<?php echo esc_url( $img_dir . 'factory-overview.jpg' ); ?>" data-src="<?php echo esc_url( $img_dir . 'factory-overview.jpg' ); ?>" loading="lazy" alt="VINACOS Factory">
								</div>
							</div>
							<div class="swiper-slide">
								<div class="image img-cover">
									<img class="lozad" src="<?php echo esc_url( $img_dir . 'rd-lab-main.jpg' ); ?>" data-src="<?php echo esc_url( $img_dir . 'rd-lab-main.jpg' ); ?>" loading="lazy" alt="VINACOS R&D Lab">
								</div>
							</div>
							<div class="swiper-slide">
								<div class="image img-cover">
									<img class="lozad" src="<?php echo esc_url( $img_dir . 'cleanroom-factory.jpg' ); ?>" data-src="<?php echo esc_url( $img_dir . 'cleanroom-factory.jpg' ); ?>" loading="lazy" alt="GMP Cleanroom">
								</div>
							</div>
						</div>
					</div>
					<div class="swiper about-6-caption mt-10 pt-10">
						<div class="swiper-wrapper">
							<div class="swiper-slide">
								<h3 class="title"><?= $is_en ? 'cGMP & FDA Certified Cleanroom Plant' : 'Nhà máy sản xuất chuẩn GMP & FDA' ?></h3>
								<div class="desc"><?= $is_en ? 'High-capacity automated filling & compounding lines capable of producing millions of units annually.' : 'Hệ thống phòng sạch hiện đại, tự động hóa cao, đáp ứng công suất hàng triệu sản phẩm mỗi năm.' ?></div>
							</div>
							<div class="swiper-slide">
								<h3 class="title"><?= $is_en ? 'Advanced Analytical R&D Laboratory' : 'Phòng Lab R&D chuyên sâu' ?></h3>
								<div class="desc"><?= $is_en ? 'High-tech analytical testing instruments for active compound verification & strict safety stability testing.' : 'Trang thiết bị kiểm nghiệm công nghệ cao, phân tích hoạt chất và đo lường chỉ số an toàn nghiêm ngặt.' ?></div>
							</div>
							<div class="swiper-slide">
								<h3 class="title"><?= $is_en ? 'Turnkey End-to-End Manufacturing Workflow' : 'Quy trình sản xuất khép kín A-Z' ?></h3>
								<div class="desc"><?= $is_en ? 'From formula engineering, sample trial runs, stability testing to custom packaging & regulatory filing.' : 'Từ nghiên cứu công thức, kiểm định mẫu thử, thử nghiệm độ ổn định đến đóng gói và bàn giao hồ sơ công bố.' ?></div>
							</div>
						</div>
					</div>
					<div class="desktop-only mt-10">
						<div class="swiper-button" data-aos="fade-up" data-aos-duration="700" data-aos-delay="1300">
							<div class="button-prev"><?= spl_icon( 'chevron-left', '', 20 ) ?></div>
							<div class="button-next"><?= spl_icon( 'chevron-right', '', 20 ) ?></div>
						</div>
					</div>
					<div class="mobile-only">
						<div class="swiper-pagination"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
