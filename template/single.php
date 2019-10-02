<?php get_header(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class("l-single"); ?>>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<?php 
					if ( have_posts() ) : while ( have_posts() ) : the_post();
						get_template_part( '/template-parts/post-page', get_post_format() );
						if ( comments_open() || get_comments_number() ) :
						 	comments_template("/side-templates/comments.php");
						endif;                    
					endwhile; endif; 
				?>
			</div> <!-- /.col -->
		</div> <!-- /.row -->
	</div>
</section>

<?php get_footer(); ?> 