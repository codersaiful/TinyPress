<?php

include("connection.php");
include("config.php");
include("inc/functions.php");

$url = NULL;

if(isset($_GET['url'])){
    $url = $_GET['url'];
    $url = explode("/",$url);
    
    $slug = $url[0];
}
else{
    $slug = "index";
}

if($slug == 'admin'){

    
    //all file will come from Adminstration directory
    //$restriction_file variable now include at config file
    //$restriction_file = ['login','login.php','logout','logout.php','signup','signup.php'];

    $default_admin = ADMIN."404.php";
    $admin_file = ADMIN."index.php";
    if(isset($url[1])){
        $dharsboar_url = '';
        if($url[1] != NULL){
            $admin_url = explode(".",$url[1]);
            if(end($admin_url) == 'php'){
                $admin_file = ADMIN.$url[1];
                $dharsboar_url = $url[1]; //for dashabord title declear
                
            }
            else{
                $admin_file = ADMIN.$url[1].'.php';
                $dharsboar_url = $url[1] . '.php'; //for dashabord title declear
                
                
            }

        }
    }
    
    /*ALL INCLUDE are avaiale at bellow*/
   
    #SESSION File for full admin section
    $session_file = ADMIN.'session.php';
    include_once $session_file;
    
    
    #INCLUDE header file 
    if((isset($url[1]) && !in_array($url[1], $restriction_file)) || !isset($url[1])){     
        $header_file = ADMIN.'header.php';        
        include $header_file;
    }
    
    //Include ADMIN file
    if(is_file($admin_file)){
    include $admin_file;
    }else{
        include $default_admin;
    }

     //Error file and message file for all page
    $error_file = ADMIN."inc/err.php";
    $message_file = ADMIN."inc/msg.php";
    include_once $error_file;
    include_once $message_file;
    
    #INCLUDE header file
    if((isset($url[1]) && !in_array($url[1], $restriction_file)) || !isset($url[1])){
        $footer_file = ADMIN.'footer.php';
        include $footer_file;
    }
    
    
}else{
    
    //upload data section by default update file
    if(isset($_GET['update'])):
        include 'update.php';
    endif;
    
    $sql_url = "SELECT * FROM controller WHERE slug = '{$slug}'  LIMIT 1";
    $result_url = $conn->query($sql_url);
    if($row_url = $result_url->fetch_assoc()){
        $file = TEMPLATE.$row_url['type'].".php";
        if(is_file($file)){
            $slug = $slug;
            $type = $row_url['type'];
            include $file;
        }
        else{
            $file = TEMPLATE."index.php";
            if(!is_file($file)){
                echo "<span style='color: red;'>There is no index file on your Template. It's must.</span>";
            }
            else{
                $slug = 'home';
                $type = 'home';
                include $file;
            }
        }

    }
     else {
        $required_404 = TEMPLATE.'404.php';
        if(!is_file($required_404)){
            $required_404 = ROOT."inc/404.php";
        }
        $slug = '404';
        $type = '404';
        include $required_404;
    }
}
//echo 'http://www.gravatar.com/avatar/'.md5('salam@gmail.com');
/*
echo '<hr>Slug:<br>';
var_dump($slug);

echo '<hr>Options:<br>';
var_dump($options);

echo '<hr>Type:<br>';
var_dump($type);

echo '<hr>Query:<br>';
var_dump($query);

*/
