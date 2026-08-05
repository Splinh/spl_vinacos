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
		'svg'    => '<svg class="w-10 h-10 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-4"/></svg>',
	],
	[
		'number' => '100%',
		'desc'   => 'Kiểm nghiệm công thức và test độ ổn định',
		'svg'    => '<svg class="w-10 h-10 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M9 3h6"/><path d="M10 3v5.4a2 2 0 0 1-.57 1.43L4.2 15.06a3 3 0 0 0 .7 4.9 3 3 0 0 0 3.5-.36L12 17l3.6 2.6a3 3 0 0 0 4.2-4.54l-5.23-5.23A2 2 0 0 1 14 8.4V3"/><path d="M8.5 14h7"/></svg>',
	],
	[
		'number' => '30+',
		'desc'   => 'Đề tài nghiên cứu khoa học đã đăng tải',
		'svg'    => '<svg class="w-10 h-10 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/><path d="M9 7h6"/><path d="M9 11h6"/></svg>',
	],
	[
		'number' => '3+',
		'desc'   => 'Bằng sáng chế & giải pháp hữu ích',
		'svg'    => '<svg class="w-10 h-10 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"/></svg>',
	],
];

$promises = [
	[
		'title' => 'Chất lượng bền vững',
		'desc'  => 'Mỗi công thức từ VINACOS đều phải vượt qua hàng trăm lần kiểm nghiệm trước khi được phép rời khỏi phòng lab. Chúng tôi không chỉ test độ ổn định của sản phẩm qua thời gian, mà còn kiểm tra khả năng tương thích giữa các hoạt chất, đảm bảo chúng không phản ứng phụ hay làm giảm hiệu quả lẫn nhau.',
		'svg'   => '<svg class="w-10 h-10 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-4"/></svg>',
	],
	[
		'title' => 'Năng lực chuyên gia',
		'desc'  => 'Một công thức R&D tại VINACOS mất ít nhất 3-6 tháng để hoàn thiện. Chúng tôi tính toán chính xác từng phần trăm hoạt chất, điều chỉnh pH phù hợp với làn da Việt, test độ thẩm thấu và thử nghiệm hàng chục mẫu trước khi chốt công thức tối ưu.',
		'svg'   => '<svg class="w-10 h-10 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/><path d="m16 16-2 2"/></svg>',
	],
	[
		'title' => 'Sự minh bạch',
		'desc'  => 'Chúng tôi công khai 100% thành phần, đầy đủ hồ sơ pháp lý, chứng từ kiểm nghiệm từ đơn vị uy tín và nguồn gốc nguyên liệu rõ ràng. Mỗi sản phẩm đều kèm tài liệu về quy trình sản xuất, kết quả test an toàn và các chứng nhận cần thiết.',
		'svg'   => '<svg class="w-10 h-10 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6"/><path d="m9 15 2 2 4-4"/></svg>',
	],
	[
		'title' => 'Tâm thế cộng sự',
		'desc'  => 'VINACOS không chỉ nhận đơn và sản xuất, chúng tôi đồng hành cùng bạn từ câu chuyện thương hiệu, phân tích thị trường, tư vấn công thức phù hợp định vị đến hoàn thiện hồ sơ pháp lý để sản phẩm lưu hành hợp pháp.',
		'svg'   => '<svg class="w-10 h-10 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7z"/><path d="M12 5 9.04 7.96a2.17 2.17 0 0 0 0 3.08c.82.82 2.13.85 3 .07l2.07-1.9a2.82 2.82 0 0 1 3.79 0l2.96 2.66"/></svg>',
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
						<div class="icon flex items-center justify-center w-16 h-16 rounded-2xl bg-blue-50/90 text-primary border border-blue-100 shadow-sm mx-auto mb-3">
							<?php echo $stat['svg']; ?>
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
						<div class="icon flex items-center justify-center w-16 h-16 rounded-2xl bg-blue-50/90 text-primary border border-blue-100 shadow-sm mb-4">
							<?php echo $item['svg']; ?>
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
