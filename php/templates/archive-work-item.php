<?php
// override content archive option
add_filter( 'genesis_pre_get_option_content_archive','childtheme_override_work_item_archive_option' );
if( !function_exists( 'childtheme_override_work_item_archive_option' ) ) {
	function childtheme_override_work_item_archive_option() {
		if ( is_post_type_archive( 'work-item' ) ) {
			return 'full';
		}
	}
}

// override content archive limit
add_filter( 'genesis_pre_get_option_content_archive_limit','childtheme_override_work_item_archive_limit' );
if( !function_exists( 'childtheme_override_work_item_archive_limit' ) ) {
	function childtheme_override_work_item_archive_limit() {
		if ( is_post_type_archive( 'work-item' ) ) {
			return 0;
		}
	}
}

// do the archive title
add_action( 'genesis_before_loop', 'childtheme_do_work_item_title', 15 );
if( !function_exists( 'childtheme_do_work_item_title' ) ) {
	function childtheme_do_work_item_title() {
		?>

		<header class="archive-description">
			<h1 class="archive-title">Portfolio</h1>
		</header>

		<?php
	}
}
