<?php
        if($dharsboar_url == 'profile.php'){
            if(isset($url[2]) && $_SESSION['username'] != $url[2]){
                $sql_user_profile = "SELECT * FROM user WHERE username = '{$url[2]}'";
            }
            else{
                $sql_user_profile = "SELECT * FROM user WHERE username = '{$_SESSION['username']}'";    
            }
            
        }
        $result_Profile = $conn->query($sql_user_profile);
        $row_profile = $result_Profile->fetch_assoc();
        
        $user_profile = $row_profile;
if($result_Profile->num_rows > 0){
?>
<div class="profile_view_wrapper">
    <h2>Name: <?php echo $user_profile['fullname']; ?></h2><hr>
    <div class="information_box">
        <b>Other Information:</b><br>
        Username: Name: <?php echo $user_profile['username']; ?> | email: Name: <?php echo $user_profile['email']; ?><br>
        Account Status: Name: <?php echo $user_profile['active']; ?> <br>
        web: Name: <?php echo $user_profile['url']; ?>
    </div>
    
</div>
<?php
}
else {
    echo '<p style="color: red; text-align: center;">Not found User</p>';
}
?>


