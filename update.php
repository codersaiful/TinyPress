<?php
if(isset($_GET['update'])){
    
//Comment update start here    
if($_GET['update'] == 'comment'):
if(isset($_POST['comment_submit']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['web']) && isset($_POST['comment'])){
    $cmt_err = NULL;
    $cmt_value = NULL;
    $name = $_POST['name'];
    if($name == null){
        $cmt_err['name'] = 'Name field blank';
    }else if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
        $cmt_err['name'] = "Only letters and white space allowed"; 
    }
    $cmt_value['name'] = $name;

    
    $email = $_POST['email'];
    if($email == null){
        $cmt_err['email'] = 'Email field blank';
    }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $cmt_err['email'] = "Invalid email format"; 
    }
    $cmt_value['email'] = $email;

    
    $web = $_POST['web'];
    if($web == null){
        $cmt_err['web'] = 'URL field blank';
    }else if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$web)) { 
            $cmt_err['web'] = "Invalid URL - Obviously looks at <b>http:// or https://</b>";
    }
    $cmt_value['web'] = $web;

    
    
    $comment = convert2content($_POST['comment']);
    if($comment == null){
        $cmt_err['comment'] = 'Comment field blank';
    }
    $cmt_value['comment'] = $comment;
    
    if(count($cmt_err)==0){
        $sql = "INSERT INTO comment(id,slug,name,email,web,comment) VALUES (NULL,'{$slug}','{$name}','{$email}','{$web}','{$comment}')";
       
        comment::add_comment($sql);
    }
    else{
        $cmt_msg = '<a name="error"></a>Something went wrong. Check all fields again.';
    }
}
endif;
//comment update end here.






}
else{ echo err_msg("something Error to here");}
