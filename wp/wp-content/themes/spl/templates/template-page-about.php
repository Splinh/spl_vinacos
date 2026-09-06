<?php
/**
 * Template Name: Giới Thiệu — 100% Exact Unila HTML layout for /tam-the-cong-su-unila-viet-nam/.
 *
 * @package SPL
 */

use SPL\Core\Helper;

defined( 'ABSPATH' ) || exit;

get_header();

global $post;
$page_id  = $post->ID ?? 0;
$sections = $page_id ? ( function_exists( 'get_field' ) ? get_field( 'about_sections', $page_id ) : ( class_exists( Helper::class ) ? Helper::getField( 'about_sections', $page_id ) : false ) ) : false;

// Always render Hero Banner & Breadcrumbs at top of About page
$hero_section = null;
if ( ! empty( $sections ) && is_array( $sections ) ) {
	foreach ( $sections as $s ) {
		if ( ( $s['acf_fc_layout'] ?? '' ) === 'about_hero' || ( $s['acf_fc_layout'] ?? '' ) === 'hero' ) {
			$hero_section = $s;
			break;
		}
	}
}
get_template_part( 'parts/about/hero', null, $hero_section );

if ( ! empty( $sections ) && is_array( $sections ) ) :
	foreach ( $sections as $section ) :
		if ( ! empty( $section['disable'] ) ) :
			continue;
		endif;

		$layout = $section['acf_fc_layout'] ?? '';
		$part   = str_replace( 'about_', '', $layout );

		// Skip hero (already rendered at top) or hidden sections
		if ( in_array( $part, [ 'hero', 'mission', 'timeline' ], true ) ) :
			continue;
		endif;

		// Map 'stats' or 'promises' layout to 'promises'
		if ( in_array( $part, [ 'stats', 'promises' ], true ) ) :
			get_template_part( 'parts/about/promises', null, $section );
			continue;
		endif;

		get_template_part( 'parts/about/' . $part, null, $section );
	endforeach;

else :
	// Render default Unila sections in exact visual sequence
	get_template_part( 'parts/about/story' );
	get_template_part( 'parts/about/message' );
	get_template_part( 'parts/about/promises' );
	get_template_part( 'parts/about/team' );
	get_template_part( 'parts/about/cta' );
endif;

get_footer();
