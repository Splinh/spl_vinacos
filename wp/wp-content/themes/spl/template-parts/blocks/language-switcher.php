<?php
/**
 * Block: Language Switcher
 *
 * Renders Polylang language switcher dropdown.
 *
 * @package SPL
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'pll_the_languages' ) ) {
	return;
}

$langs = pll_the_languages( [ 'raw' => 1 ] );
if ( empty( $langs ) ) {
	return;
}

$current_lang = null;
foreach ( $langs as $lang ) {
	if ( ! empty( $lang['current_lang'] ) ) {
		$current_lang = $lang;
		break;
	}
}
if ( ! $current_lang ) {
	$current_lang = reset( $langs );
}

$current_code = strtoupper( $current_lang['slug'] );
if ( 'VI' === $current_code ) {
	$current_code = 'VI';
}
?>
<div class="wpml-ls-statics-shortcode_actions wpml-ls wpml-ls-legacy-dropdown-click js-wpml-ls-legacy-dropdown-click">
	<ul>
		<li class="wpml-ls-slot-shortcode_actions wpml-ls-item wpml-ls-item-<?= esc_attr( strtolower( $current_code ) ) ?> wpml-ls-current-language wpml-ls-first-item wpml-ls-last-item wpml-ls-item-legacy-dropdown-click">
			<a href="#" class="js-wpml-ls-item-toggle wpml-ls-item-toggle" onclick="return false;">
				<span class="wpml-ls-native"><?= esc_html( $current_code ) ?></span>
			</a>
			<ul class="wpml-ls-sub-menu">
				<?php foreach ( $langs as $lang ) :
					if ( ! empty( $lang['current_lang'] ) ) {
						continue; // Only list other available languages
					}
					$code = strtoupper( $lang['slug'] );
				?>
					<li class="wpml-ls-sub-item">
						<a href="<?= esc_url( $lang['url'] ) ?>">
							<span class="wpml-ls-native"><?= esc_html( $code ) ?></span>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</li>
	</ul>
</div>

<style>
/* Unila Language Switcher Dropdown Styling */
header .button-language {
	position: relative !important;
	display: inline-flex !important;
	align-items: center !important;
}

header .button-language .wpml-ls {
	position: relative !important;
}

header .button-language .wpml-ls > ul {
	margin: 0 !important;
	padding: 0 !important;
	list-style: none !important;
}

header .button-language .wpml-ls > ul > li {
	position: relative !important;
	margin: 0 !important;
	padding: 0 !important;
}

/* Hidden by default */
header .wpml-ls-sub-menu {
	display: none !important;
	position: absolute !important;
	top: calc(100% + 6px) !important;
	left: 50% !important;
	transform: translateX(-50%) !important;
	background: #ffffff !important;
	border: 1px solid #e2e8f0 !important;
	border-radius: 12px !important;
	box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.15) !important;
	padding: 6px 0 !important;
	min-width: 56px !important;
	text-align: center !important;
	margin: 0 !important;
	list-style: none !important;
	z-index: 99999 !important;
}

/* Display ONLY when active class is toggled on click */
header .wpml-ls-item.is-open .wpml-ls-sub-menu,
header .wpml-ls-item.wpml-ls-show .wpml-ls-sub-menu {
	display: block !important;
}

header .wpml-ls-sub-menu li {
	margin: 0 !important;
	padding: 0 !important;
	list-style: none !important;
}

header .wpml-ls-sub-menu li a {
	display: flex !important;
	align-items: center !important;
	justify-content: center !important;
	padding: 8px 14px !important;
	color: #1e293b !important;
	font-weight: 700 !important;
	font-size: 13px !important;
	line-height: 1 !important;
	text-decoration: none !important;
	white-space: nowrap !important;
	border-radius: 6px !important;
	transition: background-color 0.2s ease, color 0.2s ease !important;
}

header .wpml-ls-sub-menu li a:hover {
	background-color: #f1f5f9 !important;
	color: #1e60a3 !important;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
	document.addEventListener('click', function(e) {
		const toggleBtn = e.target.closest('.js-wpml-ls-item-toggle');
		const langItem  = e.target.closest('.wpml-ls-item');

		if (toggleBtn && langItem) {
			e.preventDefault();
			e.stopPropagation();
			langItem.classList.toggle('is-open');
		} else {
			document.querySelectorAll('.wpml-ls-item.is-open').forEach(function(item) {
				item.classList.remove('is-open');
			});
		}
	});
});
</script>
