<?php

class cbTemp {

	public static function sitelogo() {
		if ( function_exists( 'the_custom_logo' ) ) {    
			wrapit("the_custom_logo","<div id='cb-sitelogo'>","</div>");
		}
	}

	public static function basesearch() {
		if ( function_exists( 'get_search_form' ) ) {    
			wrapit("get_search_form","<div class='cb-search'>","</div>");
		}
	}


	/* --- Get Posts Thing --- */


	public static function categories_links() {

		$categories = get_categories( array(
			'orderby'    => 'name',
			'show_count' => true
			//'parent'     => 0
		));
		$nowcat = single_term_title( "", false );

		$separator = ' ';
		$output = '';
		if ( ! empty( $categories ) ) {
			foreach( $categories as $category ) {
				$class = $nowcat == esc_html( $category->name ) ? "active" : "" ;				
				$output .= '<span class="' . $class . ' badge badge-default"><a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a></span>' . $separator;
			}
			echo trim( $output, $separator );
		}
	}

	public static function categories_in_post_links() {
		$categories = get_the_category();
		$separator = ' ';
		$output = '';
		if ( ! empty( $categories ) ) {
			foreach( $categories as $category ) {
				$output .= '<span class="badge badge-default"><a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a></span>' . $separator;
			}
			echo trim( $output, $separator );
		}
	}
	public static function posts_in_categories(){

	}
	/* --- End --- */
}
//$cpt = new cbTemp();


function wrapit($call,$s,$e) {
    echo $s;
	call_user_func($call);
    echo $e;
}

?>