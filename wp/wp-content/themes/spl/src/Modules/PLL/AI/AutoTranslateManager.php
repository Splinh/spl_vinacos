<?php
/**
 * PLL AI auto-translation manager.
 *
 * @package SPL\Modules\PLL\AI
 */

declare(strict_types=1);

namespace SPL\Modules\PLL\AI;

use SPL\Modules\PLL\AI\Jobs\BatchManager;
use SPL\Modules\PLL\AI\Jobs\JobRepository;
use SPL\Modules\PLL\PLLModule;

defined( 'ABSPATH' ) || exit;

final class AutoTranslateManager {

	public static function shouldBoot(): bool {
		return is_admin()
			|| wp_doing_cron()
			|| ( defined( 'REST_REQUEST' ) && REST_REQUEST )
			|| ( function_exists( 'wp_is_serving_rest_request' ) && wp_is_serving_rest_request() );
	}

	public function register(): void {
		$repository = new JobRepository();
		add_action( 'init', [ $repository, 'registerPostType' ] );

		( new BatchManager( $repository ) )->register();

		if ( is_admin() ) {
			add_action( 'admin_enqueue_scripts', [ $this, 'enqueueAssets' ] );
			( new RowActions() )->register();
			( new BulkActions( $repository ) )->register();
		}
	}

	public function enqueueAssets(): void {
		global $pagenow;
		if ( ! in_array( $pagenow, [ 'post.php', 'post-new.php', 'edit.php' ], true ) ) {
			return;
		}

		$settings = PLLModule::getCachedOptions();
		$assetDir = dirname( __DIR__ ) . '/Admin/assets/ai';

		// Inline CSS — read from file, print directly (avoids exposing path structure).
		// phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents -- Local file read.
		$css = file_get_contents( $assetDir . '/auto-translate.css' );
		if ( $css ) {
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Trusted local file.
			printf( '<style id="hd-pll-ai-auto-translate-css">%s</style>', $css );
		}

		// Inline JS — register empty handle for localization, inject file content.
		wp_register_script( 'hd-pll-ai-auto-translate', '', [ 'wp-api-fetch' ], THEME_VERSION, true );
		// phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents -- Local file read.
		$js = file_get_contents( $assetDir . '/auto-translate.js' );
		if ( $js ) {
			wp_add_inline_script( 'hd-pll-ai-auto-translate', $js );
		}

		wp_localize_script(
			'hd-pll-ai-auto-translate',
			'hdPllAi',
			[
				'root'         => esc_url_raw( rest_url( REST_NAMESPACE . '/pll/ai' ) ),
				'nonce'        => wp_create_nonce( 'wp_rest' ),
				'adminUrl'     => esc_url_raw( admin_url() ),
				'editorAssist' => ! empty( $settings['ai_editor_assist_enabled'] ),
			]
		);

		wp_enqueue_script( 'hd-pll-ai-auto-translate' );
	}
}
