<?php
/**
 * About — Message section (THÔNG ĐIỆP TỪ TRÁI TIM - CEO).
 *
 * @package SPL
 */

defined( 'ABSPATH' ) || exit;

$data      = $args ?? [];
$title     = $data['title'] ?? 'Thông điệp từ trái tim';
$subtitle  = $data['subtitle'] ?? 'Thông điệp từ Ban Giám Đốc';
$ceo_name  = $data['ceo_name'] ?? 'BÀ NGUYỄN HỒNG TRÚC';
$ceo_title = $data['ceo_title'] ?? 'GIÁM ĐỐC / CEO FOUNDER';
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
					<p><i><span style="font-weight: 400;">Tôi bắt đầu hành trình này không từ những điều to lớn, mà từ những điều giản dị nhất, chính là đam mê dành cho vẻ đẹp Việt.</span></i></p>
					<p><i><span style="font-weight: 400;">Từ lúc bắt đầu chặng đường khởi nghiệp đầy thử thách, tôi luôn kiên định đi theo con đường của riêng mình. Đó là xây dựng một doanh nghiệp không chỉ lớn lên bằng con số, mà còn tạo ra giá trị thực. Những giá trị này được hình thành từ sự trân trọng con người trong tổ chức, và cao hơn nữa là từ tình yêu quê hương đất nước Việt Nam.</span></i></p>
					<p><i><span style="font-weight: 400;">Theo đuổi hạnh phúc vật chất lẫn tinh thần của tất cả cán bộ công nhân viên, đó chính là triết lý, là động lực và niềm tin của chúng tôi.</span></i></p>
					<p><i><span style="font-weight: 400;">Cùng với nỗi trăn trở mỗi khi nhìn thấy bà con lao động vất vả nhưng nông sản chưa được định giá xứng đáng, chúng tôi mang trong mình khát vọng đưa doanh nghiệp phát triển song hành cùng đời sống bà con nông dân.</span></i></p>
					<p><i><span style="font-weight: 400;">Để hiện thực hóa khát vọng ấy, bằng tình yêu quê hương và con người, chúng tôi đưa nguyên liệu từ nông sản Việt vào mỹ phẩm sạch, để những nông sản tưởng chừng bỏ đi có thể mang lại giá trị cao cùng niềm tự hào nông sản Việt.</span></i></p>
					<p><i><span style="font-weight: 400;">Tôi biết chặng đường phía trước còn nhiều thử thách. Nhưng tôi tin rằng với sự đồng lòng của tổ chức và niềm tin vào con người, chúng tôi sẽ kiên định theo đuổi mục tiêu: tạo ra những sản phẩm chất lượng nhất cho người tiêu dùng, đồng thời góp phần đưa ngành mỹ phẩm Việt Nam có vị thế xứng tầm trên bản đồ thế giới.</span></i></p>
					<p><i><span style="font-weight: 400;">Chúng tôi không chỉ làm ra mỹ phẩm chúng tôi đang kiến tạo một tương lai, nơi vẻ đẹp gắn liền với trách nhiệm, niềm tự hào dân tộc và những giá trị bền vững trường tồn.</span></i></p>
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
