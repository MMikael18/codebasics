<?php get_header(); ?>
<?php php_file(); ?>

<section class="upper">
	
</section>
<div class="container">
	<div class="row">
		<div class="col-sm-12">			
			<?php 
				if ( have_posts() ) : while ( have_posts() ) : the_post();
					get_template_part( 'template-parts/post-page', get_post_format() );  
				endwhile; endif; 
			?>
		</div> <!-- /.col -->
	</div> <!-- /.row -->
</div>	

<?php get_footer(); ?>