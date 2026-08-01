<?php
/**
 * About — Team section.
 *
 * @package SPL
 */

use SPL\Core\Helper;

defined( 'ABSPATH' ) || exit;

$title      = $data['title'] ?? 'Sức mạnh tập thể';
$banner_img = get_template_directory_uri() . '/static/img/suc-manh-tap-the-vinacos.jpg';
$depts      = [
	[
		'title' => 'BAN GIÁM ĐỐC',
		'desc'  => 'Định hướng tầm nhìn, dẫn dắt tương lai. Dẫn dắt chiến lược phát triển và đảm bảo VINACOS luôn đi đúng hướng, truyền cảm hứng và xây dựng văn hóa tận tâm cho toàn bộ đội ngũ.',
		'image' => 'https://unila.com.vn/wp-content/uploads/2025/09/gioi-thieu-phong-CEOFouder-scaled.jpg',
	],
	[
		'title' => 'R&D PHÒNG NGHIÊN CỨU & PHÁT TRIỂN',
		'desc'  => 'Những kiến trúc sư công thức, mã hóa vẻ đẹp Việt bằng nghiên cứu và khoa học. Đội ngũ chuyên gia tâm huyết thử nghiệm, chuẩn hóa và tạo nên các công thức mỹ phẩm độc quyền.',
		'image' => 'https://unila.com.vn/wp-content/uploads/2025/09/gioi-thieu-phong-RD-scaled.jpg',
	],
	[
		'title' => 'BỘ PHẬN SẢN XUẤT',
		'desc'  => 'Kỷ luật thép trong từng thao tác, đảm bảo sự đồng nhất 100%. Với quy trình nghiêm ngặt chuẩn GMP và thiết bị hiện đại, đội ngũ sản xuất biến công thức thành hiện thực.',
		'image' => 'https://unila.com.vn/wp-content/uploads/2025/09/gioi-thieu-nhan-vien-san-xuat-scaled.jpg',
	],
	[
		'title' => 'QUẢN LÝ CHẤT LƯỢNG (QA/QC)',
		'desc'  => 'Người gác cổng cuối cùng, đảm bảo chất lượng đạt chuẩn tuyệt đối. Từ nguyên liệu đầu vào đến thành phẩm, kiểm soát nghiêm ngặt để mọi tiêu chuẩn được tuân thủ.',
		'image' => 'https://unila.com.vn/wp-content/uploads/2025/09/gioi-thieu-phong-DBCL-scaled.jpg',
	],
	[
		'title' => 'KINH DOANH & TƯ VẤN OEM/ODM',
		'desc'  => 'Những người đồng hành đầu tiên, lắng nghe và biến ý tưởng thành dự án cụ thể. Là cầu nối tin cậy giữa VINACOS và các thương hiệu đối tác.',
		'image' => 'https://unila.com.vn/wp-content/uploads/2025/09/gioi-thieu-phong-kinh-doanh-1-scaled.jpg',
	],
	[
		'title' => 'MARKETING & TRUYỀN THÔNG',
		'desc'  => 'Người kể chuyện chính trực, đưa giá trị thực đến tay người dùng. Biến giá trị khoa học thành thông điệp cảm xúc, kết nối thương hiệu với khách hàng.',
		'image' => 'https://unila.com.vn/wp-content/uploads/2025/09/gioi-thieu-phong-marketing-2-scaled.jpg',
	],
	[
		'title' => 'NHÂN SỰ & QUẢN TRỊ',
		'desc'  => 'Người xây dựng đội ngũ, tạo môi trường để mỗi thành viên phát huy tối đa năng lực. Thu hút và phát triển nguồn nhân lực trình độ cao cho VINACOS.',
		'image' => 'https://unila.com.vn/wp-content/uploads/2025/09/gioi-thieu-phong-nhan-su-scaled.jpg',
	],
	[
		'title' => 'MUA HÀNG & CHUỖI CUNG ỨNG',
		'desc'  => 'Người quản trị nguồn lực, chọn lọc nguyên liệu nhập khẩu chính ngạch chuẩn COA, tạo nền tảng vững chắc cho sứ mệnh mỹ phẩm sạch.',
		'image' => 'https://unila.com.vn/wp-content/uploads/2025/09/gioi-thieu-phong-hanh-chinh-1-scaled.jpg',
	],
];
?>
<section class="about-5-section section-t-large">
	<div class="container">
		<h2 class="site-title text-center" data-aos="fade-up" data-aos-duration="700" data-aos-delay="300">
			<?php echo esc_html( $title ); ?>
		</h2>
		<div class="image text-center mt-10" data-aos="fade-up" data-aos-duration="700" data-aos-delay="800">
			<img class="lozad" src="<?php echo esc_url( $banner_img ); ?>" data-src="<?php echo esc_url( $banner_img ); ?>" loading="lazy" alt="Sức Mạnh Tập Thể VINACOS">
		</div>
		<div class="swiper-relative mt-10 about-5-list is-page" data-aos="fade-up" data-aos-duration="700" data-aos-delay="1300">
			<div class="swiper about-5-image">
				<div class="swiper-wrapper">
					<?php foreach ( $depts as $dept ) : ?>
						<div class="swiper-slide">
							<div class="image img-cover">
								<img class="lozad" src="<?php echo esc_url( $dept['image'] ); ?>" data-src="<?php echo esc_url( $dept['image'] ); ?>" loading="lazy" alt="<?php echo esc_attr( $dept['title'] ); ?>">
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="caption mt-6">
				<div class="swiper about-5-caption">
					<div class="swiper-wrapper">
						<?php foreach ( $depts as $dept ) : ?>
							<div class="swiper-slide">
								<h3 class="title"><?php echo esc_html( $dept['title'] ); ?></h3>
								<div class="desc"><?php echo esc_html( $dept['desc'] ); ?></div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
				<div class="desktop-only mt-8">
					<div class="swiper-button">
						<div class="button-prev"><?= spl_icon( 'chevron-left', '', 20 ) ?></div>
						<div class="button-next"><?= spl_icon( 'chevron-right', '', 20 ) ?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
