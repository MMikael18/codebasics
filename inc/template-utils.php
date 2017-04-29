<?php

if ( ! function_exists( 'codebase_sitelogo' ) ) :
function codebase_sitelogo() {
	if ( function_exists( 'the_custom_logo' ) ) {    
        wrapit("the_custom_logo","<div id='site-logo'>","</div>");
	}
}
endif;

function wrapit($call,$s,$e) {
    echo $s;
	call_user_func($call);
    echo $e;
}

?>