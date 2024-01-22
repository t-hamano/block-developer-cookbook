<?php
/**
 * Plugin Name:       Managing Formats
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       managing-formats
 *
 * @package           block-developers-cookbook
 */


// Hooks.
add_action( 'enqueue_block_editor_assets', 'enqueue_files_for_acronym_format' );
add_action( 'wp_head', 'horrible_hack_to_add_some_css' );

/**
 * Enqueue the files for the format.
 */
function enqueue_files_for_acronym_format() {
	$acronym_file = plugin_dir_path( __FILE__ ) . '/build/acronym.asset.php';

	if ( file_exists( $acronym_file ) ) {
		$assets = include $acronym_file;
		wp_enqueue_script(
			'acronym-format',
			plugin_dir_url( __FILE__ ) . 'build/acronym.js',
			$assets['dependencies'],
			$assets['version'],
			true
		);

		wp_enqueue_style(
			'acronym-format-styles',
			plugin_dir_url( __FILE__ ) . 'build/acronym.css',
			array(),
			$assets['version']
		);
	}
}


/**
 * This is a hack! Do it better than me!
 */
function horrible_hack_to_add_some_css() {
	echo '<style>.bdc-acronym {
		cursor: help;
	}</style>';
}
