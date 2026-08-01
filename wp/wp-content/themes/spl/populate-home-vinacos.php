<?php
/**
 * CLI Data Seeder Script for VINACOS Homepage ACF Fields
 *
 * Usage: php -r "require 'wp/wp-load.php'; require 'wp/wp-content/themes/spl/populate-home-vinacos.php';"
 *
 * @package SPL
 */

defined( 'ABSPATH' ) || exit;

// 1. Get or setup Front Page
$front_page_id = (int) get_option( 'page_on_front' );

if ( ! $front_page_id || ! get_post( $front_page_id ) ) {
	$front_page_id = wp_insert_post( array(
		'post_title'   => 'Trang Chủ - VINACOS',
		'post_type'    => 'page',
		'post_status'  => 'publish',
		'page_template'=> 'templates/template-page-home.php',
	) );
	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $front_page_id );
} else {
	update_post_meta( $front_page_id, '_wp_page_template', 'templates/template-page-home.php' );
}

echo "Seeding Homepage ACF data for Page ID: " . $front_page_id . PHP_EOL;

// 2. Define Flexible Content Sections matching Unila Structure
$home_sections = array(
	// 1. Hero Visual Slider
	array(
		'acf_fc_layout' => 'hero_slider',
		'disable'       => 0,
		'slides'        => array(
			array(
				'bg_image'        => get_template_directory_uri() . '/static/img/banner/slide1-desktop.jpg',
				'bg_image_mobile' => get_template_directory_uri() . '/static/img/banner/slide1-mobile.jpg',
				'title_line_1'    => 'MỞ LỐI KỶ NGUYÊN',
				'title_line_2'    => 'MỸ PHẨM VIỆT',
				'title_line_3'    => 'CHUẨN KHOA HỌC',
				'description'     => 'VINACOS là đơn vị tiên phong ứng dụng khoa học vào nghiên cứu và gia công mỹ phẩm sạch. Dẫn đầu để đặt ra tiêu chuẩn mới cho thương hiệu mỹ phẩm Việt.',
				'btn_text'        => 'Xem thêm',
				'btn_link'        => '#about-us',
			),
			array(
				'bg_image'        => get_template_directory_uri() . '/static/img/banner/slide2-desktop.jpg',
				'bg_image_mobile' => get_template_directory_uri() . '/static/img/banner/slide2-mobile.jpg',
				'title_line_1'    => 'HIỂU LÀN DA VIỆT',
				'title_line_2'    => 'ĐỒNG HÀNH',
				'title_line_3'    => 'THƯƠNG HIỆU VIỆT',
				'description'     => 'VINACOS tin rằng người Việt xứng đáng được chăm sóc bằng những công thức an toàn, lành tính, chuẩn y khoa.',
				'btn_text'        => 'Xem thêm',
				'btn_link'        => '#services',
			),
			array(
				'bg_image'        => get_template_directory_uri() . '/static/img/banner/slide3-desktop.jpg',
				'bg_image_mobile' => get_template_directory_uri() . '/static/img/banner/slide3-mobile.jpg',
				'title_line_1'    => 'RỦI RO LỚN NHẤT',
				'title_line_2'    => 'LÀ SAI TỪ CÔNG THỨC',
				'title_line_3'    => '',
				'description'     => 'VINACOS đặt sự an toàn và tính minh bạch lên hàng đầu: 0% sai sót về hoạt chất cấm – 100% kiểm nghiệm công thức – Hồ sơ pháp lý A-Z.',
				'btn_text'        => 'Xem thêm',
				'btn_link'        => '#rd-system',
			),
			array(
				'bg_image'        => get_template_directory_uri() . '/static/img/banner/slide4-desktop.jpg',
				'bg_image_mobile' => get_template_directory_uri() . '/static/img/banner/slide4-mobile.jpg',
				'title_line_1'    => 'SỨC MẠNH',
				'title_line_2'    => 'TỪ HỆ THỐNG R&D',
				'title_line_3'    => '',
				'description'     => '300+ công thức độc quyền. 10+ năm kinh nghiệm R&D. Đằng sau mỗi sản phẩm là dữ liệu khoa học & kiểm định lâm sàng.',
				'btn_text'        => 'Xem thêm',
				'btn_link'        => '#products',
			),
		),
	),

	// 2. About Section (TÂM THẾ CỘNG SỰ)
	array(
		'acf_fc_layout' => 'about_section',
		'disable'       => 0,
		'title'         => 'TÂM THẾ <br/> CỘNG SỰ',
		'content'       => '<h3><strong>Dẫn đầu (Tầm nhìn)</strong></h3>
<p><em>VINACOS là doanh nghiệp khoa học & công nghệ tiên phong trong nghiên cứu và sản xuất gia công mỹ phẩm sạch tại Việt Nam.</em></p>
<p>Chúng tôi đặt tâm huyết vào con người, thiết bị phòng Lab hiện đại đạt chuẩn FDA và quy trình chuẩn GMP để mỗi sản phẩm đến tay đối tác đều được kiểm chứng nghiêm túc, chất lượng rõ ràng, pháp lý minh bạch. Dẫn đầu với VINACOS là đặt ra tiêu chuẩn mới, góp phần chứng minh mỹ phẩm Việt hoàn toàn có thể sánh ngang thế giới.</p>
<h3><strong>Thấu hiểu (Sứ mệnh)</strong></h3>
<p><em>VINACOS đồng hành cùng các thương hiệu Việt, dùng nghiên cứu khoa học và công nghệ tạo ra những sản phẩm an toàn trọn gói xứng đáng với làn da Việt.</em></p>
<p>Chúng tôi hiểu rằng các thương hiệu mỹ phẩm cần một đối tác không chỉ biết sản xuất OEM/ODM, mà còn biết lắng nghe, tham vấn và cùng định hình sản phẩm từ gốc. VINACOS ở đây để cùng bạn đi từ ý tưởng đến thành công trên thị trường.</p>',
		'btn_text'      => 'Về chúng tôi',
		'btn_link'      => '#about-us',
		'image'         => get_template_directory_uri() . '/static/img/tam-the-cong-su-vinacos.jpg',
	),

	// 2.5 Brand Banner Section
	array(
		'acf_fc_layout' => 'brand_banner',
		'disable'       => 0,
	),

	// 3. R&D System Section
	array(
		'acf_fc_layout' => 'rd_system',
		'disable'       => 0,
		'items'         => array(
			array(
				'label'    => 'Hệ thống R&D',
				'title'    => 'Năng lực nghiên cứu sản xuất',
				'desc'     => 'VINACOS tập trung vào hai hướng nghiên cứu cốt lõi. Về nguyên liệu, chúng tôi khai thác và đánh giá các nguồn nguyên liệu tiềm năng, từ tách chiết, phân tích hoạt chất đến thử nghiệm độ ổn định. Về sản phẩm, chúng tôi phát triển công thức mỹ phẩm hoàn chỉnh OEM/ODM, đảm bảo hiệu quả, cảm quan cao cấp, sẵn sàng sản xuất hàng loạt.',
				'btn_text' => 'Tìm hiểu thêm',
				'btn_link' => '#rd-details',
				'image'    => 'https://unila.com.vn/wp-content/uploads/2026/04/HE-THONG-RD-2.1.jpg',
			),
			array(
				'label'    => 'Hệ thống R&D',
				'title'    => 'Các bài báo & Công trình khoa học',
				'desc'     => 'Ứng dụng hệ thống nhũ tương nano lipid và màng bao sinh học bọc hoạt chất trong mỹ phẩm chăm sóc da: Công trình nghiên cứu ứng dụng công nghệ hiện đại giúp hoạt chất thẩm thấu sâu và bảo toàn hiệu quả trên làn da người Việt.',
				'btn_text' => 'Tìm hiểu thêm',
				'btn_link' => '#research-papers',
				'image'    => 'https://unila.com.vn/wp-content/uploads/2026/03/HE-THONG-RD-2.jpg',
			),
		),
	),

	// 4. Key Numbers Section
	array(
		'acf_fc_layout' => 'key_numbers',
		'disable'       => 0,
		'title'         => 'Con số nổi bật',
		'items'         => array(
			array(
				'count'  => 100,
				'suffix' => '%',
				'title'  => 'Kiểm nghiệm công thức và test độ ổn định',
			),
			array(
				'count'  => 300,
				'suffix' => '+',
				'title'  => 'Công thức độc quyền đã nghiên cứu R&D',
			),
			array(
				'count'  => 30,
				'suffix' => '+',
				'title'  => 'Đề tài nghiên cứu khoa học công bố',
			),
			array(
				'count'  => 10,
				'suffix' => '+',
				'title'  => 'Năm kinh nghiệm sản xuất & gia công mỹ phẩm',
			),
		),
		'bg_image'      => get_template_directory_uri() . '/static/img/bg-stats-vinacos.jpg',
		'figure_image'  => get_template_directory_uri() . '/static/img/stats-vinacos.png',
	),

	// 5. Product Showcase Section
	array(
		'acf_fc_layout' => 'product_showcase',
		'disable'       => 0,
		'title'         => 'Danh mục sản phẩm VINACOS',
		'items'         => array(
			array(
				'title'       => 'Nền kem vỡ nước - Không Silicone',
				'description' => 'Hiệu ứng “vỡ nước” tươi mát khi thoa vốn thường chỉ đạt được nhờ hệ nhũ water-in-silicone. VINACOS nghiên cứu thành công nền công thức tương đương hoàn toàn không chứa silicone, an toàn tuyệt đối cho làn da nhạy cảm.',
				'btn_text'    => 'Xem thêm',
				'btn_link'    => '#skincare',
				'image'       => 'https://unila.com.vn/wp-content/uploads/2026/04/CHAT-1.jpg',
			),
			array(
				'title'       => 'Mặt nạ đất sét trà xanh Detox',
				'description' => 'Ứng dụng hệ đất sét khoáng tự nhiên hấp thụ bã nhờn và độc tố hiệu quả, làm sạch sâu lỗ chân lông mà vẫn duy trì độ ẩm tự nhiên cho da.',
				'btn_text'    => 'Xem thêm',
				'btn_link'    => '#clay-mask',
				'image'       => 'https://unila.com.vn/wp-content/uploads/2026/04/CHAT-SON-2.jpg',
			),
			array(
				'title'       => 'Tẩy tế bào chết Silica từ vỏ trấu Việt Nam',
				'description' => 'Giải pháp thay thế vi nhựa và silica công nghiệp bằng silica sinh học chiết xuất từ vỏ trấu Việt Nam. Tẩy da chết nhẹ nhàng, tự phân hủy sinh học, bảo vệ môi trường.',
				'btn_text'    => 'Xem thêm',
				'btn_link'    => '#scrub',
				'image'       => 'https://unila.com.vn/wp-content/uploads/2026/04/CHAT-3.jpg',
			),
			array(
				'title'       => 'Mặt nạ bùn Cúc La Mã làm dịu & phục hồi',
				'description' => 'Kết hợp bùn khoáng thiên nhiên với chiết xuất Cúc La Mã chuẩn hóa, giúp làm dịu tức thì làn da kích ứng và củng cố hàng rào bảo vệ da.',
				'btn_text'    => 'Xem thêm',
				'btn_link'    => '#soothing-mask',
				'image'       => 'https://unila.com.vn/wp-content/uploads/2026/04/CHAT-SON-4.jpg',
			),
		),
	),

	// 6. Partners Section
	array(
		'acf_fc_layout'   => 'partners_section',
		'disable'         => 0,
		'watermark'       => 'VINACOS',
		'watermark_image' => 'https://unila.com.vn/wp-content/uploads/2026/03/LO-2.png',
		'left_title'      => 'ĐỐI TÁC <br/> NGUYÊN LIỆU',
		'right_title'     => 'ĐỐI TÁC <br/> NGHIÊN CỨU',
		'left_partners'   => array(
			array( 'name' => 'Behn Meyer', 'logo' => 'https://unila.com.vn/wp-content/uploads/2026/03/BM.png' ),
			array( 'name' => 'CIDOLS', 'logo' => 'https://unila.com.vn/wp-content/uploads/2026/03/CIDOLS.png' ),
			array( 'name' => 'Clariant', 'logo' => 'https://unila.com.vn/wp-content/uploads/2026/03/CLARIANT.png' ),
			array( 'name' => 'DSM', 'logo' => 'https://unila.com.vn/wp-content/uploads/2026/03/DSM.png' ),
			array( 'name' => 'Oillio', 'logo' => 'https://unila.com.vn/wp-content/uploads/2026/03/OILLIO.png' ),
			array( 'name' => 'NOF', 'logo' => 'https://unila.com.vn/wp-content/uploads/2026/03/NOF.png' ),
			array( 'name' => 'Seppic', 'logo' => 'https://unila.com.vn/wp-content/uploads/2026/03/SEPPIC.png' ),
			array( 'name' => 'Solabia', 'logo' => 'https://unila.com.vn/wp-content/uploads/2026/03/SOLABIA.png' ),
		),
		'right_partners'  => array(
			array( 'name' => 'Đại Học Công Thương', 'logo' => 'https://unila.com.vn/wp-content/uploads/2026/03/Cong-thuong.jpeg' ),
		),
	),

	// 7. News Section
	array(
		'acf_fc_layout' => 'news_section',
		'disable'       => 0,
		'title'         => 'Tin tức',
	),

	// 8. Consult Modal Section
	array(
		'acf_fc_layout' => 'consult_modal',
		'disable'       => 0,
		'title'         => 'Vui lòng để lại thông tin để nhận TƯ VẤN GIẢI PHÁP PRODUCT INSIGHT MIỄN PHÍ.',
		'image'         => 'https://unila.com.vn/wp-content/uploads/2024/10/GIA-CONG-MY-PHAM-UNILA-PRODUCT-INSIGHT-POP-UP-01.jpg',
	),
);

if ( function_exists( 'update_field' ) ) {
	update_field( 'home_sections', $home_sections, $front_page_id );
	echo "SUCCESS: Updated home_sections via ACF update_field()!" . PHP_EOL;
} else {
	update_post_meta( $front_page_id, 'home_sections', $home_sections );
	echo "SUCCESS: Updated home_sections via update_post_meta()!" . PHP_EOL;
}
