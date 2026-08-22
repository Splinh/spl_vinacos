<?php
/**
 * The front page template (front-page.php).
 *
 * Forces 100% Unila visual layout on site root URL.
 *
 * @package SPL
 */

use SPL\Core\Helper;

defined( 'ABSPATH' ) || exit;

get_header();

// ACF Flexible Content field name on front page.
$front_page_id = (int) get_option( 'page_on_front' ) ?: 10;
$sections      = function_exists( 'get_field' ) ? get_field( 'home_sections', $front_page_id ) : ( $front_page_id ? Helper::getField( 'home_sections', $front_page_id ) : false );

if ( ! empty( $sections ) && is_array( $sections ) ) :
	foreach ( $sections as $section ) :
		if ( ! empty( $section['disable'] ) ) :
			continue;
		endif;

		$layout = $section['acf_fc_layout'] ?? '';

		switch ( $layout ) :
			case 'hero_slider':
				get_template_part( 'parts/home/hero-slider', null, $section );
				break;

			case 'about_section':
				get_template_part( 'parts/home/about-section', null, $section );
				break;

			case 'brand_banner':
				get_template_part( 'parts/home/brand-banner', null, $section );
				break;

			case 'rd_system':
				get_template_part( 'parts/home/rd-system', null, $section );
				break;

			case 'key_numbers':
				get_template_part( 'parts/home/key-numbers', null, $section );
				break;

			case 'product_showcase':
			case 'categories':
				get_template_part( 'parts/home/product-showcase', null, $section );
				break;

			case 'partners_section':
			case 'partners':
				get_template_part( 'parts/home/partners-section', null, $section );
				break;

			case 'news_section':
			case 'news':
				get_template_part( 'parts/home/news-section', null, $section );
				break;

			case 'consult_modal':
			case 'consult_form':
				get_template_part( 'parts/home/consult-modal', null, $section );
				break;
		endswitch;
	endforeach;

else :
	// Render default Unila sections in exact visual sequence.
	get_template_part( 'parts/home/hero-slider' );
	get_template_part( 'parts/home/about-section' );
	get_template_part( 'parts/home/brand-banner' );
	get_template_part( 'parts/home/rd-system' );
	get_template_part( 'parts/home/key-numbers' );
	get_template_part( 'parts/home/product-showcase' );
	get_template_part( 'parts/home/partners-section' );
	get_template_part( 'parts/home/news-section' );
	get_template_part( 'parts/home/consult-modal' );
endif;

get_footer();
