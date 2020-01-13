<?php
// WIDGETS

// load widgets
require_once( 'lib/widgets/class-childtheme-auto-menu-widget.php' );

// register the auto menu widget
add_action( 'widgets_init', 'childtheme_register_auto_menu_widget' );
if( !function_exists( 'childtheme_register_auto_menu_widget' ) ) {
	function childtheme_register_auto_menu_widget() {
		register_widget( 'Childtheme_Auto_Menu_Widget' );
	}
}
