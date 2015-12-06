<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if(isset($_GET['status']) && $_GET['status'] == 'delete' && isset($_GET['type']) && isset($_GET['id'])){
    $status = $_GET['status'];
    $type = $_GET['type'];
    $id = $_GET['id'];
        $sql = "SELECT id,title,content,slug FROM post WHERE id = '$id'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        ?>
        <div class="confirm_delete_box">
            <h1>Are you sure?</h1>
            <p>You want to delete permanently the bellow <?php echo $type; ?></p>
            <p class="post_preview_confirm">
                <b><?php echo $row['title']; ?></b><br>
                <?php echo substr($row['content'],0,120); ?>
                [<a href="<?php echo SITE_URL . $row['slug']; ?>" target="_blank">Preview</a>]
            </p>
            <hr>
            <a href="post.php?type=<?php echo $type; ?>&msg=Cancel" class="button button_cancel" > Cancel</a>
            <a href="action.php?status=delete&type=<?php echo $type; ?>&id=<?php echo $row['id'] ?>&slug=<?php echo $row['slug'] ?>" class="button button_cancel" > Delete Now</a>
            
        </div>
        <?php
}
