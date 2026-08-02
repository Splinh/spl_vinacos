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
		<div class="relative mt-10 max-w-4xl mx-auto rounded-3xl overflow-hidden shadow-xl border border-slate-100 aspect-[4/3] p-6 sm:p-8 md:p-10 text-slate-800" data-aos="fade-up" data-aos-duration="700" data-aos-delay="800">
			<!-- 4:3 Background Image -->
			<img class="absolute inset-0 w-full h-full object-cover z-0 opacity-30" src="<?= esc_url( $img_url ) ?>" alt="VINACOS Vision & Mission">
			<div class="absolute inset-0 bg-gradient-to-br from-white/95 via-white/85 to-emerald-50/90 z-0"></div>

			<!-- Live HTML Content (100% Crisp Font, No Diacritic Rendering Bugs) -->
			<div class="relative z-10 grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8 h-full items-center">
				<!-- Tầm nhìn / Vision -->
				<div class="bg-white/85 backdrop-blur-md p-6 md:p-8 rounded-2xl border border-emerald-100/80 shadow-md hover:shadow-lg transition-all group flex flex-col justify-center h-full">
					<div class="w-12 h-12 md:w-14 md:h-14 bg-emerald-600 text-white rounded-2xl flex items-center justify-center mb-4 shadow-md group-hover:scale-105 transition-transform">
						<?= spl_icon( 'sparkles', 'w-6 h-6 md:w-7 md:h-7' ) ?>
					</div>
					<h3 class="text-xl md:text-2xl font-extrabold uppercase tracking-wide text-emerald-950 mb-3">
						<?= $is_en ? 'Vision' : 'Tầm nhìn' ?>
					</h3>
					<p class="text-slate-700 text-sm md:text-base leading-relaxed font-medium">
						<?= $is_en
							? 'Elevating the stature of Vietnamese cosmetic brands in the international arena. Becoming the leading OEM/ODM manufacturing partner in Southeast Asia.'
							: 'Nâng tầm vị thế thương hiệu mỹ phẩm Việt Nam trên trường quốc tế. Trở thành đối tác nghiên cứu & sản xuất OEM/ODM hàng đầu khu vực.'
						?>
					</p>
				</div>

				<!-- Sứ mệnh / Mission -->
				<div class="bg-white/85 backdrop-blur-md p-6 md:p-8 rounded-2xl border border-amber-100/80 shadow-md hover:shadow-lg transition-all group flex flex-col justify-center h-full">
					<div class="w-12 h-12 md:w-14 md:h-14 bg-amber-500 text-white rounded-2xl flex items-center justify-center mb-4 shadow-md group-hover:scale-105 transition-transform">
						<?= spl_icon( 'heart', 'w-6 h-6 md:w-7 md:h-7' ) ?>
					</div>
					<h3 class="text-xl md:text-2xl font-extrabold uppercase tracking-wide text-amber-950 mb-3">
						<?= $is_en ? 'Mission' : 'Sứ mệnh' ?>
					</h3>
					<p class="text-slate-700 text-sm md:text-base leading-relaxed font-medium">
						<?= $is_en
							? 'Committed to delivering safe, high-efficacy, and technologically advanced cosmetic formulations for partner brands and global consumers.'
							: 'Cam kết mang đến sản phẩm mỹ phẩm an toàn, chất lượng cao, đột phá về công nghệ cho đối tác thương hiệu và người tiêu dùng.'
						?>
					</p>
				</div>
			</div>
		</div>
	</div>
</section>

