<?php
// HELPERS

// register taxonomy with preferred defaults
if( !function_exists( 'childtheme_register_taxonomy' ) ) {
	function childtheme_register_taxonomy( $codename, $singular, $plural, $args = array() )
	{
		$labels = array(
			'name' => $plural,
			'singular_name' => $singular,
			'search_items' =>  'Search ' . $plural,
			'popular_items' => 'Popular ' . $plural,
			'all_items' => 'All ' . $plural,
			'edit_item' => 'Edit ' . $singular,
			'update_item' => 'Update ' . $singular,
			'add_new_item' => 'Add New ' . $singular,
			'new_item_name' => 'New ' . $singular . ' Name',
			'separate_items_with_commas' => 'Separate ' . strtolower( $plural ) . ' with commas',
			'add_or_remove_items' => 'Add or remove ' . strtolower( $plural ),
			'choose_from_most_used' => 'Choose from the most used ' . strtolower( $plural ),
			'menu_name' => $plural,
		);
		
		$defaults = array(
			'labels' => $labels,
			'applies_to' => array( 'post' ),
			'hierarchical' => true,
		);

		$args = wp_parse_args( $args, $defaults );

		register_taxonomy( $codename, $args['applies_to'], $args );
	}
}

// reguster post type with preferred defaults
if( !function_exists( 'childtheme_register_post_type' ) ) {
	function childtheme_register_post_type( $codename, $singular, $plural, $args = array() )
	{
		$labels = array(
			'name' => $plural,
			'singular_name' => $singular,
			'add_new_item' => 'Add New ' . $singular,
			'edit_item' => 'Edit ' . $singular,
			'new_item' => 'Create ' . $singular,
			'view_item' => 'View ' . $singular,
			'search_items' => 'Search ' . $singular,
			'not_found' =>  'No ' . strtolower( $plural ) . ' found',
			'not_found_in_trash' => 'No ' . strtolower( $plural ) . ' found in trash',
		);

		$defaults = array(
			'labels' => $labels,
			'capability_type' => 'post',
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes', 'post-formats' ),
			'public' => true,
			'menu_position' => 20,
			'rewrite' => array( 'slug' => $codename ),
			'has_archive' => true,
		);

		$args = wp_parse_args( $args, $defaults );

		register_post_type( $codename, $args );
	}
}

// register sidebar with preferred defaults
if( !function_exists( 'childtheme_register_sidebar' ) ) {
	function childtheme_register_sidebar( $codename, $name, $args = array() )
	{
		$defaults = array(
			'description' => '',
			'class' => '',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widgettitle">',
			'after_title'   => '</h2>',
		);

		$args = wp_parse_args( $args, $defaults );

		$args['name'] = $name;
		$args['id'] = $codename;

		if( function_exists( 'register_sidebar' ) ) {
			register_sidebar( $args );
		}
	}
}

// add open container markup
if( !function_exists( 'childtheme_container_markup_open' ) ) {
	function childtheme_container_markup_open() {
		echo '<div class="container">';
	}
}

// add close container markup
if( !function_exists( 'childtheme_container_markup_close' ) ) {
	function childtheme_container_markup_close() {
		echo '</div>';
	}
}

// add loop start markup
if( !function_exists( 'childtheme_post_markup_open' ) ) {
	function childtheme_post_markup_open() {
		?>

		<section id="post-section" class="loop-wrap layer-wrap">
			<div class="post-container container">
				<div class="post-layer layer row">
					<?php // @TODO: Add .col to post_classes instead of including it here ?>
					<div class="col">

		<?php
	}
}

// add loop end markup
if( !function_exists( 'childtheme_post_markup_close' ) ) {
	function childtheme_post_markup_close() {
		?>

					</div>
					<?php // @TODO: Add .col to post_classes instead of including it here ?>
				</div>
			</div>
		</section>

		<?php
	}
}
