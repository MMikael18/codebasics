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
        <div class='pl-cont-top'>
            <h3>$title</h3>
            $date
        </div>
        $thumb
        <div class='pl-cont-bottom'>
            <p>$content</p>
        </div>
        <div class='pl-button-bottom'>$tags</div>
        <a href=$url></a>
    </article>";

?>