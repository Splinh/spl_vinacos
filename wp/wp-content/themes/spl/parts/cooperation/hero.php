<?php
/**
 * R&D System — Hero & Intro section (100% Unila HTML).
 *
 * @package SPL
 */

defined( 'ABSPATH' ) || exit;

$img_banner = get_template_directory_uri() . '/static/img/banner/WEB-BIA.jpg';
?>
<?php
$title = $args['title'] ?? ( ( function_exists( 'pll_current_language' ) && 'en' === pll_current_language() ) ? 'R&D SYSTEM & OEM/ODM COSMETICS MANUFACTURING' : 'HỆ THỐNG R&D & GIA CÔNG MỸ PHẨM OEM / ODM' );
$desc  = $args['description'] ?? ( ( function_exists( 'pll_current_language' ) && 'en' === pll_current_language() )
	? 'B&B Vinacos is a pioneer in applying advanced formulation science to clean cosmetics OEM/ODM manufacturing in Vietnam. We operate international cGMP/FDA certified cleanroom facilities and an experienced R&D engineer team.'
	: 'VINACOS là đơn vị tiên phong ứng dụng khoa học vào nghiên cứu và gia công mỹ phẩm sạch tại Việt Nam. Chúng tôi sở hữu phòng Lab chuẩn quốc tế, đội ngũ kỹ sư R&D trình độ cao cùng hệ thống nhà máy sản xuất đạt chuẩn GMP/FDA.' );

$home_text  = ( function_exists( 'pll_current_language' ) && 'en' === pll_current_language() ) ? 'Home' : 'Trang chủ';
$crumb_text = ( function_exists( 'pll_current_language' ) && 'en' === pll_current_language() ) ? 'VINACOS – R&D System & Cosmetics OEM/ODM' : 'VINACOS Việt Nam – Hệ Thống R&D & Gia Công OEM/ODM';
?>
<section class="banner-child">
	<div class="swiper">
		<div class="swiper-wrapper">
			<div class="swiper-slide">
				<div class="image img-cover">
					<img class="lozad" src="<?php echo esc_url( $img_banner ); ?>" data-src="<?php echo esc_url( $img_banner ); ?>" alt="R&D VINACOS">
				</div>
			</div>
		</div>
	</div>
</section>

<section class="global-breadcrumb">
	<div class="container">
		<nav aria-label="breadcrumbs" class="rank-math-breadcrumb">
			<p>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?= esc_html( $home_text ) ?></a>
				<span class="separator"> - </span>
				<span class="last"><?= esc_html( $crumb_text ) ?></span>
			</p>
		</nav>
	</div>
</section>

<section class="oem-1-section section-t-large section-b-small">
	<div class="container">
		<div class="row items-center">
			<div class="col w-full lg:w-1/2">
				<h1 class="site-title" data-aos="fade-up" data-aos-duration="700">
					<?= esc_html( $title ) ?>
				</h1>
				<div class="site-desc mt-6" data-aos="fade-up" data-aos-duration="700" data-aos-delay="300">
					<p><?= esc_html( $desc ) ?></p>
				</div>
			</div>
			<div class="col w-full mt-8 lg:mt-0 lg:w-1/2">
				<div class="image img-cover rounded-2xl overflow-hidden shadow-xl" data-aos="fade-left" data-aos-duration="700">
<?php $img_rd = get_template_directory_uri() . '/static/img/vinacos/rd-lab-main.jpg'; ?>
					<img class="lozad" src="<?php echo esc_url( $img_rd ); ?>" data-src="<?php echo esc_url( $img_rd ); ?>" alt="R&D VINACOS">
				</div>
			</div>
		</div>
	</div>
</section>
