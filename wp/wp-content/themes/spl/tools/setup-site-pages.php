<?php
/**
 * CLI Script to Setup All WordPress Pages & Navigation Menu for VINACOS.
 *
 * Usage: php -r "require 'wp/wp-load.php'; require 'wp/wp-content/themes/spl/tools/setup-site-pages.php';"
 *
 * @package SPL
 */

defined( 'ABSPATH' ) || exit;

echo "--- Starting VINACOS Site Pages & Navigation Setup ---" . PHP_EOL;

// List of target pages matching unila.com.vn structure
$pages_config = array(
	'home'        => array(
		'title'    => 'Trang Chủ - VINACOS',
		'slug'     => 'trang-chu',
		'template' => 'templates/template-page-home.php',
		'is_front' => true,
	),
	'about'       => array(
		'title'    => 'TÂM THẾ CỘNG SỰ',
		'slug'     => 'tam-the-cong-su-unila-viet-nam',
		'template' => 'templates/template-page-about.php',
	),
	'products'    => array(
		'title'    => 'Sản phẩm',
		'slug'     => 'san-pham-gia-cong-unila-viet-nam',
		'template' => '',
	),
	'rd_system'   => array(
		'title'    => 'HỆ THỐNG R&D',
		'slug'     => 'oem-odm-gia-cong-unila-viet-nam',
		'template' => 'templates/template-page-cooperation.php',
	),
	'news'        => array(
		'title'    => 'Tin tức',
		'slug'     => 'tin-tuc-unila-viet-nam',
		'template' => '',
		'is_posts' => true,
	),
	'contact'     => array(
		'title'    => 'Liên hệ',
		'slug'     => 'lien-he',
		'template' => 'templates/template-page-contact.php',
	),
);

$created_pages = array();

foreach ( $pages_config as $key => $cfg ) {
	$existing = get_page_by_path( $cfg['slug'] );
	if ( ! $existing ) {
		// try by title
		$existing = get_page_by_title( $cfg['title'] );
	}

	if ( $existing ) {
		$page_id = $existing->ID;
		wp_update_post( array(
			'ID'         => $page_id,
			'post_title' => $cfg['title'],
			'post_name'  => $cfg['slug'],
			'post_status'=> 'publish',
		) );
		echo "Updated existing page '{$cfg['title']}' (ID: {$page_id})" . PHP_EOL;
	} else {
		$page_id = wp_insert_post( array(
			'post_title'  => $cfg['title'],
			'post_name'   => $cfg['slug'],
			'post_type'   => 'page',
			'post_status' => 'publish',
		) );
		echo "Created new page '{$cfg['title']}' (ID: {$page_id})" . PHP_EOL;
	}

	if ( ! empty( $cfg['template'] ) ) {
		update_post_meta( $page_id, '_wp_page_template', $cfg['template'] );
	}

	if ( ! empty( $cfg['is_front'] ) ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $page_id );
	}

	if ( ! empty( $cfg['is_posts'] ) ) {
		update_option( 'page_for_posts', $page_id );
	}

	$created_pages[ $key ] = array(
		'id'    => $page_id,
		'title' => $cfg['title'],
		'url'   => get_permalink( $page_id ),
	);
}

// Set up WordPress Primary Navigation Menu
$menu_name = 'VINACOS Primary Menu';
$menu_obj  = wp_get_nav_menu_object( $menu_name );

if ( ! $menu_obj ) {
	$menu_id = wp_create_nav_menu( $menu_name );
	echo "Created Nav Menu: '{$menu_name}' (ID: {$menu_id})" . PHP_EOL;
} else {
	$menu_id = $menu_obj->term_id;
	echo "Using existing Nav Menu: '{$menu_name}' (ID: {$menu_id})" . PHP_EOL;
}

// Clear existing items in menu to rebuild cleanly
$menu_items = wp_get_nav_menu_items( $menu_id );
if ( ! empty( $menu_items ) ) {
	foreach ( $menu_items as $item ) {
		wp_delete_post( $item->ID, true );
	}
}

// Add menu items in exact Unila order
$nav_order = array( 'about', 'products', 'rd_system', 'news', 'contact' );

foreach ( $nav_order as $order_num => $nav_key ) {
	if ( isset( $created_pages[ $nav_key ] ) ) {
		$pg = $created_pages[ $nav_key ];
		wp_update_nav_menu_item( $menu_id, 0, array(
			'menu-item-title'     => $pg['title'],
			'menu-item-object-id' => $pg['id'],
			'menu-item-object'    => 'page',
			'menu-item-type'      => 'post_type',
			'menu-item-status'    => 'publish',
			'menu-item-position'  => $order_num + 1,
		) );
		echo "Added menu item: {$pg['title']}" . PHP_EOL;
	}
}

// Assign to primary theme location
$locations = get_theme_mod( 'nav_menu_locations' );
if ( ! is_array( $locations ) ) {
	$locations = array();
}
$locations['primary'] = $menu_id;
$locations['main_menu'] = $menu_id;
set_theme_mod( 'nav_menu_locations', $locations );

echo "--- VINACOS Pages & Navigation Setup Completed Successfully ---" . PHP_EOL;
