<?php
// The Events Calendar plugin integration for Genesis

/**
* The Events Calendar - Bypass Genesis genesis_do_post_content in Event Views
 *
 * This snippet overrides the Genesis Content Archive settings for Event Views
 *
 * Event Template set to: Admin > Events > Settings > Display Tab > Events template > Default Page Template
 *
 * The Events Calendar @4.0.4
 * Genesis @2.2.6
*/

add_action( 'get_header', 'tribe_genesis_bypass_genesis_do_post_content' );
function tribe_genesis_bypass_genesis_do_post_content() {
	if ( class_exists( 'Tribe__Events__Main' ) && class_exists( 'Tribe__Events__Pro__Main' ) ) {
		if ( tribe_is_month() || tribe_is_upcoming() || tribe_is_past() || tribe_is_day() || tribe_is_map() || tribe_is_photo() || tribe_is_week() || ( tribe_is_recurring_event() && ! is_singular( 'tribe_events' ) ) ) {
			add_filter( 'genesis_post_permalink', '__return_false' );
			remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
			remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
			add_action( 'genesis_entry_content', 'the_content', 15 );
		}
	} elseif ( class_exists( 'Tribe__Events__Main' ) && ! class_exists( 'Tribe__Events__Pro__Main' ) ) {
		if ( tribe_is_month() || tribe_is_upcoming() || tribe_is_past() || tribe_is_day() ) {
			add_filter( 'genesis_post_permalink', '__return_false' );
			remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
			remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
			add_action( 'genesis_entry_content', 'the_content', 15 );
		}
	}

	if( is_singular( 'tribe_events' ) ) {
		// remove the bootstrap content markup
		remove_filter( 'the_content', 'apl_content_layers_filter' );
		remove_filter( 'the_content', 'childtheme_content_layers_filter' );

		// override the bootstrap classes filter to wrap entry-content in a container
		add_filter( 'childtheme_bootstrap_classes', 'childtheme_modify_event_entry_classes', 11, 3 );
		function childtheme_modify_event_entry_classes( $classes_to_add, $context, $attr ) {
			$classes_to_add['entry-content'] = 'container';

			return $classes_to_add;
		}
	}
}
