
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <?php wp_head();?>
    <?php    
      global $post;

      $twitter_url    = get_permalink();
      $twitter_title  = get_the_title();
      $twitter_desc = $post->post_excerpt;
      if(empty($twitter_desc)){
        $twitter_desc = substr(strip_tags (strip_shortcodes((string)$post->post_content)),0,110);
        $twitter_desc = trim(preg_replace('!\s+!', ' ', $twitter_desc));
      }

      $twitter_thumbs = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), full );
      $twitter_thumb  = $twitter_thumbs[0];   

      if(!$twitter_thumb) {        
        $twitter_thumb = esc_url( get_template_directory_uri() . '/img/siteicon.PNG' );
      }
  ?>
    <meta name="description" content="<?php echo $twitter_desc; ?>">
    <meta name="author" content="Matti Uusitalo">
  <?php
  if(is_single() || is_page()) {
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
      