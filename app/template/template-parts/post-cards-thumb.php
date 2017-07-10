<?php
$url = get_permalink();
$title = get_the_title();
$date = get_the_date();
$content = get_the_excerpt();
$tags = cbTemp::get_tags_links();
$cath = cbTemp::get_categories_links();
$thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'medium_large' ); 
$thumb = "";
if(!empty($thumb_url)){
    $thumb = "<div class='thumb' style='background-image:url($thumb_url)'></div>";
}

echo "<article class='pl-li'>
        <div class='pl-button-top'>$cath</div>
        <h3 class='pl-title'>$title </h3>
        <span class='pl-date'>$date</span>
        $thumb
        <p class='pl-content'>
            $content
        </p>
        <div class='pl-button-bottom'>$tags</div>
        <a href=$url></a>
    </article>";

?>