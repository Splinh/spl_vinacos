<?php
/**
 * Shared product card — Vinacos / Unila design.
 *
 * @package SPL
 */

defined( 'ABSPATH' ) || exit;

$data = $args ?? array();

/** @var \WC_Product|null $card_product */
$card_product = $data['product'] ?? null;
if ( ! $card_product instanceof \WC_Product ) {
	$prod_id      = $data['id'] ?? get_the_ID();
	$card_product = function_exists( 'wc_get_product' ) ? wc_get_product( $prod_id ) : null;
}
if ( ! $card_product instanceof \WC_Product ) {
	return;
}

$pid     = $card_product->get_id();
$p_title = $card_product->get_name();
$p_url   = get_permalink( $pid );

$thumb_id = $card_product->get_image_id();
$p_thumb  = $thumb_id ? wp_get_attachment_image_url( $thumb_id, 'medium_large' ) : ( get_template_directory_uri() . '/static/img/logo.png' );

// 2nd image for hover flipper effect (if available).
$gallery_ids = $card_product->get_gallery_image_ids();
$back_thumb  = ( ! empty( $gallery_ids ) && ! empty( $gallery_ids[0] ) )
	? ( wp_get_attachment_image_url( $gallery_ids[0], 'medium_large' ) ?: $p_thumb )
	: $p_thumb;

$is_en = function_exists( 'pll_current_language' ) && 'en' === pll_current_language();

$p_desc = $card_product->get_short_description();
if ( empty( $p_desc ) ) {
	$p_desc = $card_product->get_description();
}
if ( empty( $p_desc ) ) {
	$terms = get_the_terms( $pid, 'product_cat' );
	if ( $terms && ! is_wp_error( $terms ) ) {
		$p_desc = $terms[0]->name;
	}
}
if ( empty( $p_desc ) ) {
	$p_desc = $is_en ? 'High quality OEM/ODM cosmetic formulation by VINACOS.' : 'Dòng sản phẩm gia công mỹ phẩm chuẩn y khoa nghiên cứu bởi VINACOS.';
}

// Dynamic badge.
$badge = '';
if ( $card_product->is_featured() ) {
	$badge = 'HOT';
} elseif ( ( time() - get_post_time( 'U', false, $pid ) ) < ( 30 * DAY_IN_SECONDS ) ) {
	$badge = $is_en ? 'NEW' : 'MỚI';
}
?>
<article class="product-item">
	<div class="image">
		<a class="img-scale flipper" href="<?php echo esc_url( $p_url ); ?>" title="<?php echo esc_attr( $p_title ); ?>">
			<img class="lozad front" src="<?php echo esc_url( $p_thumb ); ?>" data-src="<?php echo esc_url( $p_thumb ); ?>" loading="lazy" alt="<?php echo esc_attr( $p_title ); ?>">
			<img class="lozad back" src="<?php echo esc_url( $back_thumb ); ?>" data-src="<?php echo esc_url( $back_thumb ); ?>" loading="lazy" alt="<?php echo esc_attr( $p_title ); ?>">
		</a>
		<?php if ( $badge ) : ?>
			<span class="product-tag"><?php echo esc_html( $badge ); ?></span>
		<?php endif; ?>
	</div>
	<div class="caption">
		<h3 class="title">
			<a href="<?php echo esc_url( $p_url ); ?>" title="<?php echo esc_attr( $p_title ); ?>">
				<?php echo esc_html( $p_title ); ?>
			</a>
		</h3>
		<?php if ( ! empty( $p_desc ) ) : ?>
			<div class="desc">
				<?php echo esc_html( wp_trim_words( wp_strip_all_tags( $p_desc ), 15 ) ); ?>
			</div>
		<?php endif; ?>
	</div>
</article>
