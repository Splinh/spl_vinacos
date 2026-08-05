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
		'svg'    => '<svg class="w-10 h-10 text-[#1e60a3]" viewBox="0 0 48 48" fill="none" stroke="#1e60a3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="10" y="8" width="28" height="20" rx="3" fill="#f0f7ff"/><line x1="15" y1="14" x2="27" y2="14"/><line x1="15" y1="18" x2="23" y2="18"/><circle cx="30" cy="30" r="7" fill="#ffffff"/><path d="M30 25l1.5 3 3.5.5-2.5 2.5.6 3.5-3.1-1.6-3.1 1.6.6-3.5-2.5-2.5 3.5-.5z"/><path d="M26 36l-3 7 4-2 4 2-3-7"/></svg>',
	],
	[
		'number' => '100%',
		'desc'   => 'Kiểm nghiệm công thức và test độ ổn định',
		'svg'    => '<svg class="w-10 h-10 text-[#1e60a3]" viewBox="0 0 48 48" fill="none" stroke="#1e60a3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="24" cy="24" r="18" stroke-dasharray="3 3" stroke-opacity="0.5"/><path d="M16 28h5l3-3 4 4 4-2"/><path d="M28 16v5l-3 3 4 4-2 4"/><path d="M16 20h8l-2 5 5 2"/><path d="M18 16l6 6M24 30l6-6M30 18l-6 6"/></svg>',
	],
	[
		'number' => '30+',
		'desc'   => 'Đề tài nghiên cứu khoa học đã đăng tải',
		'svg'    => '<svg class="w-10 h-10 text-[#1e60a3]" viewBox="0 0 48 48" fill="none" stroke="#1e60a3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="12" y="10" width="24" height="32" rx="3" fill="#f0f7ff"/><path d="M18 10V7a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v3"/><path d="M22 18v5M20 23h4M24 28a4 4 0 1 0 4-4h-4"/><path d="M18 36h12"/><circle cx="22" cy="18" r="2"/></svg>',
	],
	[
		'number' => '3+',
		'desc'   => 'Bằng sáng chế & giải pháp hữu ích',
		'svg'    => '<svg class="w-10 h-10 text-[#1e60a3]" viewBox="0 0 48 48" fill="none" stroke="#1e60a3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="20" cy="16" r="6"/><path d="M10 36c0-6 4.5-10 10-10 2 0 3.8.6 5.2 1.6"/><circle cx="32" cy="32" r="7" stroke-dasharray="3 2"/><path d="M28 26l8-8M36 22v-4h-4"/></svg>',
	],
];

$promises = [
	[
		'title' => 'Chất lượng bền vững',
		'desc'  => 'Mỗi công thức từ VINACOS đều phải vượt qua hàng trăm lần kiểm nghiệm trước khi được phép rời khỏi phòng lab. Chúng tôi không chỉ test độ ổn định của sản phẩm qua thời gian, mà còn kiểm tra khả năng tương thích giữa các hoạt chất, đảm bảo chúng không phản ứng phụ hay làm giảm hiệu quả lẫn nhau.',
		'svg'   => '<svg class="w-14 h-14 text-[#1e60a3]" viewBox="0 0 64 64" fill="none" stroke="#1e60a3" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><rect x="10" y="12" width="44" height="32" rx="2"/><circle cx="42" cy="38" r="8" fill="#ffffff"/><path d="M42 33l1.8 3.5 3.9.6-2.8 2.7.7 3.8-3.6-1.9-3.6 1.9.7-3.8-2.8-2.7 3.9-.6z"/><path d="M38 45l-3 7 5-2.5 5 2.5-3-7"/></svg>',
	],
	[
		'title' => 'Năng lực chuyên gia',
		'desc'  => 'Một công thức R&D tại VINACOS mất ít nhất 3-6 tháng để hoàn thiện. Chúng tôi tính toán chính xác từng phần trăm hoạt chất, điều chỉnh pH phù hợp với làn da Việt, test độ thẩm thấu và thử nghiệm hàng chục mẫu trước khi chốt công thức tối ưu.',
		'svg'   => '<svg class="w-14 h-14 text-[#1e60a3]" viewBox="0 0 64 64" fill="none" stroke="#1e60a3" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><rect x="10" y="20" width="44" height="30" rx="3"/><path d="M24 20v-5a3 3 0 0 1 3-3h10a3 3 0 0 1 3 3v5"/><line x1="10" y1="32" x2="54" y2="32"/><rect x="20" y="29" width="6" height="6" rx="1" fill="#ffffff"/><rect x="38" y="29" width="6" height="6" rx="1" fill="#ffffff"/></svg>',
	],
	[
		'title' => 'Sự minh bạch',
		'desc'  => 'Chúng tôi công khai 100% thành phần, đầy đủ hồ sơ pháp lý, chứng từ kiểm nghiệm từ đơn vị uy tín và nguồn gốc nguyên liệu rõ ràng. Mỗi sản phẩm đều kèm tài liệu về quy trình sản xuất, kết quả test an toàn và các chứng nhận cần thiết.',
		'svg'   => '<svg class="w-14 h-14 text-[#1e60a3]" viewBox="0 0 64 64" fill="none" stroke="#1e60a3" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><rect x="20" y="10" width="30" height="40" rx="2"/><line x1="26" y1="18" x2="42" y2="18"/><line x1="26" y1="24" x2="42" y2="24"/><line x1="26" y1="30" x2="36" y2="30"/><line x1="26" y1="36" x2="34" y2="36"/><circle cx="24" cy="34" r="10" fill="#ffffff"/><line x1="17" y1="41" x2="11" y2="47" stroke-width="3"/><line x1="20" y1="34" x2="28" y2="34"/><line x1="24" y1="30" x2="24" y2="38"/></svg>',
	],
	[
		'title' => 'Tâm thế cộng sự',
		'desc'  => 'VINACOS không chỉ nhận đơn và sản xuất, chúng tôi đồng hành cùng bạn từ câu chuyện thương hiệu, phân tích thị trường, tư vấn công thức phù hợp định vị đến hoàn thiện hồ sơ pháp lý để sản phẩm lưu hành hợp pháp.',
		'svg'   => '<svg class="w-14 h-14 text-[#1e60a3]" viewBox="0 0 64 64" fill="none" stroke="#1e60a3" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="32" cy="22" r="8"/><path d="M16 46c0-9 7.2-16 16-16s16 7.2 16 16v4H16v-4z"/></svg>',
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
						<div class="icon flex items-center justify-center w-20 h-20 rounded-full bg-white shadow-md border border-blue-100 mx-auto mb-3">
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
						<div class="arrow"><?= spl_icon( 'arrow-up-right', '', 20 ) ?></div>
						<div class="icon flex items-center justify-center w-20 h-20 mb-4">
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
