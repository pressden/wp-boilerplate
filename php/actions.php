<?php
// ACTIONS

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

// add the utility bar
add_action( 'genesis_before_header', 'childtheme_add_utility_bar' );
if( !function_exists( 'childtheme_add_utility_bar' ) ) {
	function childtheme_add_utility_bar() {
		childtheme_utility_widget_areas();
	}
}

// move secondary menu to header right
add_action( 'after_setup_theme', 'childtheme_move_subnav' );
if( !function_exists( 'childtheme_move_subnav' ) ) {
	function childtheme_move_subnav() {
		remove_action( 'genesis_after_header', 'genesis_do_subnav' );
		add_action( 'genesis_header_right', 'genesis_do_subnav', 5 );
	}
}

// add custom header banner after header
add_action( 'genesis_after_header', 'childtheme_header_banner' );
if( !function_exists( 'childtheme_header_banner' ) ) {
	function childtheme_header_banner() {
		echo '<div class="site-header-banner"></div>';
	}
}

// move the secondary sidebar inside of the content-sidebar wrap
add_action( 'after_setup_theme', 'childtheme_move_sidebar_alt' );
if( !function_exists( 'childtheme_move_sidebar_alt' ) ) {
	function childtheme_move_sidebar_alt() {
		remove_action( 'genesis_after_content_sidebar_wrap', 'genesis_get_sidebar_alt' );
		add_action( 'genesis_after_content', 'genesis_get_sidebar_alt' );
	}
}

// modify the faq archive main query
add_filter( 'pre_get_posts', 'childtheme_modify_faq_archive_query' );
if( !function_exists( 'childtheme_modify_faq_archive_query' ) ) {
	function childtheme_modify_faq_archive_query( $query ) {
		if ( $query->is_main_query() && $query->is_post_type_archive( 'faq' ) ) {
			// remove the `posts_per_page` limit so all entries load on a single page
			$query->query_vars['posts_per_page'] = -1;
		}

		return $query;
	}
}

// modify the work-item archive main query
add_filter( 'pre_get_posts', 'childtheme_modify_work_item_archive_query' );
if( !function_exists( 'childtheme_modify_work_item_archive_query' ) ) {
	function childtheme_modify_work_item_archive_query( $query ) {
    // exit early on admin pages
    if( is_admin() ) {
      return $query;
    }

		if ( $query->is_main_query() && $query->is_post_type_archive( 'work-item' ) ) {
			// remove the `posts_per_page` limit so all entries load on a single page
      $query->query_vars['posts_per_page'] = -1;
      // suppress private work items regardless of logged in status
      $query->query_vars['post_status'] = array( 'publish' );
		}

		return $query;
	}
}

// modify the work-type taxonomy main query
add_filter( 'pre_get_posts', 'childtheme_modify_work_type_taxonomy_query' );
if( !function_exists( 'childtheme_modify_work_type_taxonomy_query' ) ) {
	function childtheme_modify_work_type_taxonomy_query( $query ) {
    // exit early on admin pages
    if( is_admin() ) {
      return $query;
    }

		if ( $query->is_main_query() && $query->is_tax( 'work-type' ) ) {
			// remove the `posts_per_page` limit so all entries load on a single page
      $query->query_vars['posts_per_page'] = -1;
      // suppress private work items regardless of logged in status
      $query->query_vars['post_status'] = array( 'publish' );
		}

		return $query;
	}
}

// modify the client taxonomy main query
add_filter( 'pre_get_posts', 'childtheme_modify_client_taxonomy_query' );
if( !function_exists( 'childtheme_modify_client_taxonomy_query' ) ) {
	function childtheme_modify_client_taxonomy_query( $query ) {
    // exit early on admin pages
    if( is_admin() ) {
      return $query;
    }

		if ( $query->is_main_query() && $query->is_tax( 'client' ) ) {
			// remove the `posts_per_page` limit so all entries load on a single page
      $query->query_vars['posts_per_page'] = -1;
      // show private work items regardless of logged in status
      $query->query_vars['post_status'] = array( 'publish', 'private' );
		}

		return $query;
	}
}

// ensure all archives have the proper containers
//add_action( 'the_post', 'childtheme_add_archive_markup' );
if( !function_exists( 'childtheme_add_archive_markup' ) ) {
	function childtheme_add_archive_markup() {
		if( is_home() || is_archive() ) {
			add_action( 'genesis_before_loop', 'childtheme_archive_markup_open', 11);
			add_action( 'genesis_after_endwhile', 'childtheme_archive_markup_close', 9);
		}
	}
}

// move the after entry widget and ensure the functionality is added to pages
add_action( 'after_setup_theme', 'childtheme_move_after_entry_widget' );
if( !function_exists( 'childtheme_move_after_entry_widget' ) ) {
	function childtheme_move_after_entry_widget() {
		remove_action( 'genesis_after_entry', 'genesis_after_entry_widget_area' );
		add_action( 'genesis_entry_footer', 'genesis_after_entry_widget_area' );
	}
}

// override the standard genesis footer widgets to get bootstrap friendly markup in place
add_action( 'after_setup_theme', 'childtheme_override_footer_widget_areas' );
if( !function_exists( 'childtheme_override_footer_widget_areas' ) ) {
	function childtheme_override_footer_widget_areas() {
		remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );
		add_action( 'genesis_before_footer', 'childtheme_footer_widget_areas' );
	}
}

if( !function_exists( 'childtheme_footer_widget_areas' ) ) {
	function childtheme_footer_widget_areas() {

		$footer_widgets = get_theme_support( 'genesis-footer-widgets' );

		if ( ! $footer_widgets || ! isset( $footer_widgets[0] ) || ! is_numeric( $footer_widgets[0] ) ) {
			return;
		}

		$footer_widgets = (int) $footer_widgets[0];

		// Check to see if first widget area has widgets. If not, do nothing. No need to check all footer widget areas.
		if ( ! is_active_sidebar( 'footer-1' ) ) {
			return;
		}

		$inside  = '';
		$output  = '';
	 	$counter = 1;

		while ( $counter <= $footer_widgets ) {

			// Darn you, WordPress! Gotta output buffer.
			ob_start();
			dynamic_sidebar( 'footer-' . $counter );
			$widgets = ob_get_clean();

			if ( $widgets ) {

				$inside .= genesis_markup( array(
					'open'    => '<div %s>',
					'close'   => '</div>',
					'context' => 'footer-widget-area',
					'content' => $widgets,
					'echo'    => false,
					'params'  => array(
						'column' => $counter,
						'count'  => $footer_widgets,
				) ) );

			}

			$counter++;

		}

		if ( $inside ) {

			$_inside = genesis_get_structural_wrap( 'footer-widgets', 'open' );

			$_inside .= '<div class="row">';

			$_inside .= $inside;

			$_inside .= '</div>';

			$_inside .= genesis_get_structural_wrap( 'footer-widgets', 'close' );

			$output .= genesis_markup( array(
				'open'    => '<div %s>' . genesis_sidebar_title( 'Footer' ),
				'close'   => '</div>',
				'content' => $_inside,
				'context' => 'footer-widgets',
				'echo'    => false,
			) );

		}

		echo apply_filters( 'genesis_footer_widget_areas', $output, $footer_widgets );
	}
}

// override the genesis site footer.
add_action( 'after_setup_theme', 'childtheme_override_do_footer' );
if( !function_exists( 'childtheme_override_do_footer' ) ) {
	function childtheme_override_do_footer() {
		remove_action( 'genesis_footer', 'genesis_do_footer' );
		add_action( 'genesis_footer', 'childtheme_do_footer' );
	}
}

if( !function_exists( 'childtheme_do_footer' ) ) {
	function childtheme_do_footer() {
		echo '<p>&copy; ' . date( 'Y' ) . ' ' . get_bloginfo( 'name' ) . '</p>';
	}
}
