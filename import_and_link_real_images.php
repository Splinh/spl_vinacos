<?php
/**
 * Import exact static VINACOS images to WordPress Media Library and link to ACF fields
 */
define('WP_USE_THEMES', false);
define('WP_ADMIN', true);
require __DIR__ . '/wp/wp-load.php';
require_once ABSPATH . 'wp-admin/includes/image.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/media.php';

echo "=== IMPORTING REAL VINACOS IMAGES INTO MEDIA LIBRARY ===\n\n";

function import_local_image_to_media($relative_path, $title) {
    global $wpdb;
    $theme_dir = get_template_directory();
    $full_path = $theme_dir . '/' . ltrim($relative_path, '/');

    if (!file_exists($full_path)) {
        echo " [!] File not found: $full_path\n";
        return 0;
    }

    $filename = basename($full_path);

    // Check if already imported
    $existing = $wpdb->get_var($wpdb->prepare(
        "SELECT ID FROM {$wpdb->posts} WHERE post_type = 'attachment' AND post_title = %s LIMIT 1",
        $title
    ));
    if ($existing) {
        echo " - Found existing attachment for '$title' (ID: $existing)\n";
        return (int) $existing;
    }

    $upload_dir = wp_upload_dir();
    $new_file   = $upload_dir['path'] . '/' . $filename;
    
    // Copy file to uploads dir
    copy($full_path, $new_file);

    $wp_filetype = wp_check_filetype($filename, null);
    $attachment = array(
        'post_mime_type' => $wp_filetype['type'],
        'post_title'     => $title,
        'post_content'   => '',
        'post_status'    => 'inherit'
    );

    $attach_id = wp_insert_attachment($attachment, $new_file);
    $attach_data = wp_generate_attachment_metadata($attach_id, $new_file);
    wp_update_attachment_metadata($attach_id, $attach_data);

    echo " + Imported '$title' -> ID: $attach_id ($filename)\n";
    return (int) $attach_id;
}

// 1. Import all authentic images
$att = [
    'slide1_d'   => import_local_image_to_media('static/img/banner/slide1-desktop.jpg', 'Slide 1 Desktop VINACOS'),
    'slide1_m'   => import_local_image_to_media('static/img/banner/slide1-mobile.jpg', 'Slide 1 Mobile VINACOS'),
    'slide2_d'   => import_local_image_to_media('static/img/banner/slide2-desktop.jpg', 'Slide 2 Desktop VINACOS'),
    'slide2_m'   => import_local_image_to_media('static/img/banner/slide2-mobile.jpg', 'Slide 2 Mobile VINACOS'),
    'slide3_d'   => import_local_image_to_media('static/img/banner/slide3-desktop.jpg', 'Slide 3 Desktop VINACOS'),
    'slide3_m'   => import_local_image_to_media('static/img/banner/slide3-mobile.jpg', 'Slide 3 Mobile VINACOS'),
    'slide4_d'   => import_local_image_to_media('static/img/banner/slide4-desktop.jpg', 'Slide 4 Desktop VINACOS'),
    'slide4_m'   => import_local_image_to_media('static/img/banner/slide4-mobile.jpg', 'Slide 4 Mobile VINACOS'),
    
    'about_img'  => import_local_image_to_media('static/img/tam-the-cong-su-collage.jpg', 'Tâm Thế Cộng Sự - Ảnh Ghép VINACOS'),
    'brand_b'    => import_local_image_to_media('static/img/banner/brand-banner-vi.jpg', 'Banner Thương Hiệu VINACOS'),
    'about_b'    => import_local_image_to_media('static/img/banner/brand-banner-vi.jpg', 'Banner Trang Tâm Thế Cộng Sự VINACOS'),
    'rd_b'       => import_local_image_to_media('static/img/banner/rd-system-banner-vi.jpg', 'Banner Trang Hệ Thống R&D VINACOS'),
    
    'rd_img1'    => import_local_image_to_media('static/img/tam-the-cong-su-vinacos.jpg', 'Hệ thống R&D Năng Lực Nghiên Cứu VINACOS'),
    'rd_img2'    => import_local_image_to_media('static/img/story-vinacos.jpg', 'Công Trình Khoa Học VINACOS'),
    
    'stats_bg'   => import_local_image_to_media('static/img/bg-stats-vinacos.jpg', 'Background Con Số Nổi Bật'),
    'stats_fig'  => import_local_image_to_media('static/img/stats-vinacos.png', 'Figure Con Số Nổi Bật VINACOS'),
    
    'prod1'      => import_local_image_to_media('static/img/products/product1.jpg', 'Sản phẩm 1 - Nền kem vỡ nước'),
    'prod2'      => import_local_image_to_media('static/img/products/product2.jpg', 'Sản phẩm 2 - Mặt nạ đất sét trà xanh'),
    'prod3'      => import_local_image_to_media('static/img/products/product3.jpg', 'Sản phẩm 3 - Tẩy tế bào chết Silica'),
    'prod4'      => import_local_image_to_media('static/img/products/product4.jpg', 'Sản phẩm 4 - Mặt nạ bùn Cúc La Mã'),
    
    'logo'       => import_local_image_to_media('static/img/logo.png', 'Logo VINACOS'),
];

echo "\n2. Updating ACF Options & Homepage with Exact Image IDs...\n";

// Update Logo
if ($att['logo']) {
    update_option('options_logo', $att['logo']);
    update_option('_options_logo', 'field_logo');
    set_theme_mod('custom_logo', $att['logo']);
}

// Build Vietnamese Homepage sections with real image IDs
$home_sections_vi = [
    [
        'acf_fc_layout' => 'hero_slider',
        'disable'       => 0,
        'slides'        => [
            [
                'bg_image'        => $att['slide1_d'],
                'bg_image_mobile' => $att['slide1_m'] ?: $att['slide1_d'],
                'title'           => 'MỞ LỐI KỶ NGUYÊN MỸ PHẨM VIỆT CHUẨN KHOA HỌC',
                'description'     => 'VINACOS là đơn vị tiên phong ứng dụng khoa học vào nghiên cứu và gia công mỹ phẩm sạch. Dẫn đầu để đặt ra tiêu chuẩn mới cho thương hiệu mỹ phẩm Việt.',
                'link'            => ['title' => 'Xem chi tiết', 'url' => '#about-us', 'target' => ''],
            ],
            [
                'bg_image'        => $att['slide2_d'],
                'bg_image_mobile' => $att['slide2_m'] ?: $att['slide2_d'],
                'title'           => 'HIỂU LÀN DA VIỆT - ĐỒNG HÀNH THƯƠNG HIỆU VIỆT',
                'description'     => 'VINACOS tin rằng người Việt xứng đáng được chăm sóc bằng những công thức an toàn, lành tính, chuẩn y khoa.',
                'link'            => ['title' => 'Dịch vụ R&D', 'url' => '#services', 'target' => ''],
            ],
            [
                'bg_image'        => $att['slide3_d'],
                'bg_image_mobile' => $att['slide3_m'] ?: $att['slide3_d'],
                'title'           => 'RỦI RO LỚN NHẤT LÀ SAI TỪ CÔNG THỨC',
                'description'     => 'VINACOS đặt sự an toàn và tính minh bạch lên hàng đầu: 0% sai sót về hoạt chất cấm – 100% kiểm nghiệm công thức – Hồ sơ pháp lý A-Z.',
                'link'            => ['title' => 'Hệ thống kiểm nghiệm', 'url' => '#rd-system', 'target' => ''],
            ],
            [
                'bg_image'        => $att['slide4_d'],
                'bg_image_mobile' => $att['slide4_m'] ?: $att['slide4_d'],
                'title'           => 'SỨC MẠNH TỪ HỆ THỐNG R&D ĐỘC QUYỀN',
                'description'     => '300+ công thức độc quyền. 10+ năm kinh nghiệm R&D. Đằng sau mỗi sản phẩm là dữ liệu khoa học & kiểm định lâm sàng.',
                'link'            => ['title' => 'Khám phá sản phẩm', 'url' => '#products', 'target' => ''],
            ],
        ],
    ],
    [
        'acf_fc_layout' => 'about_section',
        'disable'       => 0,
        'title'         => "TÂM THẾ \n CỘNG SỰ",
        'content'       => "<h3><strong>Dẫn đầu (Tầm nhìn)</strong></h3>\n<p><em>VINACOS là doanh nghiệp khoa học & công nghệ tiên phong trong nghiên cứu và sản xuất gia công mỹ phẩm sạch tại Việt Nam.</em></p>\n<p>Chúng tôi đặt tâm huyết vào con người, thiết bị phòng Lab hiện đại đạt chuẩn FDA và quy trình chuẩn GMP để mỗi sản phẩm đến tay đối tác đều được kiểm chứng nghiêm túc, chất lượng rõ ràng, pháp lý minh bạch.</p>\n<h3><strong>Thấu hiểu (Sứ mệnh)</strong></h3>\n<p><em>VINACOS đồng hành cùng các thương hiệu Việt, dùng nghiên cứu khoa học và công nghệ tạo ra những sản phẩm an toàn trọn gói xứng đáng với làn da Việt.</em></p>",
        'btn_text'      => 'Về chúng tôi',
        'btn_link'      => '/ve-chung-toi/',
        'image'         => $att['about_img'],
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
                'btn_text' => 'Tìm hiểu thêm',
                'btn_link' => '/nghien-cuu-phat-trien/',
                'image'    => $att['rd_img1'],
            ],
            [
                'label'    => 'Công nghệ tiên tiến',
                'title'    => 'Các bài báo & Công trình khoa học',
                'desc'     => 'Ứng dụng hệ thống nhũ tương nano lipid và màng bao sinh học bọc hoạt chất trong mỹ phẩm chăm sóc da: Công trình nghiên cứu giúp hoạt chất thẩm thấu sâu và bảo toàn hiệu quả tối đa.',
                'btn_text' => 'Xem công trình',
                'btn_link' => '/cong-trinh-khoa-hoc/',
                'image'    => $att['rd_img2'],
            ],
        ],
    ],
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
        'bg_image'      => $att['stats_bg'],
        'figure_image'  => $att['stats_fig'],
    ],
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
                'image'       => $att['prod1'],
            ],
            [
                'title'       => 'Mặt nạ đất sét trà xanh Detox',
                'description' => 'Ứng dụng đất sét khoáng tự nhiên hấp thụ bã nhờn và độc tố, làm sạch sâu lỗ chân lông.',
                'btn_text'    => 'Xem chi tiết',
                'btn_link'    => '/san-pham/',
                'image'       => $att['prod2'],
            ],
            [
                'title'       => 'Tẩy tế bào chết Silica từ vỏ trấu Việt Nam',
                'description' => 'Giải pháp thay thế vi nhựa bằng silica sinh học chiết xuất từ vỏ trấu Việt Nam. Thân thiện môi trường.',
                'btn_text'    => 'Xem chi tiết',
                'btn_link'    => '/san-pham/',
                'image'       => $att['prod3'],
            ],
            [
                'title'       => 'Mặt nạ bùn Cúc La Mã làm dịu & phục hồi',
                'description' => 'Kết hợp bùn khoáng thiên nhiên với chiết xuất Cúc La Mã chuẩn hóa, phục hồi hàng rào bảo vệ da.',
                'btn_text'    => 'Xem chi tiết',
                'btn_link'    => '/san-pham/',
                'image'       => $att['prod4'],
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

// English sections
$home_sections_en = $home_sections_vi;
$home_sections_en[0]['slides'][0]['title'] = 'PIONEERING SCIENTIFIC VIETNAMESE COSMETICS';
$home_sections_en[0]['slides'][1]['title'] = 'UNDERSTANDING ASIAN SKIN - EMPOWERING GLOBAL BRANDS';
$home_sections_en[1]['title'] = "PARTNERSHIP \n MINDSET";
$home_sections_en[4]['title'] = 'Key Numbers';
$home_sections_en[5]['title'] = 'Featured Product Categories';

// Save Vietnamese (ID 10)
if (get_post(10)) {
    update_field('home_sections', $home_sections_vi, 10);
    update_post_meta(10, 'home_sections', $home_sections_vi);
    echo " - Updated Vietnamese Homepage (ID 10) with exact image attachments.\n";
}

// Save English (ID 1121)
if (get_post(1121)) {
    update_field('home_sections', $home_sections_en, 1121);
    update_post_meta(1121, 'home_sections', $home_sections_en);
    echo " - Updated English Homepage (ID 1121) with exact image attachments.\n";
}

echo "\n=== IMPORT & LINK COMPLETED 100%! ===\n";
