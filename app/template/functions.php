<?php
/* ************************************************************************ */
/* ----------------------------- Includes --------------------------------- */
/* ************************************************************************ */



require get_template_directory() . '/inc/devtools.php';
require get_template_directory() . '/inc/template-utils.php';




/* ************************************************************************ */
/* ----------------------------- Customizer   ----------------------------- */
/* ************************************************************************ */

// add_action('customize_register','mytheme_customizer_options');
// function mytheme_customizer_options( $wp_customize ) {
// 	$wp_customize->get_section('header_image')->title = __( 'Featured Image' );
// }



add_theme_support( 'custom-header' );



/* ************************************************************************ */
/* ----------------------------- Recaptcha ----------------------------- */
/* ************************************************************************ */




function no_captcha_recaptcha_menu() {
	add_menu_page("reCapatcha", "reCaptcha", "manage_options", "recaptcha-options", "recaptcha_options_page", "", 100);
}

function recaptcha_options_page() { ?>
	<div class="wrap">
		<h1>reCaptcha</h1>
		<form method="post" action="options.php">
		<?php 
			settings_fields("header_section");
			do_settings_sections("recaptcha-options");
			submit_button(); 
		?>          
		</form>
	</div>
<?php }
add_action("admin_menu", "no_captcha_recaptcha_menu");

function display_recaptcha_options() {
	add_settings_section("header_section", "Keys", "display_recaptcha_content", "recaptcha-options");

	add_settings_field("captcha_site_key", __("Site Key"), "display_captcha_site_key_element", "recaptcha-options", "header_section");
	add_settings_field("captcha_secret_key", __("Secret Key"), "display_captcha_secret_key_element", "recaptcha-options", "header_section");

	register_setting("header_section", "captcha_site_key");
	register_setting("header_section", "captcha_secret_key");
}

function display_recaptcha_content() {
	echo __('<p>You need to <a href="https://www.google.com/recaptcha/admin" rel="external">register you domain</a> and get keys to make this plugin work.</p>');
	echo __("Enter the key details below");
}

function display_captcha_site_key_element() { ?>
	<input type="text" name="captcha_site_key" id="captcha_site_key" value="<?php echo get_option('captcha_site_key'); ?>" />
<?php }

function display_captcha_secret_key_element() { ?>
	<input type="text" name="captcha_secret_key" id="captcha_secret_key" value="<?php echo get_option('captcha_secret_key'); ?>" />
<?php }
add_action("admin_init", "display_recaptcha_options");






function frontend_recaptcha_script() {
	wp_register_script("recaptcha", "https://www.google.com/recaptcha/api.js");
	wp_enqueue_script("recaptcha");
}
add_action("wp_enqueue_scripts", "frontend_recaptcha_script");

function display_comment_recaptcha() { 
	// https://www.google.com/recaptcha/admin#list
	?>
	<div class="g-recaptcha" data-sitekey="<?php echo get_option('captcha_site_key'); ?>"></div>
	<input class="g-submit" name="submit" type="submit" value="Submit Comment">
	<?php 
}
add_action("comment_form", "display_comment_recaptcha");

function verify_comment_captcha($commentdata) {
	if (isset($_POST['g-recaptcha-response'])) {
		$recaptcha_secret = get_option('captcha_secret_key');
		$response = wp_remote_get("https://www.google.com/recaptcha/api/siteverify?secret=". $recaptcha_secret ."&response=". $_POST['g-recaptcha-response']);
		$response = json_decode($response["body"], true);
		if (true == $response["success"]) {
			return $commentdata;
		} else {
			echo __("Bots are not allowed to submit comments.");
			return null;
		}
	} else {
		echo __("Bots are not allowed to submit comments. If you are not a bot then please enable JavaScript in browser.");
		return null;
	}
}
add_filter("preprocess_comment", "verify_comment_captcha");



/* ************************************************************************ */
/* -------------------------- Editor css file ----------------------------- */
/* ************************************************************************ */



function theme_add_editor_styles() {
    add_editor_style( 'css/editor.css' );
}
add_action( 'admin_init', 'theme_add_editor_styles' );



/* ************************************************************************ */
/* --------------------------- TinyMCE styles --------------------------- */
/* ************************************************************************ */



function set_mce_buttons_2( $buttons ) {
	array_unshift( $buttons, 'styleselect' );
	return $buttons;
}
add_filter( 'mce_buttons_2', 'set_mce_buttons_2' );


function set_formats( $init_array ) {  
	$style_formats = array(
		array(  
			'title' => 'Button link',  
			'selector' => 'a',  
			'classes' => 'button-link',
			'wrapper' => false,			
		),
        array(  
			'title' => 'Title look',  
			'block' => 'h1',  
			'classes' => 'title-look',
			'wrapper' => false,			
		),
        array(  
			'title' => 'Article image',  
			'selector' => 'img',  
			'classes' => 'img-look',
			'wrapper' => false,			
		),
	);  
	$init_array['style_formats'] = json_encode( $style_formats );  
	
	return $init_array;  
}
add_filter( 'tiny_mce_before_init', 'set_formats' );



/* ************************************************************************ */
// --------------------------- Scripts and stylesheets ---------------------------
/* ************************************************************************ */



function startwordpress_scripts() {
    wp_enqueue_style('Quicksand', '//fonts.googleapis.com/css?family=Quicksand:300,400,500,700', false );
    wp_enqueue_style('Roboto', '//fonts.googleapis.com/css?family=Roboto:100,200,300,400,500,700', false );
    wp_enqueue_style('Monoton', '//fonts.googleapis.com/css?family=Monoton|Roboto', false );
    

    wp_enqueue_script('codejs', get_template_directory_uri() . '/js/scripts.js', '', '1', true );
    wp_enqueue_style ('blog', get_template_directory_uri() . '/css/main.css' );	
}
add_action( 'wp_enqueue_scripts', 'startwordpress_scripts' );



/* ************************************************************************ */
// --------------------------- Theme supports ---------------------------
/* ************************************************************************ */



add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'custom-logo', array(
    'height'      => 64,
    'width'       => 248,
    'flex-height' => false,
));
add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
//add_theme_support( 'customize-selective-refresh-widgets' );



/* ************************************************************************ */
// ---------------------------  Filter ---------------------------
/* ************************************************************************ */



function wpdocs_custom_excerpt_length( $length ) {
    return 30;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );



/* ************************************************************************ */
// ---------------------------  Menus ---------------------------
/* ************************************************************************ */



register_nav_menus( array(
    'top'    => __( 'Top', 'main navigation' ),
));



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
