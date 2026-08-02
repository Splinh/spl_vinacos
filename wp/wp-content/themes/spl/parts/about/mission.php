<?php
/**
 * About — Mission section (100% exact Unila about-3-section HTML).
 *
 * @package SPL
 */

defined( 'ABSPATH' ) || exit;

$is_en   = function_exists( 'pll_current_language' ) && 'en' === pll_current_language();
$img_url = get_template_directory_uri() . '/static/img/tam-nhin-su-menh-vinacos.png';
?>

<section class="about-3-section section-large">
	<div class="container">
		<h2 class="site-title text-center" data-aos="fade-up" data-aos-duration="700" data-aos-delay="300">
			<?= $is_en ? 'Vision & Mission' : 'Tầm nhìn & Sứ mệnh' ?>
		</h2>
		<div class="image img-cover mt-10" data-aos="fade-up" data-aos-duration="700" data-aos-delay="800">
			<img class="lozad" src="<?= esc_url( $img_url ) ?>" data-src="<?= esc_url( $img_url ) ?>" loading="lazy" alt="VINACOS Vision & Mission">
		</div>
	</div>
</section>

