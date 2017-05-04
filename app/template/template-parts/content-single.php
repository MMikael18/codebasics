<?php php_file(); ?>
<div class="blog-post">
	<h2 class="blog-post-title"><?php the_title(); ?></h2>	
 	<?php 
	 	the_content(); 
		cbTemp::categories_in_post_links();
	?>
	<p class="blog-post-meta"><?php the_date(); ?> by <a href="#"><?php the_author(); ?></a></p>
</div><!-- /.blog-post -->