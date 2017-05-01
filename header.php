
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Code Basics">
    <meta name="author" content="Matti Uusitalo">
    <?php wp_head();?> 
  </head>

  <body>

    <header id="site-header">
      <div class="container">  
         	<div class="row">
		        <div class="col-sm-2"> <?php cb_sitelogo();  ?> </div>
            <div class="col-sm-8"> <?php get_template_part( 'template-parts/nav', 'main' ); ?> </div>
            <div class="col-sm-2"> <?php cb_basesearch(); ?> </div>
          </div>
      </div>
    </header>

    <article class="container">
      <div class="blog-header">
        <h1 class="blog-title"><a href="<?php echo get_bloginfo( 'wpurl' );?>"> <?php echo get_bloginfo( 'name' ); ?></a></h1>
        <p class="lead blog-description"><?php echo get_bloginfo( 'description' ); ?></p>
      </div>