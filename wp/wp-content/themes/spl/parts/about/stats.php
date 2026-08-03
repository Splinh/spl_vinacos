<?php
/**
 * About — Stats section (100% exact Unila HTML with icon images).
 *
 * @package SPL
 */

defined( 'ABSPATH' ) || exit;

$title = $data['title'] ?? 'Những con số biết nói';
$center_image = get_template_directory_uri() . '/static/img/stats-about-vinacos.png';

$stats = [
	[
		'number' => '0%',
		'desc'   => 'Tỉ lệ sai sót về pháp lý và hoạt chất cấm',
		'icon'   => 'shield',
	],
	[
		'number' => '100%',
		'desc'   => 'Kiểm nghiệm công thức và test độ ổn định',
		'icon'   => 'sparkles',
	],
	[
		'number' => '30+',
		'desc'   => 'Đề tài nghiên cứu khoa học đã đăng tải',
		'icon'   => 'droplet',
	],
	[
		'number' => '3+',
		'desc'   => 'Bằng sáng chế & giải pháp hữu ích',
		'icon'   => 'bolt',
	],
];

$promises = [
	[
		'title' => 'Chất lượng bền vững',
		'desc'  => 'Mỗi công thức từ VINACOS đều phải vượt qua hàng trăm lần kiểm nghiệm trước khi được phép rời khỏi phòng lab. Chúng tôi không chỉ test độ ổn định của sản phẩm qua thời gian, mà còn kiểm tra khả năng tương thích giữa các hoạt chất, đảm bảo chúng không phản ứng phụ hay làm giảm hiệu quả lẫn nhau.',
		'icon'  => 'shield',
	],
	[
		'title' => 'Năng lực chuyên gia',
		'desc'  => 'Một công thức R&D tại VINACOS mất ít nhất 3-6 tháng để hoàn thiện. Chúng tôi tính toán chính xác từng phần trăm hoạt chất, điều chỉnh pH phù hợp với làn da Việt, test độ thẩm thấu và thử nghiệm hàng chục mẫu trước khi chốt công thức tối ưu.',
		'icon'  => 'sparkles',
	],
	[
		'title' => 'Sự minh bạch',
		'desc'  => 'Chúng tôi công khai 100% thành phần, đầy đủ hồ sơ pháp lý, chứng từ kiểm nghiệm từ đơn vị uy tín và nguồn gốc nguyên liệu rõ ràng. Mỗi sản phẩm đều kèm tài liệu về quy trình sản xuất, kết quả test an toàn và các chứng nhận cần thiết.',
		'icon'  => 'heart',
	],
	[
		'title' => 'Tâm thế cộng sự',
		'desc'  => 'VINACOS không chỉ nhận đơn và sản xuất, chúng tôi đồng hành cùng bạn từ câu chuyện thương hiệu, phân tích thị trường, tư vấn công thức phù hợp định vị đến hoàn thiện hồ sơ pháp lý để sản phẩm lưu hành hợp pháp.',
		'icon'  => 'box',
	],
];
?>
<section class="about-4-section section-large bg-slate-50">
	<div class="container">
		<h2 class="site-title text-center" data-aos="fade-up" data-aos-duration="700" data-aos-delay="300">
			<?php echo esc_html( $title ); ?>
		</h2>
		<div class="about-4-wrap mt-10 xl:mt-14" data-aos="fade-up" data-aos-duration="700" data-aos-delay="800">
			<div class="about-4-list">
				<?php foreach ( $stats as $stat ) : ?>
					<div class="about-4-item">
						<div class="icon img-contain flex items-center justify-center">
							<?php if ( str_starts_with( $stat['icon'], 'http' ) ) : ?>
								<img src="<?php echo esc_url( $stat['icon'] ); ?>" alt="<?php echo esc_attr( $stat['number'] ); ?>">
							<?php else : ?>
								<?php echo spl_icon( $stat['icon'], 'w-8 h-8 text-primary' ); ?>
							<?php endif; ?>
						</div>
						<div class="caption">
							<h3 class="title"><?php echo esc_html( $stat['number'] ); ?></h3>
							<div class="desc"><?php echo esc_html( $stat['desc'] ); ?></div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
			<div class="about-4-image text-center">
				<img src="<?php echo esc_url( $center_image ); ?>" alt="NHỮNG CON SỐ BIẾT NÓI VINACOS">
			</div>
		</div>

		<div class="about-42 mt-10 xl:mt-20">
			<h2 class="site-title text-center" data-aos="fade-up" data-aos-duration="700" data-aos-delay="300">
				LỜI HỨA CỦA VINACOS
			</h2>
			<div class="about-42-list mt-10">
				<?php foreach ( $promises as $index => $item ) : ?>
					<div class="about-42-item" data-aos="fade-up" data-aos-duration="700" data-aos-delay="<?php echo ( 300 * ( $index + 1 ) ); ?>">
						<div class="arrow"><?= spl_icon( 'arrow-right', '', 20 ) ?></div>
						<div class="icon img-contain flex items-center justify-center">
							<?php if ( str_starts_with( $item['icon'], 'http' ) ) : ?>
								<img src="<?php echo esc_url( $item['icon'] ); ?>" alt="<?php echo esc_attr( $item['title'] ); ?>">
							<?php else : ?>
								<?php echo spl_icon( $item['icon'], 'w-8 h-8 text-primary' ); ?>
							<?php endif; ?>
						</div>
						<div class="caption">
							<h3 class="title"><?php echo esc_html( $item['title'] ); ?></h3>
							<div class="desc"><?php echo esc_html( $item['desc'] ); ?></div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
