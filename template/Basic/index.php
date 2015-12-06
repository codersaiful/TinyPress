<?php get_header();?>
<?php
$post_sql = "SELECT * FROM post WHERE type = 'page' AND ( id = '44' OR id = '47') ORDER BY id DESC"; 
$post_result = $conn->query($post_sql);
while($post_row = $post_result->fetch_assoc()):
?>
<div class="column clear main_content">
        <h3 title="<?php echo $post_row['title'] ?>"><?php echo $post_row['title'] ?></h3>
        <?php echo $post_row['content'] ?>
</div>
<?php
endwhile;
?>
<?php get_comment(); ?>
<?php get_footer(); ?>
<h1><?php my_comment(); ?></h1>
