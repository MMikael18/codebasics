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

?>
<article id="post-<?php the_ID(); ?>" <?php post_class("c-postwall-list__item"); ?> data-loadarticle="<?php the_ID(); ?>">	    
    <a href="<?php the_permalink() ?>">
        <div class="c-postwall-list__item_top_coll">
            <small><?php echo get_the_date() ?></small>
            <h3><?php the_title(); ?></h3>
            <?php the_excerpt(); ?>
        </div>
        <div class="c-postwall-list__item_bottom_coll">
            <small><?php PostWall::the_tags_inpost(" / ") ?></small>
            <div class="c-postwall-list__comment-numper">        
                <?php echo '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M7 11c-.828 0-1.5-.671-1.5-1.5s.672-1.5 1.5-1.5c.829 0 1.5.671 1.5 1.5s-.671 1.5-1.5 1.5zm5 0c-.828 0-1.5-.671-1.5-1.5s.672-1.5 1.5-1.5c.829 0 1.5.671 1.5 1.5s-.671 1.5-1.5 1.5zm5 0c-.828 0-1.5-.671-1.5-1.5s.672-1.5 1.5-1.5c.829 0 1.5.671 1.5 1.5s-.671 1.5-1.5 1.5zm5-8v13h-11.643l-4.357 3.105v-3.105h-4v-13h20zm2-2h-24v16.981h4v5.019l7-5.019h13v-16.981z"/></svg>'; ?>
            <div><?php echo get_comments_number(); ?></div>
            </div>
        </div>
    </a>    
</article> 
<?php
//the_excerpt(); 
?> 
