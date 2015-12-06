<?php
session_start();

if((isset($url[1]) && $url != NULL && !in_array($url[1], $restriction_file)) || !isset($url[1])){
    if(isset($_SESSION['session_auth']) && isset($_SESSION['username']) && $_SESSION['session_auth'] == 'logedin'){
        $sql_user = "SELECT username,fullname FROM user WHERE username = '{$_SESSION['username']}'";
        
        $result_result = $conn->query($sql_user);
        $row_user = $result_result->fetch_assoc();
        $user = $row_user;
        function login($tag = 'b'){
            global $user;
            $username = $user['username'];
            $name = $user['fullname'];
            if(empty($name)){
               $name =  $username;
            }
            $html = '<div class="user_login_box">';
            $html .= 'You are <'.$tag.'>'.$name.'</'.$tag.'> <a href="'. ADMIN_URL .'logout">Logout</a>';
            $html .= ' <a href="'. ADMIN_URL .'profile/'.$username.'"> Profile</a>';
            $html .= '</div>';
            echo $html;
            
        }
    }
    else{        
       header("Location: ". ADMIN_URL ."login"); 
       exit();
    }
}
