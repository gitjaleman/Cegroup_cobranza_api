<?php
session_start();
chdir( dirname(__DIR__) );
define("SYS_PATH","lib/");
define("APP_PATH","app/");
require SYS_PATH."initial.php";
$app =new Api;
?>
