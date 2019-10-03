<?php
// $url = get_permalink();
// $title = get_the_title();
// $date = get_the_date();
// $content = get_the_excerpt();
// $tags = cbTemp::get_tags_links();
// $cath = cbTemp::get_categories_links();
// $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'medium_large' ); 
// $thumb = "";
// $comment_numper = get_comments_number();
// if(!empty($thumb_url)){
//     $thumb = "<div class='thumb' style='background-image:url($thumb_url)'></div>";
// }else{
//     $thumb = "<div class='thumb-empty'></div>";
// }

// echo "<article class='pl-li'>
//         $thumb
//         <div class='pl-button-top'>$cath <span class='pl-com'><span>$comment_numper</span></span></div>
//         <div class='pl-content'>
//             <h3>$title </h3>
//             <span>$date</span>        
//             <p>$content</p>
//             <div class='pl-tags'>$tags</div>
//         </div>
//         <a href=$url></a>
//     </article>";

$url = get_permalink();
$date = get_the_date();
?>
<article id="post-<?php the_ID(); ?>" <?php post_class("c-postwall-list__item"); ?> data-loadarticle="<?php the_ID(); ?>">	
    <span><?php PostWall::get_tags() ?></span>
    <a href="<?php the_permalink() ?>">
        <h3><?php the_title(); ?></h3>
        <?php the_excerpt(); ?>
    </a>
</article>
<?php

?> 
