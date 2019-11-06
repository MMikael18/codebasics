
<?php

// public static function get_tags() {
// 	$tags = get_the_tags();
// 	$separator = ' ';
// 	$output = '';
// 	if ( ! empty( $tags ) ) {
// 		foreach( $tags as $t ) {
// 			$output .= '<span class=""><a href="' . esc_url( get_category_link( $t->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $t->name ) ) . '">' . esc_html( $t->name ) . '</a></span>' . $separator;
// 		}
// 		return trim( $output, $separator );
// 	}
// 	return "";
// }

class PostWall {

    function __construct() {
        //add_action( 'wp_enqueue_scripts', [$this, 'my_enqueue'] );

        // get_tags / action
        add_action("wp_ajax_get_tags", [$this ,"get_tags_ajax"]);
        add_action("wp_ajax_nopriv_get_tags", [$this ,"get_tags_ajax"]);

        // get_tags / action
        add_action("wp_ajax_get_categories", [$this ,"get_categories_ajax"]);
        add_action("wp_ajax_nopriv_get_categories", [$this ,"get_categories_ajax"]);
  
        // get_posts / action
        add_action("wp_ajax_get_posts", [$this ,"get_posts_ajax"]);
        add_action("wp_ajax_nopriv_get_posts", [$this ,"get_posts_ajax"]);
        
        add_action('wp_head', function () {            
            printf('<script type="text/javascript">window.custom_nonce = "%s";</script>', wp_create_nonce());
        }); 
    }

    //add_action("wp_ajax_nopriv_my_user_vote", "my_must_login");

    public function get_tags_ajax()
    {
        $category = json_decode(file_get_contents('php://input'), true)['category'];

        $tags =  PostWall::get_tags_in_use($category); 
        $models = [];
        foreach ($tags as $tag_id) {
            $models[] = array('slug' => get_tag($tag_id)->slug, 'name' => get_tag($tag_id)->name );
        }
        echo wp_send_json($models);
        die;
    }
 
    public function get_categories_ajax(){
        
        $cateries = get_terms(array('taxonomy'=> 'category') );
        $models = [];
        foreach($cateries as $category)
        {
            $models[] = array('slug' => $category->slug, 'name' => $category->name);            
        }
        echo wp_send_json($models);
        die;
    }

    public function get_posts_ajax(){
        
        $category = json_decode(file_get_contents('php://input'), true)['category'];
        $tag      = json_decode(file_get_contents('php://input'), true)['tag'];
        
        global $paged;
		
        $args = array(
            'category_name' => $category,
            'tag' => $tag,
            'posts_per_page' => 999,
        );
        $post_query = new WP_Query( $args );

        $models = [];
        while( $post_query->have_posts() ) : 
                $post_query->the_post();            		
                $models[] = array(
                    'id' => get_the_ID(),
                    'date' => get_the_date(),
                    'url' => get_the_permalink(),
                    'title' => get_the_title(),
                    'comment_num' => get_comments_number(),
                    'img' => get_the_post_thumbnail_url()
                );
        endwhile;
        wp_reset_postdata();

        echo wp_send_json($models);
        die;        
    }

    /*
    *
    * Static funtions
    *
    */
    /*
    private static $target_index = 0;
 
    public static function get_navigation()
    {  
        $cateries = get_terms(array('taxonomy'=> 'category') );
        ?>
        <div class="c-post-wall_navigation">
            <div>
                <?php
                foreach($cateries as $category)
                {
                    ?>
                    <span class="h3" data-category="" data-slug="<?php echo $category->slug ?>"><?php echo $category->name; ?></span>
                    <?php
                }
                ?>
            </div>
            <div>
                <?php
                    //PostWall::get_tags_in_category();
                ?>
            </div>
        </div>
        <?php
    }
    */



    static function get_posts($category = "", $title = "all")
    {
        /*
        global $paged;
						
        $args = array(
            'category_name' => $category,            
            'posts_per_page' => 999,
        );
        $post_query = new WP_Query( $args );
        PostWall::$target_index += 1;

        ?>
        <div class="c-postwall-title">
            <h2><?php echo $title; ?></h2>
            <div><?php PostWall::the_used_tags($category); ?></div>
            <div class="c-wall-controls" data-wall-controls="target_<?php echo PostWall::$target_index; ?>">
                <svg class="c-bt_previous" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 24c6.627 0 12-5.373 12-12s-5.373-12-12-12-12 5.373-12 12 5.373 12 12 12zm-1-17v4h8v2h-8v4l-6-5 6-5z"/></svg>
                <svg class="c-bt_next" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm1 17v-4h-8v-2h8v-4l6 5-6 5z"/></svg>
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
        */
    }


    
    public static function get_tags_in_use ($category ) {

        if(empty($category))
            return  get_tags();

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
$PostWall = new PostWall();

?>