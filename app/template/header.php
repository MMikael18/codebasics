
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Code Basics">
    <meta name="author" content="Matti Uusitalo">
    <?php wp_head();?>
    <?php
    #twitter cards hack
    if(is_single() || is_page()) {
      global $post;

      $twitter_url    = get_permalink();
      $twitter_title  = get_the_title();
      $twitter_desc   = strip_tags (strip_shortcodes(substr((string)$post->post_content,0,110)));

      $twitter_thumbs = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), full );
      $twitter_thumb  = $twitter_thumbs[0];   

      //if(!$twitter_thumb) {
      //  $twitter_thumb = 'http://www.gravatar.com/avatar/8eb9ee80d39f13cbbad56da88ef3a6ee?rating=PG&size=75';
      //}

      ?>
      <meta name="twitter:card" value="summary" />
      <meta name="twitter:url" value="<?php echo $twitter_url; ?>" />
      <meta name="twitter:title" value="<?php echo $twitter_title; ?>" />
      <meta name="twitter:description" value="<?php echo $twitter_desc; ?>" />
      <meta name="twitter:image" value="<?php echo $twitter_thumb; ?>" />
      <meta name="twitter:site" value="@MMikael_18" />
      <meta name="twitter:creator" value="@MMikael_18" />

      <?php
    }
    
    ?>
  </head>

  <body>

    <header id="site-header">
      <div class="container">  
         	<div class="row">
		        <div class="col-sm-12" id="header-content">
              <?php 
                //cbTemp::sitelogo();                
                //cbTemp::basesearch();
              ?>
            </div>          
          </div>
      </div>
    </header>

    <main>
      