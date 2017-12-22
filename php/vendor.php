<?php
// VENDOR (third-party files)

// load the bootstrap walker
add_action( 'after_setup_theme', 'childtheme_include_third_party_files' );
if( !function_exists( 'childtheme_include_third_party_files' ) ) {
	function childtheme_include_third_party_files() {
		require_once( get_stylesheet_directory() . '/boilerplate/php/lib/wp-bootstrap-navwalker.php' );
		require_once( get_stylesheet_directory() . '/boilerplate/php/lib/genesis-title-toggle.php' );
	}
}