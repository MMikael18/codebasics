<?php
/* --------------------------- Ing --------------------------- */
require get_template_directory() . '/inc/template-utils.php';

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

// This theme uses wp_nav_menu() in two locations.
register_nav_menus( array(
    'top'    => __( 'Top', 'main navigation' ),
));

add_action( 'widgets_init', 'theme_slug_widgets_init' );
function theme_slug_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Post Sidebar', 'sidepar-post' ),
        'id' => 'sidepar-post',
        'description' => __( 'Widgets in this area will be shown on all posts.', 'sidepar-post' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>',
    ));
}

// Add scripts and stylesheets
function startwordpress_scripts() {
	//wp_enqueue_style ('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css', array(), '3.3.6' );
	//wp_enqueue_script('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js', array( 'jquery' ), '3.3.6', true );

    wp_enqueue_style ('blog', get_template_directory_uri() . '/css/main.css' );	
}

add_action( 'wp_enqueue_scripts', 'startwordpress_scripts' );

// Add Google Fonts
// function startwordpress_google_fonts() {
//     wp_register_style('OpenSans', 'http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800');
//     wp_enqueue_style( 'OpenSans');
// }
// add_action('wp_print_styles', 'startwordpress_google_fonts');

/* Adds the individual sections, settings, and controls to the theme customizer */
// adding setting for copyright text
/*
function theme_copyright_customizer($wp_customize) {
    //adding section in wordpress customizer   
    $wp_customize->add_section('copyright_extras_section', array(
        'title'          => 'Copyright Text Section'
    ));

    //adding setting for copyright text
    $wp_customize->add_setting('text_setting', array(
        'default'        => 'Default Text For copyright Section',
    ));

    $wp_customize->add_control('text_setting', array(
        'label'   => 'Copyright text',
        'section' => 'copyright_extras_section',
        'type'    => 'text',
    ));
}
add_action('customize_register', 'theme_copyright_customizer');
*/

?>