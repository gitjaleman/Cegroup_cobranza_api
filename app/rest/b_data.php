<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('content-type: application/json; charset=utf-8');
http_response_code(200);

$return=null;

switch ($_SERVER['REQUEST_METHOD']){
  case 'GET':
      $return = SELECT_DATA();
    break;
}

function SELECT_DATA(){
 $t = $_GET['t'];
 $v =  mb_strtoupper($_GET['v']);
  switch ($t) {
    case 'o':
      $data['operacion'] = SELECT_DATA_OPERACION($v);
      break;
    default:
      $data['result'] = SELECT_DATA_all($t,$v);
      break;
  }
  return $data;
}

function SELECT_DATA_all($t,$v){
  $data['titular'] = SELECT_DATA_TITULAR($t,$v);
  $data['codeudor'] = SELECT_DATA_CODEUDOR($t,$v);
  $data['garante'] = SELECT_DATA_GARANTE($t,$v);
  return $data;
}



///////////////////
//               //
//    SELECT     //
//               //
///////////////////


function SELECT_DATA_OPERACION($v){
  $obj = new conn;
  $sql = "SELECT * FROM `t_base` WHERE `operacion` =  '$v' ";
  $con = $obj->query($sql);
  $num = mysqli_num_rows($con);
  $data['num'] = $num;
  if ($num >= 1) {
    while ($d = mysqli_fetch_assoc($con)) {
      $data['data'][] =  $d;
    }
  } else {
    $data['data'] = FALSE;
    $data['sql'] = $sql;
  }
  
  return $data;
}

function SELECT_DATA_TITULAR($t,$v){
  $obj = new conn;
  switch ($t) {
    case 'c':
      $sql = "SELECT * FROM `t_base` WHERE `tcedula` = '$v' ";
      break;
    case 'n':
      $sql = "SELECT * FROM `t_base` WHERE `tnombre` LIKE '%$v%' ORDER BY `tnombre` ASC";
      break;
  }
  $con = $obj->query($sql);
  $num = mysqli_num_rows($con);
  $data['num'] = $num;
  if ($num >= 1) {
    while ($d = mysqli_fetch_assoc($con)) {
      $data['data'][] =  $d;
    }
  } else {
    $data['data'] = FALSE;
    $data['sql'] = $sql;
  }
  
  return $data;
}

function SELECT_DATA_CODEUDOR($t,$v){
  $obj = new conn;
  switch ($t) {
    case 'c':
      $sql = "SELECT * FROM `t_base` WHERE `ccedula` = '$v'";
      break;
    case 'n':
      $sql = "SELECT * FROM `t_base` WHERE `cnombre` LIKE '%$v%' ORDER BY `cnombre` ASC ";
      break;
  }
  $con = $obj->query($sql);
  $num = mysqli_num_rows($con);
  $data['num'] = $num;
  if ($num >= 1) {
    while ($d = mysqli_fetch_assoc($con)) {
      $data['data'][] =  $d;
    }
  } else {
    $data['data'] = FALSE;
    $data['sql'] = $sql;
  }
  
  return $data;
}

function SELECT_DATA_GARANTE($t,$v){
  $obj = new conn;
  switch ($t) {
    case 'c':
      $sql = "SELECT * FROM `t_base` WHERE `gcedula` = '$v' ";
      break;
    case 'n':
      $sql = "SELECT * FROM `t_base` WHERE `gnombre` LIKE '%$v%' ORDER BY `gnombre` ASC";
      break;
  }
  $con = $obj->query($sql);
  $num = mysqli_num_rows($con);
  $data['num'] = $num;
  if ($num >= 1) {
    while ($d = mysqli_fetch_assoc($con)) {
      $data['data'][] =  $d;
    }
  } else {
    $data['data'] = FALSE;
    $data['sql'] = $sql;
  }
  
  return $data;
}







echo json_encode($return);