<?php get_header(); ?>
<?php php_file(); ?>
	<div class="row">		
		<div class="col-sm-12">
			<h1><?php echo apply_filters( 'the_title', get_the_title( get_option( 'page_for_posts' ) ) ); ?></h1>
			<p><?php echo apply_filters( 'the_content', get_post_field( 'post_content', get_option( 'page_for_posts' ) ) ); ?></p>
			<?php // cbTemp::categories_links(); ?> 
		</div>
	</div>
	<div class="row">
		<div class="col-sm-8">			
			
			<?php
			
			//cbTemp::posts_in_categories();

			/* Select multiple categories */

			// get query string
			$qString = ($_GET["cats"]) ? $_GET["cats"] : "";
			$qArray = explode("+", $qString);


			$categories = get_categories( array(
				'orderby'    => 'name',
				'show_count' => true
			));
			
			$output = '';
			if ( ! empty( $categories ) ) {
				foreach( $categories as $category ) {

					$class = "";
					$newQstring = strlen($qString) ? $qString . "+" . $category->slug : $category->slug ;

					if(in_array($category->slug, $qArray)){
						$class = "active";
						$newQstring = "";
						foreach($qArray as $qa){
							if($qa != $category->slug){
								$newQstring .= strlen($newQstring) > 0 ? "+".$qa : $qa ;
							}
						}												
					}

					$newUrl = esc_url(add_query_arg( 'cats', urlencode($newQstring) ));
					$output .=  '<span class="'.$class.' badge badge-default"><a href="' . $newUrl . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a></span> ';
				}
				echo trim( $output, $separator );
			}
 
			/* secondary query using WP_Query */
			
			$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;			
			$args = array(
				'post_type' => 'post',
				'category_name' => $qString,
				'posts_per_page' => 2,
				'paged' => $paged
			);
			$query = new WP_Query( $args );
			/* loop */
			
            while( $query->have_posts() ) : $query->the_post();
				get_template_part( 'content', get_post_format() );
            endwhile;    

			?>
			<nav class="prev-next-posts">				
				<?php echo get_next_posts_link( 'Older', $query->max_num_pages ); // display older posts link ?>				
				<?php echo get_previous_posts_link( 'Newer' ); // display newer posts link ?>				
			</nav>
			
		</div> <!-- /.blog-main -->
		<?php get_sidebar(); ?>

	</div> <!-- /.row -->

<?php get_footer(); ?>