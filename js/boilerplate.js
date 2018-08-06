/* begin boilerplate.js */

$( document ).ready( function () {

	// add a hover event to our dropdowns
	$( '.dropdown' ).hover(
		function() {
			$( this ).find( '.dropdown-menu' ).addClass( 'show' );
		},
		function() {
			$( this ).find( '.dropdown-menu' ).removeClass( 'show' );
		}
	);

	// allow dropdown parents with href attributes to be clickable
	$( '.dropdown-toggle' ).click( function() {
		if( $( this ).attr( 'href' ) && $( this ).next( '.dropdown-menu' ).is( ':visible' ) ) {
			window.location = $( this ).attr( 'href' );
		}
	} );

} );
