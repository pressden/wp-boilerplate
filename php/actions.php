<?php
// ACTIONS

// modify the faq archive main query
add_filter( 'pre_get_posts', 'childtheme_modify_faq_archive_query' );
if( !function_exists( 'childtheme_modify_faq_archive_query' ) ) {
	function childtheme_modify_faq_archive_query( $query ) {
		if ( $query->is_main_query() && $query->is_post_type_archive( 'faq' ) ) {
			// Remove the `posts_per_page` limit so all FAQ's load on a single page
			$query->query_vars['posts_per_page'] = -1;
		}

		return $query;
	}
}

// enqueue fonts
add_action( 'wp_enqueue_scripts', 'childtheme_enqueue_fonts' );
if( !function_exists( 'childtheme_enqueue_fonts' ) ) {
	function childtheme_enqueue_fonts() {
		// Google fonts
		wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Lato:300,400,700|Roboto:300,400,700|Material+Icons', array(), CHILD_THEME_VERSION );
	}
}

// enqueue styles
add_action( 'wp_enqueue_scripts', 'childtheme_enqueue_styles' );
if( !function_exists( 'childtheme_enqueue_styles' ) ) {
	function childtheme_enqueue_styles() {
		// main CSS file (generated via webpack from SASS files)
		wp_enqueue_style( 'main', get_stylesheet_directory_uri() . '/dist/main.css' );
	}
}

// enqueue scripts
add_action( 'wp_enqueue_scripts', 'childtheme_enqueue_scripts' );
if( !function_exists( 'childtheme_enqueue_scripts' ) ) {
	function childtheme_enqueue_scripts() {
		// main JS file (generated via webpack)
		wp_enqueue_script( 'bundle', get_stylesheet_directory_uri() . '/dist/main.js', array( 'jquery' ), 1, false );
	}
}

/*
// setup custom functionality for the childtheme
add_action( 'after_setup_theme', 'childtheme_setup_theme' );
function childtheme_setup_theme() {
	remove_action( 'genesis_after_header', 'genesis_do_nav' );
	add_action( 'genesis_before_header', 'genesis_do_nav' );
}
*/

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

// ensure all page sections have the proper containers
//add_action( 'genesis_entry_header', 'childtheme_container_markup_open', 6 );
//add_action( 'genesis_entry_header', 'childtheme_container_markup_close', 14 );
add_action( 'the_post', 'childtheme_add_post_markup' );

if( !function_exists( 'childtheme_add_post_markup' ) ) {
	function childtheme_add_post_markup() {
		if( is_home() ) {
			add_action( 'genesis_before_entry', 'childtheme_post_markup_open', 6 );
			add_action( 'genesis_after_entry', 'childtheme_post_markup_close', 14 );
		}
	}
}

// wrap entry-content in a container on specific pages
if( !function_exists( 'childtheme_add_container_markup' ) ) {
	function childtheme_add_container_markup() {
		if( is_home() ) {
			//add_action( 'genesis_entry_content', 'childtheme_container_markup_open', 6 );
			//add_action( 'genesis_entry_content', 'childtheme_container_markup_close', 14 );
		}
	}
}

// move the after entry widget and ensure the functionality is added to pages
add_action( 'after_setup_theme', 'childtheme_move_after_entry_widget' );
if( !function_exists( 'childtheme_move_after_entry_widget' ) ) {
	function childtheme_move_after_entry_widget() {
		remove_action( 'genesis_after_entry', 'genesis_after_entry_widget_area' );
		//add_action( 'genesis_entry_footer', 'childtheme_container_markup_open', 6 );
		add_action( 'genesis_entry_footer', 'genesis_after_entry_widget_area' );
		//add_action( 'genesis_entry_footer', 'childtheme_container_markup_close', 14 );
		add_post_type_support( 'page', 'genesis-after-entry-widget-area' );
	}
}

// add widget areas to the utility bar
add_action( 'after_setup_theme', 'childtheme_register_utility_widget_areas' );
if( !function_exists( 'childtheme_register_utility_widget_areas' ) ) {
	function childtheme_register_utility_widget_areas() {
		$counter = 1;

		while ( $counter <= 3 ) {
			genesis_register_widget_area(
				array(
					'id'               => sprintf( 'utility-%d', $counter ),
					'name'             => sprintf( 'Utility %d', $counter ),
					'description'      => sprintf( 'Utility %d widget area.', $counter ),
				)
			);

			$counter++;
		}
	}
}

if( !function_exists( 'childtheme_utility_widget_areas' ) ) {
	function childtheme_utility_widget_areas() {

		$inside  = '';
		$output  = '';
	 	$counter = 1;
		$utility_widgets = 3;

		while ( $counter <= $utility_widgets ) {

			// Darn you, WordPress! Gotta output buffer.
			ob_start();
			dynamic_sidebar( 'utility-' . $counter );
			$widgets = ob_get_clean();

			if ( $widgets ) {
				$inside .= genesis_markup(
					array(
						'open'    => '<div %s>',
						'close'   => '</div>',
						'context' => 'utility-widget-area',
						'content' => $widgets,
						'echo'    => false,
						'params'  => array(
							'column' => $counter,
							'count'  => $utility_widgets,
						)
					)
				);
			}

			$counter++;

		}

		if ( $inside ) {
			$_inside = genesis_structural_wrap( 'utility-widgets', 'open', 0 );
			$_inside .= '<div class="row">';
			$_inside .= $inside;
			$_inside .= '</div>';
			$_inside .= genesis_structural_wrap( 'utility-widgets', 'close', 0 );

			$output .= genesis_markup( array(
				'open'    => '<section %s>' . genesis_sidebar_title( 'Utility' ),
				'close'   => '</section>',
				'content' => $_inside,
				'context' => 'utility-widgets',
				'echo'    => false,
			) );

		}

		echo apply_filters( 'genesis_utility_widget_areas', $output, $utility_widgets );
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

			$_inside = genesis_structural_wrap( 'footer-widgets', 'open', 0 );

			$_inside .= '<div class="row">';

			$_inside .= $inside;

			$_inside .= '</div>';

			$_inside .= genesis_structural_wrap( 'footer-widgets', 'close', 0 );

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
