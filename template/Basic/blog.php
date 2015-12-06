<?php get_header();?>
<div class="column clear main_content">
<?php
$post_sql = "SELECT * FROM post WHERE type = 'post' ORDER BY id DESC"; 
$post_result = $conn->query($post_sql);
if($post_result->num_rows > 0):
while($post_row = $post_result->fetch_assoc()):
?>
<div class="column clear">
        <h3 title="<?php echo $post_row['title'] ?>"><?php echo $post_row['title'] ?></h3>
        <?php echo $post_row['content'] ?>
        <p><?php the_tags(); ?></p>
</div>
<?php
endwhile;
else:
    echo 'There is no post.';
endif;
?>
</div>
<?php get_comment(); ?>
<?php get_footer(); ?>
