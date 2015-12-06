<?php
if(isset($_GET['type']) && $_GET['type'] == TRUE){
    $type = $_GET['type'];
}
include ADMIN . 'inc/new.php';

/*
 * if want to change new page/post form, go to inc folder than edit new.php file
 */
