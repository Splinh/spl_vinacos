<?php
/**
 * Inline SVG Icon Helper.
 *
 * Replaces FontAwesome icons with lightweight inline SVGs for
 * zero-dependency rendering and optimal PageSpeed scores.
 *
 * Usage: <?= spl_icon('search', 'extra-class') ?>
 *
 * @package SPL
 */

defined( 'ABSPATH' ) || exit;

/**
 * Return an inline SVG icon by name.
 *
 * @param string $name  Icon name (e.g. 'search', 'cart', 'plus').
 * @param string $class Extra CSS classes to add.
 * @param int    $size  Width/height in px (default 24).
 * @return string SVG markup.
 */
function spl_icon( string $name, string $class = '', int $size = 24 ): string {
	$icons = spl_get_icons();

	if ( ! isset( $icons[ $name ] ) ) {
		return '<!-- icon "' . esc_html( $name ) . '" not found -->';
	}

	$cls = 'spl-icon spl-icon--' . esc_attr( $name );
	if ( $class ) {
		$cls .= ' ' . esc_attr( $class );
	}

	return sprintf(
		'<svg class="%s" width="%d" height="%d" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">%s</svg>',
		$cls,
		$size,
		$size,
		$icons[ $name ]
	);
}

/**
 * Return all SVG icon paths.
 *
 * Each value is the inner SVG content (path/polyline elements).
 * Stroke-based (light weight) for consistency with fa-light style.
 *
 * @return array<string, string>
 */
function spl_get_icons(): array {
	static $icons = null;

	if ( $icons !== null ) {
		return $icons;
	}

	$s = 'stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"';

	$icons = [
		// ── Header ──────────────────────────────────────────────
		'search' => '<circle cx="11" cy="11" r="7" ' . $s . '/><path d="M21 21l-4.35-4.35" ' . $s . '/>',

		'cart' => '<path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z" ' . $s . '/><path d="M3 6h18" ' . $s . '/><path d="M16 10a4 4 0 0 1-8 0" ' . $s . '/>',

		'close' => '<path d="M18 6L6 18" ' . $s . '/><path d="M6 6l12 12" ' . $s . '/>',

		// ── Buttons / CTAs ──────────────────────────────────────
		'plus' => '<path d="M12 5v14" ' . $s . '/><path d="M5 12h14" ' . $s . '/>',

		'arrow-right' => '<path d="M5 12h14" ' . $s . '/><path d="M12 5l7 7-7 7" ' . $s . '/>',

		'arrow-up' => '<path d="M12 19V5" ' . $s . '/><path d="M5 12l7-7 7 7" ' . $s . '/>',

		// ── Slider navigation ───────────────────────────────────
		'chevron-left' => '<path d="M15 18l-6-6 6-6" ' . $s . '/>',

		'chevron-right' => '<path d="M9 18l6-6-6-6" ' . $s . '/>',

		// ── CTA Sidebar ─────────────────────────────────────────
		'phone' => '<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z" ' . $s . '/>',

		'envelope' => '<path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" ' . $s . '/><polyline points="22,6 12,13 2,6" ' . $s . '/>',

		// ── Social ──────────────────────────────────────────────
		'facebook' => '<path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" fill="currentColor"/>',

		'youtube' => '<path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19.1c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.43z" fill="currentColor"/><polygon points="9.75,15.02 15.5,11.75 9.75,8.48" fill="#fff"/>',

		'instagram' => '<rect x="2" y="2" width="20" height="20" rx="5" ry="5" ' . $s . '/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" ' . $s . '/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5" ' . $s . '/>',

		'tiktok' => '<path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5" ' . $s . '/>',

		'linkedin' => '<path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z" fill="currentColor"/><rect x="2" y="9" width="4" height="12" fill="currentColor"/><circle cx="4" cy="4" r="2" fill="currentColor"/>',
	];

	return $icons;
}
