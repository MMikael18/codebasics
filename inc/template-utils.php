<?php
/*
class cbTemp {

	public static function get_textdomain() {
		return "codebasics";		
	}
	
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

	public static function get_tags_menu() {

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

}


?>