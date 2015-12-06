<?php
$type = 'post';
if(isset($_GET['type']) && $_GET['type'] == TRUE){
    $type = $_GET['type'];
}
include ADMIN . 'inc/list.php';


/*
 * if want to change all post/page page go to inc folder than edit list.php file
 */
