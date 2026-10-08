<?php
/**
 * Seeder script to populate ACF fields for VINACOS OEM/ODM Cooperation Page in WP Database.
 *
 * Usage via CLI: php -r "require 'wp/wp-load.php'; require 'wp/wp-content/themes/spl/tools/seed-cooperation-acf.php';"
 *
 * @package SPL
 */

defined( 'ABSPATH' ) || exit;

echo "=== POPULATING VINACOS OEM/ODM COOPERATION ACF FIELDS ===" . PHP_EOL;

// Find the OEM/ODM cooperation page
$page = get_page_by_path( 'oem-odm-gia-cong-unila-viet-nam' );
if ( ! $page ) {
	$page = get_page_by_title( 'Hệ thống R&D & Gia công OEM/ODM' );
}

if ( ! $page ) {
	echo "Error: Cooperation page not found!" . PHP_EOL;
	return;
}

$page_id = $page->ID;
echo "Found Target Page: ID {$page_id} ('{$page->post_title}')" . PHP_EOL;

// Build flexible content sections array matching group_daily_cooperation schema
$cooperation_sections = array(
	// Section 1: Hero Banner + Stats
	array(
		'acf_fc_layout' => 'cooperation_hero',
		'disable'       => 0,
		'tagline'       => '★ Nhà Máy Đạt Chuẩn cGMP / FDA',
		'title'         => "Gia Công Mỹ Phẩm Trọn Gói\nTừ Ý Tưởng Đến Thương Hiệu (Chỉ Trong 20 Ngày)",
		'subtitle'      => 'Vinacos cung cấp giải pháp gia công mỹ phẩm OEM/ODM toàn diện: Nghiên cứu công thức độc quyền, sản xuất nhà máy chuẩn cGMP/FDA, thiết kế bao bì và hoàn thiện thủ tục pháp lý A-Z. MOQ linh hoạt chỉ từ 1.000 sản phẩm.',
		'btn_text_1'    => 'Nhận báo giá 5 phút',
		'btn_link_1'    => '#register-form',
		'btn_text_2'    => 'Xem gói hợp tác',
		'btn_link_2'    => '#packages',
		'stats'         => array(
			array( 'stat_number' => '10+',  'stat_label' => 'Năm kinh nghiệm' ),
			array( 'stat_number' => '300+', 'stat_label' => 'Công thức R&D' ),
			array( 'stat_number' => '30+',  'stat_label' => 'Dòng sản phẩm' ),
			array( 'stat_number' => '500+', 'stat_label' => 'Nguyên liệu COA' ),
			array( 'stat_number' => '20',   'stat_label' => 'Ngày hoàn thành' ),
		),
	),

	// Section 2: Benefits (5 Lý do)
	array(
		'acf_fc_layout' => 'cooperation_benefits',
		'disable'       => 0,
		'title'         => '5 Lý Do Hàng Trăm Thương Hiệu Chọn Vinacos',
		'subtitle'      => 'Không chỉ là nhà máy gia công — Vinacos là đối tác đồng hành giúp bạn xây dựng thương hiệu mỹ phẩm bền vững',
		'cards'         => array(
			array(
				'icon'        => '<svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>',
				'title'       => 'Ra mắt sản phẩm chỉ 20 ngày',
				'description' => 'Dây chuyền tự động & phòng lab R&D nội bộ giúp rút ngắn 50% thời gian so với thị trường (45-60 ngày).',
			),
			array(
				'icon'        => '<svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M10 2v7.31c0 1.24-.76 2.34-1.92 2.76L4 13.5V20c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2v-6.5l-4.08-1.43c-1.16-.42-1.92-1.52-1.92-2.76V2h-4z"/></svg>',
				'title'       => '300+ Công thức R&D sẵn sàng',
				'description' => 'Đội ngũ Dược sĩ, Thạc sĩ hóa mỹ phẩm sẵn sàng điều chỉnh tầng hương, chất kem và công dụng theo yêu cầu riêng.',
			),
			array(
				'icon'        => '<svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>',
				'title'       => 'MOQ nhỏ chỉ từ 1.000 SP',
				'description' => 'Rào cản gia nhập thấp cho Startup, Spa & KOLs khởi nghiệp brand mỹ phẩm riêng với vốn đầu tư tối ưu.',
			),
			array(
				'icon'        => '<svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><path d="M16 13H8"/><path d="M16 17H8"/></svg>',
				'title'       => 'Trọn gói pháp lý A-Z an tâm',
				'description' => 'Hoàn thiện 100% hồ sơ: công bố mỹ phẩm, đăng ký nhãn hiệu, mã vạch và giấy phép quảng cáo lưu hành hợp pháp.',
			),
			array(
				'icon'        => '<svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 21h18"/><path d="M5 21V7l8-4v18"/><path d="M19 21V11l-6-4"/></svg>',
				'title'       => 'Nhà máy chuẩn cGMP / FDA',
				'description' => 'Sở hữu trực tiếp không qua trung gian. Hệ thống lọc nước tinh khiết RO & tiệt trùng UV đạt chuẩn vô trùng.',
			),
			array(
				'icon'        => '<svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2" ry="2"/></svg>',
				'title'       => 'Đồng hành Marketing & KOLs',
				'description' => 'Cung cấp hình ảnh/video sản xuất tại nhà máy làm tư liệu quảng cáo, hỗ trợ kết nối KOCs & chuyên gia.',
			),
		),
	),

	// Section 3: Packages
	array(
		'acf_fc_layout' => 'cooperation_packages',
		'disable'       => 0,
		'title'         => 'Gói Gia Công Phù Hợp Với Mọi Quy Mô',
		'subtitle'      => 'Dù bạn là startup mới khởi nghiệp hay doanh nghiệp cần mở rộng — Vinacos đều có giải pháp tối ưu cho ngân sách và mục tiêu',
		'packages'      => array(
			array(
				'badge'       => 'Khởi nghiệp',
				'title'       => 'Khởi Nghiệp Brand Mỹ Phẩm',
				'subtitle'    => 'Phù hợp startup, Spa, KOLs mới khởi nghiệp',
				'discount'    => '1.000 SP',
				'details'     => "Lựa chọn từ 300+ công thức đã test — không chờ R&D\nSản xuất số lượng nhỏ để test phản hồi thị trường\nNhận mẫu thử (sample) miễn phí trước khi quyết định\nTư vấn chọn sản phẩm dễ bán, phù hợp xu hướng\nx Hồ sơ thiết kế bao bì riêng biệt",
				'btn_text'    => 'Nhận báo giá miễn phí',
				'btn_link'    => '#register-form',
				'is_featured' => 0,
			),
			array(
				'badge'       => 'Phổ biến nhất',
				'title'       => 'Xây Dựng Thương Hiệu Riêng',
				'subtitle'    => 'Gia công trọn gói A – Z theo concept độc quyền',
				'discount'    => 'OEM / ODM',
				'details'     => "Phát triển công thức độc quyền theo concept riêng\nThiết kế bao bì chai lọ & in ấn tem nhãn chuyên nghiệp\nVinacos hoàn thiện 100% hồ sơ pháp lý & công bố mỹ phẩm\nTư vấn định vị thương hiệu, chọn sản phẩm Hero\nHỗ trợ kho tư liệu Marketing (hình ảnh/video nhà máy)",
				'btn_text'    => 'Bắt đầu ngay — Nhận sample free',
				'btn_link'    => '#register-form',
				'is_featured' => 1,
			),
			array(
				'badge'       => 'Tối ưu lợi nhuận',
				'title'       => 'Sản Xuất Quy Mô Lớn',
				'subtitle'    => 'Đơn hàng lớn — Giá tốt nhất thị trường',
				'discount'    => 'VIP Deal',
				'details'     => "Mức giá gia công tốt nhất — Đặt càng nhiều chi phí càng giảm\nƯu tiên dây chuyền khép kín, đảm bảo tiến độ\nBảo mật tuyệt đối — Ký hợp đồng NDA bảo vệ công thức\nHỗ trợ nâng cấp công thức & kết nối KOLs",
				'btn_text'    => 'Nhận báo giá VIP',
				'btn_link'    => '#register-form',
				'is_featured' => 0,
			),
		),
	),

	// Section 4: Process
	array(
		'acf_fc_layout' => 'cooperation_process',
		'disable'       => 0,
		'title'         => 'Quy Trình Gia Công Mỹ Phẩm 4 Bước',
		'subtitle'      => 'Chỉ 4 bước đơn giản từ ý tưởng ban đầu đến thương hiệu xuất xưởng trong 20 ngày',
		'steps'         => array(
			array(
				'icon'        => '<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>',
				'title'       => 'Tư vấn & Chọn concept',
				'description' => 'Trao đổi định hướng sản phẩm, tư vấn công thức R&D và lựa chọn gói gia công phù hợp',
			),
			array(
				'icon'        => '<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M10 2v7.31c0 1.24-.76 2.34-1.92 2.76L4 13.5V20c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2v-6.5l-4.08-1.43c-1.16-.42-1.92-1.52-1.92-2.76V2h-4z"/></svg>',
				'title'       => 'Gửi mẫu thử (Sample)',
				'description' => 'Thử nghiệm mẫu test miễn phí, điều chỉnh chất kem & tầng hương đến khi bạn hoàn toàn hài lòng',
			),
			array(
				'icon'        => '<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><path d="M16 13H8"/><path d="M16 17H8"/></svg>',
				'title'       => 'Ký HĐ & Làm pháp lý',
				'description' => 'Ký hợp đồng gia công, NDA bảo mật, thiết kế bao bì & hoàn thiện hồ sơ công bố mỹ phẩm',
			),
			array(
				'icon'        => '<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>',
				'title'       => 'Sản xuất & Bàn giao 20 ngày',
				'description' => 'Sản xuất khép kín tại nhà máy chuẩn cGMP/FDA, kiểm định chất lượng & giao thành phẩm tận nơi',
			),
		),
	),

	// Section 5: Form & FAQs
	array(
		'acf_fc_layout'   => 'cooperation_form',
		'disable'         => 0,
		'form_title'      => 'Đăng Ký Tư Vấn & Nhận Mẫu Thử Miễn Phí',
		'form_subtitle'   => 'Chuyên gia Vinacos sẽ phản hồi và gửi báo giá trong vòng 30 phút.',
		'contact_title'   => 'Liên hệ trực tiếp Vinacos',
		'contact_subtitle'=> 'Đội ngũ tư vấn R&D luôn sẵn sàng hỗ trợ giải đáp mọi thắc mắc của bạn.',
		'contacts'        => array(
			array(
				'icon'  => '<svg class="w-4 h-4 text-emerald-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>',
				'label' => 'Hotline / Zalo',
				'value' => '0902 666 746',
			),
			array(
				'icon'  => '<svg class="w-4 h-4 text-emerald-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>',
				'label' => 'Email tư vấn',
				'value' => 'contact@vinacos.vn',
			),
			array(
				'icon'  => '<svg class="w-4 h-4 text-emerald-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>',
				'label' => 'Văn phòng',
				'value' => 'TP. Hồ Chí Minh',
			),
			array(
				'icon'  => '<svg class="w-4 h-4 text-emerald-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>',
				'label' => 'Thời gian',
				'value' => '8:00 – 18:00, T2 – CN',
			),
		),
		'faq_title'       => 'Câu hỏi thường gặp về gia công mỹ phẩm',
		'faqs'            => array(
			array(
				'question' => 'Chi phí gia công mỹ phẩm tối thiểu tại Vinacos là bao nhiêu?',
				'answer'   => 'Với gói Khởi nghiệp (MOQ từ 1.000 sản phẩm), chi phí đầu tư ban đầu từ ~30 - 50 triệu tùy theo loại sản phẩm và chai lọ bao bì. Vinacos sẽ gửi báo giá bóc tách chi tiết trong vòng 30 phút.',
			),
			array(
				'question' => 'Tôi có được thử mẫu (sample) trước khi ký hợp đồng không?',
				'answer'   => 'Hoàn toàn được. Vinacos hỗ trợ gửi mẫu thử miễn phí và điều chỉnh theo phản hồi của bạn cho đến khi đạt độ hài lòng 100% trước khi ký hợp đồng sản xuất.',
			),
			array(
				'question' => 'Công thức mỹ phẩm của tôi có được bảo mật độc quyền không?',
				'answer'   => 'Vinacos cam kết bảo mật 100%. Mọi đơn hàng đều đi kèm thỏa thuận NDA (Bảo mật thông tin). Công thức của bạn sẽ không bao giờ được sử dụng cho bên thứ 3.',
			),
			array(
				'question' => 'Thời gian hoàn thiện một đơn hàng gia công là bao lâu?',
				'answer'   => 'Trung bình từ 15 - 20 ngày làm việc. Với công thức có sẵn và bao bì tiêu chuẩn, thời gian có thể rút ngắn còn 10 - 12 ngày.',
			),
		),
	),
);

// Populate using ACF update_field if function exists, else update_post_meta
if ( function_exists( 'update_field' ) ) {
	update_field( 'cooperation_sections', $cooperation_sections, $page_id );
	echo "SUCCESS: Populated 'cooperation_sections' via update_field() on Page ID {$page_id}" . PHP_EOL;
} else {
	update_post_meta( $page_id, 'cooperation_sections', $cooperation_sections );
	echo "SUCCESS: Saved 'cooperation_sections' post meta on Page ID {$page_id}" . PHP_EOL;
}

echo "=== COMPLETED SEEDING COOPERATION ACF FIELDS ===" . PHP_EOL;
