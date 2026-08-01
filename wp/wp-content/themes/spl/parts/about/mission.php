<?php
/**
 * About — Mission section (100% exact Unila about-3-section HTML).
 *
 * @package SPL
 */

defined( 'ABSPATH' ) || exit;

$is_en = function_exists( 'pll_current_language' ) && 'en' === pll_current_language();
?>

<section class="about-3-section section-large">
	<div class="container">
		<h2 class="site-title text-center" data-aos="fade-up" data-aos-duration="700" data-aos-delay="300">
			<?= $is_en ? 'Vision & Mission' : 'Tầm nhìn & Sứ mệnh' ?>
		</h2>
		<div class="image img-cover mt-10" data-aos="fade-up" data-aos-duration="700" data-aos-delay="800">
			<img class="lozad" src="https://unila.com.vn/wp-content/uploads/2026/04/TAM-NHIN-SU-MENH.jpg" data-src="https://unila.com.vn/wp-content/uploads/2026/04/TAM-NHIN-SU-MENH.jpg" loading="lazy" alt="VINACOS Vision & Mission">
		</div>
	</div>
</section>
