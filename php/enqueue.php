<?php
// ENQUEUE

// enqueue fonts
add_action( 'wp_enqueue_scripts', 'childtheme_enqueue_fonts' );
if( !function_exists( 'childtheme_enqueue_fonts' ) ) {
	function childtheme_enqueue_fonts() {
		// Google fonts
		wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Lato:300,400,700|Roboto:300,400,700|Material+Icons', array(), wp_get_theme()->get( 'Version' ) );
	}
}

// enqueue styles
add_action( 'wp_enqueue_scripts', 'childtheme_enqueue_styles' );
if( !function_exists( 'childtheme_enqueue_styles' ) ) {
	function childtheme_enqueue_styles() {
		// main CSS file (generated via webpack from SASS files)
		wp_enqueue_style( 'main', get_stylesheet_directory_uri() . '/dist/main.css', array(), wp_get_theme()->get( 'Version' ) );
	}
}

// enqueue scripts
add_action( 'wp_enqueue_scripts', 'childtheme_enqueue_scripts' );
if( !function_exists( 'childtheme_enqueue_scripts' ) ) {
	function childtheme_enqueue_scripts() {
		// main JS file (generated via webpack)
		wp_enqueue_script( 'bundle', get_stylesheet_directory_uri() . '/dist/main.js', array( 'jquery' ), wp_get_theme()->get( 'Version' ), true );
	}
}
