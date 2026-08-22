<?php
/**
 * CLI Script: Populate 100% Native ACF Flexible Content Blocks with Real Data & Images
 * For:
 * 1. Trang Chủ (ID 10 & 1121)
 * 2. Tâm Thế Cộng Sự (ID 942 & 936)
 * 3. Hệ Thống R&D (ID 944 & 926)
 */
define('WP_USE_THEMES', false);
define('WP_ADMIN', true);
require __DIR__ . '/wp/wp-load.php';

echo "=================================================================\n";
echo " VINACOS - POPULATE ALL ACF FLEXIBLE PAGES WITH REAL DATA\n";
echo "=================================================================\n\n";

global $wpdb;

// 1. Clear stale postmeta
$wpdb->query("DELETE FROM {$wpdb->postmeta} WHERE post_id IN (10, 1121, 942, 936, 944, 926) AND (meta_key LIKE '%home_sections%' OR meta_key LIKE '%about_sections%' OR meta_key LIKE '%cooperation_sections%')");
echo "1. Cleared stale postmeta for all target pages.\n";

// 2. Import authentic images
require_once __DIR__ . '/import_and_link_real_images.php';

// 3. Ensure local ACF field groups are loaded
if (function_exists('spl_register_all_vinacos_page_acf_fields')) {
    spl_register_all_vinacos_page_acf_fields();
}

// -------------------------------------------------------------
// 1. TRANG CHỦ (ID 10 & 1121)
// -------------------------------------------------------------
$structured_data_home_vi = [
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
        'btn_link'      => '/tam-the-cong-su-unila-viet-nam/',
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
                'btn_link' => '/oem-odm-gia-cong-unila-viet-nam/',
            ],
            [
                'label'    => 'Công nghệ tiên tiến',
                'title'    => 'Các bài báo & Công trình khoa học',
                'desc'     => 'Ứng dụng hệ thống nhũ tương nano lipid và màng bao sinh học bọc hoạt chất trong mỹ phẩm chăm sóc da: Công trình nghiên cứu giúp hoạt chất thẩm thấu sâu và bảo toàn hiệu quả tối đa.',
                'image'    => $att['rd_img2'],
                'btn_text' => 'Xem công trình',
                'btn_link' => '/oem-odm-gia-cong-unila-viet-nam/',
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
                'btn_link'    => '/san-pham-gia-cong-unila-viet-nam/',
            ],
            [
                'title'       => 'Mặt nạ đất sét trà xanh Detox',
                'image'       => $att['prod2'],
                'description' => 'Ứng dụng đất sét khoáng tự nhiên hấp thụ bã nhờn và độc tố, làm sạch sâu lỗ chân lông.',
                'btn_text'    => 'Xem chi tiết',
                'btn_link'    => '/san-pham-gia-cong-unila-viet-nam/',
            ],
            [
                'title'       => 'Tẩy tế bào chết Silica từ vỏ trấu Việt Nam',
                'image'       => $att['prod3'],
                'description' => 'Giải pháp thay thế vi nhựa bằng silica sinh học chiết xuất từ vỏ trấu Việt Nam. Thân thiện môi trường.',
                'btn_text'    => 'Xem chi tiết',
                'btn_link'    => '/san-pham-gia-cong-unila-viet-nam/',
            ],
            [
                'title'       => 'Mặt nạ bùn Cúc La Mã làm dịu & phục hồi',
                'image'       => $att['prod4'],
                'description' => 'Kết hợp bùn khoáng thiên nhiên với chiết xuất Cúc La Mã chuẩn hóa, phục hồi hàng rào bảo vệ da.',
                'btn_text'    => 'Xem chi tiết',
                'btn_link'    => '/san-pham-gia-cong-unila-viet-nam/',
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

update_field('field_vinacos_home_fc', $structured_data_home_vi, 10);
$structured_data_home_en = $structured_data_home_vi;
$structured_data_home_en[0]['slides'][0]['title'] = "PIONEERING SCIENTIFIC\nVIETNAMESE COSMETICS\nGLOBAL STANDARDS";
$structured_data_home_en[1]['title'] = "PARTNERSHIP\nMINDSET";
update_field('field_vinacos_home_fc', $structured_data_home_en, 1121);
echo "2. Populated Home Page (ID 10 & 1121) with 9 Flexible Blocks.\n";

// -------------------------------------------------------------
// 2. TÂM THẾ CỘNG SỰ (ABOUT PAGE - ID 942 & 936)
// -------------------------------------------------------------
$structured_about_vi = [
    [
        'acf_fc_layout' => 'about_hero',
        'disable'       => 0,
        'banner_image'  => $att['slide1_d'],
        'title'         => 'TÂM THẾ CỘNG SỰ',
    ],
    [
        'acf_fc_layout' => 'about_story',
        'disable'       => 0,
        'title'         => "Nghiên cứu <br/> sản xuất <br/> mỹ phẩm",
        'image'         => $att['rd_img2'],
        'content'       => "<h2><strong>VINACOS &#8211; Hành động vì một kỷ nguyên mỹ phẩm sạch từ nguồn lực Việt.</strong></h2>\n<p><strong><span style=\"color: #1e60a3;\"><i>Dẫn đầu</i></span></strong></p>\n<p><i>VINACOS là doanh nghiệp khoa học &amp; công nghệ tiên phong trong nghiên cứu và sản xuất mỹ phẩm sạch tại Việt Nam.</i></p>\n<p>Chúng tôi đặt tâm huyết vào con người, thiết bị và quy trình để mỗi sản phẩm đến tay đối tác đều được đảm bảo chất lượng. Dẫn đầu với VINACOS là đặt ra tiêu chuẩn mới, góp phần chứng minh mỹ phẩm Việt hoàn toàn có thể sánh ngang thế giới.</p>\n<p><strong><span style=\"color: #1e60a3;\"><i>Thấu hiểu</i></span></strong></p>\n<p><i>VINACOS đồng hành cùng các thương hiệu Việt, dùng nghiên cứu khoa học và sản xuất tạo ra những sản phẩm lành tính xứng đáng với làn da Việt.</i></p>",
    ],
    [
        'acf_fc_layout' => 'about_message',
        'disable'       => 0,
        'title'         => 'Thông điệp từ trái tim',
        'subtitle'      => 'Thông điệp từ Ban Giám Đốc',
        'ceo_name'      => 'BÀ NGUYỄN HỒNG TRÚC',
        'ceo_title'     => 'GIÁM ĐỐC / FOUNDER CEO',
        'image'         => $att['about_img'],
        'content'       => "<p><i>Tôi bắt đầu hành trình này không từ những điều to lớn, mà từ những điều giản dị nhất, chính là đam mê dành cho vẻ đẹp Việt.</i></p>\n<p><i>Từ lúc bắt đầu chặng đường khởi nghiệp đầy thử thách, tôi luôn kiên định đi theo con đường của riêng mình. Đó là xây dựng một doanh nghiệp không chỉ lớn lên bằng con số, mà còn tạo ra giá trị thực.</i></p>\n<p><i>Theo đuổi hạnh phúc vật chất lẫn tinh thần của tất cả cán bộ công nhân viên, đó chính là triết lý, là động lực và niềm tin của chúng tôi.</i></p>",
    ],
    [
        'acf_fc_layout'  => 'about_timeline',
        'disable'        => 0,
        'title'          => 'Từng mốc dấu ấn phát triển',
        'timeline_items' => [
            ['year' => '2015', 'title' => 'Khởi đầu nghiên cứu', 'desc' => 'Thành lập phòng Lab nghiên cứu công thức mỹ phẩm sạch đầu tiên.'],
            ['year' => '2018', 'title' => 'Mở rộng quy mô R&D', 'desc' => 'Đạt cột mốc 100+ công thức mỹ phẩm độc quyền cho đối tác Việt.'],
            ['year' => '2021', 'title' => 'Nhà máy chuẩn cGMP & FDA', 'desc' => 'Đầu tư dây chuyền sản xuất tự động khép kín hiện đại.'],
            ['year' => '2026', 'title' => 'Tiên phong Kỷ nguyên Mỹ phẩm Sạch', 'desc' => 'Hợp tác nghiên cứu chuyển giao công nghệ cùng các trường đại học.'],
        ],
    ],
    [
        'acf_fc_layout' => 'about_mission',
        'disable'       => 0,
        'vision_title'  => 'Tầm Nhìn',
        'vision_desc'   => 'Trở thành doanh nghiệp khoa học công nghệ dẫn đầu Việt Nam trong nghiên cứu và gia công mỹ phẩm sạch chuẩn quốc tế.',
        'mission_title' => 'Sứ Mệnh',
        'mission_desc'  => 'Đồng hành cùng thương hiệu Việt tạo ra những sản phẩm an toàn, minh bạch, chất lượng cao nhất cho làn da người Việt.',
    ],
    [
        'acf_fc_layout' => 'about_stats',
        'disable'       => 0,
        'title'         => 'Những con số biết nói',
        'items'         => [
            ['count' => 10,  'suffix' => '+', 'title' => 'Năm kinh nghiệm R&D'],
            ['count' => 300, 'suffix' => '+', 'title' => 'Công thức độc quyền'],
            ['count' => 30,  'suffix' => '+', 'title' => 'Đề tài nghiên cứu khoa học'],
            ['count' => 100, 'suffix' => '%', 'title' => 'Kiểm nghiệm công thức an toàn'],
        ],
    ],
    [
        'acf_fc_layout' => 'about_team',
        'disable'       => 0,
        'title'         => 'Sức mạnh tập thể & Đội ngũ chuyên gia',
        'team_items'    => [
            ['name' => 'Phòng Nghiên Cứu & Phát Triển (R&D)', 'desc' => 'Đội ngũ Dược sĩ, Kỹ sư hóa dược chuyên sâu về công thức mỹ phẩm.'],
            ['name' => 'Phòng Kiểm Nghiệm & Đảm Bảo Chất Lượng (QA/QC)', 'desc' => 'Kiểm tra nghiêm ngặt từng lô nguyên liệu và sản phẩm xuất xưởng.'],
            ['name' => 'Phòng Pháp Lý & Hồ Sơ Công Bố', 'desc' => 'Hỗ trợ khách hàng hoàn thiện trọn gói thủ tục pháp lý A-Z.'],
            ['name' => 'Khối Sản Xuất & Vận Hành Nhà Máy', 'desc' => 'Vận hành hệ thống dây chuyền tự động hóa đạt chuẩn cGMP.'],
        ],
    ],
    [
        'acf_fc_layout' => 'about_cta',
        'disable'       => 0,
        'title'         => 'Nhà máy & Quy trình sản xuất cGMP',
        'image'         => $att['rd_img1'],
        'content'       => '<p>Hệ thống phòng sạch đạt chuẩn, kiểm soát nghiêm ngặt nhiệt độ, độ ẩm và vi sinh để đảm bảo mỗi sản phẩm đều hoàn hảo nhất.</p>',
    ],
];

if (get_post(942)) {
    update_field('field_vinacos_about_fc', $structured_about_vi, 942);
    echo "3. Populated 'Tâm Thế Cộng Sự' (ID 942) with 8 Flexible Blocks.\n";
}
if (get_post(936)) {
    update_field('field_vinacos_about_fc', $structured_about_vi, 936);
    echo "   Populated 'Giới Thiệu' (ID 936) with 8 Flexible Blocks.\n";
}

// -------------------------------------------------------------
// 3. HỆ THỐNG R&D (COOPERATION PAGE - ID 944 & 926)
// -------------------------------------------------------------
$structured_coop_vi = [
    [
        'acf_fc_layout' => 'cooperation_hero',
        'disable'       => 0,
        'banner_image'  => $att['slide3_d'],
        'title'         => 'HỆ THỐNG R&D & GIA CÔNG OEM/ODM',
    ],
    [
        'acf_fc_layout'    => 'cooperation_benefits',
        'disable'          => 0,
        'title'            => 'Sáng tạo & Sáng chế R&D Độc Quyền',
        'benefit_items'    => [
            [
                'title' => 'Nghiên cứu nguyên liệu thiên nhiên Việt Nam',
                'image' => $att['rd_img1'],
                'desc'  => 'Tận dụng và nâng tầm nông sản Việt: Tinh dầu, chiết xuất thực vật, silica từ vỏ trấu vào các dòng mỹ phẩm cao cấp.',
            ],
            [
                'title' => 'Công nghệ bao bọc hoạt chất Nano Lipid',
                'image' => $att['rd_img2'],
                'desc'  => 'Tối ưu độ ổn định của hoạt chất, tăng khả năng thẩm thấu sâu qua biểu bì da mà không gây kích ứng.',
            ],
            [
                'title' => 'Kiểm nghiệm lâm sàng & Test độ ổn định khắt khe',
                'image' => $att['about_img'],
                'desc'  => 'Mỗi công thức trải qua thử nghiệm sốc nhiệt, ly tâm, test kích ứng da trước khi chuyển giao sản xuất.',
            ],
        ],
    ],
    [
        'acf_fc_layout'  => 'cooperation_process',
        'disable'        => 0,
        'title'          => 'Quy trình R&D & Gia công trọn gói 6 bước',
        'process_steps'  => [
            ['step_num' => '01', 'title' => 'Tiếp nhận ý tưởng & Định hướng sản phẩm', 'desc' => 'Lắng nghe nhu cầu thị trường và định hình phân khúc sản phẩm cùng đối tác.'],
            ['step_num' => '02', 'title' => 'Nghiên cứu & Phát triển mẫu thử (Sample R&D)', 'desc' => 'Phát triển công thức mẫu độc quyền theo yêu cầu cảm quan và hiệu quả.'],
            ['step_num' => '03', 'title' => 'Đánh giá mẫu & Thử nghiệm lâm sàng', 'desc' => 'Gửi mẫu test thử, điều chỉnh đến khi đối tác hoàn toàn hài lòng 100%.'],
            ['step_num' => '04', 'title' => 'Hồ sơ pháp lý & Công bố mỹ phẩm', 'desc' => 'Hỗ trợ trọn gói giấy phép công bố sản phẩm, kiểm nghiệm Viện Pasteur.'],
            ['step_num' => '05', 'title' => 'Sản xuất hàng loạt chuẩn cGMP', 'desc' => 'Sản xuất trên dây chuyền tự động, đóng gói bao bì chuyên nghiệp.'],
            ['step_num' => '06', 'title' => 'Giao hàng & Đồng hành sau bán hàng', 'desc' => 'Giao hàng tận nơi, đào tạo kiến thức sản phẩm và hỗ trợ tư vấn marketing.'],
        ],
    ],
    [
        'acf_fc_layout' => 'cooperation_form',
        'disable'       => 0,
        'title'         => 'Đăng Ký Nhận Tư Vấn R&D & Báo Giá Gia Công',
        'subtitle'      => 'Đội ngũ chuyên gia VINACOS sẽ liên hệ tư vấn giải pháp toàn diện trong 24h',
    ],
];

if (get_post(944)) {
    update_field('field_vinacos_coop_fc', $structured_coop_vi, 944);
    echo "4. Populated 'Hệ Thống R&D' (ID 944) with 4 Flexible Blocks.\n";
}
if (get_post(926)) {
    update_field('field_vinacos_coop_fc', $structured_coop_vi, 926);
    echo "   Populated 'Cơ Hội Hợp Tác' (ID 926) with 4 Flexible Blocks.\n";
}

echo "\n=================================================================\n";
echo " SUCCESS: ALL PAGES (HOME, ABOUT, R&D) NOW HAVE 100% NATIVE \n";
echo " ACF FLEXIBLE CONTENT BLOCKS PRE-POPULATED IN WP-ADMIN!\n";
echo "=================================================================\n";
