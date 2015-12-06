<?php
//$home_url_file = $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];


define("base_root", str_replace("\\", "/", __DIR__),TRUE);
define("ROOT", base_root.'/',TRUE);

define("ADMIN",ROOT."administration/",TRUE);


//list of GLOBAL VARIABLE
/*
*$type will post/page type
 * option for making option key,name and value
 * [user] variable for after session. to see logined user infomation
 * [$url] for any where to get $url[1] or $url[2] etc
 *  */
global $slug,$post,$type,$options,$dharsboar_url,$user,$url,$query,$menu,$row;



$restriction_file = ['login','login.php','logout','logout.php','signup','signup.php'];


//To global option for all pages/post/everywhere
$sql = "SELECT * FROM options";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()){
    $option_key[] = $row['option_key'];$option_value[] = $row['option_value'];$option_name[] = $row['option_name'];
}

$options['option_value'] = array_combine($option_key, $option_value);
$options['option_name'] = array_combine($option_key, $option_name);

function options($specific_data,$data_type = 'option_value'){
    global $options;
    echo $options[$data_type][$specific_data];
}
function get_options($specific_data,$data_type = 'option_value'){
    global $options;
    return $options[$data_type][$specific_data];
}

/*
$sql_menu = "SELECT * FROM menu WHERE menu_type = 'main_menu'";
$result_menu = $conn->query($sql_menu);
$row_menu = $result_menu->fetch_assoc();
*/




$template_name = get_options('current_template');
define("TEMPLATE",ROOT."templates/".$template_name."/",TRUE);
define("PLUGIN",ROOT."plugins/",TRUE);
define("CSS",ROOT."css/",TRUE);


$site_url = get_options('site_url');
define("SITE_URL", $site_url,TRUE);
define("ADMIN_URL", SITE_URL."admin/",TRUE);
define("CSS_URL", SITE_URL."css/",TRUE);

define("TEMPLATE_URL", SITE_URL . "templates/" . $template_name . "/",TRUE);




