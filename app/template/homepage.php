<?php 
/*
Template Name: Home page
Template Post Type: post, page, event
*/
// Page code here...
?>
<?php get_header(); ?>

<?php php_file(); ?>

<section class="upper">
	<?php //get_template_part( 'template-parts/site-description', 'description' ); ?>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">			
				<?php 
					if ( have_posts() ) : while ( have_posts() ) : the_post();
						get_template_part( '/template-parts/post-page', get_post_format() );  
					endwhile; endif; 
				?>
			</div> <!-- /.col -->
		</div> <!-- /.row -->
	</div>
</section>

<?php get_template_part( 'template-parts/nav', 'main' ); ?>

<section class="botter">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">		
				<?php echo do_shortcode( '[posts]' ); ?>
			</div> <!-- /.col -->
		</div> <!-- /.row -->
	</div>
</section>
<?php 
get_footer(); 
?>