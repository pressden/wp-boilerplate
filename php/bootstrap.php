<?php
// BOOTSTRAP

// filter menu args to apply bootstrap walker and other settings
add_filter( 'wp_nav_menu_args', 'childtheme_nav_menu_args_filter' );
if( !function_exists( 'childtheme_nav_menu_args_filter' ) ) {
	function childtheme_nav_menu_args_filter( $args ) {
		// define a useful menu container id
		$container_id = $args['theme_location'] . '-menu-container';
		$menu_id = $args['theme_location'] . '-menu';

		// customize output based on theme location
		switch( $args['theme_location'] ) {
			case 'primary':
				$args['items_wrap'] = '
					<div class="container navbar navbar-expand-md navbar-light" id="' . $container_id . '">
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#' . $menu_id . '" aria-controls="' . $menu_id . '" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>

						<div class="collapse navbar-collapse" id="' . $menu_id . '">
							<ul id="%1$s" class="%2$s nav nav-pills nav-fill">
								%3$s
							</ul>
						</div>
					</div>
				';

				$args['depth'] = 2;
				$args['menu_class'] = 'navbar-nav';

				$args['fallback_cb'] = 'wp_bootstrap_navwalker::fallback';
				$args['walker'] = new wp_bootstrap_navwalker();
			break;

			case 'secondary':
				$args['items_wrap'] = '
					<div class="container navbar navbar-expand-md navbar-light" id="' . $container_id . '">
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#' . $menu_id . '" aria-controls="' . $menu_id . '" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>

						<div class="collapse navbar-collapse" id="' . $menu_id . '">
							<ul id="%1$s" class="%2$s">
								%3$s
							</ul>
						</div>
					</div>
				';

				$args['depth'] = 2;
				$args['menu_class'] = 'navbar-nav';

				$args['fallback_cb'] = 'wp_bootstrap_navwalker::fallback';
				$args['walker'] = new wp_bootstrap_navwalker();
			break;

			default:
				// nothing to do here
			break;
		}

		return $args;
	}
}

// add bootstrap rows wherever they are missing
add_action( 'genesis_header', 'childtheme_bootstrap_open_row', 10 );
if( !function_exists( 'childtheme_bootstrap_open_row' ) ) {
	function childtheme_bootstrap_open_row() {
		echo '<div class="row">';
	}
}

add_action( 'genesis_header', 'childtheme_bootstrap_close_row', 11 );
if( !function_exists( 'childtheme_bootstrap_close_row' ) ) {
	function childtheme_bootstrap_close_row() {
		echo '</div>';
	}
}

// add bootstrap markup around entry header
add_action( 'genesis_entry_header', 'childtheme_entry_header_markup_open', 10 );
if( !function_exists( 'childtheme_entry_header_markup_open' ) ) {
	function childtheme_entry_header_markup_open() {
		if( is_singular() ) {
			?>

			<div class="entry-header-wrap layer-wrap">
				<div class="entry-header-container container">
					<div class="entry-header-layer layer row">
						<?php // @TODO: Add .col to post_classes instead of including it here ?>
						<div class="col">

			<?php
		}
	}
}

add_action( 'genesis_entry_header', 'childtheme_entry_header_markup_close', 13 );
if( !function_exists( 'childtheme_entry_header_markup_close' ) ) {
	function childtheme_entry_header_markup_close() {
		if( is_singular() ) {
			?>

						</div>
						<?php // @TODO: Add .col to post_classes instead of including it here ?>
					</div>
				</div>
			</div>

			<?php
		}
	}
}

// add bootstrap markup around entry footer
add_action( 'genesis_entry_footer', 'childtheme_entry_footer_markup_open', 7 );
if( !function_exists( 'childtheme_entry_footer_markup_open' ) ) {
	function childtheme_entry_footer_markup_open() {
		if( is_singular() ) {
			?>

			<div class="entry-footer-wrap layer-wrap">
				<div class="entry-footer-container container">
					<div class="entry-footer-layer layer row">
						<?php // @TODO: Add .col to post_classes instead of including it here ?>
						<div class="col">

			<?php
		}
	}
}

add_action( 'genesis_entry_footer', 'childtheme_entry_footer_markup_close', 13 );
if( !function_exists( 'childtheme_entry_footer_markup_close' ) ) {
	function childtheme_entry_footer_markup_close() {
		if( is_singular() ) {
			?>

						</div>
						<?php // @TODO: Add .col to post_classes instead of including it here ?>
					</div>
				</div>
			</div>

			<?php
		}
	}
}

// add bootstrap classes throughout the layout
add_filter( 'genesis_attr_site-container',              'childtheme_add_bootstrap_classes', 11, 2 );
add_filter( 'genesis_attr_structural-wrap',             'childtheme_add_bootstrap_classes', 11, 2 );
add_filter( 'genesis_attr_site-header',                 'childtheme_add_bootstrap_classes', 11, 2 );
add_filter( 'genesis_attr_title-area',                  'childtheme_add_bootstrap_classes', 11, 2 );
add_filter( 'genesis_attr_utility-widget-area',         'childtheme_add_bootstrap_classes', 11, 2 );
add_filter( 'genesis_attr_header-widget-area',          'childtheme_add_bootstrap_classes', 11, 2 );
add_filter( 'genesis_attr_nav-primary',                 'childtheme_add_bootstrap_classes', 11, 2 );
add_filter( 'genesis_attr_nav-secondary',               'childtheme_add_bootstrap_classes', 11, 2 );
add_filter( 'genesis_attr_site-inner',                  'childtheme_add_bootstrap_classes', 11, 2 );
add_filter( 'genesis_attr_content-sidebar-wrap',        'childtheme_add_bootstrap_classes', 11, 2 );
add_filter( 'genesis_attr_content',                     'childtheme_add_bootstrap_classes', 11, 2 );
add_filter( 'genesis_attr_sidebar-primary',             'childtheme_add_bootstrap_classes', 11, 2 );
add_filter( 'genesis_attr_sidebar-secondary',           'childtheme_add_bootstrap_classes', 11, 2 );
add_filter( 'genesis_attr_archive-pagination',          'childtheme_add_bootstrap_classes', 11, 2 );
add_filter( 'genesis_attr_search-form',                 'childtheme_add_bootstrap_classes', 11, 2 );
add_filter( 'genesis_attr_entry-header',                'childtheme_add_bootstrap_classes', 11, 2 );
add_filter( 'genesis_attr_blog-template-description',   'childtheme_add_bootstrap_classes', 11, 2 );
add_filter( 'genesis_attr_posts-page-description',      'childtheme_add_bootstrap_classes', 11, 2 );
add_filter( 'genesis_attr_taxonomy-archive-description','childtheme_add_bootstrap_classes', 11, 2 );
add_filter( 'genesis_attr_entry',               				'childtheme_add_bootstrap_classes', 11, 2 );
add_filter( 'genesis_attr_entry-content',               'childtheme_add_bootstrap_classes', 11, 2 );
add_filter( 'genesis_attr_entry-footer',                'childtheme_add_bootstrap_classes', 11, 2 );
add_filter( 'genesis_attr_entry-pagination',            'childtheme_add_bootstrap_classes', 11, 2 );
add_filter( 'genesis_attr_site-footer',                 'childtheme_add_bootstrap_classes', 11, 2 );
add_filter( 'genesis_attr_footer-widget-area',          'childtheme_add_bootstrap_classes', 11, 2 );

if( !function_exists( 'childtheme_add_bootstrap_classes' ) ) {
	function childtheme_add_bootstrap_classes( $attr, $context ) {
		// default classes to add
		$classes_to_add = apply_filters (
			'childtheme_bootstrap_classes',
			array(
				// top level containers
				'structural-wrap'             => 'container',

				// layout containers
				'site-inner'                  => 'container',

				// grid variations
				'content-sidebar-wrap'        => 'row',

				// utility regions
				'utility-widget-area'         => 'col-lg',

				// header regions
				'title-area'                  => 'col-lg-4',
				'header-widget-area'          => 'col-lg-8',

				// archive and template titles
				'blog-template-description'   => 'container',
				'posts-page-description'      => 'container',
				'taxonomy-archive-description'=> 'col-12',

				// nav regions
				//'nav-primary'               => 'container navbar navbar-expand-md navbar-light', // navbar-static-top
				//'nav-secondary'             => 'container navbar navbar-expand-md navbar-light', // navbar-static-top
				
				// search form
				'search-form'									=> 'form-inline',

				// main regions
				'content'                     => 'col-md-9',
				'sidebar-primary'             => 'col-md-3',
				'archive-pagination'          => 'clearfix',
				'entry'												=> 'col-12',
				'entry-header'                => 'clearfix',
				'entry-content'               => 'clearfix',
				'entry-footer'                => 'clearfix',
				'entry-pagination'            => 'clearfix',

				// footer regions
				'footer-widget-area'          => 'col-lg',
			),
			$context,
			$attr
		);

		// populate $classes_array based on $classes_to_add
		$value = isset( $classes_to_add[ $context ] ) ? $classes_to_add[ $context ] : array();

		if ( is_array( $value ) ) {
			$classes_array = $value;
		} else {
			$classes_array = explode( ' ', (string) $value );
		}

		// apply any filters to modify the class
		$classes_array = apply_filters( 'childtheme_add_class', $classes_array, $context, $attr );

		$classes_array = array_map( 'sanitize_html_class', $classes_array );

		// append the class(es) string (e.g. 'span9 custom-class1 custom-class2')
		$attr['class'] .= ' ' . implode( ' ', $classes_array );

		return $attr;
	}
}

// modify bootstrap classes based on genesis_site_layout
add_filter('childtheme_bootstrap_classes', 'childtheme_bootstrap_classes_layout_filter', 10, 3);
if( !function_exists( 'childtheme_bootstrap_classes_layout_filter' ) ) {
	function childtheme_bootstrap_classes_layout_filter( $classes_to_add, $context, $attr ) {
		$classes_to_add = childtheme_add_bootstrap_layout_classes( $classes_to_add );

		return $classes_to_add;
	}
}

if( !function_exists( 'childtheme_add_bootstrap_layout_classes' ) ) {
	function childtheme_add_bootstrap_layout_classes( $classes_to_add ) {
		$layout = genesis_site_layout();

		switch ( $layout ) {
			case 'full-width-content':
				$classes_to_add['site-inner'] = '';
				$classes_to_add['content-sidebar-wrap'] = '';
				$classes_to_add['content'] = '';
			break;

			case 'sidebar-content':
				$classes_to_add['content'] = 'col-lg-9 order-lg-last';
				$classes_to_add['sidebar-primary'] = 'col-lg-3';
			break;

			case 'content-sidebar-sidebar':
				$classes_to_add['content'] = 'col-lg-6';
				$classes_to_add['sidebar-primary'] = 'col-lg-3';
				$classes_to_add['sidebar-secondary'] = 'col-lg-3';
			break;

			case 'sidebar-sidebar-content':
				$classes_to_add['content'] = 'col-lg-6 order-lg-last';
				$classes_to_add['sidebar-primary'] = 'col-lg-3';
				$classes_to_add['sidebar-secondary'] = 'col-lg-3';
			break;

			case 'sidebar-content-sidebar':
				$classes_to_add['content'] = 'col-lg-6';
				$classes_to_add['sidebar-primary'] = 'col-lg-3 order-lg-first';
				$classes_to_add['sidebar-secondary'] = 'col-lg-3';
			break;

			default:
				// content-sidebar - no changes needed
			break;
		}

		return $classes_to_add;
	};
}
