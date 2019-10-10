<?php

class PostWall {
    /*
    *
    * Static funtions
    *
    */
    private static $target_index = 0;

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
        PostWall::$target_index += 1;

        ?>
        <div class="c-postwall-title">
            <h2 ><?php echo $title; ?></h2>
            <div><?php PostWall::the_used_tags($category); ?></div>
            <div class="c-wall-controls" data-wall-controls="target_<?php echo PostWall::$target_index; ?>">
                <div class="c-bt_previous"></div>
                <div class="c-bt_next"></div>
            </div>
        </div>
        <div class='c-postwall-list' data-wall="target_<?php echo PostWall::$target_index; ?>">
            <div class='c-scroller'>
                <?php
                while( $post_query->have_posts() ) : 
                        $post_query->the_post();            						
                        get_template_part( 'template-parts/postwall-item', '' );
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        </div>
        <?php
        
    }

    public static function the_used_tags($category)
    {
        $tags =  PostWall::get_tags_in_use($category);
        foreach ($tags as $tag_id) {
            ?>
            <span><?php echo get_tag($tag_id)->name; ?></span>
            <?php
        }
    }
    
    // public static function get_tags_menu($category = "") 
    // {

	// 	$tags = get_tags( array(				
	// 		'orderby'    => 'name',
    //         'show_count' => true,
    //         'hide_empty' => true
	// 	));

	// 	echo "<ul>";

	// 	if ( ! empty( $tags ) ) {
	// 		foreach( $tags as $tag ) {
	// 			echo "<li><a href=" . esc_url( get_category_link( $tag->term_id ) ) . ">" . $tag->name . "</a></li>";
	// 		}
	// 	}
	// 	echo "</ul>";
    // }
    
    public static function get_tags_in_use ($category ) {
        // Set up the query for our posts
        $my_posts = new WP_Query(array(
          'category_name' => $category, // Your category id
          'posts_per_page' => -1 // All posts from that category
        ));
    
        // Initialize our tag arrays
        $tags_by_id = array();
    
        // If there are posts in this category, loop through them
        if ($my_posts->have_posts()) : 
            while ($my_posts->have_posts()): 
                $my_posts->the_post();
    
                // Get all tags of current post
                $post_tags = wp_get_post_tags($my_posts->post->ID);
    
                // Loop through each tag
                foreach ($post_tags as $tag):
            
                    // Set up our tags by id, name, and/or slug
                    $tag_id = $tag->term_id;

                    // Push each tag into our main array if not already in it
                    if (!in_array($tag_id, $tags_by_id))
                    array_push($tags_by_id, $tag_id);

                endforeach;
            endwhile; 
        endif;
    
        // Return value specified
        return $tags_by_id;
    }

    public static function the_tags_inpost($separator = '') {
		$tags = get_the_tags();
		
		if ( ! empty( $tags ) ) {
            $i = 0;
            $len = count($tags);
			foreach( $tags as $t ) {
                ?>
                <span><?php echo esc_html( $t->name ); ?></span> 
                <?php 
                if ($i != $len - 1) {
                    echo $separator; 
                }
                $i++;
			}
		}
	}
}

?>