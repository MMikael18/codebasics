<?php php_file(); ?>
<?php 
	if (has_post_thumbnail() ): 
		$thumbnail = "background-image: url(" . get_the_post_thumbnail_url() . ");";
	endif;
?>
<header id="post-header" style="<?php echo $thumbnail ?>">
	<div id="open-post-header"></div>
	<div data-post-header="" class="container post-header-container"  style="display: none;">
		<article id="post-header-page">	
			<?php if(!is_page()) : ?>
				<h2 class="post-title"><?php the_title(); ?></h2>	
			<?php endif; ?>
			<?php 
				the_content(); 
				//get_template_part( 'template-parts/site-description', 'description' );
				//cbTemp::categories_links();
			?>
			<p class="post-meta"><?php the_date(); ?> by <a href="#"><?php the_author(); ?></a></p>
		</article><!-- /.blog-post -->
	</div>
</header>