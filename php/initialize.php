<?php
// WORDPRESS CLEAN UP

// disable all things emoji
add_action( 'init', 'childtheme_disable_emoji', 1 );
if( !function_exists( 'childtheme_disable_emoji' ) ) {
	function childtheme_disable_emoji() {
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );	
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );	
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
		add_filter( 'tiny_mce_plugins', 'childtheme_disable_tinymce_emoji' );
	}
}

// filter function used to remove the tinymce emoji plugin
if( !function_exists( 'childtheme_disable_tinymce_emoji' ) ) {
	function childtheme_disable_tinymce_emoji( $plugins ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	}
}

// remove the DNS prefetch
add_filter( 'emoji_svg_url', '__return_false' );


// WORDPRESS SETUP

// add HTML5 markup structure
add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );


// GENESIS SETUP

// lower the priority of genesis inpost meta boxes
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
