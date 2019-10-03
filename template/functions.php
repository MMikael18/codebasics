<?php
//require_once  get_template_directory() . '/inc/devtools.php';
require_once  get_template_directory() . '/lib/theme-settings.php';
//require_once  get_template_directory() . '/lib/recaptcha-options-page.php';
require_once  get_template_directory() . '/lib/post_wall.php';

class CodeBasics {

    function __construct() {
        //
        add_action( 'wp_enqueue_scripts', [$this, 'enqueue_script'] );
        // 
        add_action( 'admin_init',         [$this, 'add_editor_styles'] );
        add_filter( 'excerpt_length',     [$this, 'wpdocs_custom_excerpt_length'], 999 );
        add_filter('comment_form_default_fields', [$this, 'remove_fields_from_comment_form'] );
    }

    /*
    *
    * Enqueue_script
    *
    */

    function enqueue_script() {        
        wp_enqueue_script('codejs', get_template_directory_uri() . '/js/scripts.js', '', '1.0', true );
        wp_enqueue_style ('blog', get_template_directory_uri() . '/style.css', array(), '1.0' );
        //wp_enqueue_style('Quicksand', '//fonts.googleapis.com/css?family=Quicksand:300,400,500,700', false );
    }
 
    /*
    * 
    * Admin inits
    *
    */  

    function add_editor_styles() {
        add_editor_style( 'editor.css' );
    }

    /*
    *
    * Change lenght of excerpt
    *
    */

    function wpdocs_custom_excerpt_length( $length ) {
        return 25;
    }

    /*
    *
    * remove email to comments
    *
    */

    function remove_fields_from_comment_form($fields) {
        if(isset($fields['email'])) unset($fields['email']);
        if(isset($fields['url'])) unset($fields['url']);
        return $fields;
    }
    

}
$codebasics = new CodeBasics();

/*
*
* GetPosts
*
*/

// function colum_shortcode( $atts, $content = null ) {
// 	$a = shortcode_atts( array(
//         'num' => '1',
//     ), $atts );
//     $grid = "col-sm-".$a['num'];
//     return "<div class='$grid'>".do_shortcode($content)."</div>";
// }



//add_shortcode( 'col', 'colum_shortcode' );

/* OLDS */

/* No JQ Migrate - http://subinsb.com/remove-jquery-migrate-in-wp-blog */
// add_filter( 'wp_default_scripts', 'removeJqueryMigrate' );
// function removeJqueryMigrate(&$scripts){
//  if(!is_admin()){
//   $scripts->remove('jquery');
//  }
// }

// function add_async_attribute($tag, $handle) {
//    // add script handles to the array below wp_register_script
//    $scripts_to_async = array('recaptcha');
   
//    foreach($scripts_to_async as $async_script) {
//       if ($async_script === $handle) {
//          return str_replace(' src', ' async="async" src', $tag);
//       }
//    }
//    return $tag;
// }
// add_filter('script_loader_tag', 'add_async_attribute', 10, 2);

// add_filter( 'jpeg_quality', create_function( '', 'return 75;' ) );



/* ************************************************************************ */
/* -------------------------- Editor css file ----------------------------- */
/* ************************************************************************ */



// function theme_add_editor_styles() {
//     add_editor_style( 'editor.css' );
// }
// add_action( 'admin_init', 'theme_add_editor_styles' );


/* ************************************************************************ */
// ---------------------------  Filter ---------------------------
/* ************************************************************************ */



// function wpdocs_custom_excerpt_length( $length ) {
//     return 30;
// }
// add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );



/* ************************************************************************ */
// ---------------------------  Menus ---------------------------
/* ************************************************************************ */



// register_nav_menus( array(
//     'top'    => __( 'Top', 'main navigation' ),
// ));



/* ************************************************************************ */
// ---------------------------  Sidebars ---------------------------
/* ************************************************************************ */



// function theme_cb_sidebars() {
//     register_sidebar( array(
//         'name' => __( 'Post Sidebar', 'sidepar-post' ),
//         'id' => 'sidepar-post',
//         'description' => __( 'Widgets in this area will be shown on all posts.', 'sidepar-post' ),
//         'before_widget' => '<div id="%1$s" class="widget %2$s">',
// 	'after_widget'  => '</div>',
// 	'before_title'  => '<h4 class="widgettitle">',
// 	'after_title'   => '</h4>',
//     ));
// }
// add_action( 'widgets_init', 'theme_cb_sidebars' );



/* ************************************************************************ */
// --------------------------- Shortcodes ---------------------------
/* ************************************************************************ */



// function row_shortcode( $atts, $content = null ) {
// 	return "<div class='row'>".do_shortcode($content)."</div>";
// }
// function colum_shortcode( $atts, $content = null ) {
// 	$a = shortcode_atts( array(
//         'num' => '1',
//     ), $atts );
//     $grid = "col-sm-".$a['num'];
//     return "<div class='$grid'>".do_shortcode($content)."</div>";
// }
// add_shortcode( 'row', 'row_shortcode' );
// add_shortcode( 'col', 'colum_shortcode' );


?>