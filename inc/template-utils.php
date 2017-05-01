<?php

if ( ! function_exists( 'cb_sitelogo' ) ) :
function cb_sitelogo() {
	if ( function_exists( 'the_custom_logo' ) ) {    
        wrapit("the_custom_logo","<div id='cb-sitelogo'>","</div>");
	}
}
endif;

if ( ! function_exists( 'cb_basesearch' ) ) :
function cb_basesearch() {
	if ( function_exists( 'get_search_form' ) ) {    
        wrapit("get_search_form","<div class='cb-search'>","</div>");
	}
}
endif;

function wrapit($call,$s,$e) {
    echo $s;
	call_user_func($call);
    echo $e;
}

?>