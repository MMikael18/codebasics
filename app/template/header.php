
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
		        <div class="col-sm-12" id="header-content">
              <?php 
                cbTemp::sitelogo();
                get_template_part( 'template-parts/nav', 'main' );
                cbTemp::basesearch(); 
              ?>
            </div>          
          </div>
      </div>
    </header>

    <article id="site-container" class="container">
      <div class="blog-header">
        <h1 class="blog-title"><a href="<?php echo get_bloginfo( 'wpurl' );?>"> <?php echo get_bloginfo( 'name' ); ?></a></h1>
        <p class="lead blog-description"><?php echo get_bloginfo( 'description' ); ?></p>
      </div>