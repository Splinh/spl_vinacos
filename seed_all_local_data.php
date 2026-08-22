<?php
/**
 * All-In-One Local Database Seeder for VINACOS
 * Populates all Homepage ACF fields, Options fields, and Content fields with real attachments and texts.
 */
define('WP_USE_THEMES', false);
define('WP_ADMIN', true);
require __DIR__ . '/wp/wp-load.php';

echo "=== SEEDING ALL LOCAL DATABASE CONTENT FOR VINACOS ===\n\n";

global $wpdb;

// Helper to find attachment ID by keyword
function find_attachment_id($keywords, $fallback_url = '') {
    global $wpdb;
    if (!is_array($keywords)) {
        $keywords = [$keywords];
    }
    foreach ($keywords as $kw) {
        $id = $wpdb->get_var($wpdb->prepare(
            "SELECT ID FROM {$wpdb->posts} WHERE post_type = 'attachment' AND (post_title LIKE %s OR guid LIKE %s) ORDER BY ID DESC LIMIT 1",
            '%' . $kw . '%',
            '%' . $kw . '%'
        ));
        if ($id) {
            return (int) $id;
        }
    }
    // Return first image attachment if nothing matches
    $first_id = $wpdb->get_var("SELECT ID FROM {$wpdb->posts} WHERE post_type = 'attachment' AND post_mime_type LIKE 'image/%' ORDER BY ID DESC LIMIT 1");
    return $first_id ? (int) $first_id : 0;
}

// 1. Find logo and key attachments
$logo_id = find_attachment_id(['logovinacos', 'logo']);
$banner1_id = find_attachment_id(['slide1', 'banner', 'vespa']);
$banner2_id = find_attachment_id(['slide2', 'banner', 'gogo']);
$banner3_id = find_attachment_id(['slide3', 'banner', 'xmen']);
$banner4_id = find_attachment_id(['slide4', 'banner', 'cree']);
$about_img_id = find_attachment_id(['tam-the-cong-su', 'about', 'lab']);
$rd_img1_id = find_attachment_id(['rd-lab', 'lab', 'nghien-cuu']);
$rd_img2_id = find_attachment_id(['research', 'nano', 'cong-trinh']);
$stats_bg_id = find_attachment_id(['bg-stats', 'stats', 'banner']);
$stats_fig_id = find_attachment_id(['stats-vinacos', 'stats', 'figure']);
$prod1_id = find_attachment_id(['product1', 'kem', 'skincare']);
$prod2_id = find_attachment_id(['product2', 'mat-na', 'clay']);
$prod3_id = find_attachment_id(['product3', 'tay-te-bao', 'scrub']);
$prod4_id = find_attachment_id(['product4', 'phuc-hoi', 'soothing']);

echo "Attachments Found:\n";
echo " - Logo ID: $logo_id\n";
echo " - Banner 1 ID: $banner1_id\n";
echo " - Banner 2 ID: $banner2_id\n";
echo " - About Image ID: $about_img_id\n";
echo " - R&D Image ID: $rd_img1_id\n";
echo " - Product 1 ID: $prod1_id\n\n";

// 2. Populate Theme Options
echo "1. Populating Theme Options (Logo, Header, Contact, Footer)...\n";
update_option('options_logo', $logo_id);
update_option('_options_logo', 'field_logo');
set_theme_mod('custom_logo', $logo_id);

update_option('options_header_hotline', '0901 234 567');
update_option('_options_header_hotline', 'field_header_hotline');

update_option('options_header_slogan', 'Nhà máy gia công mỹ phẩm & bao bì chuẩn cGMP / FDA');
update_option('_options_header_slogan', 'field_header_slogan');

update_option('options_company_name', 'CÔNG TY CỔ PHẦN DƯỢC MỸ PHẨM VINACOS');
update_option('_options_company_name', 'field_company_name');

update_option('options_company_address', 'Số 12, Đường Công Nghệ Cao, KCN Long Hậu, Cần Giuộc, Long An');
update_option('_options_company_address', 'field_company_address');

update_option('options_company_phone', '0901 234 567 - 028 3770 1234');
update_option('_options_company_phone', 'field_company_phone');

update_option('options_company_email', 'info@vinacos.com.vn - contact@vinacos.vn');
update_option('_options_company_email', 'field_company_email');

update_option('options_company_website', 'https://vinacos.splworks.com');
update_option('_options_company_website', 'field_company_website');

echo " - Theme Options updated successfully.\n\n";

// 3. Populate Homepage (Page ID 10 / page_on_front)
$front_page_id = (int) get_option('page_on_front');
if (!$front_page_id || !get_post($front_page_id)) {
    $front_page_id = 10;
    if (!get_post($front_page_id)) {
        $front_page_id = wp_insert_post([
            'import_id'    => 10,
            'post_title'   => 'Trang Chủ',
            'post_type'    => 'page',
            'post_status'  => 'publish',
            'page_template'=> 'templates/template-page-home.php',
        ]);
    }
    update_option('show_on_front', 'page');
    update_option('page_on_front', $front_page_id);
}

echo "2. Populating Homepage Flexible Content for Page ID: $front_page_id...\n";

$home_sections = [
    // Section 1: Hero Banner Slider
    [
        'acf_fc_layout' => 'hero_slider',
        'disable'       => 0,
        'slides'        => [
            [
                'bg_image'        => $banner1_id,
                'bg_image_mobile' => $banner1_id,
                'title'           => 'MỞ LỐI KỶ NGUYÊN MỸ PHẨM VIỆT CHUẨN KHOA HỌC',
                'link'            => ['title' => 'Xem chi tiết', 'url' => '#about-us', 'target' => ''],
            ],
            [
                'bg_image'        => $banner2_id,
                'bg_image_mobile' => $banner2_id,
                'title'           => 'HIỂU LÀN DA VIỆT - ĐỒNG HÀNH THƯƠNG HIỆU VIỆT',
                'link'            => ['title' => 'Dịch vụ R&D', 'url' => '#services', 'target' => ''],
            ],
            [
                'bg_image'        => $banner3_id,
                'bg_image_mobile' => $banner3_id,
                'title'           => 'RỦI RO LỚN NHẤT LÀ SAI TỪ CÔNG THỨC',
                'link'            => ['title' => 'Hệ thống kiểm nghiệm', 'url' => '#rd-system', 'target' => ''],
            ],
            [
                'bg_image'        => $banner4_id,
                'bg_image_mobile' => $banner4_id,
                'title'           => 'SỨC MẠNH TỪ HỆ THỐNG R&D ĐỘC QUYỀN',
                'link'            => ['title' => 'Khám phá sản phẩm', 'url' => '#products', 'target' => ''],
            ],
        ],
    ],

    // Section 2: About Section
    [
        'acf_fc_layout' => 'about_section',
        'disable'       => 0,
        'title'         => "TÂM THẾ \n CỘNG SỰ",
        'content'       => "<h3><strong>Dẫn đầu (Tầm nhìn)</strong></h3>\n<p><em>VINACOS là doanh nghiệp khoa học & công nghệ tiên phong trong nghiên cứu và sản xuất gia công mỹ phẩm sạch tại Việt Nam.</em></p>\n<p>Chúng tôi đặt tâm huyết vào con người, thiết bị phòng Lab hiện đại đạt chuẩn FDA và quy trình chuẩn GMP để mỗi sản phẩm đến tay đối tác đều được kiểm chứng nghiêm túc, chất lượng rõ ràng, pháp lý minh bạch.</p>\n<h3><strong>Thấu hiểu (Sứ mệnh)</strong></h3>\n<p><em>VINACOS đồng hành cùng các thương hiệu Việt, dùng nghiên cứu khoa học và công nghệ tạo ra những sản phẩm an toàn trọn gói xứng đáng với làn da Việt.</em></p>",
        'btn_text'      => 'Về chúng tôi',
        'btn_link'      => '/ve-chung-toi/',
        'image'         => $about_img_id,
    ],

    // Section 3: Brand Banner
    [
        'acf_fc_layout' => 'brand_banner',
        'disable'       => 0,
    ],

    // Section 4: R&D System
    [
        'acf_fc_layout' => 'rd_system',
        'disable'       => 0,
        'items'         => [
            [
                'label'    => 'Hệ thống R&D',
                'title'    => 'Năng lực nghiên cứu sản xuất',
                'desc'     => 'VINACOS tập trung vào hai hướng nghiên cứu cốt lõi: Khai thác nguyên liệu thiên nhiên tiềm năng và phát triển công thức mỹ phẩm hoàn chỉnh OEM/ODM đạt chuẩn cGMP/FDA.',
                'btn_text' => 'Tìm hiểu thêm',
                'btn_link' => '/nghien-cuu-phat-trien/',
                'image'    => $rd_img1_id,
            ],
            [
                'label'    => 'Công nghệ tiên tiến',
                'title'    => 'Các bài báo & Công trình khoa học',
                'desc'     => 'Ứng dụng hệ thống nhũ tương nano lipid và màng bao sinh học bọc hoạt chất trong mỹ phẩm chăm sóc da: Công trình nghiên cứu giúp hoạt chất thẩm thấu sâu và bảo toàn hiệu quả tối đa.',
                'btn_text' => 'Xem công trình',
                'btn_link' => '/cong-trinh-khoa-hoc/',
                'image'    => $rd_img2_id,
            ],
        ],
    ],

    // Section 5: Key Numbers
    [
        'acf_fc_layout' => 'key_numbers',
        'disable'       => 0,
        'title'         => 'Con số nổi bật',
        'items'         => [
            ['count' => 100, 'suffix' => '%', 'title' => 'Kiểm nghiệm công thức và test độ ổn định'],
            ['count' => 300, 'suffix' => '+', 'title' => 'Công thức độc quyền đã nghiên cứu R&D'],
            ['count' => 30,  'suffix' => '+', 'title' => 'Đề tài nghiên cứu khoa học công bố'],
            ['count' => 10,  'suffix' => '+', 'title' => 'Năm kinh nghiệm sản xuất & gia công mỹ phẩm'],
        ],
        'bg_image'      => $stats_bg_id,
        'figure_image'  => $stats_fig_id,
    ],

    // Section 6: Product Showcase
    [
        'acf_fc_layout' => 'product_showcase',
        'disable'       => 0,
        'title'         => 'Danh mục sản phẩm tiêu biểu',
        'items'         => [
            [
                'title'       => 'Nền kem vỡ nước - Không Silicone',
                'description' => 'Hiệu ứng “vỡ nước” tươi mát khi thoa không chứa silicone, an toàn tuyệt đối cho làn da nhạy cảm.',
                'btn_text'    => 'Xem chi tiết',
                'btn_link'    => '/san-pham/',
                'image'       => $prod1_id,
            ],
            [
                'title'       => 'Mặt nạ đất sét trà xanh Detox',
                'description' => 'Ứng dụng đất sét khoáng tự nhiên hấp thụ bã nhờn và độc tố, làm sạch sâu lỗ chân lông.',
                'btn_text'    => 'Xem chi tiết',
                'btn_link'    => '/san-pham/',
                'image'       => $prod2_id,
            ],
            [
                'title'       => 'Tẩy tế bào chết Silica từ vỏ trấu Việt Nam',
                'description' => 'Giải pháp thay thế vi nhựa bằng silica sinh học chiết xuất từ vỏ trấu Việt Nam. Thân thiện môi trường.',
                'btn_text'    => 'Xem chi tiết',
                'btn_link'    => '/san-pham/',
                'image'       => $prod3_id,
            ],
            [
                'title'       => 'Mặt nạ bùn Cúc La Mã làm dịu & phục hồi',
                'description' => 'Kết hợp bùn khoáng thiên nhiên với chiết xuất Cúc La Mã chuẩn hóa, phục hồi hàng rào bảo vệ da.',
                'btn_text'    => 'Xem chi tiết',
                'btn_link'    => '/san-pham/',
                'image'       => $prod4_id,
            ],
        ],
    ],

    // Section 7: Partners Section
    [
        'acf_fc_layout'   => 'partners_section',
        'disable'         => 0,
        'watermark'       => 'VINACOS',
        'left_title'      => 'ĐỐI TÁC NGUYÊN LIỆU',
        'right_title'     => 'ĐỐI TÁC NGHIÊN CỨU',
    ],

    // Section 8: News Section
    [
        'acf_fc_layout' => 'news_section',
        'disable'       => 0,
        'title'         => 'Tin tức & Hoạt động',
    ],

    // Section 9: Consult Modal
    [
        'acf_fc_layout' => 'consult_modal',
        'disable'       => 0,
        'title'         => 'Nhận tư vấn giải pháp R&D & Gia công trọn gói miễn phí',
    ],
];

if (function_exists('update_field')) {
    update_field('home_sections', $home_sections, $front_page_id);
    echo " - Successfully updated 'home_sections' via update_field()!\n";
} else {
    update_post_meta($front_page_id, 'home_sections', $home_sections);
    echo " - Successfully updated 'home_sections' via update_post_meta()!\n";
}

echo "\n=== SEEDING COMPLETED 100%! ===\n";
echo "Now all ACF fields have real database values on Local.\n";
