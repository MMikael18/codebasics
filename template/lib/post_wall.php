<?php

class PostWall {
    /*
    *
    * Static funtions
    *
    */

    public static function get_tags() {
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

    static function get_component_posts_rollup($category = "", $title = "all")
    {
        global $paged;
						
        $args = array(
            'category_name' => $category,            
            'posts_per_page' => 999,
        );
        $post_query = new WP_Query( $args );

        ob_start();
        ?>
        <h2 class="c-postwall-title"><?php echo $title; ?></h2>
        <div class='c-postwall-list'>            
            <?php
            while( $post_query->have_posts() ) : 
                    $post_query->the_post();            						
                    get_template_part( 'template-parts/postwall-item', '' );
            endwhile;
            wp_reset_postdata();
            ?>
        </div>
        <?php
        
    }
}

?>