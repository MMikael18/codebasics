<?php
/* --------------------------- Ing --------------------------- */

require get_template_directory() . '/inc/devtools.php';
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



function post_listes( $atts ){

    $a = shortcode_atts( array(
        'foo' => 'something',
        'bar' => 'something else',
    ), $atts );

    /* main post's ID, the below line must be inside the main loop */
    $exclude = get_the_ID();

    /* alternatively to the above, this would work outside the main loop */
    global $wp_query;
    $exclude = $wp_query->post->ID;

    /* secondary query using WP_Query */
    $args = array(
        //'category_name' => 'MyCatName', // note: this is the slug, not name!
        'category_name' => 'css+html',
        'posts_per_page' => -1 // note: showposts is deprecated!
    );
    $your_query = new WP_Query( $args );

    /* loop */
	ob_start();
	?>
    <ul>
        <?php
            while( $your_query->have_posts() ) : $your_query->the_post();
                if( $exclude != get_the_ID() ) {
                    echo '<li><a href="' . get_permalink() . '">' .
                        get_the_title() . '</a></li>';
                }
            endwhile;
        ?>
    </ul>
    <?php
	return ob_get_clean();
    //return "foo = {$a['foo']}";
}
add_shortcode( 'posts', 'post_listes' );



// --------------------------- Scripts and stylesheets ---------------------------



function startwordpress_scripts() {
	//wp_enqueue_script('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js', array( 'jquery' ), '3.3.6', true );
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/scripts.js', '', '3.3.6', true );
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