<?php
/**
 * PLL Module Settings — Admin tab under Polylang settings.
 *
 * Adds a "SPL Polylang" tab to Languages > Settings with:
 * - Pro feature toggles (TranslateSlugs, DuplicateContent, ShareSlugs, LocaleFallback).
 * - Translation scanner settings (theme/plugin/domain selection).
 * - Translation Import/Export (CSV, PO, XLIFF 2.1).
 * - Modern HD Extended dashboard UI layout.
 *
 * @package SPL\Modules\PLL\Admin
 */

declare(strict_types=1);

namespace SPL\Modules\PLL\Admin;

use SPL\Core\Helper;
use SPL\Modules\PLL\PLLModule;
use SPL\Modules\PLL\ImportExport\FileFormatFactory;
use SPL\Modules\PLL\Translation\Scanner as TranslationSettings;

defined( 'ABSPATH' ) || exit;

final class PLLSettings {

	private const NONCE_ACTION = 'hd_pll_settings_save';
	private const NONCE_FIELD  = '_hd_pll_nonce';
	private const TAB_SLUG     = 'hd_pll';

	/**
	 * Register hooks.
	 */
	public static function init(): void {
		add_filter( 'pll_settings_tabs', [ self::class, 'addTab' ] );
		add_action( 'pll_settings_active_tab_' . self::TAB_SLUG, [ self::class, 'renderTab' ] );
		add_action( 'admin_init', [ PLLSettingsSave::class, 'handle' ] );
		add_action( 'admin_enqueue_scripts', [ self::class, 'enqueueAssets' ] );

		AiSettingsSection::init();

		// Override Polylang Free's preview modules when HD Pro features are active.
		add_filter( 'pll_settings_modules', [ self::class, 'overridePreviewModules' ], 20 );
	}

	/**
	 * Enqueue admin styles.
	 *
	 * @param string $hook Page hook.
	 */
	public static function enqueueAssets( string $hook ): void {
		if ( false === strpos( $hook, 'mlang' ) ) {
			return;
		}

		wp_enqueue_style(
			'hd-pll-admin-css',
			get_template_directory_uri() . '/src/Modules/PLL/Admin/assets/admin-pll.css',
			[],
			'1.0.0'
		);
	}

	/**
	 * Replace Polylang Free's "preview" settings modules with activated
	 * versions when HD PLL Pro features are enabled.
	 *
	 * @param string[] $modules Settings module class names.
	 *
	 * @return string[]
	 */
	public static function overridePreviewModules( array $modules ): array {
		if ( PLLModule::isProActive() ) {
			return $modules; // Polylang Pro handles its own modules.
		}

		$settings     = PLLModule::getCachedOptions();
		$replacements = [];

		if ( ! empty( $settings['share_slugs'] ) ) {
			$replacements['PLL_Settings_Preview_Share_Slug'] = HD_PLL_Settings_Share_Slug::class;
		}

		if ( ! empty( $settings['translate_slugs'] ) ) {
			$replacements['PLL_Settings_Preview_Translate_Slugs'] = HD_PLL_Settings_Translate_Slugs::class;
		}

		if ( empty( $replacements ) ) {
			return $modules;
		}

		foreach ( $modules as &$class ) {
			if ( isset( $replacements[ $class ] ) ) {
				$class = $replacements[ $class ];
			}
		}

		return $modules;
	}

	/**
	 * Add "SPL Polylang" tab to Polylang Settings.
	 *
	 * @param array<string, string> $tabs Existing tabs.
	 *
	 * @return array<string, string>
	 */
	public static function addTab( array $tabs ): array {
		$tabs[ self::TAB_SLUG ] = __( 'SPL Polylang', 'spl' );

		return $tabs;
	}

	/**
	 * Render the settings tab content.
	 */
	public static function renderTab(): void {
		$pll_settings   = PLLModule::getCachedOptions();
		$trans_settings = TranslationSettings::getSettings();
		$pro_features   = self::getProFeatureLabels();
		$themes         = self::getAvailableThemes();
		$plugins        = self::getAvailablePlugins();
		$show_pro       = ! PLLModule::isProActive();
		$show_ttfp      = ! PLLModule::isTTfPActive();
		$show_wc        = Helper::isWoocommerceActive() && ! PLLModule::isWCActive();

		$feature_descriptions = [
			'translate_slugs'   => __( 'Translate URL slugs for custom post types and taxonomies per language.', 'spl' ),
			'duplicate_content' => __( 'Automatically copy title, content, media, and meta fields when creating a new translation.', 'spl' ),
			'share_slugs'       => __( 'Allow posts of different languages to share the identical URL slug across post types.', 'spl' ),
			'locale_fallback'   => __( 'Fall back to default language content when a translation does not exist for a requested locale.', 'spl' ),
		];

		// Flash messages.
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended
		$msg = sanitize_key( $_GET['hd_pll_msg'] ?? '' );
		if ( $msg ) {
			$messages = [
				'saved'        => __( 'Settings saved.', 'spl' ),
				'imported'     => sprintf(
					/* translators: %d: number of imported items */
					__( 'Translations imported: %d items.', 'spl' ),
					absint( $_GET['hd_pll_count'] ?? 0 ) // phpcs:ignore WordPress.Security.NonceVerification.Recommended
				),
				'export_error' => sanitize_text_field( $_GET['hd_pll_error'] ?? '' ), // phpcs:ignore WordPress.Security.NonceVerification.Recommended
				'import_error' => sanitize_text_field( $_GET['hd_pll_error'] ?? '' ), // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			];
			if ( isset( $messages[ $msg ] ) && '' !== $messages[ $msg ] ) {
				$noticeType = in_array( $msg, [ 'export_error', 'import_error' ], true ) ? 'error' : 'success';
				printf( '<div class="notice notice-%s is-dismissible" style="margin-top:15px;"><p>%s</p></div>', esc_attr( $noticeType ), esc_html( $messages[ $msg ] ) );
			}
		}

		?>
		<div class="hde-wrap">
			<!-- Top Header Subnav Toolbar -->
			<div class="hde-top-bar">
				<div class="hde-brand-badge">
					<span class="hde-brand-logo">SPL</span>
					<span>Extended</span>
				</div>
				<nav class="hde-nav-tabs">
					<a href="<?php echo esc_url( admin_url( 'admin.php?page=mlang' ) ); ?>" class="hde-tab-item">
						<span class="dashicons dashicons-dashboard"></span>
						<span>Dashboard</span>
					</a>
					<a href="<?php echo esc_url( admin_url( 'admin.php?page=mlang_hd_pll' ) ); ?>" class="hde-tab-item active">
						<span class="dashicons dashicons-translation"></span>
						<span>Polylang</span>
					</a>
					<a href="<?php echo esc_url( admin_url( 'admin.php?page=hd-form-entries' ) ); ?>" class="hde-tab-item">
						<span class="dashicons dashicons-feedback"></span>
						<span>Form</span>
					</a>
					<a href="<?php echo esc_url( admin_url( 'edit.php' ) ); ?>" class="hde-tab-item">
						<span class="dashicons dashicons-visibility"></span>
						<span>Post Views</span>
					</a>
					<a href="<?php echo esc_url( admin_url( 'admin.php?page=hd-form-settings' ) ); ?>" class="hde-tab-item">
						<span class="dashicons dashicons-admin-generic"></span>
						<span>Settings</span>
					</a>
				</nav>
			</div>

			<form method="post" action="">
				<?php wp_nonce_field( self::NONCE_ACTION, self::NONCE_FIELD ); ?>
				<input type="hidden" name="hd_pll_save" value="1">

				<!-- Page Header -->
				<div class="hde-page-header">
					<div class="hde-header-info">
						<h1><?php esc_html_e( 'Polylang Multilingual Management', 'spl' ); ?></h1>
						<p><?php esc_html_e( 'Orchestrate Pro features, AI translation engine, WooCommerce, ACF, and string translation.', 'spl' ); ?></p>
					</div>
					<button type="submit" class="button hde-save-btn">
						<?php esc_html_e( 'Save Settings', 'spl' ); ?>
					</button>
				</div>

				<?php if ( $show_wc ) : ?>
				<div class="notice notice-success inline" style="margin: 0 0 20px 0; border-radius: 8px;">
					<p><span class="dashicons dashicons-yes-alt" style="color: #00a32a;"></span> <strong><?php esc_html_e( 'WooCommerce Integration Active', 'spl' ); ?>:</strong> <?php esc_html_e( 'Native translation support for products and emails is running automatically.', 'spl' ); ?></p>
				</div>
				<?php endif; ?>

				<!-- Section 1: Pro Features & Sub-System Integration -->
				<div class="hde-section">
					<div class="hde-section-header">
						<h2 class="hde-section-title"><?php esc_html_e( 'Pro Features & Sub-System Integration', 'spl' ); ?></h2>
						<p class="hde-section-desc"><?php esc_html_e( 'Configure Polylang Pro feature emulation, URL slug translation, duplicate content settings, and automatic native integrations.', 'spl' ); ?></p>
					</div>

					<div class="hde-grid-3">
						<!-- Card 1: Translate Slugs -->
						<div class="hde-card">
							<div>
								<div class="hde-card-top">
									<h3 class="hde-card-title"><?php esc_html_e( 'Translate Slugs', 'spl' ); ?></h3>
									<label class="hde-switch">
										<input type="checkbox" name="hd_pll_features[translate_slugs]" value="1" <?php checked( ! empty( $pll_settings['translate_slugs'] ) ); ?>>
										<span class="hde-slider"></span>
									</label>
								</div>
								<p class="hde-card-desc"><?php echo esc_html( $feature_descriptions['translate_slugs'] ); ?></p>
							</div>
							<div class="hde-card-bottom">
								<span class="hde-badge hde-badge-pro">SPL PRO FEATURE</span>
							</div>
						</div>

						<!-- Card 2: Duplicate Content -->
						<div class="hde-card">
							<div>
								<div class="hde-card-top">
									<h3 class="hde-card-title"><?php esc_html_e( 'Duplicate Content', 'spl' ); ?></h3>
									<label class="hde-switch">
										<input type="checkbox" name="hd_pll_features[duplicate_content]" value="1" <?php checked( ! empty( $pll_settings['duplicate_content'] ) ); ?>>
										<span class="hde-slider"></span>
									</label>
								</div>
								<p class="hde-card-desc"><?php echo esc_html( $feature_descriptions['duplicate_content'] ); ?></p>
							</div>
							<div class="hde-card-bottom">
								<span class="hde-badge hde-badge-pro">SPL PRO FEATURE</span>
							</div>
						</div>

						<!-- Card 3: Share Slugs -->
						<div class="hde-card">
							<div>
								<div class="hde-card-top">
									<h3 class="hde-card-title"><?php esc_html_e( 'Share Slugs', 'spl' ); ?></h3>
									<label class="hde-switch">
										<input type="checkbox" name="hd_pll_features[share_slugs]" value="1" <?php checked( ! empty( $pll_settings['share_slugs'] ) ); ?>>
										<span class="hde-slider"></span>
									</label>
								</div>
								<p class="hde-card-desc"><?php echo esc_html( $feature_descriptions['share_slugs'] ); ?></p>
							</div>
							<div class="hde-card-bottom">
								<span class="hde-badge hde-badge-pro">SPL PRO FEATURE</span>
							</div>
						</div>

						<!-- Card 4: Locale Fallback -->
						<div class="hde-card">
							<div>
								<div class="hde-card-top">
									<h3 class="hde-card-title"><?php esc_html_e( 'Locale Fallback', 'spl' ); ?></h3>
									<label class="hde-switch">
										<input type="checkbox" name="hd_pll_features[locale_fallback]" value="1" <?php checked( ! empty( $pll_settings['locale_fallback'] ) ); ?>>
										<span class="hde-slider"></span>
									</label>
								</div>
								<p class="hde-card-desc"><?php echo esc_html( $feature_descriptions['locale_fallback'] ); ?></p>
							</div>
							<div class="hde-card-bottom">
								<span class="hde-badge hde-badge-pro">SPL PRO FEATURE</span>
							</div>
						</div>

						<!-- Card 5: WooCommerce Integration -->
						<div class="hde-card">
							<div>
								<div class="hde-card-top">
									<h3 class="hde-card-title"><?php esc_html_e( 'WooCommerce Integration', 'spl' ); ?></h3>
									<span class="hde-badge hde-badge-warning">BYPASSED — POLYLANG WC ACTIVE</span>
								</div>
								<p class="hde-card-desc"><?php esc_html_e( 'Dual-sync order language, HPOS-safe order meta, product translation, and cart hash stability.', 'spl' ); ?></p>
							</div>
							<div class="hde-card-bottom">
								<span class="hde-badge hde-badge-native">NATIVE INTEGRATION</span>
							</div>
						</div>

						<!-- Card 6: ACF / SCF Integration -->
						<div class="hde-card">
							<div>
								<div class="hde-card-top">
									<h3 class="hde-card-title"><?php esc_html_e( 'ACF / SCF Integration', 'spl' ); ?></h3>
									<span class="hde-badge hde-badge-success">ACF LOADED</span>
								</div>
								<p class="hde-card-desc"><?php esc_html_e( 'Transparent post_id rewriting, options page slide-over language switcher, and field sync.', 'spl' ); ?></p>
							</div>
							<div class="hde-card-bottom">
								<span class="hde-badge hde-badge-native">NATIVE INTEGRATION</span>
							</div>
						</div>
					</div>
				</div>

				<!-- Section 2: Admin Dashboard Language -->
				<div class="hde-section">
					<div class="hde-section-header">
						<h2 class="hde-section-title"><?php esc_html_e( 'Admin Dashboard Language', 'spl' ); ?></h2>
						<p class="hde-section-desc"><?php esc_html_e( 'Control the language used for the WordPress admin dashboard.', 'spl' ); ?></p>
					</div>

					<table class="form-table" role="presentation">
						<tr>
							<th scope="row"><?php esc_html_e( 'Admin Language', 'spl' ); ?></th>
							<td>
								<?php $force_locale = $pll_settings['admin_force_locale'] ?? 'content'; ?>
								<select name="hd_pll_admin_force_locale" class="regular-text">
									<option value="content" <?php selected( $force_locale, 'content' ); ?>><?php esc_html_e( 'Content language (default)', 'spl' ); ?></option>
									<option value="default" <?php selected( $force_locale, 'default' ); ?>><?php esc_html_e( 'Always use default language', 'spl' ); ?></option>
									<option value="profile" <?php selected( $force_locale, 'profile' ); ?>><?php esc_html_e( 'Use user profile language', 'spl' ); ?></option>
								</select>
								<p class="description"><?php esc_html_e( 'Choose how the admin dashboard language is determined. "Content language" follows the content you are editing.', 'spl' ); ?></p>
							</td>
						</tr>
					</table>
				</div>

				<!-- Section 3: AI Settings Section -->
				<div class="hde-section">
					<?php AiSettingsSection::render( $pll_settings ); ?>
				</div>

				<?php if ( $show_ttfp ) : ?>
				<!-- Section 4: Theme & Plugin String Scanner + Import/Export -->
				<div class="hde-section">
					<div class="hde-section-header">
						<h2 class="hde-section-title"><?php esc_html_e( 'Theme & Plugin Translation', 'spl' ); ?></h2>
						<p class="hde-section-desc"><?php esc_html_e( 'Select themes and plugins to scan for translatable strings. Strings will appear in Languages > String translations.', 'spl' ); ?></p>
					</div>

					<table class="form-table" role="presentation">
						<tr>
							<th scope="row"><?php esc_html_e( 'Themes', 'spl' ); ?></th>
							<td>
								<fieldset>
									<?php foreach ( $themes as $name => $display ) : ?>
									<label style="display: block; margin-bottom: 6px;">
										<input type="checkbox" name="hd_pll_translation[themes][]"
											value="<?php echo esc_attr( $name ); ?>"
											<?php checked( in_array( $name, $trans_settings['themes'], true ) ); ?>>
										<?php echo esc_html( $display ); ?>
									</label>
									<?php endforeach; ?>
								</fieldset>
							</td>
						</tr>
						<tr>
							<th scope="row"><?php esc_html_e( 'Plugins', 'spl' ); ?></th>
							<td>
								<fieldset>
									<?php foreach ( $plugins as $name => $display ) : ?>
									<label style="display: block; margin-bottom: 6px;">
										<input type="checkbox" name="hd_pll_translation[plugins][]"
											value="<?php echo esc_attr( $name ); ?>"
											<?php checked( in_array( $name, $trans_settings['plugins'], true ) ); ?>>
										<?php echo esc_html( $display ); ?>
									</label>
									<?php endforeach; ?>
								</fieldset>
							</td>
						</tr>
					</table>

					<hr style="margin: 20px 0; border: 0; border-top: 1px solid #e2e8f0;">

					<div class="hde-section-header">
						<h2 class="hde-section-title"><?php esc_html_e( 'Translation Import/Export', 'spl' ); ?></h2>
						<p class="hde-section-desc"><?php esc_html_e( 'Export string translations in CSV, PO, or XLIFF format. Import translated files back.', 'spl' ); ?></p>
					</div>

					<?php
					$languages     = \PLL()->model->get_languages_list();
					$defaultLang   = \PLL()->model->get_default_language();
					$strings       = class_exists( 'PLL_Admin_Strings' ) ? \PLL_Admin_Strings::get_strings() : [];
					$groups        = array_unique( wp_list_pluck( $strings, 'context' ) );
					$formatFactory = new FileFormatFactory();
					$exportFormats = $formatFactory->getSupportedFormats( 'strings' );
					?>

					<table class="form-table" role="presentation">
						<tr>
							<th scope="row"><?php esc_html_e( 'Export Strings', 'spl' ); ?></th>
							<td>
								<fieldset>
									<p><strong><?php esc_html_e( 'Target languages:', 'spl' ); ?></strong></p>
									<?php foreach ( $languages as $language ) : ?>
										<?php if ( $defaultLang && $defaultLang->slug !== $language->slug ) : ?>
										<label style="display:inline-block;margin-right:12px;">
											<input type="checkbox" name="hd_pll_export_langs[]" value="<?php echo esc_attr( $language->slug ); ?>" checked>
											<?php echo esc_html( $language->name ); ?>
										</label>
										<?php endif; ?>
									<?php endforeach; ?>
								</fieldset>

								<?php if ( ! empty( $groups ) ) : ?>
								<p style="margin-top:12px;">
									<label for="hd-pll-export-group"><?php esc_html_e( 'Filter group:', 'spl' ); ?></label>
									<select name="hd_pll_export_group" id="hd-pll-export-group" class="regular-text">
										<option value=""><?php esc_html_e( 'All groups', 'spl' ); ?></option>
										<?php foreach ( $groups as $group ) : ?>
										<option value="<?php echo esc_attr( $group ); ?>"><?php echo esc_html( $group ); ?></option>
										<?php endforeach; ?>
									</select>
								</p>
								<?php endif; ?>

								<p style="margin-top:12px;">
									<strong><?php esc_html_e( 'File format:', 'spl' ); ?></strong><br>
									<?php foreach ( $exportFormats as $key => $fmt ) : ?>
									<label style="display:inline-block; margin-right:12px; margin-top: 6px;">
										<input type="radio" name="hd_pll_export_format" value="<?php echo esc_attr( $key ); ?>"
											<?php checked( 'csv', $key ); ?>>
										<?php echo esc_html( $fmt['label'] ); ?>
									</label>
									<?php endforeach; ?>
								</p>

								<p style="margin-top:12px;">
									<button type="submit" name="hd_pll_export" value="1" class="button button-secondary">
										<?php esc_html_e( 'Download', 'spl' ); ?>
									</button>
								</p>
							</td>
						</tr>
						<tr>
							<th scope="row"><?php esc_html_e( 'Import Translations', 'spl' ); ?></th>
							<td>
								<input type="file" id="hd-pll-import-file" accept=".csv,.po,.xliff,.xlf">
								<button type="button" id="hd-pll-import-btn" class="button button-secondary" style="margin-left:8px;">
									<?php esc_html_e( 'Import', 'spl' ); ?>
								</button>
								<span id="hd-pll-import-spinner" class="spinner" style="float:none;"></span>
								<div id="hd-pll-import-result" style="margin-top:8px;"></div>
								<p class="description"><?php esc_html_e( 'Upload a CSV, PO, or XLIFF file to import string translations.', 'spl' ); ?></p>
							</td>
						</tr>
					</table>
				</div>
				<?php endif; ?>
			</form>
		</div>
		<?php
	}

	/**
	 * Get Pro feature slugs and labels.
	 *
	 * @return array<string, string>
	 */
	public static function getProFeatureLabels(): array {
		return [
			'translate_slugs'   => __( 'Translate URL Slugs', 'spl' ),
			'duplicate_content' => __( 'Duplicate Content on Translation', 'spl' ),
			'share_slugs'       => __( 'Share Slugs Across Languages', 'spl' ),
			'locale_fallback'   => __( 'Locale Fallback', 'spl' ),
		];
	}

	/**
	 * Get available themes for scanning.
	 *
	 * @return array<string, string> name => display label
	 */
	private static function getAvailableThemes(): array {
		$result = [];

		foreach ( wp_get_themes() as $name => $theme ) {
			$textdomain = $theme->get( 'TextDomain' );
			$label      = $name;

			if ( $textdomain && $textdomain !== $name ) {
				$label .= sprintf( ' (TextDomain: %s)', $textdomain );
			}

			$result[ $name ] = $label;
		}

		return $result;
	}

	/**
	 * Get available plugins for scanning (excludes Polylang-related).
	 *
	 * @return array<string, string> name => display label
	 */
	private static function getAvailablePlugins(): array {
		$result  = [];
		$exclude = [ 'polylang', 'polylang-pro', 'theme-translation-for-polylang', 'polylang-theme-translation' ];
		$plugins = wp_get_active_and_valid_plugins();

		if ( \is_multisite() ) {
			$plugins = array_merge( $plugins, wp_get_active_network_plugins() );
		}

		$all_plugin_data = function_exists( 'get_plugins' ) ? get_plugins() : [];

		foreach ( $plugins as $plugin ) {
			$plugin_dir  = dirname( $plugin );
			$plugin_name = pathinfo( $plugin, PATHINFO_FILENAME );

			if ( in_array( $plugin_name, $exclude, true ) || $plugin_dir === WP_PLUGIN_DIR ) {
				continue;
			}

			$label = $plugin_name;

			// Try to get plugin full name.
			foreach ( $all_plugin_data as $key => $info ) {
				if ( pathinfo( $key, PATHINFO_FILENAME ) === $plugin_name ) {
					$full_name  = $info['Name'] ?? '';
					$textdomain = $info['TextDomain'] ?? '';

					if ( $full_name ) {
						$label = $full_name;
					}
					if ( $textdomain && $textdomain !== $plugin_name ) {
						$label .= sprintf( ' (TextDomain: %s)', $textdomain );
					}
					break;
				}
			}

			$result[ $plugin_name ] = $label;
		}

		return $result;
	}
}
