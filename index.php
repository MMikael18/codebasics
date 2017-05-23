<?php get_header(); ?>
<?php php_file(); ?>

<?php get_template_part( 'template-parts/nav', 'main' ); ?>
<section class="tag-nav">
	<div class="container">
		<div class="row">		
			<div class="col-sm-12" id="tag-content">
				<nav><?php $tag = cbTemp::tages_multiselect($nowcat); ?></nav>
			</div>
		</div>
	</div>	
</section>
<section class="botter">

	<div class="container" style="display:none;">
		<div class="row">		
			<div class="col-sm-12">
				<span >
					<h1><?php echo apply_filters( 'the_title', get_the_title( get_option( 'page_for_posts' ) ) ); ?></h1>
					<p><?php echo apply_filters( 'the_content', get_post_field( 'post_content', get_option( 'page_for_posts' ) ) ); ?></p>
					<div class="categories"> <?php $nowcat = cbTemp::all_categories_links(); ?> </div>
				</span>			
				
			</div>
		</div>
	</div>

	<div class="container">	
		<div class="row">
			<div class="col-sm-8">

				<div class='post-lister'>
				<?php
				/* secondary query using WP_Query */
				$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;			
				$args = array(
					'post_type' => 'post',
					'category_name' => $nowcat,
					'tag' => $tag,
					'posts_per_page' => 10, 
					'paged' => $paged,
					'offset' => 0
				); 
				$query = new WP_Query( $args );
				/* loop */			
				while( $query->have_posts() ) : $query->the_post();
					get_template_part( 'template-parts/post-li', get_post_format() );
				endwhile;
				?>
				</div>

				<nav class="prev-next-posts">				
					<?php echo get_next_posts_link( 'Older', $query->max_num_pages ); // display older posts link ?>				
					<?php echo get_previous_posts_link( 'Newer' ); // display newer posts link ?>				
				</nav>

			</div> 
			<div class="col-sm-4 flex-box">
				<?php get_sidebar(); ?>
			</div> 
		</div> <!-- /.row -->
	</div>
	
</section>
<?php get_footer(); ?>