<?php
// FILTERS


//* Add custom body class to the head
add_filter( 'body_class', 'childtheme_body_class' );
if( !function_exists( 'childtheme_body_class' ) ) {
	function childtheme_body_class( $classes ) {
		$classes[] = 'boilerplate';
		$classes[] = 'childtheme';
		return $classes;
	}
}
