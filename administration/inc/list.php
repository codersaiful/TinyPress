<?php
if(!isset($type)){
  echo "Type Not set!!.";
  die();
}
?>
<h2>All <?php echo $type; ?></h2>
<ul class="all_<?php echo $type; ?>_list">
    <?php
     $start = 0;
     $limit = get_options('list_amount');
     $sql = "SELECT * FROM post WHERE type = '{$type}'  ORDER BY id DESC LIMIT ". $start ."," . $limit;
     $result = $conn->query($sql);
     while($row = $result->fetch_assoc()){
         ?>
    <li>
        <div class="list_single_wrapper">
            <h3><?php echo $row['title'] ?></h3>
            <a href="<?php echo ADMIN_URL;?>new.php?type=<?php echo $type; ?>&status=update&id=<?php echo $row['id'] ?>">Edit</a> 
            <a href="<?php echo SITE_URL . $row['slug']; ?>" target="_blank">View</a>
            <a href="<?php echo ADMIN_URL;?>confirm.php?status=delete&type=<?php echo $type; ?>&id=<?php echo $row['id'] ?>">Delete Post</a>
        </div>
    </li>
    <?php
     }

    ?>
</ul>
<?php
    echo get_options('list_amount','option_name') . " - ". $limit;
