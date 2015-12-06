<?php
session_destroy();
header("Location: ". ADMIN_URL ."login"); 
die();
