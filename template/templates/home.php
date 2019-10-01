<?php 
/*
Template Name: Home page
Template Post Type: post, page, event
*/
get_header();  

$cateries = get_terms(array('taxonomy'=> 'category') );
foreach($cateries as $category)
{
	PostWall::get_component_posts_rollup($category->slug, $category->name);
}

get_footer(); 
?>