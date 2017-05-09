<?php php_file(); ?>
<div class="post-li">
<?php if (has_post_thumbnail() ): ?>
	<div class="post-thumbnail">
		<?php the_post_thumbnail('medium'); ?>
	</div><!-- .post-thumbnail -->	
<?php endif; ?>
	<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    <?php 
        the_excerpt();         
        cbTemp::tags_links();
    ?>
	<p class="post-meta"><?php the_date(); ?> by <?php the_author(); ?><?php echo number_format_i18n(get_comments_number()); ?> </p>
</div><!-- /.blog-post -->