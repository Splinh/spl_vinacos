<?php
/**
 * Theme setup and initialization.
 *
 * Handles menu registration, ACF options, widget areas.
 *
 * @package SPL
 */

use SPL\Core\Helper;

defined( 'ABSPATH' ) || exit;

// --------------------------------------------------
// Menu locations
// --------------------------------------------------

add_action( 'after_setup_theme', 'spl_register_nav_menus', 11 );
function spl_register_nav_menus(): void {
	register_nav_menus( [
		'main-nav'   => __( 'Primary Menu', 'spl' ),
		'mobile-nav' => __( 'Mobile Menu', 'spl' ),
		'about-nav'  => __( 'Footer About Menu', 'spl' ),
		'policy-nav' => __( 'Footer Support Menu', 'spl' ),
	] );
}

/**
 * Universal safe helper to get image URL from ACF ID, Array, or String
 */
function spl_get_image_url( mixed $value, string $fallback = '' ): string {
	if ( empty( $value ) ) {
		return $fallback;
	}
	if ( is_numeric( $value ) ) {
		$url = wp_get_attachment_url( (int) $value );
		return $url ? $url : $fallback;
	}
	if ( is_array( $value ) ) {
		return ! empty( $value['url'] ) ? (string) $value['url'] : $fallback;
	}
	if ( is_string( $value ) ) {
		return $value;
	}
	return $fallback;
}

// --------------------------------------------------
// Enqueue Unila Core Assets
// --------------------------------------------------

add_action( 'wp_enqueue_scripts', 'spl_enqueue_unila_assets', 20 );
function spl_enqueue_unila_assets(): void {
	if ( is_admin() ) {
		return;
	}

	$ver = (string) ( file_exists( get_template_directory() . '/static/css/unila-main.css' ) ? filemtime( get_template_directory() . '/static/css/unila-main.css' ) : time() );
	$dir = get_template_directory_uri() . '/static';

	// Unila Core CSS — global.min.css (reset, grid, typography, header, footer).
	wp_enqueue_style( 'unila-global', $dir . '/css/unila-global.css', [], $ver );

	// Unila Page CSS — main.min.css (home sections, banners, sliders, cards, etc.).
	wp_enqueue_style( 'unila-main', $dir . '/css/unila-main.css', [ 'unila-global' ], $ver );

	// Unila Core JS — global.min.js (jQuery + Swiper + animations).
	wp_enqueue_script( 'unila-global-js', $dir . '/js/unila-global.js', [], $ver, true );

	// Unila Page JS — main.min.js (header, slider, search, mobile menu interactions).
	wp_enqueue_script( 'unila-main-js', $dir . '/js/unila-main.js', [ 'unila-global-js' ], $ver, true );
}

// Dequeue conflicting HD theme assets on Unila-style pages.
add_action( 'wp_enqueue_scripts', 'spl_dequeue_conflicting_assets', 999 );
add_action( 'wp_print_styles', 'spl_dequeue_conflicting_assets', 999 );
function spl_dequeue_conflicting_assets(): void {
	// Never dequeue inside the Customizer preview iframe so WP Customizer can handshake.
	if ( is_customize_preview() ) {
		return;
	}

	// Theme compiled CSS conflicts with Unila grid/layout/typography.
	foreach ( [ 'index-css', 'share-css', 'page-css', 'woocommerce-css' ] as $h ) {
		wp_dequeue_style( $h );
		wp_deregister_style( $h );
	}

	// Theme JS + WP jQuery — Unila global.js bundles jQuery 3.7.1 already.
	// Two jQuery instances cause conflicts ($ undefined, event binding issues).
	foreach ( [ 'jquery-core', 'jquery', 'jquery-migrate', 'index-js', 'home-js', 'preflight-js', 'dxd-js' ] as $h ) {
		wp_dequeue_script( $h );
		wp_deregister_script( $h );
	}
}



// --------------------------------------------------
// Main nav fallback (when no menu assigned to main-nav)
// --------------------------------------------------

/**
 * Render a basic navigation when the "main-nav" location has no menu.
 *
 * Outputs <li><a> items (matches wp_nav_menu items_wrap '%3$s') linking to
 * the key site pages, so the header is never empty.
 *
 * @return void
 */
function spl_main_nav_fallback(): void {
	$items = [
		[ home_url( '/' ), __( 'Trang Chủ', 'spl' ) ],
	];

	$shop_id = function_exists( 'wc_get_page_id' ) ? wc_get_page_id( 'shop' ) : 0;
	if ( $shop_id > 0 ) {
		$items[] = [ get_permalink( $shop_id ), __( 'Cửa Hàng', 'spl' ) ];
	}

	$pages = [
		'gioi-thieu'     => __( 'Giới Thiệu', 'spl' ),
		'co-hoi-hop-tac' => __( 'Hợp Tác', 'spl' ),
		'tin-tuc'        => __( 'Tin Tức', 'spl' ),
		'lien-he'        => __( 'Liên Hệ', 'spl' ),
	];
	foreach ( $pages as $slug => $label ) {
		$page = get_page_by_path( $slug );
		if ( $page ) {
			$items[] = [ get_permalink( $page ), $label ];
		}
	}

	foreach ( $items as [ $url, $label ] ) {
		printf(
			'<li class="menu-item"><a href="%s">%s</a></li>',
			esc_url( $url ),
			esc_html( $label )
		);
	}
}

// --------------------------------------------------
// ACF Options Page
// --------------------------------------------------

add_action( 'acf/init', 'spl_register_acf_options_page' );
function spl_register_acf_options_page(): void {
	if ( ! function_exists( 'acf_add_options_page' ) ) {
		return;
	}

	acf_add_options_page( [
		'page_title' => __( 'Tùy Chọn Theme', 'spl' ),
		'menu_title' => __( 'Tùy Chọn', 'spl' ),
		'menu_slug'  => 'acf-options',
		'capability' => 'edit_posts',
		'redirect'   => false,
		'icon_url'   => 'dashicons-admin-generic',
		'position'   => 2,
	] );
}

// Always grant upload_files capability for any logged in user in admin to prevent wp_enqueue_media bail.
add_filter( 'user_has_cap', function ( $allcaps, $caps = [], $args = [], $user = null ) {
	if ( is_array( $allcaps ) && ( is_admin() || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) ) {
		$allcaps['upload_files'] = true;
	}
	return $allcaps;
}, 1, 4 );

add_action( 'admin_enqueue_scripts', 'spl_enqueue_all_admin_media', 20 );
add_action( 'acf/input/admin_enqueue_scripts', 'spl_enqueue_all_admin_media', 20 );
function spl_enqueue_all_admin_media(): void {
	if ( function_exists( 'wp_enqueue_media' ) ) {
		global $post;
		$post_id = 0;
		if ( isset( $post ) && $post instanceof WP_Post ) {
			$post_id = (int) $post->ID;
		} elseif ( isset( $_GET['post'] ) ) {
			$post_id = (int) $_GET['post'];
		}
		if ( $post_id > 0 ) {
			wp_enqueue_media( [ 'post' => $post_id ] );
		} else {
			wp_enqueue_media();
		}
	}
}

add_action( 'admin_head', 'spl_print_admin_media_scripts', 20 );
function spl_print_admin_media_scripts(): void {
	if ( ! is_admin() || ! function_exists( 'wp_enqueue_media' ) ) {
		return;
	}

	global $post;
	$post_id = 0;
	if ( isset( $post ) && $post instanceof WP_Post ) {
		$post_id = (int) $post->ID;
	} elseif ( isset( $_GET['post'] ) ) {
		$post_id = (int) $_GET['post'];
	}

	if ( $post_id > 0 ) {
		wp_enqueue_media( [ 'post' => $post_id ] );
	} else {
		wp_enqueue_media();
	}

	// Output core media styles and scripts in head so window.wp.media is immediately available.
	// wp_print_scripts marks handles done, preventing footer duplication.
	wp_print_styles( [ 'media-views', 'imgareaselect' ] );
	wp_print_scripts( [ 'media-editor', 'media-views', 'media-models', 'media-audiovideo', 'mce-view', 'image-edit' ] );
	?>
	<script>
	(function() {
		window.wp = window.wp || {};
		window.wp.media = window.wp.media || function() {};

		// Polyfill wp.media.mixin to prevent "Cannot read properties of undefined (reading 'removeAllPlayers')" in media-views.js
		window.wp.media.mixin = window.wp.media.mixin || {
			mejsSettings: window._wpmejsSettings || {},
			removeAllPlayers: function() {
				if (window.mejs && window.mejs.players) {
					for (var e in window.mejs.players) {
						try {
							window.mejs.players[e].pause();
							this.removePlayer(window.mejs.players[e]);
						} catch (err) {}
					}
				}
			},
			removePlayer: function(e) {
				if (!e) return;
				try {
					if (window.mejs && window.mejs.players && e.id) {
						delete window.mejs.players[e.id];
					}
					if (e.container && typeof e.container.remove === 'function') {
						e.container.remove();
					}
				} catch (err) {}
			},
			unsetPlayers: function() {
				this.players = [];
			}
		};
		window.MediaElementPlayer = window.MediaElementPlayer || function() {};

		window._wpMediaViewsL10n = window._wpMediaViewsL10n || {};
		window._wpMediaViewsL10n.settings = window._wpMediaViewsL10n.settings || {};
		if (!window._wpMediaViewsL10n.settings.post) {
			window._wpMediaViewsL10n.settings.post = {
				id: <?php echo (int) $post_id; ?>,
				featuredImageId: <?php echo (int) ( $post_id ? ( get_post_thumbnail_id( $post_id ) ?: 0 ) : 0 ); ?>,
				nonce: '<?php echo $post_id ? esc_js( wp_create_nonce( 'update-post_' . $post_id ) ) : ''; ?>'
			};
		}

		function syncMediaSettings() {
			if (window.wp && window.wp.media && window.wp.media.view && window.wp.media.view.settings) {
				window.wp.media.view.settings.post = window.wp.media.view.settings.post || window._wpMediaViewsL10n.settings.post;
				if (window.wp.media.model && window.wp.media.model.settings) {
					window.wp.media.model.settings.post = window.wp.media.model.settings.post || window.wp.media.view.settings.post;
				}
			}
		}
		syncMediaSettings();
		if (document.readyState === 'loading') {
			document.addEventListener('DOMContentLoaded', syncMediaSettings);
		}

		// Safeguard ACF media popup when Add Image is clicked
		if (typeof window.acf !== 'undefined' && !window.acf._safeMediaWrapped) {
			window.acf._safeMediaWrapped = true;
			var origNewMediaPopup = window.acf.newMediaPopup;
			if (typeof origNewMediaPopup === 'function') {
				window.acf.newMediaPopup = function(options) {
					syncMediaSettings();
					if (!window.wp || !window.wp.media || typeof window.wp.media.query !== 'function') {
						console.warn('[ACF Media Safeguard] wp.media.query not ready, falling back to native wp.media frame.');
						if (window.wp && typeof window.wp.media === 'function') {
							var frame = window.wp.media({
								title: (options && options.title) || 'Chọn hình ảnh',
								button: { text: (options && options.button && options.button.text) || 'Chọn ảnh' },
								multiple: (options && options.multiple) || false,
								library: { type: (options && options.type) || 'image' }
							});
							if (options && typeof options.select === 'function') {
								frame.on('select', function() {
									options.select(frame.state().get('selection'));
								});
							}
							return frame;
						}
					}
					return origNewMediaPopup.apply(this, arguments);
				};
			}
		}
	})();
	</script>
	<?php
}

add_action( 'admin_footer', function (): void {
	if ( function_exists( 'wp_print_media_templates' ) && ! did_action( 'wp_print_media_templates' ) ) {
		wp_print_media_templates();
	}
}, 1 );

// Diagnostics for footer execution
add_action( 'admin_footer', function (): void {
	@file_put_contents( WP_CONTENT_DIR . '/uploads/admin_debug.txt', "[" . gmdate( 'Y-m-d H:i:s' ) . "] admin_footer 25 reached on " . ( $_SERVER['REQUEST_URI'] ?? '' ) . "\n", FILE_APPEND );
}, 25 );

add_action( 'admin_print_footer_scripts', function (): void {
	@file_put_contents( WP_CONTENT_DIR . '/uploads/admin_debug.txt', "[" . gmdate( 'Y-m-d H:i:s' ) . "] admin_print_footer_scripts 999 reached\n", FILE_APPEND );
}, 999 );

add_action( 'shutdown', function (): void {
	$err = error_get_last();
	$msg = "[" . gmdate( 'Y-m-d H:i:s' ) . "] shutdown reached. Peak RAM: " . round( memory_get_peak_usage() / 1024 / 1024, 2 ) . " MB\n";
	if ( $err && in_array( $err['type'], [ E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR, E_USER_ERROR, E_RECOVERABLE_ERROR ], true ) ) {
		$msg .= sprintf( "FATAL: %s in %s:%d\n", $err['message'], $err['file'], $err['line'] );
	}
	@file_put_contents( WP_CONTENT_DIR . '/uploads/admin_debug.txt', $msg, FILE_APPEND );
}, 9999 );

add_filter( 'media_view_settings', function ( $settings, $post ) {
	if ( ! is_array( $settings ) ) {
		$settings = [];
	}
	if ( empty( $settings['post']['id'] ) ) {
		$post_id = 0;
		if ( $post instanceof WP_Post ) {
			$post_id = (int) $post->ID;
		} elseif ( ! empty( $GLOBALS['post']->ID ) ) {
			$post_id = (int) $GLOBALS['post']->ID;
		} elseif ( isset( $_GET['post'] ) ) {
			$post_id = (int) $_GET['post'];
		}
		if ( $post_id > 0 ) {
			$settings['post'] = [
				'id'              => $post_id,
				'nonce'           => wp_create_nonce( 'update-post_' . $post_id ),
				'featuredImageId' => (int) get_post_thumbnail_id( $post_id ),
			];
		}
	}
	return $settings;
}, 10, 2 );

add_filter( 'ajax_query_attachments_args', function ( $query ) {
	if ( is_array( $query ) ) {
		$query['lang'] = ''; // Polylang: do not restrict media library query by language
	}
	return $query;
}, 9999 );


add_action( 'acf/init', 'spl_register_bottom_nav_acf_fields' );
function spl_register_bottom_nav_acf_fields(): void {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( [
		'key'    => 'group_mobile_bottom_nav_options',
		'title'  => __( 'Cấu hình Bottom Nav Mobile', 'spl' ),
		'fields' => [
			[
				'key'           => 'field_bottom_nav_categories',
				'label'         => __( 'Danh mục sản phẩm hiển thị', 'spl' ),
				'name'          => 'bottom_nav_categories',
				'type'          => 'taxonomy',
				'taxonomy'      => 'product_cat',
				'field_type'    => 'multi_select',
				'allow_null'    => 1,
				'add_term'      => 0,
				'save_terms'    => 0,
				'load_terms'    => 0,
				'return_format' => 'object',
				'instructions'  => __( 'Chọn các danh mục sản phẩm cha muốn hiển thị trong slide panel di động. Bỏ trống để hiển thị tất cả.', 'spl' ),
			],
			[
				'key'           => 'field_bottom_nav_news_categories',
				'label'         => __( 'Danh mục tin tức hiển thị', 'spl' ),
				'name'          => 'bottom_nav_news_categories',
				'type'          => 'taxonomy',
				'taxonomy'      => 'category',
				'field_type'    => 'multi_select',
				'allow_null'    => 1,
				'add_term'      => 0,
				'save_terms'    => 0,
				'load_terms'    => 0,
				'return_format' => 'object',
				'instructions'  => __( 'Chọn các danh mục tin tức muốn hiển thị trong slide panel di động. Bỏ trống để hiển thị tất cả.', 'spl' ),
			],
		],
		'location' => [
			[
				[
					'param'    => 'options_page',
					'operator' => '==',
					'value'    => 'acf-options',
				],
			],
		],
	] );
}

// --------------------------------------------------
// Register Polylang Theme Strings
// --------------------------------------------------

add_action( 'init', 'spl_register_polylang_theme_strings' );
function spl_register_polylang_theme_strings(): void {
	if ( ! function_exists( 'pll_register_string' ) ) {
		return;
	}

	$strings = [
		'TÂM THẾ CỘNG SỰ'   => 'Header Nav Item 1',
		'Sản phẩm'          => 'Header Nav Item 2',
		'HỆ THỐNG R&D'      => 'Header Nav Item 3',
		'Tin tức'           => 'Header Nav Item 4',
		'Liên hệ'           => 'Header Nav Item 5',
		'Trang chủ'         => 'Breadcrumb Home',
		'Gửi yêu cầu'       => 'Button Submit',
		'Liên kết nhanh'    => 'Footer Title 1',
		'Danh mục sản phẩm' => 'Footer Title 2',
		'Mạng xã hội'       => 'Footer Title 3',
		'Chính sách bảo mật' => 'Footer Title 4',
	];

	foreach ( $strings as $str => $label ) {
		pll_register_string( $label, $str, 'VINACOS Theme' );
	}
}

// --------------------------------------------------
// Dynamic Domain Replacer (replaces vinacos.test with current HTTP host)
// --------------------------------------------------

/**
 * Dynamically replace dev domain (vinacos.test) with current request domain.
 *
 * @param mixed $url
 * @return mixed
 */
function spl_fix_dynamic_url( mixed $url ): mixed {
	if ( empty( $url ) || ! is_string( $url ) ) {
		return $url;
	}

	$host = $_SERVER['HTTP_HOST'] ?? '';
	if ( ! $host ) {
		return $url;
	}

	$is_https = is_ssl() || ( isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && 'https' === $_SERVER['HTTP_X_FORWARDED_PROTO'] );
	$scheme   = $is_https ? 'https://' : 'http://';
	$target   = rtrim( $scheme . $host, '/' );

	// Replace http(s)://vinacos.test:port with current scheme + host.
	$url = preg_replace( '#https?://vinacos\.test(?::\d+)?#i', $target, $url );

	// Replace standalone vinacos.test host.
	$url = str_ireplace( 'vinacos.test', $host, $url );

	return $url;
}

/**
 * Resolves valid local image URL with static fallback for missing/unila upload links.
 *
 * @param mixed  $url               Original image value.
 * @param string $default_fallback Default fallback static image relative to theme root.
 * @return string Valid image URL.
 */
function spl_get_valid_image_url( mixed $url, string $default_fallback = '' ): string {
	$theme_uri = get_template_directory_uri();
	$fallback  = $default_fallback ? $theme_uri . '/' . ltrim( $default_fallback, '/' ) : $theme_uri . '/static/img/tam-the-cong-su-vinacos.jpg';

	if ( empty( $url ) ) {
		return $fallback;
	}

	if ( is_numeric( $url ) ) {
		$attached_url = wp_get_attachment_url( (int) $url );
		if ( $attached_url ) {
			return $attached_url;
		}
		return $fallback;
	}

	if ( is_array( $url ) ) {
		$url = $url['url'] ?? '';
	}

	if ( empty( $url ) || ! is_string( $url ) ) {
		return $fallback;
	}

	if ( false !== strpos( $url, 'unila.com.vn' ) ) {
		return $fallback;
	}

	return $url;
}

add_filter( 'home_url', 'spl_fix_dynamic_url', 9999 );
add_filter( 'site_url', 'spl_fix_dynamic_url', 9999 );
add_filter( 'pll_home_url', 'spl_fix_dynamic_url', 9999 );
add_filter( 'pll_translation_url', 'spl_fix_dynamic_url', 9999 );
add_filter( 'pll_check_canonical_url', 'spl_fix_dynamic_url', 9999 );
add_filter( 'wp_redirect', 'spl_fix_dynamic_url', 9999 );
add_filter( 'redirect_canonical', 'spl_fix_dynamic_url', 9999 );
add_filter( 'post_link', 'spl_fix_dynamic_url', 9999 );
add_filter( 'page_link', 'spl_fix_dynamic_url', 9999 );
add_filter( 'post_type_link', 'spl_fix_dynamic_url', 9999 );
add_filter( 'term_link', 'spl_fix_dynamic_url', 9999 );
add_filter( 'wp_nav_menu_items', 'spl_fix_dynamic_url', 9999 );
add_filter( 'option_siteurl', 'spl_fix_dynamic_url', 9999 );
add_filter( 'option_home', 'spl_fix_dynamic_url', 9999 );

add_filter( 'allowed_redirect_hosts', function( $hosts ) {
	if ( ! empty( $_SERVER['HTTP_HOST'] ) ) {
		$hosts[] = $_SERVER['HTTP_HOST'];
	}
	return $hosts;
}, 9999 );

add_filter( 'option_polylang', function( $opt ) {
	if ( is_array( $opt ) ) {
		array_walk_recursive( $opt, function( &$val ) {
			if ( is_string( $val ) && false !== stripos( $val, 'vinacos.test' ) ) {
				$val = spl_fix_dynamic_url( $val );
			}
		} );
	}
	return $opt;
}, 9999 );

add_filter( 'pll_the_languages', function( $langs ) {
	if ( is_array( $langs ) ) {
		foreach ( $langs as $k => $lang ) {
			if ( is_array( $lang ) && isset( $lang['url'] ) ) {
				$langs[ $k ]['url'] = spl_fix_dynamic_url( $lang['url'] );
			}
		}
	}
	return $langs;
}, 9999 );

add_filter( 'acf/format_value/type=url', 'spl_fix_dynamic_url', 9999 );
add_filter( 'acf/format_value/type=link', function( $value ) {
	if ( is_array( $value ) && ! empty( $value['url'] ) ) {
		$value['url'] = spl_fix_dynamic_url( $value['url'] );
	}
	return $value;
}, 9999 );

require_once __DIR__ . '/acf-page-fields.php';



