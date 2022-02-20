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
  case 'POST':
      $return = INSERT_ALERTA();
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
  WHERE `t_alertas`.`operacion` = '$operacion' ORDER BY `t_alertas`.`fecha` DESC";
  $con = $obj->query($sql);
  $num = mysqli_num_rows($con);
  $data['num'] = $num;
  if ($num >= 1) {
    while ($d = mysqli_fetch_assoc($con)) {
      $data['data'][] =  array_map(CODING, $d);
    }
  } else {
    $data['data'] = FALSE;
  }
  return $data;
}



function INSERT_ALERTA(){
  $fecha =  mb_strtoupper($_POST['fecha']);
  $num =  mb_strtoupper($_POST['num']);
  $detalle =  format_post($_POST['detalle']);
  $operacion =  mb_strtoupper($_POST['operacion']);
  $asesor =  mb_strtoupper($_POST['asesor']);
  switch ($num) {
    case '08':
      $hora = '08:00 AM';
      break;
    case '09':
      $hora = '09:00 AM';
      break;
    case '10':
      $hora = '10:00 AM';
      break;
    case '11':
      $hora = '11:00 AM';
      break;
    case '12':
      $hora = '12:00 MM';
      break;
    case '13':
      $hora = '01:00 PM';
      break;
    case '14':
      $hora = '02:00 PM';
      break;
    case '15':
      $hora = '03:00 PM';
      break;
    case '16':
      $hora = '04:00 PM';
      break;
    case '17':
      $hora = '05:00 PM';
      break;
    case '18':
      $hora = '06:00 PM';
      break;
  }
  
  $obj = new conn;
  $sql = "INSERT INTO `t_alertas` (`id`, `operacion`, `asesor`, `fecha`, `hora`, `num`, `alerta`) 
  VALUES (NULL, '$operacion', '$asesor', '$fecha', '$hora', '$num','$detalle');";
  $con = $obj->query($sql);
  if ($con) {
    $data['data'] = true;
  } else {
    $data['data'] = $sql;
  }
  return $data;
}



echo json_encode($return);