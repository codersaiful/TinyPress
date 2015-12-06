<?php

if(isset($msg) || isset($_GET['msg'])){
    if(isset($_GET['msg'])){
        $msg[] = $_GET['msg'];
    }

    echo '<ul style="color: green;" class="error_list">';
    foreach ($msg as $message){
        echo '<li>'.$message.'</li>';
    }
    echo '</ul>';
}
