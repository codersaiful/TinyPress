<?php get_header(); ?>
<?php



$sql = "SELECT * FROM post WHERE slug = '{$slug}'  LIMIT 1";
$result = $conn->query($sql);
if($row = $result->fetch_assoc()){
?>
<div class="column clear main_content">
    <h3><?php echo $row['title']; ?></h3>
    Posted: <?php echo $row['time']; ?><br>
    <p><?php echo $row['content'] ?></p>
</div>
<?php
}

?>
<?php get_comment(); ?>
<?php get_footer(); ?>
