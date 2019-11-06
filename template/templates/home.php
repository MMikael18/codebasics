<?php 
/*
Template Name: Home page
Template Post Type: post, page, event
*/
get_header();  

?>
<div id="post_wall_app"></div>
<?php

// PostWall::get_navigation();

// $cateries = get_terms(array('taxonomy'=> 'category') );
// foreach($cateries as $category)
// {
// 	PostWall::get_posts($category->slug, $category->name);
//}

get_footer(); 
?>