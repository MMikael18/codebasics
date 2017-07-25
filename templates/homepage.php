<?php 
/*
Tem plate Name: Home page
Tem plate Post Type: post, page, event
*/
?>
<?php get_header(); ?>

<?php php_file(); ?>

<section class="upper">
	<?php 
		if ( have_posts() ) : while ( have_posts() ) : the_post();
			//get_template_part( '/template-parts/post-header', get_post_format() );  
		endwhile; endif; 
	?>
</section>

<?php get_template_part( 'template-parts/nav', 'main' ); ?>
<section class="tag-nav">
	<div class="container">
		<div class="row">		
			<div class="col-sm-12" id="tag-content">
				<nav><?php //$tag = cbTemp::tages_multiselect(); ?></nav>
			</div>
		</div>
	</div>	
</section>
<section class="botter">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">		
				<?php 
				    /* main post's ID, the below line must be inside the main loop */
					$exclude = get_the_ID();

					/* alternatively to the above, this would work outside the main loop */
					//global $wp_query;
					$exclude = $wp_query->post->ID;

					/* secondary query using WP_Query */
					$args = array(
						'category_name' => '',
						'tag' => $tag,
						'posts_per_page' => 10 // note: showposts is deprecated!
					);
					$your_query = new WP_Query( $args );

					/* loop */
					ob_start();    
					echo "<div class='post-cards'>";
					while( $your_query->have_posts() ) : $your_query->the_post();            						
							get_template_part( 'template-parts/post-cards-thumb', get_post_format() );            							
					endwhile;
					echo "</div>";
				 ?>
			</div> <!-- /.col -->
		</div> <!-- /.row -->
	</div>
</section>
<?php 
get_footer(); 
?>