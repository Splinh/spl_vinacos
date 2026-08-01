<?php
/**
 * ACF — Per-Field Translation Settings.
 *
 * Adds a "Translations" dropdown to each non-layout ACF field with two
 * strategies: Translate (default — seed + keep references linked) and
 * Ignore (independent per language).
 *
 * @package SPL\Modules\PLL\ACF
 */

declare(strict_types=1);

namespace SPL\Modules\PLL\ACF;

defined( 'ABSPATH' ) || exit;

final class FieldSettings {

	/**
	 * Register the settings hook for each non-layout field type.
	 * Called from ACFIntegration::onAcfInit().
	 */
	public function onAcfInit(): void {
		foreach ( acf_get_field_types() as $type ) {
			if ( 'layout' !== $type->category ) {
				add_action( "acf/render_field_settings/type={$type->name}", [ $this, 'renderFieldSettings' ] );
			}
		}
	}

	/**
	 * Render the "Translations" dropdown setting for a field.
	 *
	 * @param array $field ACF field definition.
	 */
	public function renderFieldSettings( array $field ): void {
		// Hide when field group uses Language location rule.
		$fieldGroup = LocationLanguage::getFieldGroupFromField( $field );
		if ( ! empty( $fieldGroup ) && LocationLanguage::hasLanguageLocationRule( $fieldGroup ) ) {
			return;
		}

		$instructions =
			'<details>' .
				'<summary style="cursor: pointer; outline: none; margin-bottom: 5px;">' . esc_html__( 'View translation rules', 'spl' ) . '</summary>' .
				'<div style="line-height: 1.6;">' .
				'<strong>' . esc_html__( 'Translate:', 'spl' ) . '</strong> ' . esc_html__( 'Default. The value is seeded into new translations as a starting point — reference IDs and Repeater rows stay linked — then translated independently.', 'spl' ) . '<br>' .
				'<strong>' . esc_html__( 'Ignore:', 'spl' ) . '</strong> ' . esc_html__( 'For fields that should not be translated (e.g. slug, ID). The field stays fully independent per language with no copy, sync, or linking — you can still enter a value manually in each language.', 'spl' ) .
				'</div>' .
			'</details>';

		acf_render_field_setting(
			$field,
			[
				'label'         => __( 'Translations', 'spl' ),
				'instructions'  => $instructions,
				'name'          => 'translations',
				'type'          => 'select',
				'choices'       => [
					'translate' => __( 'Translate', 'spl' ),
					'ignore'    => __( 'Ignore', 'spl' ),
				],
				'default_value' => 'translate',
			],
			false
		);
	}
}
