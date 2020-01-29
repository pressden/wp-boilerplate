<?php
// ACTIONS

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
