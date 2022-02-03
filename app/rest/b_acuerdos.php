<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('content-type: application/json; charset=utf-8');
http_response_code(200);

$return=null;

switch ($_SERVER['REQUEST_METHOD']){
  case 'GET':
      $return = SELECT_ACUERDOS();
    break;
}

function SELECT_ACUERDOS(){
 $t = $_GET['t'];
 $v =  mb_strtoupper($_GET['v']);
 $a =  mb_strtoupper($_GET['a']);
  switch ($t) {
    case 'o':
      $data['acuerdos'] = SELECT_ACUERDOS_OPERACION($v,$a);
      break;
    case 'm':
      $data['acuerdos'] = SELECT_ACUERDOS_MES($v,$a);
      break;
    case 'f':
      $data['acuerdos'] = SELECT_ACUERDOS_FECHA($v,$a);
      break;
  }
  return $data;
}




///////////////////
//               //
//    SELECT     //
//               //
///////////////////


function SELECT_ACUERDOS_OPERACION($v,$a){
  $obj = new conn;
  $sql = "SELECT * FROM `t_acuerdos` WHERE `operacion` =  '$v' AND  `asesor` = '$a' AND  `estado` = 'activo'
  ORDER BY `facuerdo` DESC ";
  $con = $obj->query($sql);
  $num = mysqli_num_rows($con);
  $data['sql'] = $sql;
  $data['num'] = $num;
  if ($num >= 1) {
    while ($d = mysqli_fetch_assoc($con)) {
      $data['data'][] =  array_map(CODING, $d);
    }
  } else {
    $data['data'] = FALSE;
    $data['sql'] = $sql;
  }
  return $data;
}

function SELECT_ACUERDOS_MES($v,$a){
  $f1 = '2022-'.$v.'-01';
  $f2 = '2022-'.$v.'-31';
  $obj = new conn;
  $sql = "SELECT * FROM `t_acuerdos`  WHERE `facuerdo` BETWEEN '$f1' AND '$f2' AND  `asesor` = '$a' AND  `estado` = 'activo' 
  ORDER BY `facuerdo` DESC";
  $con = $obj->query($sql);
  $num = mysqli_num_rows($con);
  $data['num'] = $num;
  $data['sql'] = $sql;
  if ($num >= 1) {
    while ($d = mysqli_fetch_assoc($con)) {
      $data['data'][] =  array_map(CODING, $d);
    }
  } else {
    $data['data'] = FALSE;
    $data['sql'] = $sql;
  }
  return $data;
}

function SELECT_ACUERDOS_FECHA($v,$a){
  $obj = new conn;
  $sql = "SELECT * FROM `t_acuerdos` WHERE `facuerdo` =  '$v' AND  `asesor` = '$a' AND  `estado` = 'activo' ";
  $con = $obj->query($sql);
  $num = mysqli_num_rows($con);
  $data['num'] = $num;
  $data['sql'] = $sql;
  if ($num >= 1) {
    while ($d = mysqli_fetch_assoc($con)) {
      $data['data'][] =  array_map(CODING, $d);
    }
  } else {
    $data['data'] = FALSE;
    $data['sql'] = $sql;
  }
  return $data;
}




echo json_encode($return);