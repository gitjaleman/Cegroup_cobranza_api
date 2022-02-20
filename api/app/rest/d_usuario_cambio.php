<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('content-type: application/json; charset=utf-8');
http_response_code(200);

$return=null;

switch ($_SERVER['REQUEST_METHOD']){
  case 'GET':
      $return = SELECT_PROCESS();
    break;
}

function SELECT_PROCESS(){
  $t = $_GET['t'];
   switch ($t) {
      case 'avatar':
        $data['data'] = PROCESS_AVATAR();
        break;
      case 'password':
        $data['data'] = PROCESS_PASS();
        break;


   }
   return $data;
 }




function PROCESS_AVATAR(){
  $a = $_GET['a'];
  $v = $_GET['v'];
  $obj = new conn;
  $sql = "UPDATE `t_usuarios` SET `avatar` = '$v' WHERE `t_usuarios`.`username` = '$a' ";
  $con = $obj->query($sql);
  $data['sql'] = $sql;
  if ($con) {
    $data['data'] = true;
    $data['avatar'] = $v;
  }else{
    $data['data'] = false;
  }
  return $data;
}



function PROCESS_PASS(){
  $a = $_GET['a'];
  $p = md5($_GET['v']);
  $obj = new conn;
  $sql = "UPDATE `t_usuarios` SET `userpass` = '$p' WHERE `t_usuarios`.`username` = '$a' ";
  $con = $obj->query($sql);
  $data['sql'] = $sql;
  if ($con) {
    $data['data'] = true;
  }else{
    $data['data'] = false;
  }
  return $data;
}




echo json_encode($return);