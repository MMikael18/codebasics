
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	
	<div class="entry-content">
	<?php
		the_title( '<h3>', '</h3>' ); 
        the_post_thumbnail(); 
        the_excerpt();
	?>
	</div><!-- .entry-content -->
</article>
