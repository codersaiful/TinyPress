<?php

if(isset($_SESSION['session_auth']) && $_SESSION['session_auth'] == 'logedin'){
    header("Location: ". ADMIN_URL); 
    die();
}


if(isset($_GET['signup']) && $_GET['signup'] == 'now' && (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['username']))):
    $username = $_POST['username'];
    $email = $_POST['email'];
    $fullname = $_POST['fullname'];
    $password = md5($_POST['password']);
    $url = $_POST['url'];
    
    $sql = "INSERT INTO user (id,username,email,fullname,password,url,active) VALUES (NULL,'{$username}','{$email}','{$fullname}','{$password}','{$url}',1)";
    if($conn->query($sql)){
       header("Location: ". ADMIN_URL ."login?msg=LoginNow"); 
       die();
    }
endif;
?>

<html>
    <head>
        <title>Sign Up now</title>
        <?php admin_css(); ?>
   
    </head>
    <body class="login_page">
        <div class="login_wrapper">
            <h1>Sign Up</h1>
            <form action="signup?signup=now" method="POST" id="login_form" class="login_form">
                Username:<br>
                <input type="text" name="username" class="username" id="username"><br>
                Email Address:<br>
                <input type="email" name="email" class="email" id="email"><br>
                Fill Name:<br>
                <input type="text" name="fullname" class="fullname" id="fullname"><br>
                Password:<br>
                <input type="text" name="password" class="password" id="password"><br>
                website url:<br>
                <input type="url" name="url" class="url" id="url"><br>
                <br>
                <input type="submit" name="signup" value="Sign Up">
            </form>
        <p>Already account? <a href="<?php echo ADMIN_URL; ?>login">Sign In Here</a></p>
        </div>
    </body>
</html>
