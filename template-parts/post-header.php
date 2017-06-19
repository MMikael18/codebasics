<?php php_file(); ?>
<?php 
	if (has_post_thumbnail() ): 
		$thumbnail = "background-image: url(" . get_the_post_thumbnail_url() . ");";
	endif;
?>
<header id="post-header" style="<?php echo $thumbnail ?>">
	<h1 id="page-title">Recap notes</h1>
	<article id="post-header-page">
		<div id="post-head-content">				
			<?php the_content(); ?>
			<p class="post-meta"><?php the_date(); ?> by <a href="#"><?php the_author(); ?></a></p>
		</div>
		<div id="header-post-button"></div>
	</article><!-- /.blog-post -->
</header>