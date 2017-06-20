<?php php_file(); ?>
<article class="post-page">
	<a href="/" id="home-link">Home</a>
	<?php if (has_post_thumbnail() ): ?>
		<div class="post-thumbnail">
			<?php the_post_thumbnail('large'); ?>
		</div><!-- .post-thumbnail -->	
	<?php endif; ?>
	<?php if(!is_page()) : ?>
		<h2 class="post-title"><?php the_title(); ?></h2>	
	<?php endif; ?>
 	<?php the_content(); ?>
	<p class="post-meta"><?php the_date(); ?> by <a href="//twitter.com/MMikael_18"><?php the_author(); ?></a></p>

</article><!-- /.blog-post -->