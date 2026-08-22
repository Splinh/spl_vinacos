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

if ( ! empty( $sections ) && is_array( $sections ) ) :
	foreach ( $sections as $section ) :
		if ( ! empty( $section['disable'] ) ) :
			continue;
		endif;

		$layout = $section['acf_fc_layout'] ?? '';
		$part   = str_replace( 'about_', '', $layout );

		get_template_part( 'parts/about/' . $part, null, $section );
	endforeach;

else :
	// Render default Unila sections in exact visual sequence.
	get_template_part( 'parts/about/hero' );
	get_template_part( 'parts/about/story' );
	get_template_part( 'parts/about/message' );
	get_template_part( 'parts/about/timeline' );
	get_template_part( 'parts/about/mission' );
	get_template_part( 'parts/about/stats' );
	get_template_part( 'parts/about/team' );
	get_template_part( 'parts/about/cta' );
endif;

get_footer();
