<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('content-type: application/json; charset=utf-8');
http_response_code(200);

$return=null;

switch ($_SERVER['REQUEST_METHOD']){
  case 'GET':
      $return = SELECT_APORTES();
    break;

}

function SELECT_APORTES(){
  $operacion = $_GET['o'];
  $data['process'] = 'Select aportes';
  $data['aportes'] = SELECT_APORTES_OPERACION($operacion);
  $data['suma'] = SUM_APORTES_OPERACION($operacion);
  


  return $data;
}




///////////////////
//               //
//    SELECT     //
//               //
///////////////////

// SELECT  INIT
function SELECT_APORTES_OPERACION($operacion){
  $obj = new conn;
  $sql = "SELECT * FROM `t_pagos` 
  WHERE `t_pagos`.`operacion` = '$operacion'";
  $con = $obj->query($sql);
  $num = mysqli_num_rows($con);
  $data['num'] = $num;
  if ($num >= 1) {
    while ($d = mysqli_fetch_assoc($con)) {
      $data['data'][] =  $d;
    }
  } else {
    $data['data'] = FALSE;
  }
  return $data;
}
// SELECT  ALL
function SUM_APORTES_OPERACION($operacion){
  $obj = new conn;
  $sql = "SELECT SUM(`pago`) as 'aporte_total' FROM `t_pagos` 
  WHERE `t_pagos`.`operacion` = '$operacion' ";
  $con = $obj->query($sql);
  $num = mysqli_num_rows($con);
  $data['num'] = $num;
  if ($num >= 1) {
    while ($d = mysqli_fetch_assoc($con)) {
      $data['data'][] = $d;
    }
  } else {
    $data['data'] = 0;
  }
  return $data;
}








echo json_encode($return);