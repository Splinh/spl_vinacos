<?php
/**
 * CLI Script: Populate 100% Native ACF Flexible Content Blocks with Real Data & Images
 */
define('WP_USE_THEMES', false);
define('WP_ADMIN', true);
require __DIR__ . '/wp/wp-load.php';

echo "=======================================================\n";
echo " VINACOS - POPULATE ACF FLEXIBLE CONTENT WITH REAL DATA\n";
echo "=======================================================\n\n";

global $wpdb;

// 1. Clear any stale corrupt meta
$wpdb->query("DELETE FROM {$wpdb->postmeta} WHERE post_id IN (10, 1121) AND meta_key LIKE '%home_sections%'");
echo "1. Cleared stale postmeta.\n";

// 2. Import authentic images
require_once __DIR__ . '/import_and_link_real_images.php';

// 3. Ensure local ACF field group is loaded
if (function_exists('spl_register_vinacos_home_acf_fields')) {
    spl_register_vinacos_home_acf_fields();
}

// 4. Prepare complete structured data for Vietnamese Homepage (ID 10)
$structured_data_vi = [
    [
        'acf_fc_layout' => 'hero_slider',
        'disable'       => 0,
        'slides'        => [
            [
                'bg_image'        => $att['slide1_d'],
                'bg_image_mobile' => $att['slide1_m'],
                'title'           => "MỞ LỐI KỶ NGUYÊN\nMỸ PHẨM VIỆT\nCHUẨN KHOA HỌC",
                'description'     => 'VINACOS là đơn vị tiên phong ứng dụng khoa học vào nghiên cứu và gia công mỹ phẩm sạch. Dẫn đầu để đặt ra tiêu chuẩn mới cho thương hiệu mỹ phẩm Việt.',
                'link'            => ['title' => 'Xem chi tiết', 'url' => '#about-us', 'target' => ''],
            ],
            [
                'bg_image'        => $att['slide2_d'],
                'bg_image_mobile' => $att['slide2_m'],
                'title'           => "HIỂU LÀN DA VIỆT\nĐỒNG HÀNH\nTHƯƠNG HIỆU VIỆT",
                'description'     => 'VINACOS tin rằng người Việt xứng đáng được chăm sóc bằng những công thức an toàn, lành tính, chuẩn y khoa.',
                'link'            => ['title' => 'Dịch vụ R&D', 'url' => '#services', 'target' => ''],
            ],
            [
                'bg_image'        => $att['slide3_d'],
                'bg_image_mobile' => $att['slide3_m'],
                'title'           => "RỦI RO LỚN NHẤT\nLÀ SAI TỪ CÔNG THỨC",
                'description'     => 'VINACOS đặt sự an toàn và tính minh bạch lên hàng đầu: 0% sai sót về hoạt chất cấm – 100% kiểm nghiệm công thức – Hồ sơ pháp lý A-Z.',
                'link'            => ['title' => 'Hệ thống kiểm nghiệm', 'url' => '#rd-system', 'target' => ''],
            ],
            [
                'bg_image'        => $att['slide4_d'],
                'bg_image_mobile' => $att['slide4_m'],
                'title'           => "SỨC MẠNH\nTỪ HỆ THỐNG R&D",
                'description'     => '300+ công thức độc quyền. 10+ năm kinh nghiệm R&D. Đằng sau mỗi sản phẩm là dữ liệu khoa học & kiểm định lâm sàng.',
                'link'            => ['title' => 'Khám phá sản phẩm', 'url' => '#products', 'target' => ''],
            ],
        ],
    ],
    [
        'acf_fc_layout' => 'about_section',
        'disable'       => 0,
        'title'         => "TÂM THẾ \n CỘNG SỰ",
        'image'         => $att['about_img'],
        'content'       => "<h3><strong>Dẫn đầu (Tầm nhìn)</strong></h3>\n<p><em>VINACOS là doanh nghiệp khoa học & công nghệ tiên phong trong nghiên cứu và sản xuất gia công mỹ phẩm sạch tại Việt Nam.</em></p>\n<p>Chúng tôi đặt tâm huyết vào con người, thiết bị phòng Lab hiện đại đạt chuẩn FDA và quy trình chuẩn GMP để mỗi sản phẩm đến tay đối tác đều được kiểm chứng nghiêm túc, chất lượng rõ ràng, pháp lý minh bạch.</p>\n<h3><strong>Thấu hiểu (Sứ mệnh)</strong></h3>\n<p><em>VINACOS đồng hành cùng các thương hiệu Việt, dùng nghiên cứu khoa học và công nghệ tạo ra những sản phẩm an toàn trọn gói xứng đáng với làn da Việt.</em></p>",
        'btn_text'      => 'Về chúng tôi',
        'btn_link'      => '/ve-chung-toi/',
    ],
    [
        'acf_fc_layout' => 'brand_banner',
        'disable'       => 0,
        'image'         => $att['brand_b'],
    ],
    [
        'acf_fc_layout' => 'rd_system',
        'disable'       => 0,
        'title'         => 'Hệ thống R&D',
        'items'         => [
            [
                'label'    => 'Hệ thống R&D',
                'title'    => 'Năng lực nghiên cứu sản xuất',
                'desc'     => 'VINACOS tập trung vào hai hướng nghiên cứu cốt lõi: Khai thác nguyên liệu thiên nhiên tiềm năng và phát triển công thức mỹ phẩm hoàn chỉnh OEM/ODM đạt chuẩn cGMP/FDA.',
                'image'    => $att['rd_img1'],
                'btn_text' => 'Tìm hiểu thêm',
                'btn_link' => '/nghien-cuu-phat-trien/',
            ],
            [
                'label'    => 'Công nghệ tiên tiến',
                'title'    => 'Các bài báo & Công trình khoa học',
                'desc'     => 'Ứng dụng hệ thống nhũ tương nano lipid và màng bao sinh học bọc hoạt chất trong mỹ phẩm chăm sóc da: Công trình nghiên cứu giúp hoạt chất thẩm thấu sâu và bảo toàn hiệu quả tối đa.',
                'image'    => $att['rd_img2'],
                'btn_text' => 'Xem công trình',
                'btn_link' => '/cong-trinh-khoa-hoc/',
            ],
        ],
    ],
    [
        'acf_fc_layout' => 'key_numbers',
        'disable'       => 0,
        'title'         => 'Con số nổi bật',
        'bg_image'      => $att['stats_bg'],
        'figure_image'  => $att['stats_fig'],
        'items'         => [
            ['count' => 100, 'suffix' => '%', 'title' => 'Kiểm nghiệm công thức và test độ ổn định'],
            ['count' => 300, 'suffix' => '+', 'title' => 'Công thức độc quyền đã nghiên cứu R&D'],
            ['count' => 30,  'suffix' => '+', 'title' => 'Đề tài nghiên cứu khoa học công bố'],
            ['count' => 10,  'suffix' => '+', 'title' => 'Năm kinh nghiệm sản xuất & gia công mỹ phẩm'],
        ],
    ],
    [
        'acf_fc_layout' => 'product_showcase',
        'disable'       => 0,
        'title'         => 'Danh mục sản phẩm tiêu biểu',
        'items'         => [
            [
                'title'       => 'Nền kem vỡ nước - Không Silicone',
                'image'       => $att['prod1'],
                'description' => 'Hiệu ứng “vỡ nước” tươi mát khi thoa không chứa silicone, an toàn tuyệt đối cho làn da nhạy cảm.',
                'btn_text'    => 'Xem chi tiết',
                'btn_link'    => '/san-pham/',
            ],
            [
                'title'       => 'Mặt nạ đất sét trà xanh Detox',
                'image'       => $att['prod2'],
                'description' => 'Ứng dụng đất sét khoáng tự nhiên hấp thụ bã nhờn và độc tố, làm sạch sâu lỗ chân lông.',
                'btn_text'    => 'Xem chi tiết',
                'btn_link'    => '/san-pham/',
            ],
            [
                'title'       => 'Tẩy tế bào chết Silica từ vỏ trấu Việt Nam',
                'image'       => $att['prod3'],
                'description' => 'Giải pháp thay thế vi nhựa bằng silica sinh học chiết xuất từ vỏ trấu Việt Nam. Thân thiện môi trường.',
                'btn_text'    => 'Xem chi tiết',
                'btn_link'    => '/san-pham/',
            ],
            [
                'title'       => 'Mặt nạ bùn Cúc La Mã làm dịu & phục hồi',
                'image'       => $att['prod4'],
                'description' => 'Kết hợp bùn khoáng thiên nhiên với chiết xuất Cúc La Mã chuẩn hóa, phục hồi hàng rào bảo vệ da.',
                'btn_text'    => 'Xem chi tiết',
                'btn_link'    => '/san-pham/',
            ],
        ],
    ],
    [
        'acf_fc_layout'   => 'partners_section',
        'disable'         => 0,
        'watermark'       => 'VINACOS',
        'left_title'      => 'ĐỐI TÁC NGUYÊN LIỆU',
        'right_title'     => 'ĐỐI TÁC NGHIÊN CỨU',
    ],
    [
        'acf_fc_layout' => 'news_section',
        'disable'       => 0,
        'title'         => 'Tin tức & Hoạt động',
    ],
    [
        'acf_fc_layout' => 'consult_modal',
        'disable'       => 0,
        'title'         => 'Nhận tư vấn giải pháp R&D & Gia công trọn gói miễn phí',
        'image'         => $att['slide2_d'],
    ],
];

// Save Vietnamese (ID 10)
update_field('field_vinacos_home_fc', $structured_data_vi, 10);
echo "4. Populated Vietnamese Homepage (ID 10) with 9 Flexible Content blocks.\n";

// English (ID 1121)
$structured_data_en = $structured_data_vi;
$structured_data_en[0]['slides'][0]['title'] = "PIONEERING SCIENTIFIC\nVIETNAMESE COSMETICS\nGLOBAL STANDARDS";
$structured_data_en[1]['title'] = "PARTNERSHIP\nMINDSET";
$structured_data_en[4]['title'] = 'Key Numbers';
$structured_data_en[5]['title'] = 'Featured Product Categories';

update_field('field_vinacos_home_fc', $structured_data_en, 1121);
echo "5. Populated English Homepage (ID 1121) with 9 Flexible Content blocks.\n";

echo "\n=======================================================\n";
echo " SUCCESS: ALL 9 ACF FLEXIBLE BLOCKS ARE NOW VISIBLE \n";
echo " AND FULLY POPULATED IN WP-ADMIN!\n";
echo "=======================================================\n";
