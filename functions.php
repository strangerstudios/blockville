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

/**
 * Register block patterns.
 * 
 * @since [version]
 */

 function blockville_register_block_patterns() {
	// Create the block pattern category for Blockville patterns.
	register_block_pattern_category(
		'blockville',
		array(
			'label' => __( 'Blockville', 'blockville' )
		)
	);

	// Home Hero Block Pattern
	register_block_pattern(
		'blockville/home-hero',
		array(
			'title' => __( 'Home Hero', 'blockville' ),
			'description' => _x( '', 'Block pattern description', 'blockville' ),
			'content' => "<!-- wp:columns -->\n<div class=\"wp-block-columns\"><!-- wp:column -->\n<div class=\"wp-block-column\"><!-- wp:heading {\"level\":1} -->\n<h1 class=\"wp-block-heading\">Welcome to BlockVille. You'll like it here.</h1>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph -->\n<p>Connect and engage with your community in a safe space and have fun.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:buttons {\"layout\":{\"type\":\"flex\",\"justifyContent\":\"space-between\"}} -->\n<div class=\"wp-block-buttons\"><!-- wp:button {\"backgroundColor\":\"septenary\",\"width\":50} -->\n<div class=\"wp-block-button has-custom-width wp-block-button__width-50\"><a class=\"wp-block-button__link has-septenary-background-color has-background wp-element-button\" href=\"#\">Compare plans</a></div>\n<!-- /wp:button -->\n\n<!-- wp:button {\"width\":50,\"className\":\"is-style-outline\"} -->\n<div class=\"wp-block-button has-custom-width wp-block-button__width-50 is-style-outline\"><a class=\"wp-block-button__link wp-element-button\" href=\"#\">Join now</a></div>\n<!-- /wp:button --></div>\n<!-- /wp:buttons --></div>\n<!-- /wp:column -->\n\n<!-- wp:column -->\n<div class=\"wp-block-column\"><!-- wp:image {\"id\":18,\"sizeSlug\":\"large\",\"linkDestination\":\"none\"} -->\n<figure class=\"wp-block-image size-large\"><img src=\"http://blockville-dev.local/wp-content/uploads/2023/05/Screenshot-2023-05-02-at-4.58.33-PM-1024x676.png\" alt=\"\" class=\"wp-image-18\"/></figure>\n<!-- /wp:image --></div>\n<!-- /wp:column --></div>\n<!-- /wp:columns -->",
			'categories' => array( 'blockville' )
		)
	);
}
add_action( 'init', 'blockville_register_block_patterns' );
 
//events post type

function blockvillePostTypes() {
	register_post_type('event', array(
		'supports' => array('title', 'editor', 'excerpt'),
		'rewrite' => array('slug' => 'events'),
		'has_archive' => true, 
		'public' => true,
		'show_in_rest' => true,
		  'labels' => array(
			'name' => 'Events',
			'add_new_item' => 'Add New Event',
			'edit_item' => 'Edit Event',
			'all_items' => 'All Events',
			'singular_name' => 'Event'
		),
		'menu_icon' => 'dashicons-calendar'
	  ));
}

add_action('init', 'blockvillePostTypes');



//Blocks
class placeHolderBlock {
	function __construct($name) {
		$this->name = $name; 
		add_action('init', [$this, 'onInit']);
	}
	//pass block attr and  nested content into the function
	function ourRenderCallback($attributes, $content) {
		ob_start();
		require get_theme_file_path("/our-blocks/{$this->name}.php");
		return ob_get_clean();
	}

	function onInit() {
		wp_register_script($this->name, get_stylesheet_directory_uri() . "/our-blocks/{$this->name}.js", array(
			'wp-blocks', 'wp-editor'
		));
		register_block_type("ourblocktheme/{$this->name}", array(
			'editor_script' => $this->name,
			'render_callback' => [$this, 'ourRenderCallback']
		));
	}
}

new placeHolderBlock('events');


//making a class so I dont have to repeat initializing new blocks
class JSXBlock {
	function __construct($name, $renderCallback = null) {
		$this->name = $name; 
		//replace the name of the specfic block to whatever value was passed into class
		$this->renderCallback = $renderCallback;

		add_action('init', [$this, 'onInit']);
	}
	//pass block attr and  nested content into the function
	function ourRenderCallback($attributes, $content) {
		ob_start();
		require get_theme_file_path("/our-blocks/{$this->name}.php");
		return ob_get_clean();
	}

	function onInit() {
		$ourArgs = array('editor_script' => $this->name);
		if ($this->renderCallback) {
			$ourArgs['render_callback'] = [$this, 'ourRenderCallback'];
		}

		wp_register_script($this->name, get_stylesheet_directory_uri() . "/build/{$this->name}.js", array(
			'wp-blocks', 'wp-editor'
		));
		register_block_type("ourblocktheme/{$this->name}", $ourArgs);
	}
}

new JSXBlock('perfectplan', true); 
