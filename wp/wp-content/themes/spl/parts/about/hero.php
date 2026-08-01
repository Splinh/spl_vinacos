<?php
/**
 * About — Hero section & Breadcrumbs (100% Unila HTML).
 *
 * @package SPL
 */

defined( 'ABSPATH' ) || exit;

$is_en      = function_exists( 'pll_current_language' ) && 'en' === pll_current_language();
$section    = $args ?? array();
$banner_img = is_array( $section['banner_image'] ?? null ) ? ( $section['banner_image']['url'] ?? '' ) : ( is_numeric( $section['banner_image'] ?? null ) ? wp_get_attachment_url( $section['banner_image'] ) : ( $section['banner_image'] ?? '' ) );

if ( empty( $banner_img ) ) {
	$banner_img = get_template_directory_uri() . '/static/img/banner/' . ( $is_en ? 'brand-banner-en.jpg' : 'brand-banner-vi.jpg' );
}
?>
<section class="banner-child">
	<div class="swiper">
		<div class="swiper-wrapper">
			<div class="swiper-slide">
				<div class="image img-cover">
					<img class="lozad" src="<?php echo esc_url( $banner_img ); ?>" data-src="<?php echo esc_url( $banner_img ); ?>" alt="VINACOS - <?= $is_en ? 'Partner Mindset' : 'Tâm Thế Cộng Sự' ?>">
				</div>
			</div>
		</div>
	</div>
</section>

<section class="global-breadcrumb">
	<div class="container">
		<nav aria-label="breadcrumbs" class="rank-math-breadcrumb">
			<p>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?= $is_en ? 'Home' : 'Trang chủ' ?></a>
				<span class="separator"> - </span>
				<span class="last"><?= $is_en ? 'VINACOS – Partner Mindset & Philosophy' : 'VINACOS Việt Nam – Tâm Thế Cộng Sự' ?></span>
			</p>
		</nav>
	</div>
</section>
