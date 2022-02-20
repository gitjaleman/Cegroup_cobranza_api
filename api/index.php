<?php
session_start();
chdir( dirname(__DIR__) );
define("SYS_PATH","lib/");
define("APP_PATH","app/");
define("CODING",   null);
require SYS_PATH."initial.php";
function format_post($value){
  $micoding = 'null';
  switch ($micoding) {
    case 'encode':
      $value = utf8_encode(mb_strtoupper($value));
      break;
    case 'decode':
      $value =  utf8_decode(mb_strtoupper($value));
      break;
    case 'null':
      $value =  mb_strtoupper($value);
      break;
  }
 return $value;
}
$app =new Api;
/*  prueba */
?>
