<?php
// override content archive option
add_filter( 'genesis_pre_get_option_content_archive','childtheme_override_content_archive' );
if( !function_exists( 'childtheme_override_content_archive' ) ) {
	function childtheme_override_content_archive() {
		if ( is_post_type_archive( 'faq' ) ) {
			return 'full';
		}
	}
}

// override content archive limit
add_filter( 'genesis_pre_get_option_content_archive_limit','childtheme_override_content_archive_limit' );
if( !function_exists( 'childtheme_override_content_archive_limit' ) ) {
	function childtheme_override_content_archive_limit() {
		if ( is_post_type_archive( 'faq' ) ) {
			return 0;
		}
	}
}

// do the archive title
add_action( 'genesis_before_loop', 'childtheme_do_faq_title', 15 );
if( !function_exists( 'childtheme_do_faq_title' ) ) {
	function childtheme_do_faq_title() {
		?>

		<header class="archive-description col-12">
			<h1 class="archive-title">Frequently Asked Questions</h1>
		</header>

		<?php
	}
}

// open the accordion markup
add_action( 'genesis_loop', 'childtheme_open_faq_accordion', 5 );
if( !function_exists( 'childtheme_open_faq_accordion' ) ) {
	function childtheme_open_faq_accordion() {
		echo '<div id="faq-accordion" class="accordion col-12">';
	}
}

// override the bootstrap filter to output render articles in two columns
add_filter( 'childtheme_bootstrap_classes', 'childtheme_modify_bootstrap_faq_classes', 11, 3 );
if( !function_exists( 'childtheme_modify_bootstrap_faq_classes' ) ) {
	function childtheme_modify_bootstrap_faq_classes( $classes_to_add, $context, $attr ) {
		$classes_to_add['entry'] = 'card';
		$classes_to_add['entry-content'] = 'collapse';

		return $classes_to_add;
	}
}

// add additional attributes to the entry-content markup
add_filter( 'genesis_attr_entry-content_output', 'childtheme_add_entry_content_attributes', 10, 4 );
if( !function_exists( 'childtheme_add_entry_content_attributes' ) ) {
	function childtheme_add_entry_content_attributes( $output, $attributes, $context, $args ) {
		$entry_content_id = 'entry-content-' . get_the_ID();

		$output .= ' id="' . $entry_content_id . '" aria-labelledby="' . $entry_content_id . '" data-parent="#faq-accordion"';

		return $output;
	}
}

// remove the default entry header markup
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

// do the card header markup
add_action( 'genesis_entry_header', 'childtheme_do_faq_entry_header' );
if( !function_exists( 'childtheme_do_faq_entry_header' ) ) {
	function childtheme_do_faq_entry_header() {
		// target the collapsible content via unique id
		$entry_content_id = 'entry-content-' . get_the_ID();
		?>

		<header class="faq-entry-header card-header">
			<h2>
				<a class="collapsed" data-toggle="collapse" data-target="#<?php echo $entry_content_id; ?>" aria-expanded="false" aria-controls="<?php echo $entry_content_id; ?>">
					<?php the_title(); ?>
				</a>
			</h2>
		</header>

		<?php
	}
}

// open the collapsible content markup
add_action( 'genesis_entry_content', 'childtheme_open_faq_post_content', 5 );
if( !function_exists( 'childtheme_open_faq_post_content' ) ) {
	function childtheme_open_faq_post_content() {
		// give the collapsible content a unique id
		$entry_content_id = 'entry-content-' . get_the_ID();

		echo '<div class="card-body">';
	}
}

// close markup (div)
add_action( 'genesis_loop', 'childtheme_close_faq_div', 15 );
add_action( 'genesis_entry_content', 'childtheme_close_faq_div', 15 );
if( !function_exists( 'childtheme_close_faq_div' ) ) {
	function childtheme_close_faq_div() {
		echo '</div>';
	}
}
