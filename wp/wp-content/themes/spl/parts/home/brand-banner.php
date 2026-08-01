<?php
/**
 * Brand Banner Section (HÀNH ĐỘNG VÌ MỘT KỶ NGUYÊN MỸ PHẨM SẠCH - TỪ NGUỒN LỰC VIỆT).
 *
 * @package SPL
 */

defined( 'ABSPATH' ) || exit;

$is_en    = function_exists( 'pll_current_language' ) && 'en' === pll_current_language();
$subtitle = $is_en ? 'ACTING FOR AN ERA OF CLEAN COSMETICS' : 'HÀNH ĐỘNG VÌ MỘT KỶ NGUYÊN MỸ PHẨM SẠCH';
$title    = $is_en ? 'POWERED BY VIETNAMESE RESOURCES' : 'TỪ NGUỒN LỰC VIỆT';
$img_name = $is_en ? 'brand-banner-en.png' : 'brand-banner-vi.png';
$img_url  = get_template_directory_uri() . '/static/img/banner/' . $img_name;
?>

<section class="brand-banner-section section-small" id="brand-banner">
	<div class="container mx-auto px-4">
		<div class="brand-banner-card relative overflow-hidden rounded-2xl bg-[#800000] text-white shadow-xl transition-transform duration-300 hover:scale-[1.005]">
			<img class="lozad w-full h-auto object-cover min-h-[160px] md:min-h-[220px]" 
				 src="<?php echo esc_url( $img_url ); ?>" 
				 data-src="<?php echo esc_url( $img_url ); ?>" 
				 alt="<?php echo esc_attr( $subtitle . ' - ' . $title ); ?>" 
				 loading="lazy" 
				 width="1400" 
				 height="400">
		</div>
	</div>
</section>
