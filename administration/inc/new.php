
<?php

if(!isset($type)){
    echo "Type Not set!!";
    die();
}

if(isset($_GET['status']) && $_GET['status'] == 'update' && $_GET['id']):
    $id = $_GET['id'];
    $sql_post = "SELECT * FROM post WHERE id = '{$id}'";
    $result_post = $conn->query($sql_post);
    while($row_post = $result_post->fetch_assoc()){ ?>
<div style="border: 1px solid black; padding: 10px;">
    <a href="<?php echo SITE_URL . $row_post['slug']; ?>" target="_blank">View Details</a>
    <form action="" method="post">
        Title: <input type="text" name="title" value="<?php echo $row_post['title'] ?>"><br>
        Slug: <input type="text" name="slug" value="<?php echo $row_post['slug'] ?>"><br>
        <input type="hidden" name="exising_slug" value="<?php echo $row_post['slug'] ?>">
        Content: <br><textarea name="content"><?php echo $row_post['content'] ?></textarea><br>
        Tags: <input type="text" name="tags" value="<?php echo $row_post['tags'] ?>"><br>
        <input name="update" type="submit" value='Update'>
        <a href="post.php?type=<?php echo $type; ?>&msg=Cancel" class="button button_cancel" > Cancel</a>
    </form>
</div>          
    

<?php
    }    
else: 
    ?>
<div style="border: 1px solid black; padding: 10px;">
    <form action="" method="post">
        Title: <input type="text" name="title"><br>
        Slug: <input type="text" name="slug"><br>
        Content: <br><textarea name="content"></textarea><br>
        Tags: <input type="text" name="tags"><br>
        <input name="submit" type="submit" value='Publish'>
    </form>
</div>    
<?php endif;
?>

<?php 

if(isset($_POST['submit'])){
    $id = null;
    $title = $_POST['title'];
    $slug = $_POST['slug'];
    $content = $_POST['content'];
    $auth_user_id = 1;
    $tags = $_POST['tags'];
    $time = '';

//    echo $title.$slug.$time.$tags;
	$sql = "
	INSERT INTO post
	(
	id,
	title,
	slug,
	content,
	type,
	auth_user_id,
	tags,
	time
	)
	VALUES
	(
	NULL,
	'{$title}',
	'{$slug}',
	'{$content}',
	'{$type}',
	'{$auth_user_id}',
	'{$tags}',
	NOW()
	)
	";
    //$sql = "INSERT INTO post (title,content) VALUES ('SAIFUL','ISLAM')";
    //$sql = "INSERT INTO post (id,title,slug,content,type,auth_user_id,tags,time) VALUES (NULL,'{$title}','{$slug}','{$content}','{$type}','{$auth_user_id}','{$tags}','{$time}'";
    $sql2 = "INSERT INTO controller (id,slug,type) VALUES (NULL,'{$slug}','{$type}')";
    $conn->query($sql);
    $last_id = $conn->insert_id;
    $conn->query($sql2);

    $conn->close();
    header("Location: new.php?type=".$type."&status=update&id={$last_id}");
}
else if(isset($_POST['update']) && isset($_GET['status']) && isset ($_GET['id'])){
$id = $_GET['id'];
$title = $_POST['title'];
$slug = $_POST['slug'];
$exising_slug = $_POST['exising_slug'];
$content = $_POST['content'];

$auth_user_id = 1;
$tags = $_POST['tags'];
$time = '';
$sql_update = "UPDATE post SET title = '{$title}',slug = '{$slug}',content = '{$content}',tags = '{$tags}' WHERE id = '{$id}'";
$sql_update_controller = "UPDATE controller SET slug = '{$slug}' WHERE slug = '{$exising_slug}'";
$conn->query($sql_update);
$conn->query($sql_update_controller);
$conn->close();
header("Location: new.php?type=".$type."&status=update&id={$id}&msg=okUpdated");

}

?>
