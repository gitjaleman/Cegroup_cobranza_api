<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('content-type: application/json; charset=utf-8');
http_response_code(200);

$return=null;

switch ($_SERVER['REQUEST_METHOD']){
  case 'GET':
      $return = SELECT_ALERTAS();
    break;

}

function SELECT_ALERTAS(){
  $operacion = $_GET['o'];
  $data['process'] = 'Select alertas';
  $data['alertas'] = SELECT_ALERTAS_OPERACION($operacion);
  return $data;
}




///////////////////
//               //
//    SELECT     //
//               //
///////////////////


function SELECT_ALERTAS_OPERACION($operacion){
  $obj = new conn;
  $sql = "SELECT * FROM `t_alertas` 
  WHERE `t_alertas`.`operacion` = '$operacion'";
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







echo json_encode($return);