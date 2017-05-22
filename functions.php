<?php
/* --------------------------- Ing --------------------------- */



require get_template_directory() . '/inc/devtools.php';
require get_template_directory() . '/inc/template-utils.php';



// --------------------------- Scripts and stylesheets ---------------------------



function startwordpress_scripts() {
    wp_enqueue_style('Quicksand', 'https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700', false );
    wp_enqueue_style('Roboto', 'https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet', false );
    

    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/scripts.js', '', '3.3.6', true );
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
        'grid' => '1',
    ), $atts );
    $grid = "col-sm-".$a['grid'];
    return "<div class='$grid'>".do_shortcode($content)."</div>";
}
add_shortcode( 'row', 'row_shortcode' );
add_shortcode( 'col', 'colum_shortcode' );

function post_lister( $atts ){

    /* main post's ID, the below line must be inside the main loop */
    $exclude = get_the_ID();

    /* alternatively to the above, this would work outside the main loop */
    //global $wp_query;
    $exclude = $wp_query->post->ID;

    /* secondary query using WP_Query */
    $args = array(
        'category_name' => '',
        'posts_per_page' => 10 // note: showposts is deprecated!
    );
    $your_query = new WP_Query( $args );

    /* loop */
	ob_start();    
    echo "<div class='post-cards'>";
    $colm = [];
    $colm_num = 0;

    while( $your_query->have_posts() ) : $your_query->the_post();            
            
            ob_start();
            get_template_part( 'template-parts/post-cards-thumb', get_post_format() );            
            $colm[$colm_num] .= ob_get_contents();
            $colm_num += $colm_num == 3 ? -3 : 1 ;
            ob_end_clean();
        
    endwhile;

    echo "<div class='post-column' >" . $colm[0] . "</div>";
    echo "<div class='post-column' >" . $colm[1] . "</div>";
    echo "<div class='post-column' >" . $colm[2] . "</div>";
    echo "<div class='post-column' >" . $colm[3] . "</div>";

    echo "</div>";

	return ob_get_clean();
}
add_shortcode( 'posts', 'post_lister' );




/*

function subjects_init() {
	// create a new taxonomy
	register_taxonomy(
		'subjects',
		'articles',
		array(
			'label' => __( 'Subjects' ),
			'rewrite' => array( 'slug' => 'subjects' ),
            'hierarchical' => true,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true
		)

	);
}
add_action( 'init', 'subjects_init' );



function create_post_your_post() {
	register_post_type( 'articles',
		array(
			'labels'       => array(
				'name'       => __( 'Articles' ),
			),
			'public'       => true,
			'hierarchical' => true,
			'has_archive'  => true,
            'menu_position' => 5,
			'supports'     => array(
				'title',
				'editor',
				'excerpt',
				'thumbnail',
			), 
			'taxonomies'   => array(
				'post_sub'
			)
		)
	);
    register_taxonomy_for_object_type( 'post_sub', 'your_post' );
}
add_action( 'init', 'create_post_your_post' );



*/

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
