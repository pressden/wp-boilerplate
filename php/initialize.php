<?php
// CUSTOM POST TYPE SETUP

// initialize the banner post type
add_action( 'init', 'childtheme_initialize_banners' );
if( !function_exists( 'childtheme_initialize_banners' ) ) {
	function childtheme_initialize_banners() {
		childtheme_register_taxonomy( 'banner-group', 'Banner Group', 'Banner Groups', array( 'applies_to' => 'banner' ) );
		childtheme_register_taxonomy( 'banner-size', 'Banner Size', 'Banner Sizes', array( 'applies_to' => 'banner' ) );

		$args = array (
			'exclude_from_search' => true,
			'publicly_queryable' => false,
			'supports' => array( 'title', 'thumbnail' ),
		);

		childtheme_register_post_type( 'banner', 'Banner', 'Banners', $args );
	}
}

// initialize the contact post type (useful for staff directories / committees / boards / etc.)
add_action( 'init', 'childtheme_initialize_contacts' );
if( !function_exists( 'childtheme_initialize_contacts' ) ) {
	function childtheme_initialize_contacts() {
		childtheme_register_taxonomy( 'contact-group', 'Contact Group', 'Contact Groups', array( 'applies_to' => 'contact' ) );

		$args = array (
			'rewrite' => array( 'slug' => 'contact-directory' ),
			'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		);

		childtheme_register_post_type( 'contact', 'Contact', 'Contacts', $args );
	}
}

// initialize the faq post type
add_action( 'init', 'childtheme_initialize_faqs' );
if( !function_exists( 'childtheme_initialize_faqs' ) ) {
	function childtheme_initialize_faqs() {
		childtheme_register_taxonomy( 'faq-category', 'FAQ Category', 'FAQ Categories', array( 'applies_to' => 'faq' ) );
		childtheme_register_post_type( 'faq', 'FAQ', 'FAQs' );
	}
}

// initialize the layer post type (reusable layers shared across multiple pages / posts)
add_action( 'init', 'childtheme_initialize_layers' );
if( !function_exists( 'childtheme_initialize_layers' ) ) {
	function childtheme_initialize_layers() {
		$args = array (
			'exclude_from_search' => true,
			'publicly_queryable' => false,
			'supports' => array( 'title', 'author' ),
		);

		childtheme_register_post_type( 'layer', 'Layer', 'Layers', $args );
	}
}

// initialize the work item post type (useful for showcasing various types of client work)
add_action( 'init', 'childtheme_initialize_work_items' );
if( !function_exists( 'childtheme_initialize_work_items' ) ) {
	function childtheme_initialize_work_items() {
		childtheme_register_taxonomy( 'client', 'Client', 'Clients', array( 'applies_to' => 'work-item' ) );
		childtheme_register_taxonomy( 'work-type', 'Work Type', 'Work Types', array( 'applies_to' => 'work-item' ) );
		childtheme_register_post_type( 'work-item', 'Work Item', 'Work Items' );
	}
}
