<?php 
/*
Template Name: Home page
Template Post Type: post, page, event
*/
// Page code here...
?>
<?php get_header(); ?>

<section class="botter">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">		
				<?php 
				    if(is_single() || is_page()) :

						if ( have_posts() ) : 
							while ( have_posts() ) : the_post();
								get_template_part( '/template-parts/post-page', get_post_format() );
								if ( comments_open() || get_comments_number() ) :
									comments_template("/side-templates/comments.php");
								endif;                    
							endwhile; 
						endif; 

					else: 

						global $paged;
						
						/* secondary query using WP_Query */
						$args = array(
							'cat' => $cat,
							'tag' => $tag,
							'posts_per_page' => 9,
							'paged' => $paged
						);
						$post_query = new WP_Query( $args );

						/* loop */
						ob_start();    
						echo "<div class='post-cards'>";
						while( $post_query->have_posts() ) : 
								$post_query->the_post();            						
								get_template_part( 'template-parts/post-cards-thumb', get_post_format() );            							
						endwhile;
						echo "</div>";

					endif;

					if ($post_query->max_num_pages > 1) :  ?>
					<nav class="prev-next-posts">
						<div class="prev-posts-link">
						<?php echo get_next_posts_link( 'Older Entries', $post_query->max_num_pages ); // display older posts link ?>
						</div>
						<div class="next-posts-link">
						<?php echo get_previous_posts_link( 'Newer Entries' ); // display newer posts link ?>
						</div>
					</nav>
					<?php 
					endif; 
					?>
			</div> <!-- /.col -->
		</div> <!-- /.row -->
	</div>
</section>
<?php 
get_footer(); 
?>