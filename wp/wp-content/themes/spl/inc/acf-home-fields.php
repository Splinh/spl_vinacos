<?php
/**
 * Register VINACOS Homepage ACF Flexible Content via PHP Code
 *
 * @package SPL
 */

defined( 'ABSPATH' ) || exit;

add_action( 'acf/init', 'spl_register_vinacos_home_acf_fields', 10 );
function spl_register_vinacos_home_acf_fields(): void {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( [
		'key'                   => 'group_vinacos_home_page',
		'title'                 => __( 'VINACOS - Quản Trị Nội Dung Trang Chủ', 'spl' ),
		'fields'                => [
			[
				'key'          => 'field_vinacos_home_fc',
				'label'        => __( 'Nội dung trang chủ (Flexible Content)', 'spl' ),
				'name'         => 'home_sections',
				'type'         => 'flexible_content',
				'instructions' => __( 'Thêm, sửa, xóa hoặc kéo thả sắp xếp các block hiển thị trên Trang Chủ', 'spl' ),
				'button_label' => __( 'Thêm Block nội dung', 'spl' ),
				'layouts'      => [
					// 1. Hero Banner Slider
					'layout_hero_slider' => [
						'key'        => 'layout_hero_slider',
						'name'       => 'hero_slider',
						'label'      => __( '1. Hero Banner Slider', 'spl' ),
						'display'    => 'block',
						'sub_fields' => [
							[
								'key'          => 'field_hero_disable',
								'label'        => __( 'Ẩn section này', 'spl' ),
								'name'         => 'disable',
								'type'         => 'true_false',
								'ui'           => 1,
								'ui_on_text'   => 'Ẩn',
								'ui_off_text'  => 'Hiện',
								'default_value'=> 0,
							],
							[
								'key'          => 'field_hero_slides',
								'label'        => __( 'Danh sách Slide Banner', 'spl' ),
								'name'         => 'slides',
								'type'         => 'repeater',
								'layout'       => 'block',
								'button_label' => __( 'Thêm Slide', 'spl' ),
								'sub_fields'   => [
									[
										'key'           => 'field_slide_bg_image',
										'label'         => __( 'Ảnh banner (Desktop)', 'spl' ),
										'name'          => 'bg_image',
										'type'          => 'image',
										'return_format' => 'id',
										'preview_size'  => 'medium',
										'wrapper'       => [ 'width' => '33' ],
									],
									[
										'key'           => 'field_slide_bg_image_mobile',
										'label'         => __( 'Ảnh banner (Mobile)', 'spl' ),
										'name'          => 'bg_image_mobile',
										'type'          => 'image',
										'return_format' => 'id',
										'preview_size'  => 'medium',
										'wrapper'       => [ 'width' => '33' ],
									],
									[
										'key'     => 'field_slide_title',
										'label'   => __( 'Tiêu đề Slide (Mỗi dòng cách nhau Enter)', 'spl' ),
										'name'    => 'title',
										'type'    => 'textarea',
										'rows'    => 3,
										'wrapper' => [ 'width' => '34' ],
									],
									[
										'key'     => 'field_slide_desc',
										'label'   => __( 'Mô tả ngắn', 'spl' ),
										'name'    => 'description',
										'type'    => 'textarea',
										'rows'    => 2,
										'wrapper' => [ 'width' => '50' ],
									],
									[
										'key'           => 'field_slide_link',
										'label'         => __( 'Nút bấm / Liên kết', 'spl' ),
										'name'          => 'link',
										'type'          => 'link',
										'return_format' => 'array',
										'wrapper'       => [ 'width' => '50' ],
									],
								],
							],
						],
					],

					// 2. About Section (Tâm thế cộng sự)
					'layout_about_section' => [
						'key'        => 'layout_about_section',
						'name'       => 'about_section',
						'label'      => __( '2. Giới thiệu (Tâm Thế Cộng Sự)', 'spl' ),
						'display'    => 'block',
						'sub_fields' => [
							[
								'key'          => 'field_about_disable',
								'label'        => __( 'Ẩn section này', 'spl' ),
								'name'         => 'disable',
								'type'         => 'true_false',
								'ui'           => 1,
								'default_value'=> 0,
							],
							[
								'key'     => 'field_about_title',
								'label'   => __( 'Tiêu đề chính', 'spl' ),
								'name'    => 'title',
								'type'    => 'text',
								'wrapper' => [ 'width' => '50' ],
							],
							[
								'key'           => 'field_about_image',
								'label'         => __( 'Hình ảnh minh họa', 'spl' ),
								'name'          => 'image',
								'type'          => 'image',
								'return_format' => 'id',
								'preview_size'  => 'medium',
								'wrapper'       => [ 'width' => '50' ],
							],
							[
								'key'          => 'field_about_content',
								'label'        => __( 'Nội dung chi tiết (Tầm nhìn & Sứ mệnh)', 'spl' ),
								'name'         => 'content',
								'type'         => 'wysiwyg',
								'toolbar'      => 'full',
								'media_upload' => 1,
							],
							[
								'key'     => 'field_about_btn_text',
								'label'   => __( 'Chữ trên nút', 'spl' ),
								'name'    => 'btn_text',
								'type'    => 'text',
								'wrapper' => [ 'width' => '50' ],
							],
							[
								'key'     => 'field_about_btn_link',
								'label'   => __( 'Liên kết nút', 'spl' ),
								'name'    => 'btn_link',
								'type'    => 'text',
								'wrapper' => [ 'width' => '50' ],
							],
						],
					],

					// 3. Brand Banner
					'layout_brand_banner' => [
						'key'        => 'layout_brand_banner',
						'name'       => 'brand_banner',
						'label'      => __( '3. Banner Thương Hiệu (Brand Banner)', 'spl' ),
						'display'    => 'block',
						'sub_fields' => [
							[
								'key'          => 'field_brand_banner_disable',
								'label'        => __( 'Ẩn section này', 'spl' ),
								'name'         => 'disable',
								'type'         => 'true_false',
								'ui'           => 1,
								'default_value'=> 0,
							],
							[
								'key'           => 'field_brand_banner_img',
								'label'         => __( 'Ảnh banner thương hiệu', 'spl' ),
								'name'          => 'image',
								'type'          => 'image',
								'return_format' => 'id',
								'preview_size'  => 'large',
							],
						],
					],

					// 4. R&D System
					'layout_rd_system' => [
						'key'        => 'layout_rd_system',
						'name'       => 'rd_system',
						'label'      => __( '4. Hệ thống R&D (Năng lực & Công trình)', 'spl' ),
						'display'    => 'block',
						'sub_fields' => [
							[
								'key'          => 'field_rd_disable',
								'label'        => __( 'Ẩn section này', 'spl' ),
								'name'         => 'disable',
								'type'         => 'true_false',
								'ui'           => 1,
								'default_value'=> 0,
							],
							[
								'key'   => 'field_rd_title',
								'label' => __( 'Tiêu đề khối R&D', 'spl' ),
								'name'  => 'title',
								'type'  => 'text',
							],
							[
								'key'          => 'field_rd_items',
								'label'        => __( 'Danh sách thẻ R&D', 'spl' ),
								'name'         => 'items',
								'type'         => 'repeater',
								'layout'       => 'block',
								'button_label' => __( 'Thêm thẻ R&D', 'spl' ),
								'sub_fields'   => [
									[
										'key'     => 'field_rd_item_label',
										'label'   => __( 'Nhãn nhỏ (Ví dụ: Hệ thống R&D)', 'spl' ),
										'name'    => 'label',
										'type'    => 'text',
										'wrapper' => [ 'width' => '50' ],
									],
									[
										'key'     => 'field_rd_item_title',
										'label'   => __( 'Tiêu đề thẻ', 'spl' ),
										'name'    => 'title',
										'type'    => 'text',
										'wrapper' => [ 'width' => '50' ],
									],
									[
										'key'     => 'field_rd_item_desc',
										'label'   => __( 'Mô tả chi tiết', 'spl' ),
										'name'    => 'desc',
										'type'    => 'textarea',
										'rows'    => 3,
									],
									[
										'key'           => 'field_rd_item_img',
										'label'         => __( 'Ảnh minh họa', 'spl' ),
										'name'          => 'image',
										'type'          => 'image',
										'return_format' => 'id',
										'preview_size'  => 'medium',
										'wrapper'       => [ 'width' => '50' ],
									],
									[
										'key'     => 'field_rd_item_btn_text',
										'label'   => __( 'Chữ nút', 'spl' ),
										'name'    => 'btn_text',
										'type'    => 'text',
										'wrapper' => [ 'width' => '25' ],
									],
									[
										'key'     => 'field_rd_item_btn_link',
										'label'   => __( 'Link nút', 'spl' ),
										'name'    => 'btn_link',
										'type'    => 'text',
										'wrapper' => [ 'width' => '25' ],
									],
								],
							],
						],
					],

					// 5. Key Numbers
					'layout_key_numbers' => [
						'key'        => 'layout_key_numbers',
						'name'       => 'key_numbers',
						'label'      => __( '5. Con số nổi bật (Key Numbers)', 'spl' ),
						'display'    => 'block',
						'sub_fields' => [
							[
								'key'          => 'field_numbers_disable',
								'label'        => __( 'Ẩn section này', 'spl' ),
								'name'         => 'disable',
								'type'         => 'true_false',
								'ui'           => 1,
								'default_value'=> 0,
							],
							[
								'key'   => 'field_numbers_title',
								'label' => __( 'Tiêu đề khối', 'spl' ),
								'name'  => 'title',
								'type'  => 'text',
							],
							[
								'key'           => 'field_numbers_bg',
								'label'         => __( 'Ảnh nền (Background)', 'spl' ),
								'name'          => 'bg_image',
								'type'          => 'image',
								'return_format' => 'id',
								'preview_size'  => 'medium',
								'wrapper'       => [ 'width' => '50' ],
							],
							[
								'key'           => 'field_numbers_fig',
								'label'         => __( 'Ảnh đồ họa / Người mẫu giữa', 'spl' ),
								'name'          => 'figure_image',
								'type'          => 'image',
								'return_format' => 'id',
								'preview_size'  => 'medium',
								'wrapper'       => [ 'width' => '50' ],
							],
							[
								'key'          => 'field_numbers_items',
								'label'        => __( 'Danh sách con số', 'spl' ),
								'name'         => 'items',
								'type'         => 'repeater',
								'layout'       => 'table',
								'button_label' => __( 'Thêm con số', 'spl' ),
								'sub_fields'   => [
									[
										'key'     => 'field_num_count',
										'label'   => __( 'Số lượng', 'spl' ),
										'name'    => 'count',
										'type'    => 'number',
										'wrapper' => [ 'width' => '20' ],
									],
									[
										'key'     => 'field_num_suffix',
										'label'   => __( 'Ký tự sau (%, +)', 'spl' ),
										'name'    => 'suffix',
										'type'    => 'text',
										'wrapper' => [ 'width' => '20' ],
									],
									[
										'key'     => 'field_num_title',
										'label'   => __( 'Mô tả con số', 'spl' ),
										'name'    => 'title',
										'type'    => 'text',
										'wrapper' => [ 'width' => '60' ],
									],
								],
							],
						],
					],

					// 6. Product Showcase
					'layout_product_showcase' => [
						'key'        => 'layout_product_showcase',
						'name'       => 'product_showcase',
						'label'      => __( '6. Danh mục sản phẩm tiêu biểu', 'spl' ),
						'display'    => 'block',
						'sub_fields' => [
							[
								'key'          => 'field_prod_disable',
								'label'        => __( 'Ẩn section này', 'spl' ),
								'name'         => 'disable',
								'type'         => 'true_false',
								'ui'           => 1,
								'default_value'=> 0,
							],
							[
								'key'   => 'field_prod_title',
								'label' => __( 'Tiêu đề khối sản phẩm', 'spl' ),
								'name'  => 'title',
								'type'  => 'text',
							],
							[
								'key'          => 'field_prod_items',
								'label'        => __( 'Danh sách sản phẩm tiêu biểu', 'spl' ),
								'name'         => 'items',
								'type'         => 'repeater',
								'layout'       => 'block',
								'button_label' => __( 'Thêm sản phẩm', 'spl' ),
								'sub_fields'   => [
									[
										'key'     => 'field_prod_item_title',
										'label'   => __( 'Tên sản phẩm / Công thức', 'spl' ),
										'name'    => 'title',
										'type'    => 'text',
										'wrapper' => [ 'width' => '50' ],
									],
									[
										'key'           => 'field_prod_item_img',
										'label'         => __( 'Ảnh sản phẩm', 'spl' ),
										'name'          => 'image',
										'type'          => 'image',
										'return_format' => 'id',
										'preview_size'  => 'medium',
										'wrapper'       => [ 'width' => '50' ],
									],
									[
										'key'     => 'field_prod_item_desc',
										'label'   => __( 'Mô tả công thức', 'spl' ),
										'name'    => 'description',
										'type'    => 'textarea',
										'rows'    => 3,
									],
									[
										'key'     => 'field_prod_item_btn_text',
										'label'   => __( 'Chữ nút', 'spl' ),
										'name'    => 'btn_text',
										'type'    => 'text',
										'wrapper' => [ 'width' => '50' ],
									],
									[
										'key'     => 'field_prod_item_btn_link',
										'label'   => __( 'Link nút', 'spl' ),
										'name'    => 'btn_link',
										'type'    => 'text',
										'wrapper' => [ 'width' => '50' ],
									],
								],
							],
						],
					],

					// 7. Partners Section
					'layout_partners_section' => [
						'key'        => 'layout_partners_section',
						'name'       => 'partners_section',
						'label'      => __( '7. Đối tác (Nguyên liệu & Nghiên cứu)', 'spl' ),
						'display'    => 'block',
						'sub_fields' => [
							[
								'key'          => 'field_partners_disable',
								'label'        => __( 'Ẩn section này', 'spl' ),
								'name'         => 'disable',
								'type'         => 'true_false',
								'ui'           => 1,
								'default_value'=> 0,
							],
							[
								'key'     => 'field_partners_watermark',
								'label'   => __( 'Chữ mờ nền (Watermark)', 'spl' ),
								'name'    => 'watermark',
								'type'    => 'text',
								'wrapper' => [ 'width' => '50' ],
							],
							[
								'key'     => 'field_partners_left_title',
								'label'   => __( 'Tiêu đề bên trái', 'spl' ),
								'name'    => 'left_title',
								'type'    => 'text',
								'wrapper' => [ 'width' => '50' ],
							],
							[
								'key'     => 'field_partners_right_title',
								'label'   => __( 'Tiêu đề bên phải', 'spl' ),
								'name'    => 'right_title',
								'type'    => 'text',
								'wrapper' => [ 'width' => '50' ],
							],
						],
					],

					// 8. News Section
					'layout_news_section' => [
						'key'        => 'layout_news_section',
						'name'       => 'news_section',
						'label'      => __( '8. Tin tức & Hoạt động', 'spl' ),
						'display'    => 'block',
						'sub_fields' => [
							[
								'key'          => 'field_news_disable',
								'label'        => __( 'Ẩn section này', 'spl' ),
								'name'         => 'disable',
								'type'         => 'true_false',
								'ui'           => 1,
								'default_value'=> 0,
							],
							[
								'key'   => 'field_news_title',
								'label' => __( 'Tiêu đề khối tin tức', 'spl' ),
								'name'  => 'title',
								'type'  => 'text',
							],
						],
					],

					// 9. Consult Modal
					'layout_consult_modal' => [
						'key'        => 'layout_consult_modal',
						'name'       => 'consult_modal',
						'label'      => __( '9. Khung đăng ký nhận tư vấn', 'spl' ),
						'display'    => 'block',
						'sub_fields' => [
							[
								'key'          => 'field_consult_disable',
								'label'        => __( 'Ẩn section này', 'spl' ),
								'name'         => 'disable',
								'type'         => 'true_false',
								'ui'           => 1,
								'default_value'=> 0,
							],
							[
								'key'     => 'field_consult_title',
								'label'   => __( 'Tiêu đề form tư vấn', 'spl' ),
								'name'    => 'title',
								'type'    => 'text',
								'wrapper' => [ 'width' => '50' ],
							],
							[
								'key'           => 'field_consult_img',
								'label'         => __( 'Ảnh banner popup', 'spl' ),
								'name'          => 'image',
								'type'          => 'image',
								'return_format' => 'id',
								'preview_size'  => 'medium',
								'wrapper'       => [ 'width' => '50' ],
							],
						],
					],
				],
			],
		],
		'location'              => [
			[
				[
					'param'    => 'page_template',
					'operator' => '==',
					'value'    => 'templates/template-page-home.php',
				],
			],
			[
				[
					'param'    => 'page_type',
					'operator' => '==',
					'value'    => 'front_page',
				],
			],
			[
				[
					'param'    => 'post',
					'operator' => '==',
					'value'    => '10',
				],
			],
			[
				[
					'param'    => 'post',
					'operator' => '==',
					'value'    => '1121',
				],
			],
		],
		'menu_order'            => 0,
		'position'              => 'normal',
		'style'                 => 'default',
		'label_placement'       => 'top',
		'instruction_placement' => 'label',
		'active'                => true,
	] );
}
