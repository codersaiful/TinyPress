<?php
function site_url(){
$site_url = SITE_URL;
return $site_url;
}

//comon few function for internal
//error generate
function err_msg($arg){
    if(isset($arg)){
       echo '<code style="color: #d00;font-size: 9px; border: 1px solid gray;padding: 1px 2px;background: #eaeaea;font-family: monospace;">'.$arg.'</code>';
    }
}
function get_err_msg($arg){
    if(isset($arg)){
        return '<code style="color: #d00;font-size: 9px; border: 1px solid gray;padding: 1px 2px;background: #eaeaea;">'.$arg.'</code>';
    }
    else{return FALSE;}
}


function convert2content($data=null){
    if(!is_null($data)){
        $data = nl2br(htmlspecialchars($data));
        return $data;
    }
    else{
        return NULL;
    }
}

function get_header($file_name = null){
    $file = TEMPLATE.'header.php';
    if($file_name){
      $file = TEMPLATE.'header-'.$file_name.'.php';  
    }
    
    if(is_file($file)){
        include $file;
    }
    else{
        echo "[HEADER NOT FOUND]";
    }
}
function get_comment($file_name = null){
    $file = TEMPLATE.'comment.php';
    if($file_name){
      $file = TEMPLATE.'comment-'.$file_name.'.php';  
    }
    
    if(is_file($file)){
        include $file;
    }
    else{
        echo "[COMMENT FILE NOT FOUND]";
    }
}

function get_footer($file_name = null){
    $file = TEMPLATE.'footer.php';
    if($file_name){
      $file = TEMPLATE.'footer-'.$file_name.'.php';  
    }
    
    if(is_file($file)){
        include $file;
    }
    else{
        echo "[FOOTER NOT FOUND]";
    }
}

function get_sidebar($file_name = null){
    $file = TEMPLATE.'sidebar.php';
    if($file_name){
      $file = TEMPLATE.'sidebar-'.$file_name.'.php';  
    }
    
    if(is_file($file)){
        include $file;
    }
    else{
        echo "[SIDEBAR NOT FOUND]";
    }
}









function site_info($info_specify = 'site_title'){
    echo options($info_specify,'option_value');
}
function get_site_info($info_specify = 'site_title'){
    return get_options($info_specify,'option_value');
}











function data($required_column,$table_name,$tbl_collum = '',$tbl_colum_value=''){
    global $conn;
    $collum = '';
    if($tbl_colum_value != NULL){
        if($tbl_collum != NULL){
            $collum = " WHERE `{$tbl_collum}` = '{$tbl_colum_value}'"; 
         }
         else{
             $collum = NULL;
         }

    }
    
    $sql = "SELECT * FROM ".$table_name.$collum." ORDER BY `{$required_column}` DESC LIMIT 1";
    $data_result = $conn->query($sql);
    if($data_row = $data_result->fetch_assoc()):
        return $data_row[$required_column];
    else:
        return FALSE;
    endif;
    
    
}

//Post function
//for post page



function title(){

    //this function only for header title . page title
    global $type;
    global $slug;
    $title = '';
    if($type == 'index'){
        $title = options('site_title') . ' - ' . get_options('site_slogan');
    }else{
        $title = data("title","post","slug",$slug) . ' - ' . get_site_info();
    }
    if($type == '404'){
        $title = options($type);
    }
    echo $title;
    
}


function slogan(){

    //this function only for header title . page title
    global $type;
    global $slug;
    $title = '';
    if($type == 'index'){
        $title = options('site_slogan');
    }else{
        $title = data("title","post","slug",$slug);
    }
    echo $title;
    
}

function title_dashboard(){
    global $user;
    global $dharsboar_url;
    global $url;
    $title = "Dashboard";
    
    if(isset($_GET['type'])){
        $type = $_GET['type'];
    }
    if($dharsboar_url == 'new.php'){
        if(isset($_GET['status']) && $_GET['status'] == 'update'){
          $title = "Update $type -" . $title;  
        }
        else{
            $title = "New $type -" . $title;
        }
    }
    else if($dharsboar_url == 'post.php'){

        $title = "All $type -" . $title;
    }

    else if($dharsboar_url == 'confirm.php'){
        if(isset($_GET['status'])){
            $title = $_GET['status']." Confirmation -" . $title;
        }else{
        $title = "Confirmation -" . $title;
        }
    }
    else if($dharsboar_url == 'profile.php'){
        
        $username = $user['username'];
        $name = $user['fullname'];
        if($name == null){
            $name = $user['username'];    
        }
        if(isset($url[2]) && $url[2] != $username){
            $name = $url[2];
        }
        $title = $name . '\' Profile - '.$title;
    }
    
    
    echo $title;
}
/*
function have_posts(){
    return TRUE;
}
function the_post(){
    global $conn;
    global $slug;
    global $post;
    $sql = "SELECT * FROM post WHERE slug = '{$slug}'  LIMIT 1";
    $result = $conn->query($sql);
    $post = $result->fetch_assoc();
    return $post;
}
function the_title(){
    global $post;
    if(isset($post)){
        echo $post['title'];
    }
    else{
    echo "[the_post() REQUIRED]";
    }
}

function the_content(){
    global $post;
    if(isset($post)){
        echo $post['content'];
    }
    else{
    echo "[the_post() REQUIRED]";
    }
}
function the_time(){
    global $post;
    if(isset($post)){
        echo $post['time'];
    }
    else{
    echo "[the_post() REQUIRED]";
    }
}

 */
function the_tags(){
    global $post;
    if(isset($post)){
        $tags = $post['tags'];
        $tags = explode(",", $tags);
        echo '<ul class="tags '.$post['type'].'-tags postid-'.$post['id'].'">';
        foreach ($tags as $tag) {
            echo '<li>'.$tag.'</li>';
        }
        echo '<ul>';
        var_dump($tags);
    }
    else{
    echo "[the_post() REQUIRED]";
    }
}




//Menu section only for now. we have to delete after complete
#we have to customize more for better. but later.
function menu($menu_name = 'page',$options = array()){
    $default_supported_type = array('post','page');
    global $conn,$slug;
    $html = NULL;
    $active_class = ' ';
    $default_menu = 'default_menu';
    $class = "menubar";
    $menu_item_serial = 2; //Its for each menu id as serial into while loop
    
    
    //options section variable
    /*
     * container_class
     * container_id
     * container_tag
     * class
     * id
     */
    

    $menu_id = (isset($options['id'])) ? ' id="'. $options['id'] .'" ' : NULL ;
    $menu_class = (isset($options['class'])) ? ' '.$options['class'] : NULL ;
    $container_class = (isset($options['container_class'])) ? ' class="'. $options['container_class'] .'" ' : NULL ;
    $container_id = (isset($options['container_id'])) ? ' id="'. $options['container_id'] .'" ' : NULL ;
    $tag = (isset($options['container_tag'])) ? $options['container_tag'] : 'div';
    $container_tag_start = (isset($options['container_tag']) || isset($options['container_class']) || isset($options['container_id'])) ? '<' . $tag . ' ' . $container_class . ' ' . $container_id . '>' : NULL; 
    $container_tag_end = (isset($options['container_tag']) || isset($options['container_class']) || isset($options['container_id'])) ? '</' . $tag . ' >' : NULL; 
    

    
    
   $html .= $container_tag_start; // only when container tag
   
   
   if(in_array($menu_name, $default_supported_type) || $menu_name == NULL){  
        if(is_null($menu_name)){
            $menu_name = 'page';
        }
   $sql_menu = "SELECT slug,title,id FROM post WHERE type = '{$menu_name}'";
   $result_menu = $conn->query($sql_menu);
   if($result_menu->num_rows > 0){
   $html .= '<ul '.$menu_id.' class="'. $class .$menu_class.'">';
       while($row_menu = $result_menu->fetch_assoc()){           
           $active_class = ($slug == $row_menu['slug']) ? ' active_menu ' : ' ';
           $item_class = (is_null($row_menu['slug'])) ? ' menu-item ' : ' menu-item menu-'. $row_menu['slug'];
           
           $html .= '<li class="'. $item_class .' postid_'. $row_menu['id'] . $active_class . ' menuid_' . $menu_item_serial . '"> <a href="' . SITE_URL . $row_menu['slug']. '">'. $row_menu['title'] .'</a></li>';
       
        $menu_item_serial++;
        }
   $html .= '</ul>';
   }
   else{
       err_msg('MENU ERROR: not found any ' . $menu_name);

   }
}



else if($menu_name == TRUE && $menu_name != ''){
    $default_menu = $menu_name . '_menu';
    $sql_menu = "SELECT * FROM menu WHERE name = '{$menu_name}' LIMIT 1";
    $result_menu = $conn->query($sql_menu);
    if($result_menu->num_rows == 1){
        $row_menu = $result_menu->fetch_assoc();
        $menu = json_decode($row_menu['json'], TRUE);
        $html .= '<ul '.$menu_id.' class="'. $class .' ' . $default_menu . $menu_class. '">';
        foreach($menu as $key=>$link){
           $active_class = ($slug == $link['slug']) ? ' active_menu ' : ' ';
           $item_class = (is_null($link['slug'])) ? ' menu-item ' : ' menu-item menu-'. $link['slug'];
           
            $html .= '<li class="' . $item_class . $active_class . ' menuid_' . $key . '"><a title="' . $link['attr'] . '" href="' . SITE_URL . $link['slug'] . '">' . $link['title'] . '</a></li>';
        }
        $html .= '</ul>';
        
        }else{
            err_msg('MENU ERROR: not found any ' . $menu_name);
        }
    }
   $html .= $container_tag_end; // only when container tag
echo $html;

}


//the below color function only for random color use. now only used at comment function
function color(){
    $color = array('#EFADAD','#0E820D','#A6A9A6','#CC61AF','#62CC61','#6D61CC','#DA7A13','#FFB86B','#6B9EFF','#B2C761','#EFADAD','#000000');
    echo $color[rand(0, 11)];    
}

//Comment show for page/post
function comment(){
global $conn,$slug;


$default_msg_cmt = "There is no comment!";

$sql_cmt = "SELECT * FROM comment WHERE slug='{$slug}' ORDER BY id ASC";
$result_cmt = $conn->query($sql_cmt);
//if start here of comment abouve 1
if($result_cmt->num_rows > 0):
$default_msg_cmt = ($result_cmt->num_rows == 1)? "There is only 1 comment founded." :"There are ".$result_cmt->num_rows." comments founded.";

?>    
<div class="comment_header">
    <h4><?php echo $default_msg_cmt; ?></h4>
</div>
<div class="comment_wrapper">

    <?php
    while ($row_cmt = $result_cmt->fetch_assoc()):
    ?>       
            <a class="location_anchor" name="<?php echo $row_cmt['id']; ?>"></a>
<?php
if(isset($_COOKIE['last_cmt_id'])){
    if($_COOKIE['last_cmt_id'] == $row_cmt['id']):
        echo '<span class="comment_publish_message">Comment publish succefully</span>'; 
    endif;
}
?>
            <div class="comment_single">
                
                <div class="comment_image_box">
                    <img src="<?php echo 'http://www.gravatar.com/avatar/'.md5($row_cmt['email']); ?>" height="50px" width="50px">
                </div>
                <div class="comment_info_box">
                    <p class="author_name"><a href="<?php echo $row_cmt['web']; ?>" target="_blank"><?php echo $row_cmt['name']; ?></a></p>
                    <p class="author_tag"><?php echo date("D, d M, Y h:i:s",strtotime($row_cmt['time'])); ?></p>
                    <div style="color:<?php color();?>" class="comment_content"><?php echo $row_cmt['comment']; ?></div>

                </div>
                <br style="clear: both;">
            </div>    
    <?php endwhile; ?>
</div>
 <?php
else:
    echo '<h4>'.$default_msg_cmt.'</h4>';
endif; //if end here  
}


//comment form function
/*
 * ARRAY Structrure for comment_form function
 * @: 
 */
function comment_form($options = array('method'=>'post')){
    
    global $slug,$cmt_err,$cmt_msg,$cmt_value;
    $error_class = NULL; //this set for findout error form
//Error Handleling section and default value set - START here
$cmt_err['name'] = (isset($cmt_err['name']))? '<span class="error">'.$cmt_err['name'].'</span>' : NULL;
$error_class['name'] = (isset($cmt_err['name']))? 'error_field' : NULL;
$cmt_value['name'] = (isset($cmt_value['name']))? $cmt_value['name'] : null;

$cmt_err['email'] = (isset($cmt_err['email']))? '<span class="error">'.$cmt_err['email'].'</span>' : NULL;
$error_class['email'] = (isset($cmt_err['email']))? 'error_field' : NULL;
$cmt_value['email'] = (isset($cmt_value['email']))? $cmt_value['email'] : null;

$cmt_err['web'] = (isset($cmt_err['web']))? '<span class="error">'.$cmt_err['web'].'</span>' : NULL;
$error_class['web'] = (isset($cmt_err['web']))? 'error_filed' : NULL;
$cmt_value['web'] = (isset($cmt_value['web']))? $cmt_value['web'] : null;

$cmt_err['comment'] = (isset($cmt_err['comment']))? '<span class="error">'.$cmt_err['comment'].'</span>' : NULL;
$error_class['comment'] = (isset($cmt_err['comment']))? 'error_field' : NULL;
$cmt_value['comment'] = (isset($cmt_value['comment']))? $cmt_value['comment'] : null;
$cmt_msg = (isset($cmt_msg))? $cmt_msg : NULL;
//Error Handleling section and default value set - END here


    
    
    $html = '';
    $default_msg = '<a class="location_anchor" name="if_error"></a><span class="comment_default_msg">Leave a comment</span>';
    $container_class = 'form_wrapper';
    $class = $id = 'comment_form';
    $container_id = 'form_wrapper';
    $method = 'post';
    
    
    //array part handle
    /*container_tag
     * container_class
     * container_id
     * class
     * id
     * method = post
     */
    //class and id control for parameter
    $container_class = (isset($options['container_class'])) ? $options['container_class'] : $container_class ;
    $container_id = (isset($options['container_id'])) ? $options['container_id'] : $container_id ;
    
    $class = (isset($options['class'])) ? $options['class'] : $class ;
    $id = (isset($options['id'])) ? $options['id'] : $id ;
    
    
    
    /*
    if(isset($options['container_tag'])){
        $tag = $options['container_tag'];
    }
    else{
        $tag = NULL;
    }
    */

    
    $tag = (isset($options['container_tag']))? $options['container_tag'] : NULL;
    $tag_start = (isset($options['container_tag']))? '<'.$tag.' class="'.$container_class.'" id="'.$container_id.'">' : NULL;
    $tag_end = (isset($options['container_tag']))? '</'.$container_class.'>' : NULL;
    
    
    //method
    $method = (isset($options['method'])) ? $options['method'] : $method ;
    
    //container tag start here
    $html .= $tag_start;
    $html .= $default_msg;
    $html .= '<span class="error">'.$cmt_msg.'</span>';
    $html .= '<form action="?update=comment#if_error" method="'.$method.'" class="'.$class.'" id="'.$id.'">';
    $html .= '<p>Name:'.$cmt_err['name'].'<input class="comment_inpu comment_input_name '.$error_class['name'].'" type="text" value="'.$cmt_value['name'].'" placeholder="Write Name" name="name"></p>';
    $html .= 'Email:'.$cmt_err['email'].' <input class="comment_inpu comment_input_email '.$error_class['email'].'" type="text" value="'.$cmt_value['email'].'" placeholder="Write Email" name="email">';
    $html .= 'Web:'.$cmt_err['web'].' <input class="comment_inpu comment_input_web '.$error_class['web'].'" type="text" value="'.$cmt_value['web'].'" placeholder="Website URL" name="web">';
    $html .= 'Comment:'.$cmt_err['comment'].'<br><textarea class="comment_inpu comment_input_comment '.$error_class['comment'].'" name="comment" placeholder="Write Comment...">'.$cmt_value['comment'].'</textarea>';
    $html .= '<input id="comment_submit_button" type="submit" name="comment_submit" value="Submit">';
    
    $html .= '</form>';
    //container tag End here
    $html .= $tag_end;
    
    echo $html;
}











//Menu Section

/*
function menu($menu_name = null){
    global $conn;
    global $menu;
    $html = '';
    $class = 'menubar';
    
if($menu_name == FALSE){
   $sql_menu = "SELECT slug,title,id FROM post WHERE type = 'page'";
   $result_menu = $conn->query($sql_menu);
   if($result_menu->num_rows > 0){
   $html .= '<ul class="'. $class .'">';
       while($row_menu = $result_menu->fetch_assoc()){
           $html .= '<li class="menu-'. $row_menu['slug'] .' postid_'. $row_menu['id'] .'"> <a href="' . SITE_URL . $row_menu['slug']. '">'. $row_menu['title'] .'</a></li>';
       }
   $html .= '</ul>';
   }
}
else{
    $sql_menu = "SELECT * FROM menu WHERE menu_name = '{$menu_name}' ORDER BY menu_position ASC";
    
    $result_menu = $conn->query($sql_menu);
    if($result_menu->num_rows > 0){
        $class = 'menubar '. $menu_name . ' ' . 'menu_' . $menu_name;
        $html .= '<ul class="'. $class .'">';
        while($row_menu = $result_menu->fetch_assoc()){
            $html .= '<li class="menu_' . $row_menu['menu_slug'] .  ' menuid_'. $row_menu['id'] .' postid_'. $row_menu['menu_post_id'] .'"><a  title="'.$row_menu['menu_attr'].'" href="' . SITE_URL . $row_menu['menu_slug'] . '">'. $row_menu['menu_title'] .'</a></li>';
        }
        $html .= '</ul>';
    }
    
    
}

echo $html;
}
 */
$query = array();
$query['sql'] = TRUE;
$query['have_post'] = TRUE;

function query($options = array('post_type'=>'post','posts_per_page'=>'10')){
    global $slug,$type,$query;
    $where = " WHERE type='{$options['post_type']}'";
    $limit = " LIMIT {$options['posts_per_page']}";
    $query['post_type'] = $options['post_type'];
    $query['post_per_page'] = $options['posts_per_page'];
    $query['sql'] = "SELECT * FROM post";
    
    
    /*
    return $query['sql'];
    return $query['post_per_page'];

     */
}


