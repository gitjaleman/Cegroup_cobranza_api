<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('content-type: application/json; charset=utf-8');
http_response_code(200);

$return=null;

switch ($_SERVER['REQUEST_METHOD']){
  case 'GET':
      $return = SELECT_ESTADOS();
    break;
}

function SELECT_ESTADOS(){
  $a = $_GET['a'];
  date_default_timezone_set('America/Bogota');
  $f = date('Ymd');

  $data['gestiones'] = SELECT_DATA_GESTIONES($a,$f);
  $data['acuerdos'] = SELECT_DATA_ACUERDOS($a,$f);
  return $data;
}




///////////////////
//               //
//    SELECT     //
//               //
///////////////////




function SELECT_DATA_GESTIONES($a,$f){
  $obj = new conn;
  $sql = "SELECT `id` FROM `t_gestiones` WHERE `asesor` = '$a' AND  `fecha` = '$f' ";
  $con = $obj->query($sql);
  $num = mysqli_num_rows($con);
  $data['num'] = $num;
  if ($num >= 1) {
    while ($d = mysqli_fetch_assoc($con)) {
      $data['data'][] = array_map(CODING, $d);
    }
  } else {
    $data['data'] = FALSE;
  }
  return $data;
}



function SELECT_DATA_ACUERDOS($a,$f){
  $obj = new conn;
  $sql = "SELECT `id` FROM `t_acuerdos` WHERE `asesor` = '$a' AND  `fregistro` = '$f' ";
  $con = $obj->query($sql);
  $num = mysqli_num_rows($con);
  $data['num'] = $num;
  if ($num >= 1) {
    while ($d = mysqli_fetch_assoc($con)) {
      $data['data'][] = array_map(CODING, $d);
    }
  } else {
    $data['data'] = FALSE;
  }
  return $data;
}




echo json_encode($return);