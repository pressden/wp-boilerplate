<?php
// ACTIONS

//* Enqueue fonts
add_action( 'wp_enqueue_scripts', 'childtheme_enqueue_fonts' );
if( !function_exists( 'childtheme_enqueue_fonts' ) ) {
	function childtheme_enqueue_fonts() {
		// Google fonts
		wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Lato:300,400,700|Roboto:300,400,700', array(), CHILD_THEME_VERSION );
	}
}

//* Enqueue styles
add_action( 'wp_enqueue_scripts', 'childtheme_enqueue_styles' );
if( !function_exists( 'childtheme_enqueue_styles' ) ) {
	function childtheme_enqueue_styles() {
		// main CSS file (generated via webpack from SASS files)
		wp_enqueue_style( 'main', get_stylesheet_directory_uri() . '/dist/main.css' );
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

//* Move secondary menu above the header
add_action( 'after_setup_theme', 'childtheme_move_subnav' );
if( !function_exists( 'childtheme_move_subnav' ) ) {
	function childtheme_move_subnav() {
		remove_action( 'genesis_after_header', 'genesis_do_subnav' );
		add_action( 'genesis_header_right', 'genesis_do_subnav', 5 );
	}
}

//* Add custom header banner after header
add_action( 'genesis_after_header', 'childtheme_header_banner' );
if( !function_exists( 'childtheme_header_banner' ) ) {
	function childtheme_header_banner() {
		if ( !get_background_image() ) {
			return;
		}

		echo '<div class="site-header-banner"></div>';
	}
}

// Lower the priority of genesis inpost meta boxes
add_action( 'after_setup_theme', 'childtheme_genesis_inpost_meta_boxes' );
if( !function_exists( 'childtheme_genesis_inpost_meta_boxes' ) ) {
	function childtheme_genesis_inpost_meta_boxes() {
	  // exit early if genesis isn't installed
	  if( ! function_exists( 'genesis' ) ) {
	    return;
	  }

	  // unhook the genesis meta box actions
	  remove_action( 'admin_menu', 'genesis_add_inpost_seo_box' );
	  remove_action( 'admin_menu', 'genesis_add_inpost_layout_box' );

	  // hook the genesis meta box actions
	  add_action( 'admin_head', 'genesis_add_inpost_seo_box', 25 );
	  add_action( 'admin_head', 'genesis_add_inpost_layout_box', 25 );
	}
}
