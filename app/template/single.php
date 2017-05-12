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
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;                    
				endwhile; endif; 
			?>

		</div> <!-- /.col -->
	</div> <!-- /.row -->
</div>
<?php get_footer(); ?>