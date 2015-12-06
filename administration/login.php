<?php
if(isset($_SESSION['session_auth']) && $_SESSION['session_auth'] == 'logedin'){
    header("Location: ". ADMIN_URL); 
    exit();
}
/*
$_POST['username'];
$_POST['password'];
$_POST['login'];
 */
//preset variable
$logErr[] = NULL;
$user = NULL;
$pass = NULL;
if(isset($_GET['login']) && $_GET['login'] == 'now'):
    if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        if($username != NULL && $password != NULL){
            $sql_user = "SELECT username,password,active FROM user WHERE username = '{$username}' LIMIT 1";
            $result_user = $conn->query($sql_user);
            if($result_user->num_rows == 1){
                $user = TRUE;
                $row_user = $result_user->fetch_assoc();
                $user_confirm_from_db = $row_user['username']; //its taken for making session as username
                
                
                //password of database
                $database_password = $row_user['password'];
                $encripted_password = md5($password);
                if($encripted_password == $database_password){
                    $pass = TRUE;
                    //active status of database for user
                    $active_status = $row_user['active'];
                    if($active_status == 0){
                        $user = FALSE;
                        $logErr[] = "Your account is not active yet";

                    }                    
                    
                }
                else{
                    $pass = FALSE;
                    $logErr[] = "Password Not match in Database";
                }
                
            }else{
                $user = FALSE;
                $logErr[] = "Username not Found in Database !";
            }
            
        }
        if($username == NULL){
            $user = FALSE;
            $logErr[] = "Username blank!";
        }
        if($password ==  NULL){
            $pass = FALSE;
            $logErr[] = "Password blank!";
        }
        
        
        
        if($user == TRUE && $pass == TRUE){
            
            $_SESSION['session_auth'] = 'logedin';
            $_SESSION['username'] = $user_confirm_from_db;
            header("Location: ". ADMIN_URL); 
            exit();
        }
        
        
    }
    
endif;
?>
<html>
    <head>
        <title>Login Page</title>
        <?php admin_css(); ?>
   
    </head>
    <body class="login_page">
        <div class="login_wrapper">
            <h1>Login</h1>
            <form action="login?login=now" method="POST" id="login_form" class="login_form">
                <p>Username:</p>
                <input type="text" name="username" class="username" id="username"><br>
                <p>Password:</p>
                <input type="password" name="password" class="password" id="password">
                <br>
                <p>
                    <input type="submit" name="login" value="Sign In" class="submit" id="submit">
                </p>
            </form>
        <?php
        if($logErr != null):
            echo '<p style="color: red;">';
            foreach($logErr as $singErr){
                echo $singErr.'<br>';
            }
            echo '</p>';
        endif;
        ?>
            <p>Don't have account? <a href="<?php echo ADMIN_URL; ?>signup">Sign up Now</a></p>
        </div>
        
    </body>
</html>
