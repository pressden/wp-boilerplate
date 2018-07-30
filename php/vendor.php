<?php
// VENDOR (third-party files)

// load the bootstrap walker
add_action( 'after_setup_theme', 'childtheme_include_third_party_files' );
if( !function_exists( 'childtheme_include_third_party_files' ) ) {
	function childtheme_include_third_party_files() {
		$vendors_path = get_stylesheet_directory() . '/boilerplate/php/lib/';
		require_once( $vendors_path . 'genesis-title-toggle.php' );
		require_once( $vendors_path . 'the-events-calendar.php' );
		require_once( $vendors_path . 'wp-bootstrap-navwalker.php' );
	}
}
