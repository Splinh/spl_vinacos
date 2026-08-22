<?php
/**
 * Template Name: Trang Chủ
 *
 * Home page template with ACF flexible content.
 * Replicates Unila design 100% with Labcos cosmetics OEM/ODM content.
 *
 * @package SPL
 */

use SPL\Core\Helper;

defined( 'ABSPATH' ) || exit;

get_header();

// ACF Flexible Content field name.
$sections = Helper::getField( 'home_sections' );

if ( $sections ) :
	foreach ( $sections as $section ) :
		// Skip disabled sections.
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

			case 'brand_banner':
				get_template_part( 'parts/home/brand-banner', null, $section );
				break;

			case 'partners_section':
			case 'partners':
				get_template_part( 'parts/home/partners', null, $section );
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
	// Fallback: render default Unila sections in exact visual sequence
	get_template_part( 'parts/home/hero-slider' );
	get_template_part( 'parts/home/about-section' );
	get_template_part( 'parts/home/brand-banner' );
	get_template_part( 'parts/home/rd-system' );
	get_template_part( 'parts/home/key-numbers' );
	get_template_part( 'parts/home/product-showcase' );
	get_template_part( 'parts/home/news-section' );
	get_template_part( 'parts/home/consult-modal' );
endif;

get_footer();
