<?php
if(isset($err)){
    echo '<ul class="message_list">';
    foreach ($err as $error){
        echo '<li>'.$error.'</li>';
    }
    echo '</ul>';
}
