
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <link href="https://fonts.googleapis.com/css?family=Alegreya+Sans:300,400,500,700,800,900|Raleway:400,500,600,700,800,900&display=swap" rel="stylesheet">
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
  <?php get_template_part( 'template-parts/nav', 'main' ); ?>
  <!--?php echo get_bloginfo( 'name' ); ?-->
  <header class="c-3dhero" >
    <div class="c-3dhero__content c-3dhero__content--1">
      <h2>Content Design</h2>
      <div class="c-3d__leve_m1">
        <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" viewBox="0 0 24 24"><path d="M24 10.935v2.131l-8 3.947v-2.23l5.64-2.783-5.64-2.79v-2.223l8 3.948zm-16 3.848l-5.64-2.783 5.64-2.79v-2.223l-8 3.948v2.131l8 3.947v-2.23zm7.047-10.783h-2.078l-4.011 16h2.073l4.016-16z"/></svg>
      </div>
      <div class="c-3d__leve_00">
        <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" viewBox="0 0 24 24"><path d="M24 10.935v2.131l-8 3.947v-2.23l5.64-2.783-5.64-2.79v-2.223l8 3.948zm-16 3.848l-5.64-2.783 5.64-2.79v-2.223l-8 3.948v2.131l8 3.947v-2.23zm7.047-10.783h-2.078l-4.011 16h2.073l4.016-16z"/></svg>
      </div>
      <div class="c-3d__leve_p1">
        <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" viewBox="0 0 24 24"><path d="M24 10.935v2.131l-8 3.947v-2.23l5.64-2.783-5.64-2.79v-2.223l8 3.948zm-16 3.848l-5.64-2.783 5.64-2.79v-2.223l-8 3.948v2.131l8 3.947v-2.23zm7.047-10.783h-2.078l-4.011 16h2.073l4.016-16z"/></svg>
      </div>      
    </div>
    <div class="c-3dhero__content c-3dhero__content--2">
      <h2>User Experience & Design</h2>
      <h3>UX</h3>
      <h3>UI</h3>
      <div class="c-3d__leve_p1">
        <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" viewBox="0 0 24 24"><path d="M24 10.935v2.131l-8 3.947v-2.23l5.64-2.783-5.64-2.79v-2.223l8 3.948zm-16 3.848l-5.64-2.783 5.64-2.79v-2.223l-8 3.948v2.131l8 3.947v-2.23zm7.047-10.783h-2.078l-4.011 16h2.073l4.016-16z"/></svg>
      </div>      
    </div>
    <div class="c-3dhero__content c-3dhero__content--3">
      <h2>Front-end development</h2>
      <div class="c-3d__leve_p1">
        <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" viewBox="0 0 24 24"><path d="M24 10.935v2.131l-8 3.947v-2.23l5.64-2.783-5.64-2.79v-2.223l8 3.948zm-16 3.848l-5.64-2.783 5.64-2.79v-2.223l-8 3.948v2.131l8 3.947v-2.23zm7.047-10.783h-2.078l-4.011 16h2.073l4.016-16z"/></svg>
      </div>
    </div>
    <div class="c-3dhero__content c-3dhero__content--4">
      <h2>Back-End development</h2>
      <div class="c-3d__leve_p1">
        <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" viewBox="0 0 24 24"><path d="M24 10.935v2.131l-8 3.947v-2.23l5.64-2.783-5.64-2.79v-2.223l8 3.948zm-16 3.848l-5.64-2.783 5.64-2.79v-2.223l-8 3.948v2.131l8 3.947v-2.23zm7.047-10.783h-2.078l-4.011 16h2.073l4.016-16z"/></svg>
      </div>
    </div>
  </header>
  
 
  <main>    