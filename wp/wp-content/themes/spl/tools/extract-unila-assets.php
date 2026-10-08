<?php
/**
 * Script to extract downloaded Unila CSS and JS assets cleanly.
 *
 * @package SPL
 */

defined( 'ABSPATH' ) || exit;

$base_brain = 'C:/Users/MSI/.gemini/antigravity-ide/brain/0c2e2ee1-45cf-430b-bd26-4f51b2f05482/.system_generated/steps';

$files_map = array(
	'247/content.md' => 'wp/wp-content/themes/spl/assets/css/unila-global.css',
	'244/content.md' => 'wp/wp-content/themes/spl/assets/css/unila-main.css',
	'256/content.md' => 'wp/wp-content/themes/spl/assets/js/unila-global.js',
	'259/content.md' => 'wp/wp-content/themes/spl/assets/js/unila-main.js',
);

foreach ( $files_map as $src => $dest ) {
	$full_src = $base_brain . '/' . $src;
	if ( file_exists( $full_src ) ) {
		$raw_content = file_get_contents( $full_src );
		// Strip the markdown header metadata (Title, Source, etc. up to ---)
		$parts = explode( "---", $raw_content, 2 );
		$clean_code = isset( $parts[1] ) ? trim( $parts[1] ) : $raw_content;

		$full_dest = 'd:/laragon/www/vinacos/' . $dest;
		$dir = dirname( $full_dest );
		if ( ! is_dir( $dir ) ) {
			mkdir( $dir, 0755, true );
		}

		file_put_contents( $full_dest, $clean_code );
		echo "Extracted: " . $dest . " (" . strlen( $clean_code ) . " bytes)" . PHP_EOL;
	} else {
		echo "ERROR: Source file not found: " . $full_src . PHP_EOL;
	}
}
