$(function() {

  $( '.theme-option' ).on( 'click', function() {
    $( '.theme-option' ).removeClass( 'active' );
    $( '.themes-list option' ).removeAttr( 'selected' );
    $( '.themes-list option[value="' + $( this ).attr( 'data-value' ) + '"]' ).attr( 'selected', true );
    $( this ).addClass( 'active' );
  });

});
