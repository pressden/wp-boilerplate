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

// add custom header support
add_theme_support( 'custom-header' );

// add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

// add support for after entry widget
add_theme_support( 'genesis-after-entry-widget-area' );

// GENESIS SETUP

// remove structural wraps
add_theme_support( 'genesis-structural-wraps', array( 'header', 'footer', 'footer-widgets' ) );

// add accessibility support
add_theme_support( 'genesis-accessibility', array( '404-page', 'drop-down-menu', 'headings', 'rems', 'search-form', 'skip-links' ) );

// add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

// add excerpts to pages
add_post_type_support( 'page', 'excerpt' );


// CUSTOM POST TYPE SETUP

// initialize the contact post type (useful for staff directories / committees / boards / etc.)
add_action( 'init', 'childtheme_initialize_contacts' );
if( !function_exists( 'childtheme_initialize_contacts' ) ) {
	function childtheme_initialize_contacts() {
		childtheme_register_taxonomy( 'contact-groups', 'Contact Group', 'Contact Groups', array( 'applies_to' => 'contact' ) );
		childtheme_register_post_type( 'contact', 'Contact', 'Contacts' );
	}
}
