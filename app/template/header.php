
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,400i,500,600,700,800,900&display=swap" 
          rel="stylesheet">
    <?php wp_head();?>
    <?php
      global $post;

      $twitter_url    = get_permalink();
      $twitter_title  = get_the_title();
      $twitter_desc = $post->post_excerpt;
      if(empty($twitter_desc)){
        $twitter_desc = substr(strip_tags (strip_shortcodes($post->post_content)),0,110);
        $twitter_desc = str_replace("&nbsp;", ' ', $twitter_desc);
        $twitter_desc = wp_trim_excerpt(trim(preg_replace('!\s+!', ' ', $twitter_desc)));
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
  <?php 
    //$thumbnail = "background-image: url(" . get_header_image() . ");";
    //cbTemp::sitelogo();                
    //cbTemp::basesearch();
  ?>

  <body>      
  <?php //get_template_part( 'template-parts/nav', 'main' ); ?>
  <?php //echo get_bloginfo( 'name' ); ?>
  <?php get_template_part( 'template-parts/sos', 'links' ); ?>
  <div class="l-orage_box">
    <span class="c-blog_title">ReCapNotes.com</span>    
  </div>
  <header class="c-hero-camere" >
    <div class="c-hero-object c-hero-object--dia1">
      <div class="c-hero-object__inner"></div>
      <span class="c-text-logic">logic</span>
    </div>
    <div class="c-hero-object c-hero-object--dia2">      
      <div class="c-hero-object__inner">dia 2</div>
    </div>
    <div class="c-hero-object c-hero-object--dia3">
      <div class="c-hero-object__inner">dia 3</div>
    </div>
    <div class="c-hero-object c-hero-object--dia4"> 
      <div class="c-hero-object__inner">dia 4</div>
    </div>
  </header>
  
 
  <main>    