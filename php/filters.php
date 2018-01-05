<?php
// FILTERS

//* Add custom body class to the head
add_filter( 'body_class', 'childtheme_body_class' );
if( !function_exists( 'childtheme_body_class' ) ) {
	function childtheme_body_class( $classes ) {
		$classes[] = 'boilerplate';
		$classes[] = 'childtheme';
		return $classes;
	}
}

//* Add Bootstrap 4 compatibility via a content wrapper (if the ACF Pro Layers plugin is not activated)
if( !function_exists( apl_content_layers_filter) ) {
	add_filter( 'the_content', 'childtheme_content_layers_filter' );
	function childtheme_content_layers_filter ( $content ) {
	  // initialize the output variable
		$output = '';
		
		// name the layer wordpress-content
		$layer_name = 'wordpress-content';
		
		// generate a unique ID for direct targeting
		$layer_id = 'apl-content-0-' . $layer_name;
		
		// wrap code extracted from the APL Pro Layers plugin
	  $output.= '
			<section id="' . $layer_id . '" class="' . $layer_name . '-wrap layer-wrap">
				<div class="container ' . $layer_name . '-container">
	      	<div class="' . $layer_name . '-layer layer row">
						<div class="col">
							' . $content . '
						</div>
					</div>
				</div>
			</section>
		';

	  return $output;
	}
}
