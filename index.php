<?php get_header(); ?>
<?php php_file(); ?>
	<div class="row">
		<div class="col-sm-8">
			<?php cbTemp::categories_links(); ?> 
			<h1><?php echo apply_filters( 'the_title', get_the_title( get_option( 'page_for_posts' ) ) ); ?></h1>
			<?php
			echo apply_filters( 'the_content', get_post_field( 'post_content', get_option( 'page_for_posts' ) ) );
			
			if ( have_posts() ) : while ( have_posts() ) : the_post();
				get_template_part( 'content', get_post_format() );  
			endwhile; endif; 
			?>
			<nav aria-label="Page navigation example">
  				<ul class="pagination">
					<li class="page-item"><?php next_posts_link( 'Previous' ); ?></li>
					<li class="page-item"><?php previous_posts_link( 'Next' ); ?></li>
				</ul>
			</nav>
		</div> <!-- /.blog-main -->

		<?php
		 get_sidebar(); 
		?>		
	</div> <!-- /.row -->

<?php get_footer(); ?>