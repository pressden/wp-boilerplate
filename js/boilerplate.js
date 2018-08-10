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

	// add Bootstrap 4 pagination classes to the genesis pagination markup
	// @TODO: Genesis (v2.6.1) does not allow direct access to the ul, li or a tags. Perhaps someday...
	$( 'div.pagination ul' ).addClass( 'pagination' );
	$( 'div.pagination li' ).addClass( 'page-item' );
	$( 'div.pagination li.pagination-omission' ).addClass( 'disabled' ).html( '<a href="javascript:void(0);" class="page-link"> ... </a>' );
	$( 'div.pagination a' ).addClass( 'page-link' );
	$( 'div.pagination' ).removeClass( 'pagination' );

} );
