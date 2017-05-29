

/* open the post header top to the page */


$( document ).ready(function() {
    
    $( "#open-post-header" ).bind( "click", function() {
        $( "[data-post-header]" ).toggle();
        $( "#open-post-header" ).toggle();
    });

    $( "#close-header-post" ).bind( "click", function() {
        $( "[data-post-header]" ).toggle();
        $( "#open-post-header" ).show();  
    });
    
});

