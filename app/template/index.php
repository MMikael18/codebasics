<?php 
/*
Template Name: Home page
Template Post Type: post, page, event
*/
?>
<?php get_header(); ?>

<?php
 foreach((get_terms(
	[ 'taxonomy'=> 'category']
	)) as $category)
{
	CodeBasics::get_component_posts_rollup($category->slug, $category->name);
}


if ( have_posts() ) {
	// Load posts loop.
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content/content' );
	}
}
?>

<section class="botter">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">		
				<?php 
/*				
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
						
						$args = array(
							'cat' => $cat,
							'tag' => $tag,
							'posts_per_page' => 9,
							'paged' => $paged
						);
						$post_query = new WP_Query( $args );

						ob_start();    
						echo "<div class='post-cards'>";
						while( $post_query->have_posts() ) : 
								$post_query->the_post();            						
								get_template_part( 'template-parts/post-cards-thumb', get_post_format() );            							
						endwhile;
						echo "</div>";

					endif;

*/
					?>
			</div> <!-- /.col -->
		</div> <!-- /.row -->
	</div>
</section>
<?php 
get_footer(); 
?>