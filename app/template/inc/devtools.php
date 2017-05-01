<?php



if ( ! function_exists( 'php_file' ) ) :
function php_file(){
    ob_start();
	?>
    <span style="padding:2px 5px;margin-bottom:5px;display:inline-block;background-color:#ccc;">
    <?php
    //echo basename(__FILE__, '.php');
    foreach(debug_backtrace() as $item){
        echo var_dump($item["file"]) . "<br/>";
    }
    ?>
    </span>
    <?php
	echo ob_get_clean();
}
endif;




?>