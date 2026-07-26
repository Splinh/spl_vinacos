<?php
/**
 * About — Timeline section.
 *
 * @package SPL
 */

use SPL\Core\Helper;

defined( 'ABSPATH' ) || exit;

$title = $data['title'] ?? 'Từng mốc dấu ấn';
$items = [
	[ 'year' => '2015', 'desc' => 'Khởi đầu. Thành lập công ty tại TP. Hồ Chí Minh', 'image' => 'https://unila.com.vn/wp-content/uploads/2024/10/gia-cong-my-pham-sach-unila-tl2.jpg' ],
	[ 'year' => '2016', 'desc' => 'Bước tiến đầu. Nhà máy đầu tiên tại Bến Tre khởi công và đi vào hoạt động.', 'image' => 'https://unila.com.vn/wp-content/uploads/2025/08/nha-may-gia-cong-my-pham-nam-2018.jpg' ],
	[ 'year' => '2018', 'desc' => 'Mở rộng. Nhà máy thứ hai chính thức hoạt động, nâng tầm quy mô sản xuất.', 'image' => 'https://unila.com.vn/wp-content/uploads/2024/10/gia-cong-my-pham-sach-unila-nha-may.jpg' ],
	[ 'year' => '2022', 'desc' => 'Tái cấu trúc. Tái cơ cấu bộ máy tổ chức và tối ưu hóa quy trình.', 'image' => 'https://unila.com.vn/wp-content/uploads/2026/04/XUONG.jpg' ],
	[ 'year' => '2023', 'desc' => 'Chuyển mình. Tập trung nghiên cứu và phát triển sản phẩm mới, đầu tư mạnh vào R&D chuyên sâu, nâng cao trải nghiệm dịch vụ khách hàng toàn diện.', 'image' => 'https://unila.com.vn/wp-content/uploads/2025/07/nha-may-gia-cong-my-pham-1.jpg' ],
	[ 'year' => '2024', 'desc' => 'Kỷ nguyên mới. Tái định vị thương hiệu sau 9 năm hình thành và phát triển. VINACOS chuyển mình từ nhà sản xuất thành đối tác R&D.', 'image' => 'https://unila.com.vn/wp-content/uploads/2026/04/LAB.jpg' ],
	[ 'year' => '2025', 'desc' => 'Đồng hành. Với nền tảng vững chắc và năng lực R&D chuyên sâu, VINACOS đồng hành cùng nhiều thương hiệu Việt chinh phục thị trường mỹ phẩm.', 'image' => 'https://unila.com.vn/wp-content/uploads/2024/10/gia-cong-my-pham-sach-unila-xu-the-moi.jpg' ],
	[ 'year' => '2026', 'desc' => 'Tiến xa. Một cột mốc quan trọng: VINACOS chính thức trở thành Doanh nghiệp Khoa học – Công nghệ, khẳng định cam kết đầu tư mạnh mẽ vào đội ngũ R&D trình độ cao và hệ thống Lab tiêu chuẩn.', 'image' => 'https://unila.com.vn/wp-content/uploads/2025/07/nha-may-gia-cong-my-pham-4.jpg' ],
	[ 'year' => 'Đến 2030', 'desc' => 'Khẳng định. VINACOS với vị thế đối tác R&D uy tín hàng đầu, góp phần đưa mỹ phẩm Việt Nam tỏa sáng trên bản đồ thế giới.', 'image' => 'https://unila.com.vn/wp-content/uploads/2025/07/nha-may-gia-cong-my-pham-1.jpg' ],
];
?>
<section class="about-2-section section-large lozad-bg" style="background-image: url('https://unila.com.vn/wp-content/themes/Unila-theme/HongTruc/dist/img/about-2-bg.jpg'); background-size: cover; background-position: center;">
	<div class="container">
		<h2 class="site-title text-center" data-aos="fade-up" data-aos-duration="700" data-aos-delay="300">
			<?php echo esc_html( $title ); ?>
		</h2>
		<div class="swiper-relative mt-10" data-aos="fade-up" data-aos-duration="700" data-aos-delay="800">
			<div class="swiper swiper-thumbs">
				<div class="swiper-wrapper">
					<?php foreach ( $items as $item ) : ?>
						<div class="swiper-slide">
							<div class="year-item">
								<span class="dot"></span>
								<span class="year"><?php echo esc_html( $item['year'] ); ?></span>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<div class="swiper-relative swiper-relative-top mt-10 is-page" data-aos="fade-up" data-aos-duration="700" data-aos-delay="1300">
			<div class="swiper swiper-top">
				<div class="swiper-wrapper">
					<?php foreach ( $items as $item ) : ?>
						<div class="swiper-slide">
							<div class="about-2-item">
								<div class="image img-cover">
									<img class="lozad" src="<?php echo esc_url( $item['image'] ); ?>" data-src="<?php echo esc_url( $item['image'] ); ?>" loading="lazy" alt="<?php echo esc_attr( $item['year'] ); ?>">
								</div>
								<div class="caption">
									<div class="year"><?php echo esc_html( $item['year'] ); ?></div>
									<div class="title">
										<p><span style="font-weight: 400;"><?php echo esc_html( $item['desc'] ); ?></span></p>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="desktop-only">
				<div class="swiper-button is-abs is-top-40">
					<div class="button-prev"><?= spl_icon( 'chevron-left', '', 20 ) ?></div>
					<div class="button-next"><?= spl_icon( 'chevron-right', '', 20 ) ?></div>
				</div>
			</div>
		</div>
	</div>
</section>
