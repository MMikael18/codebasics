<?php

/*
* 
* Theme customizer setting
*
*/

add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'custom-logo', array(
    'height'      => 64,
    'width'       => 248,
    'flex-height' => false,
));
add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );


/*
* 
* TinyMCE styles 
*
*/

// function set_mce_buttons_2( $buttons ) {
//     array_unshift( $buttons, 'styleselect' );
//     return $buttons;
// }
// add_filter( 'mce_buttons_2', 'set_mce_buttons_2' );


// function set_formats( $init_array ) {
//     $style_formats = array(
//     array(
// 		'title' => 'Button link',
// 		'selector' => 'a',
// 		'classes' => 'button-link',
// 		'wrapper' => false,
//     ),
//     array(
// 		'title' => 'Title look',
// 		'block' => 'h1',
// 		'classes' => 'title-look',
// 		'wrapper' => false,
//     ),
//     array(
// 		'title' => 'Article image',
// 		'selector' => 'img',
// 		'classes' => 'img-look',
// 		'wrapper' => false,
//     ),
//     );
//     $init_array['style_formats'] = json_encode( $style_formats );
    
//     return $init_array;
// }
// add_filter( 'tiny_mce_before_init', 'set_formats' );


// class cbTemp { 

// 	public static function get_textdomain() {
// 		return "codebasics";		
// 	}
	
// 	public static function categories_links() {
// 		echo cbTemp::get_categories_links();		
// 	}

// 	public static function get_categories_links() {
// 		$categories = get_the_category();
// 		$separator = ' ';
// 		$output = '';
// 		if ( ! empty( $categories ) ) {
// 			foreach( $categories as $category ) {
// 				$output .= '<span class=""><a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a></span>' . $separator;
// 			}
// 			return trim( $output, $separator );
// 		}
// 		return "";
// 	}

// 	public static function get_tags_menu() {

// 		$tags = get_tags( array(				
// 			'orderby'    => 'name',
// 			'show_count' => true
// 		));

// 		echo "<ul>";

// 		if ( ! empty( $tags ) ) {
// 			foreach( $tags as $tag ) {
// 				echo "<li><a href=" . esc_url( get_category_link( $tag->term_id ) ) . ">" . $tag->name . "</a></li>";
// 			}
// 		}
// 		echo "</ul>";
// 	}

// 	public static function tags_links() {
// 		echo cbTemp::get_tags_links();		
// 	}

// 	public static function get_tags_links() {
// 		$tags = get_the_tags();
// 		$separator = ' ';
// 		$output = '';
// 		if ( ! empty( $tags ) ) {
// 			foreach( $tags as $t ) {
// 				$output .= '<span class=""><a href="' . esc_url( get_category_link( $t->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $t->name ) ) . '">' . esc_html( $t->name ) . '</a></span>' . $separator;
// 			}
// 			return trim( $output, $separator );
// 		}
// 		return "";
// 	}

// }


?>