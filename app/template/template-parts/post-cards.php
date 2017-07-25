<?php
die("off");

$url = get_permalink();
$title = get_the_title();
$content = get_the_excerpt();
$tags = cbTemp::get_tags_links();
$cath = cbTemp::get_categories_links();

echo "<article class='pl-li'>
        <div class='pl-cats' style='display:none;'>$cath</div>
        <div class='pl-cont'>
            <h3>$title</h3>
            <p>$content</p>
            <div class='pl-tags'>$tags</div>
        </div>
        <a href=$url></a>
    </article>";
?>