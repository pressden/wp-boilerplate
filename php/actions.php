<?php
// ACTIONS

//* Enqueue styles
add_action( 'wp_enqueue_scripts', 'childtheme_enqueue_styles' );
if( !function_exists( 'childtheme_enqueue_styles' ) ) {
	function childtheme_enqueue_styles() {
		// main CSS file (generated via webpack from SASS files)
		wp_enqueue_style( 'main', get_stylesheet_directory_uri() . '/dist/main.css' );

		// Google fonts
		wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Lato:300,400,700|Raleway:400,500', array(), CHILD_THEME_VERSION );
	}
}

//* Enqueue scripts
add_action( 'wp_enqueue_scripts', 'childtheme_enqueue_scripts' );
if( !function_exists( 'childtheme_enqueue_scripts' ) ) {
	function childtheme_enqueue_scripts() {
		// main JS file (generated via webpack)
		wp_enqueue_script( 'bundle', get_stylesheet_directory_uri() . '/dist/main.js', array( 'jquery' ), 1, false );
	}
}

//* Add custom header banner after header
add_action( 'genesis_after_header', 'childtheme_header_banner' );
if( !function_exists( 'childtheme_header_banner' ) ) {
	function childtheme_header_banner() {
		if ( !get_background_image() )
			return;

		echo '<div class="site-header-banner"></div>';
	}
}
