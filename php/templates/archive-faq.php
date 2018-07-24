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

		<header class="archive-description container">
			<h1 class="archive-title">Frequently Asked Questions</h1>
		</header>

		<?php
	}
}

// open the accordion markup
add_action( 'genesis_loop', 'childtheme_open_faq_accordion', 5 );
if( !function_exists( 'childtheme_open_faq_accordion' ) ) {
	function childtheme_open_faq_accordion() {
		echo '<div id="faq-accordion" class="accordion">';
	}
}

// open the card markup
add_action( 'genesis_before_entry', 'childtheme_open_faq_entry' );
if( !function_exists( 'childtheme_open_faq_entry' ) ) {
	function childtheme_open_faq_entry() {
		echo '<div class="card">';
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

		echo '<section id="' . $entry_content_id . '" class="card-body collapse" aria-labelledby="' . $entry_content_id . '" data-parent="#faq-accordion">';
	}
}

// close the collapsible content markup
add_action( 'genesis_entry_content', 'childtheme_close_faq_post_content', 15 );
if( !function_exists( 'childtheme_close_faq_post_content' ) ) {
	function childtheme_close_faq_post_content() {
		echo '</section>';
	}
}

// close markup (div)
add_action( 'genesis_after_entry', 'childtheme_close_faq_div' );
add_action( 'genesis_loop', 'childtheme_close_faq_div', 15 );
if( !function_exists( 'childtheme_close_faq_div' ) ) {
	function childtheme_close_faq_div() {
		echo '</div>';
	}
}
