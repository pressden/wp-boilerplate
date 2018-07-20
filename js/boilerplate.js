/* begin boilerplate.js */

$( document ).ready( function () {
	// if a parent has an href attribute allow it to be clickable
	$( '.dropdown-toggle' ).click( function() {
		if( $( this ).attr( 'href' ) && $( this ).next( '.dropdown-menu' ).is( ':visible' ) ) {
			window.location = $( this ).attr( 'href' );
		}
	});
} );
