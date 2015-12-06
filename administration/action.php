<?php
if(isset($_GET['status']) && $_GET['status'] == 'delete' && isset($_GET['type']) && isset($_GET['id']) && isset($_GET['slug'])){
    //$status = $_GET['status'];
    $type = $_GET['type'];
    $id = $_GET['id'];
    $slug = $_GET['slug'];
        $sql = "DELETE FROM post WHERE id = '{$id}'";
        $sql_2 = "DELETE FROM controller WHERE slug = '{$slug}'";
        if($conn->query($sql) == TRUE && $conn->query($sql_2) == TRUE){
            header("Location: post.php?type=".$type."&msg=SucceffullyDeleted");
        }else{
          header("Location: post.php?type=".$type."&err=ProblemInPerform");  
        }
    
    
}
