<?php
/**
 * Blockville functions and definitions.
 *
 * @package Blockville
 *
 * @since [version]
 * @version [version]
 */

/**
 * Enqueue the style.css file.
 * 
 * @since [version]
 */
function blockville_styles() {
	wp_enqueue_style(
		'blockville-style',
		get_stylesheet_uri(),
		array(),
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'blockville_styles' );

/**
 * Enable theme support for block editor.
 * 
 * @since [version]
 */
if ( ! function_exists( 'blockville_setup' ) ) {
	function blockville_setup() {
			add_theme_support( 'wp-block-styles' );
			add_editor_style( 'style.css' );
			add_editor_style( 'editor.css' );
		}
}
add_action( 'after_setup_theme', 'blockville_setup' );