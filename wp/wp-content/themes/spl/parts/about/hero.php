<?php
/**
 * About — Hero section & Breadcrumbs (100% Unila HTML).
 *
 * @package SPL
 */

defined( 'ABSPATH' ) || exit;

$section    = $args ?? array();
$banner_img = is_array( $section['banner_image'] ?? null ) ? ( $section['banner_image']['url'] ?? '' ) : ( is_numeric( $section['banner_image'] ?? null ) ? wp_get_attachment_url( $section['banner_image'] ) : ( $section['banner_image'] ?? '' ) );

if ( empty( $banner_img ) ) {
	$banner_img = get_template_directory_uri() . '/static/img/banner/WEB-BIA.jpg';
}
?>
<section class="banner-child">
	<div class="swiper">
		<div class="swiper-wrapper">
			<div class="swiper-slide">
				<div class="image img-cover">
					<img class="lozad" src="<?php echo esc_url( $banner_img ); ?>" data-src="<?php echo esc_url( $banner_img ); ?>" alt="VINACOS Việt Nam - Tâm Thế Cộng Sự">
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
				<span class="last">VINACOS Việt Nam – Tâm Thế Cộng Sự</span>
			</p>
		</nav>
	</div>
</section>
