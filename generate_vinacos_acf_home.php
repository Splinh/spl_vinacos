<?php
/**
 * Script to generate complete ACF Field Group JSON for VINACOS Homepage
 */
$file = __DIR__ . '/wp/wp-content/themes/spl/acf-json/group_daily_home.json';
$current = json_decode(file_get_contents($file), true) ?: [];

$layouts = $current['fields'][0]['layouts'] ?? [];

// Helper to create basic field
function f_text($key, $name, $label, $width = '') {
    return [
        'key' => $key,
        'label' => $label,
        'name' => $name,
        'type' => 'text',
        'wrapper' => ['width' => $width]
    ];
}

function f_textarea($key, $name, $label, $rows = 3, $width = '') {
    return [
        'key' => $key,
        'label' => $label,
        'name' => $name,
        'type' => 'textarea',
        'rows' => $rows,
        'wrapper' => ['width' => $width]
    ];
}

function f_image($key, $name, $label, $width = '') {
    return [
        'key' => $key,
        'label' => $label,
        'name' => $name,
        'type' => 'image',
        'return_format' => 'id',
        'preview_size' => 'medium',
        'wrapper' => ['width' => $width]
    ];
}

function f_disable($key) {
    return [
        'key' => $key,
        'label' => 'Ẩn section này',
        'name' => 'disable',
        'type' => 'true_false',
        'ui' => 1,
        'ui_on_text' => 'Ẩn',
        'ui_off_text' => 'Hiện',
        'default_value' => 0
    ];
}

// 1. HERO SLIDER
$layouts['layout_home_hero_slider'] = [
    'key' => 'layout_home_hero_slider',
    'name' => 'hero_slider',
    'label' => '1. Hero Banner Slider',
    'display' => 'block',
    'sub_fields' => [
        f_disable('field_hero_slider_disable'),
        [
            'key' => 'field_hero_slider_slides',
            'label' => 'Danh sách Slide',
            'name' => 'slides',
            'type' => 'repeater',
            'layout' => 'block',
            'button_label' => 'Thêm Slide',
            'sub_fields' => [
                f_image('field_hero_slide_image', 'bg_image', 'Ảnh banner (Desktop)', '33'),
                f_image('field_hero_slide_image_mobile', 'bg_image_mobile', 'Ảnh banner (Mobile)', '33'),
                f_text('field_hero_slide_title', 'title', 'Tiêu đề Slide', '33'),
                f_textarea('field_hero_slide_desc', 'description', 'Mô tả ngắn', 2, '50'),
                [
                    'key' => 'field_hero_slide_link',
                    'label' => 'Đường dẫn liên kết',
                    'name' => 'link',
                    'type' => 'link',
                    'return_format' => 'array',
                    'wrapper' => ['width' => '50']
                ]
            ]
        ]
    ]
];

// 2. ABOUT SECTION (Tâm thế cộng sự)
$layouts['layout_home_about_section'] = [
    'key' => 'layout_home_about_section',
    'name' => 'about_section',
    'label' => '2. Giới thiệu (Tâm Thế Cộng Sự)',
    'display' => 'block',
    'sub_fields' => [
        f_disable('field_about_disable'),
        f_text('field_about_title', 'title', 'Tiêu đề chính', '50'),
        f_image('field_about_image', 'image', 'Hình ảnh minh họa', '50'),
        [
            'key' => 'field_about_content',
            'label' => 'Nội dung chi tiết (Tầm nhìn & Sứ mệnh)',
            'name' => 'content',
            'type' => 'wysiwyg',
            'tabs' => 'all',
            'toolbar' => 'full',
            'media_upload' => 1
        ],
        f_text('field_about_btn_text', 'btn_text', 'Chữ nút bấm', '50'),
        f_text('field_about_btn_link', 'btn_link', 'Link nút bấm', '50'),
    ]
];

// 3. BRAND BANNER
$layouts['layout_home_brand_banner'] = [
    'key' => 'layout_home_brand_banner',
    'name' => 'brand_banner',
    'label' => '3. Banner Thương Hiệu (Brand Banner)',
    'display' => 'block',
    'sub_fields' => [
        f_disable('field_brand_banner_disable'),
        f_image('field_brand_banner_img', 'image', 'Ảnh banner thương hiệu', '100')
    ]
];

// 4. R&D SYSTEM
$layouts['layout_home_rd_system'] = [
    'key' => 'layout_home_rd_system',
    'name' => 'rd_system',
    'label' => '4. Hệ thống R&D (Năng lực & Công trình)',
    'display' => 'block',
    'sub_fields' => [
        f_disable('field_rd_disable'),
        f_text('field_rd_main_title', 'title', 'Tiêu đề khối', '100'),
        [
            'key' => 'field_rd_items',
            'label' => 'Danh sách thẻ R&D',
            'name' => 'items',
            'type' => 'repeater',
            'layout' => 'block',
            'button_label' => 'Thêm thẻ R&D',
            'sub_fields' => [
                f_text('field_rd_item_label', 'label', 'Nhãn nhỏ trên', '50'),
                f_text('field_rd_item_title', 'title', 'Tiêu đề thẻ', '50'),
                f_textarea('field_rd_item_desc', 'desc', 'Mô tả chi tiết', 3, '100'),
                f_image('field_rd_item_img', 'image', 'Ảnh minh họa', '50'),
                f_text('field_rd_item_btn_text', 'btn_text', 'Chữ nút', '25'),
                f_text('field_rd_item_btn_link', 'btn_link', 'Link nút', '25'),
            ]
        ]
    ]
];

// 5. KEY NUMBERS
$layouts['layout_home_key_numbers'] = [
    'key' => 'layout_home_key_numbers',
    'name' => 'key_numbers',
    'label' => '5. Con số nổi bật (Key Numbers)',
    'display' => 'block',
    'sub_fields' => [
        f_disable('field_numbers_disable'),
        f_text('field_numbers_title', 'title', 'Tiêu đề khối', '100'),
        f_image('field_numbers_bg', 'bg_image', 'Ảnh nền (Background)', '50'),
        f_image('field_numbers_fig', 'figure_image', 'Ảnh đồ họa / Người mẫu', '50'),
        [
            'key' => 'field_numbers_items',
            'label' => 'Danh sách con số',
            'name' => 'items',
            'type' => 'repeater',
            'layout' => 'table',
            'button_label' => 'Thêm con số',
            'sub_fields' => [
                ['key' => 'field_num_count', 'label' => 'Số lượng', 'name' => 'count', 'type' => 'number', 'wrapper' => ['width' => '20']],
                ['key' => 'field_num_suffix', 'label' => 'Ký tự sau (%, +)', 'name' => 'suffix', 'type' => 'text', 'wrapper' => ['width' => '20']],
                ['key' => 'field_num_title', 'label' => 'Mô tả con số', 'name' => 'title', 'type' => 'text', 'wrapper' => ['width' => '60']],
            ]
        ]
    ]
];

// 6. PRODUCT SHOWCASE
$layouts['layout_home_product_showcase'] = [
    'key' => 'layout_home_product_showcase',
    'name' => 'product_showcase',
    'label' => '6. Danh mục sản phẩm tiêu biểu',
    'display' => 'block',
    'sub_fields' => [
        f_disable('field_prod_showcase_disable'),
        f_text('field_prod_showcase_title', 'title', 'Tiêu đề khối', '100'),
        [
            'key' => 'field_prod_showcase_items',
            'label' => 'Danh sách sản phẩm tiêu biểu',
            'name' => 'items',
            'type' => 'repeater',
            'layout' => 'block',
            'button_label' => 'Thêm sản phẩm',
            'sub_fields' => [
                f_text('field_prod_item_title', 'title', 'Tên sản phẩm / Công thức', '50'),
                f_image('field_prod_item_img', 'image', 'Ảnh sản phẩm', '50'),
                f_textarea('field_prod_item_desc', 'description', 'Mô tả công thức', 3, '100'),
                f_text('field_prod_item_btn_text', 'btn_text', 'Chữ nút', '50'),
                f_text('field_prod_item_btn_link', 'btn_link', 'Link nút', '50'),
            ]
        ]
    ]
];

// 7. PARTNERS SECTION
$layouts['layout_home_partners_section'] = [
    'key' => 'layout_home_partners_section',
    'name' => 'partners_section',
    'label' => '7. Đối tác (Nguyên liệu & Nghiên cứu)',
    'display' => 'block',
    'sub_fields' => [
        f_disable('field_partners_disable'),
        f_text('field_partners_watermark', 'watermark', 'Chữ mờ nền (Watermark)', '50'),
        f_image('field_partners_watermark_img', 'watermark_image', 'Ảnh logo mờ nền', '50'),
        f_text('field_partners_left_title', 'left_title', 'Tiêu đề bên trái', '50'),
        f_text('field_partners_right_title', 'right_title', 'Tiêu đề bên phải', '50'),
        [
            'key' => 'field_partners_left_list',
            'label' => 'Danh sách Đối tác Trái',
            'name' => 'left_partners',
            'type' => 'repeater',
            'layout' => 'table',
            'sub_fields' => [
                f_text('field_pl_name', 'name', 'Tên đối tác'),
                f_image('field_pl_logo', 'logo', 'Logo')
            ]
        ],
        [
            'key' => 'field_partners_right_list',
            'label' => 'Danh sách Đối tác Phải',
            'name' => 'right_partners',
            'type' => 'repeater',
            'layout' => 'table',
            'sub_fields' => [
                f_text('field_pr_name', 'name', 'Tên đối tác'),
                f_image('field_pr_logo', 'logo', 'Logo')
            ]
        ]
    ]
];

// 8. NEWS SECTION
$layouts['layout_home_news_section'] = [
    'key' => 'layout_home_news_section',
    'name' => 'news_section',
    'label' => '8. Tin tức & Hoạt động',
    'display' => 'block',
    'sub_fields' => [
        f_disable('field_news_section_disable'),
        f_text('field_news_section_title', 'title', 'Tiêu đề khối tin tức', '100')
    ]
];

// 9. CONSULT MODAL
$layouts['layout_home_consult_modal'] = [
    'key' => 'layout_home_consult_modal',
    'name' => 'consult_modal',
    'label' => '9. Khung đăng ký nhận tư vấn (Popup / Form)',
    'display' => 'block',
    'sub_fields' => [
        f_disable('field_consult_modal_disable'),
        f_text('field_consult_modal_title', 'title', 'Tiêu đề form tư vấn', '50'),
        f_image('field_consult_modal_img', 'image', 'Ảnh banner popup', '50')
    ]
];

$current['title'] = 'VINACOS - Cấu hình Trang Chủ';
$current['fields'] = [
    [
        'key' => 'field_daily_home_fc',
        'label' => 'Nội dung trang chủ',
        'name' => 'home_sections',
        'type' => 'flexible_content',
        'instructions' => 'Thêm các block nội dung hiển thị ở Trang Chủ',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => [
            'width' => '',
            'class' => '',
            'id' => ''
        ],
        'layouts' => $layouts,
        'button_label' => 'Thêm Block nội dung',
        'min' => '',
        'max' => ''
    ]
];

file_put_contents($file, json_encode($current, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
echo "SUCCESS: Generated complete VINACOS Homepage ACF field group definitions with " . count($layouts) . " layouts!\n";
