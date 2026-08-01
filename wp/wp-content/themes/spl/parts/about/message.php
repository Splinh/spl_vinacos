<?php
/**
 * About — Message section (THÔNG ĐIỆP TỪ TRÁI TIM - CEO).
 *
 * @package SPL
 */

defined( 'ABSPATH' ) || exit;

$is_en     = function_exists( 'pll_current_language' ) && 'en' === pll_current_language();
$title     = $is_en ? 'Message from the Heart' : 'Thông điệp từ trái tim';
$subtitle  = $is_en ? 'Executive Board Statement' : 'Thông điệp từ Ban Giám Đốc';
$ceo_name  = 'MRS. NGUYEN HONG TRUC';
$ceo_title = $is_en ? 'MANAGING DIRECTOR / FOUNDER CEO' : 'GIÁM ĐỐC / CEO FOUNDER';
$image_url = 'https://unila.com.vn/wp-content/uploads/2026/04/CEO-FOUNDER-UNILA.jpg';
?>

<div class="about-brand mt-10 xl:pt-25 container">
	<div class="row -mt-10 items-center lg:flex-row-reverse">
		<div class="col w-full mt-10 lg:w-1/2">
			<div class="block-content block-content-2">
				<h2 class="site-title" data-aos="fade-up" data-aos-duration="700" data-aos-delay="800">
					<?php echo esc_html( $title ); ?>
				</h2>
				<h3 class="site-secondary mt-6" data-aos="fade-up" data-aos-duration="700" data-aos-delay="1300">
					<?php echo esc_html( $subtitle ); ?>
				</h3>
				<div class="site-desc mt-10" data-aos="fade-up" data-aos-duration="700" data-aos-delay="1800">
					<?php if ( $is_en ) : ?>
						<p><i><span style="font-weight: 400;">I started this journey not from grand statements, but from the simplest element: a deep passion for natural beauty and authentic quality.</span></i></p>
						<p><i><span style="font-weight: 400;">From the early days of entrepreneurship, I remained steadfast in building a company measured not only by numerical growth, but by genuine value delivered to people, partners, and community.</span></i></p>
						<p><i><span style="font-weight: 400;">Pursuing both material and spiritual well-being for our team members is our philosophy, driving force, and core belief.</span></i></p>
						<p><i><span style="font-weight: 400;">By infusing high-purity natural botanical extracts into clean cosmetic formulations, we transform raw agricultural ingredients into high-value beauty products with international standards.</span></i></p>
						<p><i><span style="font-weight: 400;">We believe that with organizational unity and relentless innovation, VINACOS will establish Vietnam as a trusted hub for premium cosmetics OEM/ODM manufacturing on the global map.</span></i></p>
					<?php else : ?>
						<p><i><span style="font-weight: 400;">Tôi bắt đầu hành trình này không từ những điều to lớn, mà từ những điều giản dị nhất, chính là đam mê dành cho vẻ đẹp Việt.</span></i></p>
						<p><i><span style="font-weight: 400;">Từ lúc bắt đầu chặng đường khởi nghiệp đầy thử thách, tôi luôn kiên định đi theo con đường của riêng mình. Đó là xây dựng một doanh nghiệp không chỉ lớn lên bằng con số, mà còn tạo ra giá trị thực.</span></i></p>
						<p><i><span style="font-weight: 400;">Theo đuổi hạnh phúc vật chất lẫn tinh thần của tất cả cán bộ công nhân viên, đó chính là triết lý, là động lực và niềm tin của chúng tôi.</span></i></p>
						<p><i><span style="font-weight: 400;">Bằng tình yêu quê hương và con người, chúng tôi đưa nguyên liệu từ nông sản Việt vào mỹ phẩm sạch, để những nông sản mang lại giá trị cao cùng niềm tự hào nông sản Việt.</span></i></p>
						<p><i><span style="font-weight: 400;">Chúng tôi tin rằng với sự đồng lòng của tổ chức và niềm tin vào con người, chúng tôi sẽ kiên định theo đuổi mục tiêu: tạo ra những sản phẩm chất lượng nhất cho người tiêu dùng.</span></i></p>
					<?php endif; ?>
					<p><strong><span style="font-family: helvetica, arial, sans-serif;"><?php echo esc_html( $ceo_name ); ?></span></strong></p>
					<p><span style="font-weight: 400; font-family: helvetica, arial, sans-serif;"><?php echo esc_html( $ceo_title ); ?></span></p>
				</div>
			</div>
		</div>
		<div class="col w-full mt-10 lg:w-1/2">
			<div class="swiper-relative one-slider" data-aos="fade-right" data-aos-duration="700" data-aos-delay="300">
				<div class="swiper">
					<div class="swiper-wrapper">
						<div class="swiper-slide">
							<div class="image image-2 img-cover">
								<img class="lozad" src="<?php echo esc_url( $image_url ); ?>" data-src="<?php echo esc_url( $image_url ); ?>" loading="lazy" alt="<?php echo esc_attr( $ceo_name ); ?> - CEO VINACOS">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
