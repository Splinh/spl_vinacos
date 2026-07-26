<?php
/**
 * About — Factory & Process (about-6-section 100% Unila HTML).
 *
 * @package SPL
 */

defined( 'ABSPATH' ) || exit;

$section = $args ?? array();
$title   = $section['title'] ?? 'Nhà máy & Quy trình sản xuất chuẩn quốc tế';
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
								<div class="image img-cover">
									<img class="lozad" src="https://unila.com.vn/wp-content/uploads/2026/04/NHA-MAY.jpg" data-src="https://unila.com.vn/wp-content/uploads/2026/04/NHA-MAY.jpg" loading="lazy" alt="Nhà máy VINACOS">
								</div>
							</div>
							<div class="swiper-slide">
								<div class="image img-cover">
									<img class="lozad" src="https://unila.com.vn/wp-content/uploads/2026/04/LAB.jpg" data-src="https://unila.com.vn/wp-content/uploads/2026/04/LAB.jpg" loading="lazy" alt="Phòng Lab R&D">
								</div>
							</div>
							<div class="swiper-slide">
								<div class="image img-cover">
									<img class="lozad" src="https://unila.com.vn/wp-content/uploads/2026/04/XUONG.jpg" data-src="https://unila.com.vn/wp-content/uploads/2026/04/XUONG.jpg" loading="lazy" alt="Xưởng sản xuất GMP">
								</div>
							</div>
						</div>
					</div>
					<div class="swiper about-6-caption mt-10 pt-10">
						<div class="swiper-wrapper">
							<div class="swiper-slide">
								<h3 class="title">Nhà máy sản xuất chuẩn GMP & FDA</h3>
								<div class="desc">Hệ thống phòng sạch hiện đại, tự động hóa cao, đáp ứng công suất hàng triệu sản phẩm mỗi năm.</div>
							</div>
							<div class="swiper-slide">
								<h3 class="title">Phòng Lab R&D chuyên sâu</h3>
								<div class="desc">Trang thiết bị kiểm nghiệm công nghệ cao, phân tích hoạt chất và đo lường chỉ số an toàn nghiêm ngặt.</div>
							</div>
							<div class="swiper-slide">
								<h3 class="title">Quy trình sản xuất khép kín A-Z</h3>
								<div class="desc">Từ nghiên cứu công thức, kiểm định mẫu thử, thử nghiệm độ ổn định đến đóng gói và bàn giao hồ sơ công bố.</div>
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
