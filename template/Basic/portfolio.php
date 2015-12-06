<?php get_header(); ?>
<div class="column clear">
<h1>Porfolio Template</h1>
<?php
$sql = "SELECT * FROM post WHERE slug = '{$slug}'  LIMIT 1";
$result = $conn->query($sql);
if($row = $result->fetch_assoc()){
?>
<div class="post_wraper">
    <h1 title="<?php echo $row['title']; ?>"><?php echo $row['title']; ?></h1><hr>
    Posted: <?php echo $row['time']; ?><br>
    <p><?php echo $row['content'] ?></p>
</div>
<?php
}


?>
<?php get_comment(); ?>
</div>
<?php get_footer(); ?>
