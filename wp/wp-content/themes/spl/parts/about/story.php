<?php
/**
 * About — Story section.
 *
 * @package SPL
 */

defined( 'ABSPATH' ) || exit;

$title     = $data['title'] ?? 'Nghiên cứu <br/> sản xuất <br/> mỹ phẩm';
$image_url = 'https://unila.com.vn/wp-content/uploads/2026/04/Hanh-dong-vi-mot-ky-nguyen-my-pham-sach-tu-nguon.jpg';
?>
<section class="about-1-section section-large">
	<div class="container">
		<div class="row -mt-10 items-center">
			<div class="col w-full mt-10 lg:w-5/12">
				<div class="block-content block-content-1">
					<h1 class="site-title" data-aos="fade-up" data-aos-duration="700" data-aos-delay="300">
						<?php echo wp_kses_post( $title ); ?>
					</h1>
					<div class="site-desc mt-6" data-aos="fade-up" data-aos-duration="700" data-aos-delay="800">
						<h2><span style="font-size: 14pt;"><strong>VINACOS &#8211; Hành động vì một kỷ nguyên mỹ phẩm sạch từ nguồn lực Việt.</strong></span></h2>
						<p><strong><span style="color: #993300;"><i>Dẫn đầu</i></span></strong></p>
						<p><i><span style="font-weight: 400;">VINACOS là doanh nghiệp khoa học &amp; công nghệ tiên phong trong nghiên cứu và sản xuất mỹ phẩm sạch tại Việt Nam.</span></i></p>
						<p><span style="font-weight: 400;">Chúng tôi đặt tâm huyết vào con người, thiết bị và quy trình để mỗi sản phẩm đến tay đối tác đều được đảm bảo chất lượng. Dẫn đầu với VINACOS là đặt ra tiêu chuẩn mới, góp phần chứng minh mỹ phẩm Việt hoàn toàn có thể sánh ngang thế giới.</span></p>
						<p><strong><span style="color: #993300;"><i>Thấu hiểu</i></span></strong></p>
						<p><i><span style="font-weight: 400;">VINACOS đồng hành cùng các thương hiệu Việt, dùng nghiên cứu khoa học và sản xuất tạo ra những sản phẩm lành tính xứng đáng với làn da Việt.</span></i></p>
						<p><span style="font-weight: 400;">Chúng tôi hiểu rằng người Việt xứng đáng được chăm sóc bằng những gì thực sự an toàn. Và các thương hiệu muốn làm điều đó cần một đối tác không chỉ biết sản xuất, mà còn biết lắng nghe, tư vấn và cùng định hình sản phẩm từ đầu.</span></p>
						<p><span style="font-weight: 400;">VINACOS ở đây để làm đúng điều đó. Với nền tảng nghiên cứu khoa học và đội ngũ am hiểu ngành, chúng tôi cùng các đối tác đi từ ý tưởng đến thành quả, cho đến khi giá trị sản phẩm đến được với khách hàng.</span></p>
					</div>
				</div>
			</div>
			<div class="col w-full mt-10 lg:w-7/12">
				<div class="image image-1 img-contain" data-aos="fade-left" data-aos-duration="700" data-aos-delay="300">
					<img class="lozad" src="<?php echo esc_url( $image_url ); ?>" data-src="<?php echo esc_url( $image_url ); ?>" loading="lazy" alt="Hành động vì một kỷ nguyên mỹ phẩm sạch từ nguồn lực Việt.">
				</div>
			</div>
		</div>
	</div>
</section>

