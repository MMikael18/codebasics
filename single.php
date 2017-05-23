<?php get_header(); ?>
<?php php_file(); ?>

<section class="upper">

</section>

<?php get_template_part( 'template-parts/nav', 'main' ); ?>

<section class="botter">
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
</section>
<?php get_footer(); ?>