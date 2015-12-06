<?php

/* 
These function only for Admin use
 */
function admin_css($css_file_name = null){
    if(!isset($css_file_name)):
    $avail_able_css_folder = scandir(CSS,TRUE);
    foreach ($avail_able_css_folder as $each_css){
        if(strlen($each_css)>2){
            $css_file = CSS_URL.$each_css;
            echo '<link rel="stylesheet" type="text/css" href="'.$css_file.'">';
        }
    }
    else:
        echo '<link rel="stylesheet" type="text/css" href="'.CSS_URL.$css_file_name.'.css">';
    endif;
}
