<html>
    <head>
        <title><?php title_dashboard(); ?></title>
        
        <?php admin_css(); ?>
    </head>
    <body>
        <div class="header">
            <div class="left_side col-5">
                <h1 class="admin_logo"><a href="<?php echo ADMIN_URL; ?>">Dashboard</a></h1>
            </div>
            <div class="right_side col-5">
                <div>
                    <?php login(); ?>
                </div>
            </div>
            <br class="clear">
        </div>
        
        <br style="clear: both;">
        <div style="width: 65%; float: left; min-width: 300px;">
        <a href="<?php echo ADMIN_URL; ?>new.php?type=post">New Post</a>
        <a href="<?php echo ADMIN_URL; ?>post.php?type=post">All Post</a>
        <a href="<?php echo ADMIN_URL; ?>new.php?type=page">New Page</a>
        <a href="<?php echo ADMIN_URL; ?>post.php?type=page">All Page</a>
        <a href="<?php echo ADMIN_URL; ?>new.php?type=portfolio">New Portfolio</a>
        <a href="<?php echo ADMIN_URL; ?>post.php?type=portfolio">All Portfolio</a>
        
        </div>
        <div style="width: 30%;float: left;min-width: 300px;">
            <?php login(); ?>
        </div>
        <br style="clear: both;">
