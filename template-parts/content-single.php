<?php php_file(); ?>
<div class="post-page">

<?php if (has_post_thumbnail() ): ?>
	<div class="post-thumbnail">
		<?php the_post_thumbnail('large'); ?>
	</div><!-- .post-thumbnail -->	
<?php endif; ?>

	<h2 class="post-title"><?php the_title(); ?></h2>	
 	<?php 
	 	the_content(); 
		cbTemp::categories_links();
	?>
	<p class="post-meta"><?php the_date(); ?> by <a href="#"><?php the_author(); ?></a></p>
</div><!-- /.blog-post -->