<?php
// CUSTOMIZER

//* Add support for custom header
add_action( 'after_setup_theme', 'childtheme_add_custom_header_support' );
if( !function_exists( 'childtheme_add_custom_header_support' ) ) {
	function childtheme_add_custom_header_support() {
		$header_width = apply_filters( 'childtheme_header_width', '600' );
		$header_height = apply_filters( 'childtheme_header_height', '200' );

		add_theme_support( 'custom-header', array(
			'default-text-color'     => '000000',
			'header-selector'        => '.site-title a',
			'header-text'            => false,
			'width'                  => $header_width,
			'height'                 => $header_height,
			'flex-width'             => true,
			'flex-height'            => true,
		) );
	}
}

//* Add support for custom background
add_action( 'after_setup_theme', 'childtheme_add_custom_background_support' );
if( !function_exists( 'childtheme_add_custom_background_support' ) ) {
	function childtheme_add_custom_background_support() {
		add_theme_support( 'custom-background', array(
			'default-color'        	 => 'ffffff',
      'default-image'          => get_stylesheet_directory_uri() . '/images/bg.png',
			'wp-head-callback'       => 'childtheme_background_callback',
		) );
	}
}

//* Add custom background callback
if( !function_exists( 'childtheme_background_callback' ) ) {
	function childtheme_background_callback() {

		$background = get_background_image();
		$color = get_background_color();

		$target = apply_filters( 'childtheme_background_target', '.custom-background .site-header' );

		if ( ! $background && ! $color )
			return;

		echo trim( sprintf(
			"<style type='text/css'>$target { background: %s %s %s %s %s; } </style>",
			$background ? 'url('. $background .')' : '',
			$color ? '#'. $color : 'transparent',
			get_theme_mod( 'background_repeat', 'repeat' ),
			get_theme_mod( 'background_position_x', 'left' ),
			get_theme_mod( 'background_attachment', 'scroll' )
		) );
	}
}
