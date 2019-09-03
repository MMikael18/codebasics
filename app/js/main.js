/* open the post header top to the page */
$( document ).ready(function() {
    $( "[data-hamburger]" ).bind( "click", function() {
        $(this).toggleClass( "is-active" );
        $("[data-hamburger-target]").toggleClass( "is-active" );        
    });
});