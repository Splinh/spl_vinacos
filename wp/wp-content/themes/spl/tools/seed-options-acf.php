<?php
/**
 * Seeder script to populate ACF Options fields for VINACOS in WP Database.
 *
 * Usage via CLI: php -r "require 'wp/wp-load.php'; require 'wp/wp-content/themes/spl/tools/seed-options-acf.php';"
 *
 * @package SPL
 */

defined( 'ABSPATH' ) || exit;

echo "=== POPULATING VINACOS THEME OPTIONS ACF FIELDS ===" . PHP_EOL;

$options_data = array(
	// Header & General
	'logo'            => 1050,
	'logo_tagline'    => 'Nhà cung ứng bao bì chai lọ & sản xuất mỹ phẩm OEM/ODM',
	'hotline_label'   => 'Hotline tư vấn B&B Vinacos',

	// Contact Info
	'hotline'         => '0967 198 483',
	'email'           => 'bbvinacos@gmail.com',
	'address'         => 'Số 44 Đường Thạnh Xuân 31, Phường Thới An, Quận 12, TP. Hồ Chí Minh',
	'working_hours'   => 'Thứ 2 – Chủ Nhật: 08:00 – 18:00',

	// Footer & Company
	'footer_desc'     => 'Công ty TNHH B&B Vinacos — Chuyên sản xuất, gia công mỹ phẩm OEM/ODM trọn gói và cung cấp các loại bao bì chai lọ mỹ phẩm cao cấp đạt chuẩn cGMP / FDA.',
	'company_name'    => 'CÔNG TY TNHH B&B VINACOS',
	'company_intl_name' => 'B&B VINACOS COMPANY LIMITED',
	'company_tax'     => '2601138503 (CN TP.HCM: 2601138503-001)',
	'complaint_phone' => '0906 941 088',
	'addr_showroom'   => 'Số 44 Đường Thạnh Xuân 31, Phường Thới An, Quận 12, TP. Hồ Chí Minh',
	'addr_farm'       => 'Thửa đất số 55, tờ bản đồ số 22, Xã Đào Xá, Huyện Thanh Thủy, Tỉnh Phú Thọ',
	'addr_factory'    => 'Nhà máy sản xuất & gia công mỹ phẩm đạt chuẩn cGMP / FDA',
	'website_url'     => home_url( '/' ),

	// Social Links
	'facebook_url'    => 'https://www.facebook.com/people/Chai-L%E1%BB%8D-M%E1%BB%B9-Ph%E1%BA%A9m-Bb-Vinacos/61587092227490/',
	'zalo_url'        => 'https://zalo.me/0967198483',
	'youtube_url'     => 'https://www.youtube.com/@vinacos',
	'tiktok_url'      => 'https://www.tiktok.com/@vinacos',

	// Floating Buttons
	'show_zalo_float'  => 1,
	'show_phone_float' => 1,
	'show_back_to_top' => 1,

	// Company Info Repeater
	'company_info_list' => array(
		array(
			'label' => 'Chi nhánh TP.HCM',
			'value' => 'Số 44 Đường Thạnh Xuân 31, Phường Thới An, Quận 12, TP. Hồ Chí Minh',
			'link'  => '',
		),
		array(
			'label' => 'Trụ sở chính',
			'value' => 'Thửa đất số 55, tờ bản đồ số 22, Xã Đào Xá, Huyện Thanh Thủy, Tỉnh Phú Thọ',
			'link'  => '',
		),
		array(
			'label' => 'Nhà máy',
			'value' => 'Nhà máy gia công mỹ phẩm & bao bì chai lọ chuẩn cGMP / FDA',
			'link'  => '',
		),
		array(
			'label' => 'Hotline / Zalo',
			'value' => '0967.198.483 – 0906.941.088',
			'link'  => 'tel:0967198483',
		),
		array(
			'label' => 'Email',
			'value' => 'bbvinacos@gmail.com',
			'link'  => 'mailto:bbvinacos@gmail.com',
		),
		array(
			'label' => 'Mã số thuế',
			'value' => '2601138503 (CN TP.HCM: 2601138503-001)',
			'link'  => '',
		),
	),
);

foreach ( $options_data as $key => $val ) {
	if ( function_exists( 'update_field' ) ) {
		update_field( $key, $val, 'option' );
		echo "SUCCESS: Updated option field '{$key}'" . PHP_EOL;
	} else {
		update_option( "options_{$key}", $val );
		echo "SUCCESS: Saved option 'options_{$key}'" . PHP_EOL;
	}
}

echo "=== COMPLETED SEEDING VINACOS THEME OPTIONS ===" . PHP_EOL;
