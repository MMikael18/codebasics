<?php
/* --------------------------- Ing --------------------------- */



require get_template_directory() . '/inc/devtools.php';
require get_template_directory() . '/inc/template-utils.php';



// --------------------------- Scripts and stylesheets ---------------------------



function startwordpress_scripts() {
    wp_enqueue_style('Quicksand', '//fonts.googleapis.com/css?family=Quicksand:300,400,500,700', false );
    wp_enqueue_style('Roboto', '//fonts.googleapis.com/css?family=Roboto:100,200,300,400,500,700', false );
    wp_enqueue_style('Monoton', '//fonts.googleapis.com/css?family=Monoton|Roboto', false );
    

    wp_enqueue_script('codejs', get_template_directory_uri() . '/js/scripts.js', '', '1', true );
    wp_enqueue_style ('blog', get_template_directory_uri() . '/css/main.css' );	
}
add_action( 'wp_enqueue_scripts', 'startwordpress_scripts' );



// --------------------------- Theme supports ---------------------------



add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'custom-logo', array(
    'height'      => 64,
    'width'       => 248,
    'flex-height' => false,
));
add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
//add_theme_support( 'customize-selective-refresh-widgets' );



// ---------------------------  Filter ---------------------------



function wpdocs_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );



// ---------------------------  Menus ---------------------------



register_nav_menus( array(
    'top'    => __( 'Top', 'main navigation' ),
));



// ---------------------------  Sidebars ---------------------------



function theme_cb_sidebars() {
    register_sidebar( array(
        'name' => __( 'Post Sidebar', 'sidepar-post' ),
        'id' => 'sidepar-post',
        'description' => __( 'Widgets in this area will be shown on all posts.', 'sidepar-post' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h4 class="widgettitle">',
	'after_title'   => '</h4>',
    ));
}
add_action( 'widgets_init', 'theme_cb_sidebars' );



// --------------------------- Shortcodes ---------------------------



function row_shortcode( $atts, $content = null ) {
	return "<div class='row'>".do_shortcode($content)."</div>";
}
function colum_shortcode( $atts, $content = null ) {
	$a = shortcode_atts( array(
        'num' => '1',
    ), $atts );
    $grid = "col-sm-".$a['num'];
    return "<div class='$grid'>".do_shortcode($content)."</div>";
}
add_shortcode( 'row', 'row_shortcode' );
add_shortcode( 'col', 'colum_shortcode' );


?>
