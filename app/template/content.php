<div class="blog-post">
    content.php
	<h2 class="blog-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php
	printf( _nx( 'One Comment', '%1$s Comments', get_comments_number(), 'comments title', 'textdomain' ), number_format_i18n(get_comments_number()) ); ?>
	<p class="blog-post-meta"><?php the_date(); ?> by <a href="#"><?php the_author(); ?></a></p>
    <?php the_excerpt(); ?>
    <hr>
</div><!-- /.blog-post -->
