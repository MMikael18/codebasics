<?php php_file(); ?>
<div class="post-li">
	<div class="post-content">
		<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<?php 
			the_excerpt();         
			cbTemp::tags_links();
		?>
		<span class="post-meta"><?php the_date(); ?> by <?php the_author(); ?><?php echo number_format_i18n(get_comments_number()); ?> </span>	
	</div>
	<?php if (has_post_thumbnail() ): ?>
		<div class="post-thumbnail">
			<?php the_post_thumbnail('thumbnail'); ?>
		</div><!-- .post-thumbnail -->	
	<?php endif; ?>
</div><!-- /.blog-post -->