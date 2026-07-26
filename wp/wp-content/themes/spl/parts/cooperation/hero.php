<?php
/**
 * R&D System — Hero & Intro section (100% Unila HTML).
 *
 * @package SPL
 */

defined( 'ABSPATH' ) || exit;

$img_banner = get_template_directory_uri() . '/static/img/banner/WEB-BIA.jpg';
?>
<section class="banner-child">
	<div class="swiper">
		<div class="swiper-wrapper">
			<div class="swiper-slide">
				<div class="image img-cover">
					<img class="lozad" src="<?php echo esc_url( $img_banner ); ?>" data-src="<?php echo esc_url( $img_banner ); ?>" alt="Hệ thống R&D VINACOS">
				</div>
			</div>
		</div>
	</div>
</section>

<section class="global-breadcrumb">
	<div class="container">
		<nav aria-label="breadcrumbs" class="rank-math-breadcrumb">
			<p>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Trang chủ</a>
				<span class="separator"> - </span>
				<span class="last">VINACOS Việt Nam – Hệ Thống R&D & Gia Công OEM/ODM</span>
			</p>
		</nav>
	</div>
</section>

<section class="oem-1-section section-t-large section-b-small">
	<div class="container">
		<div class="row items-center">
			<div class="col w-full lg:w-1/2">
				<h1 class="site-title" data-aos="fade-up" data-aos-duration="700">
					HỆ THỐNG R&D & GIA CÔNG MỸ PHẨM OEM / ODM
				</h1>
				<div class="site-desc mt-6" data-aos="fade-up" data-aos-duration="700" data-aos-delay="300">
					<p>VINACOS là đơn vị tiên phong ứng dụng khoa học vào nghiên cứu và gia công mỹ phẩm sạch tại Việt Nam. Chúng tôi sở hữu phòng Lab chuẩn quốc tế, đội ngũ kỹ sư R&D trình độ cao cùng hệ thống nhà máy sản xuất đạt chuẩn GMP/FDA.</p>
					<p>Dù bạn khởi nghiệp thương hiệu mới hay mở rộng dòng sản phẩm hiện có, VINACOS sẵn sàng đồng hành từ khâu định hình ý tưởng, nghiên cứu công thức độc quyền đến công bố sản phẩm lưu hành hợp pháp.</p>
				</div>
			</div>
			<div class="col w-full mt-8 lg:mt-0 lg:w-1/2">
				<div class="image img-cover rounded-2xl overflow-hidden shadow-xl" data-aos="fade-left" data-aos-duration="700">
					<img class="lozad" src="https://unila.com.vn/wp-content/uploads/2026/04/LAB.jpg" data-src="https://unila.com.vn/wp-content/uploads/2026/04/LAB.jpg" alt="R&D VINACOS">
				</div>
			</div>
		</div>
	</div>
</section>
