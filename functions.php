<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Blockville
 * @since 0.1.0
 */

/**
 * Enqueue the style.css file.
 * 
 * @since 0.1.0
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
 * @since 0.1.0
 */

if ( ! function_exists( 'blockville_setup' ) ) {
	function blockville_setup() {
            add_theme_support( 'wp-block-styles' );
            add_editor_style( 'style.css' );
            add_editor_style( 'editor.css' );
        }
}
add_action( 'after_setup_theme', 'blockville_setup' );


//here, I am making the content inside custom-template.html become a default template. This means that
//it will have pre-made blocks when I choose it in the admin screen. 
function prefix_default_page_template( $settings ) {
	$settings['defaultBlockTemplate'] = file_get_contents( get_theme_file_path( 'templates/custom-template.html' ) );;
	return $settings;
}
add_filter( 'block_editor_settings_all', 'prefix_default_page_template' );

//this function creates a section on the admin section called books in the form of an archive screen
//Like a post, you can add, edit, and view posts. When you click add new, it has a default block template for this section
//the object "template" is making that default template.
function myplugin_register_book_post_type() {
    $args = array(
        'public' => true,
        'label'  => 'Books',
        'show_in_rest' => true,
        'template' => array(
            array( 'core/columns', array(), array(
                array( 'core/column', array(), array(
                    array( 'core/image', array() ),
                ) ),
                array( 'core/column', array(), array(
                    array( 'core/paragraph', array(
                        'placeholder' => 'Add a inner paragraph'
                    ) ),
                ) ),
            ) )
        ),
    );
    register_post_type( 'book', $args );
}
add_action( 'init', 'myplugin_register_book_post_type' );


// <--------------------------Other way to add default post type ------------------->

// function prefix_filter_book_content( $content, $post ) {
// 	if ( $post->post_type === 'book' ) {
// 		$content ='<!-- wp:columns -->
// 		<div class="wp-block-columns"><!-- wp:column -->
// 		<div class="wp-block-column"><!-- wp:image -->
// 		<figure class="wp-block-image"><img alt=""/></figure>
// 		<!-- /wp:image --></div>
// 		<!-- /wp:column -->

// 		<!-- wp:column -->
// 		<div class="wp-block-column"><!-- wp:paragraph -->
// 		<p></p>
// 		<!-- /wp:paragraph --></div>
// 		<!-- /wp:column --></div>
// 		<!-- /wp:columns -->';
// 	}
// 	return $content;
// }
// add_filter( 'default_content', 'prefix_filter_book_content', 10, 2 );


// function myplugin_register_template() {
//     $post_type_object = get_post_type_object( 'book' );
//     $post_type_object->template = array(
//         array( 'core/image' ),
//     );
// }
// add_action( 'init', 'myplugin_register_template' );
//Changes layout of block template above to make it single column. Not double