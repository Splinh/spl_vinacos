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

// --------------------------------------------------
// Enqueue Unila Core Assets
// --------------------------------------------------

add_action( 'wp_enqueue_scripts', 'spl_enqueue_unila_assets', 20 );
function spl_enqueue_unila_assets(): void {
	if ( is_admin() ) {
		return;
	}

	$ver = '1.1.2';
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
		wp_enqueue_media();
	}
	if ( function_exists( 'wp_enqueue_script' ) ) {
		wp_enqueue_script( 'media-editor' );
		wp_enqueue_script( 'media-views' );
		wp_enqueue_script( 'media-models' );
		wp_enqueue_script( 'wp-plupload' );
	}
	if ( function_exists( 'wp_enqueue_style' ) ) {
		wp_enqueue_style( 'media-views' );
	}
}

add_action( 'admin_footer', function (): void {
	$screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;
	if ( $screen && str_contains( (string) $screen->id, 'acf-options' ) ) {
		if ( function_exists( 'wp_print_media_templates' ) ) {
			wp_print_media_templates();
		}
	}
}, 999 );

add_action( 'admin_head', function (): void {
	$inc_js = includes_url( 'js/' );
	?>
	<script>
	(function() {
		var incJsUrl = <?php echo wp_json_encode( $inc_js ); ?>;

		function ensureMediaReady(callback) {
			if (typeof window.wp !== 'undefined' && typeof window.wp.media === 'function') {
				callback();
				return;
			}

			var scripts = [
				incJsUrl + 'wp-backbone.min.js',
				incJsUrl + 'media-models.min.js',
				incJsUrl + 'plupload/wp-plupload.min.js',
				incJsUrl + 'media-views.min.js',
				incJsUrl + 'media-editor.min.js'
			];

			var loadNext = function(idx) {
				if (idx >= scripts.length) {
					if (typeof window.wp !== 'undefined' && typeof window.wp.media === 'function') {
						callback();
					} else {
						alert('Đang kết nối thư viện ảnh, vui lòng bấm lại lần nữa.');
					}
					return;
				}

				var existing = document.querySelector('script[src*="' + scripts[idx].split('/').pop() + '"]');
				if (existing && typeof window.wp !== 'undefined' && typeof window.wp.media === 'function') {
					loadNext(idx + 1);
					return;
				}

				var s = document.createElement('script');
				s.src = scripts[idx];
				s.async = false;
				s.onload = function() { loadNext(idx + 1); };
				s.onerror = function() { loadNext(idx + 1); };
				(document.head || document.documentElement).appendChild(s);
			};

			loadNext(0);
		}

		// Helper to dynamically open WP Media Frame
		function triggerMediaUpload(uploader) {
			ensureMediaReady(function() {
				var frame = window.wp.media({
					title: 'Chọn hoặc tải ảnh lên',
					button: { text: 'Sử dụng ảnh này' },
					multiple: false,
					library: { type: 'image' }
				});

				frame.on('select', function() {
					var selection = frame.state().get('selection').first();
					if (!selection) return;
					var attachment = selection.toJSON();

					var input = uploader.querySelector('input[type="hidden"]');
					var img = uploader.querySelector('img[data-name="image"]');
					var view = uploader.querySelector('.view, .image-wrap');

					if (input) {
						input.value = attachment.id;
						if (window.jQuery) {
							window.jQuery(input).trigger('change');
						}
					}

					var displayUrl = (attachment.sizes && attachment.sizes.thumbnail) ? attachment.sizes.thumbnail.url : (attachment.sizes && attachment.sizes.medium ? attachment.sizes.medium.url : attachment.url);

					if (img) {
						img.src = displayUrl;
						img.style.display = '';
					} else if (view) {
						view.innerHTML = '<img data-name="image" src="' + displayUrl + '" alt="" style="max-width:100%;height:auto;" />';
					}

					uploader.classList.add('has-value');

					if (typeof window.acf !== 'undefined' && window.acf.getField) {
						var fieldElem = uploader.closest('.acf-field');
						if (fieldElem) {
							var fieldObj = window.acf.getField(fieldElem);
							if (fieldObj) {
								fieldObj.val(attachment.id);
							}
						}
					}
				});

				frame.open();
			});
		}

		// 1. Direct Capture Click Handler for ACF Image Field Upload
		document.addEventListener('click', function(e) {
			var addBtn = e.target.closest(
				'.acf-field-image [data-name="add"], .acf-field-image .button, .acf-image-uploader [data-name="add"], .acf-image-uploader .button, .acf-uploader [data-name="add"], .acf-uploader input[type="button"]'
			);
			if (!addBtn) return;

			var uploader = addBtn.closest('.acf-image-uploader, .acf-uploader');
			if (!uploader) return;

			if (e.target.closest('[data-name="remove"]') || e.target.closest('[data-name="edit"]')) return;

			e.preventDefault();
			e.stopImmediatePropagation();

			triggerMediaUpload(uploader);
		}, true);

		// 2. Direct Capture Click Handler for ACF Image Field Remove
		document.addEventListener('click', function(e) {
			var removeBtn = e.target.closest(
				'.acf-field-image [data-name="remove"], .acf-image-uploader [data-name="remove"], .acf-uploader [data-name="remove"]'
			);
			if (!removeBtn) return;

			var uploader = removeBtn.closest('.acf-image-uploader, .acf-uploader');
			if (!uploader) return;

			e.preventDefault();
			e.stopImmediatePropagation();

			var input = uploader.querySelector('input[type="hidden"]');
			var img = uploader.querySelector('img[data-name="image"]');

			if (input) {
				input.value = '';
				if (window.jQuery) {
					window.jQuery(input).trigger('change');
				}
			}

			if (img) {
				img.src = '';
				img.style.display = 'none';
			}

			uploader.classList.remove('has-value');

			if (typeof window.acf !== 'undefined' && window.acf.getField) {
				var fieldElem = uploader.closest('.acf-field');
				if (fieldElem) {
					var fieldObj = window.acf.getField(fieldElem);
					if (fieldObj) {
						fieldObj.val('');
					}
				}
			}
		}, true);
	})();
	</script>
	<?php
}, 99 );

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
	$fallback = $default_fallback ? get_template_directory_uri() . '/' . ltrim( $default_fallback, '/' ) : get_template_directory_uri() . '/static/img/vinacos/rd-lab-main.jpg';

	if ( empty( $url ) ) {
		return $fallback;
	}

	if ( is_array( $url ) ) {
		$url = $url['url'] ?? '';
	} elseif ( is_numeric( $url ) ) {
		$url = wp_get_attachment_url( (int) $url );
	}

	if ( empty( $url ) || ! is_string( $url ) ) {
		return $fallback;
	}

	if ( false !== strpos( $url, 'unila.com.vn' ) ) {
		return $fallback;
	}

	if ( false !== strpos( $url, 'uploads/' ) ) {
		$parsed_path = parse_url( $url, PHP_URL_PATH );
		if ( $parsed_path ) {
			$abs_path = ABSPATH . ltrim( $parsed_path, '/' );
			if ( ! file_exists( $abs_path ) ) {
				return $fallback;
			}
		}
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


