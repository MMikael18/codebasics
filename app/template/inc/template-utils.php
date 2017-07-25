<?php

class cbTemp {

	// public static function sitelogo() {
	// 	if ( function_exists( 'the_custom_logo' ) ) {    
	// 		wrapit("the_custom_logo","<div id='cb-sitelogo'>","</div>");
	// 	}
	// }

	// public static function basesearch() {
	// 	if ( function_exists( 'get_search_form' ) ) {    
	// 		wrapit("get_search_form","<div class='cb-search'>","</div>");
	// 	}
	// }


	/* --- Get Posts Thing --- */

	/*
	public static function all_categories_links() {

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
				$output .= '<span class="' . $class . '"><a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a></span>' . $separator;
			}
			echo trim( $output, $separator );
		}
		return $nowcat;
	}
	*/

	public static function categories_links() {
		echo cbTemp::get_categories_links();		
	}

	public static function get_categories_links() {
		$categories = get_the_category();
		$separator = ' ';
		$output = '';
		if ( ! empty( $categories ) ) {
			foreach( $categories as $category ) {
				$output .= '<span class=""><a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a></span>' . $separator;
			}
			return trim( $output, $separator );
		}
		return "";
	}

	/* --- Get Posts Thing --- */

	public static function get_tags_menu() {
			// echo var_dump(get_option('permalink_structure'));
			// /%postname%/
		$tags = get_tags( array(				
			'orderby'    => 'name',
			'show_count' => true
		));

		echo "<ul>";

		if ( ! empty( $tags ) ) {
			foreach( $tags as $tag ) {
				echo "<li><a href=" . esc_url( get_category_link( $tag->term_id ) ) . ">" . $tag->name . "</a></li>";
			}
		}
		echo "</ul>";
	}

/*
	public static function old_tages_multiselect() {
		$category = get_queried_object();
		$category = $category->name;

		$query_name = "tags";

		// Select multiple tags 
		$qString = ($_GET[$query_name]) ? $_GET[$query_name] : "";
		$qArray = explode("+", $qString);

		$tags = get_tags( array(				
			'orderby'    => 'name',
			'show_count' => true
		));
		if(isset($category) && ! empty( $tags )){			
			$isTags = [];
			foreach( $tags as $tag ) {
				$args = array(
					'post_type' => 'post',
					'post_count' => 1,
					'category_name' => $category,					
					'tag' => $tag->slug
				);
				$query = new WP_Query( $args );
				if($query->have_posts()){					
					array_push($isTags,$tag);
				}
				
			}	
			
			$tags = $isTags;			
		}

		$output = '';
		if ( ! empty( $tags ) ) {
			foreach( $tags as $tag ) {

				$class = "";
				$newQstring = strlen($qString) ? $qString . "+" . $tag->slug : $tag->slug ;

				if(in_array($tag->slug, $qArray)){
					$class = "active";
					$newQstring = "";
					foreach($qArray as $qa){
						if($qa != $tag->slug){
							$newQstring .= strlen($newQstring) > 0 ? "+".$qa : $qa ;
						}
					}												
				}

				$newUrl = esc_url(add_query_arg( $query_name, urlencode($newQstring) ));
				$output .=  '<li class="'.$class.'"><a href="' . $newUrl . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $tag->name ) ) . '">' . esc_html( $tag->name ) . '</a></li>';
			}
			echo "<ul>" . $output . "</ul>";
		}
		return $qString;
	}
	*/


	public static function tags_links() {
		echo cbTemp::get_tags_links();		
	}

	public static function get_tags_links() {
		$tags = get_the_tags();
		$separator = ' ';
		$output = '';
		if ( ! empty( $tags ) ) {
			foreach( $tags as $t ) {
				$output .= '<span class=""><a href="' . esc_url( get_category_link( $t->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $t->name ) ) . '">' . esc_html( $t->name ) . '</a></span>' . $separator;
			}
			return trim( $output, $separator );
		}
		return "";
	}

	
	/* --- End --- */
}
//$cpt = new cbTemp();


// function wrapit($call,$s,$e) {
//     echo $s;
// 	call_user_func($call);
//     echo $e;
// }

?>