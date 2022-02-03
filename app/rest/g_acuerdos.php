<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('content-type: application/json; charset=utf-8');
http_response_code(200);

$return = null;

switch ($_SERVER['REQUEST_METHOD']) {
  case 'GET':
    $return = SELECT_ACUERDOS();
    break;
  case 'POST':
    $return = INSERT_ACUERDOS();
    break;
}

function SELECT_ACUERDOS()
{
  $operacion = $_GET['o'];
  $data['process'] = 'Select acuerdos';
  $data['acuerdos'] = SELECT_ACUERDOS_OPERACION($operacion);
  return $data;
}




///////////////////
//               //
//    SELECT     //
//               //
///////////////////


function SELECT_ACUERDOS_OPERACION($operacion)
{
  $obj = new conn;
  $sql = "SELECT * FROM `t_acuerdos` 
  WHERE `t_acuerdos`.`operacion` = '$operacion' ORDER BY `t_acuerdos`.`facuerdo` DESC";
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


function INSERT_ACUERDOS(){
  date_default_timezone_set('America/Bogota');
  $fecha_registro = date('Ymd');
  $fecha_pago =  mb_strtoupper($_POST['fecha_pago']);
  $tipo_cliente =  mb_strtoupper($_POST['tipo_cliente']);
  $nombre_cliente =  format_post($_POST['nombre_cliente']);
  $valor =  mb_strtoupper($_POST['valor']);
  $operacion =  mb_strtoupper($_POST['operacion']);
  $asesor =  mb_strtoupper($_POST['asesor']);
  $obj = new conn;
  $sql = "INSERT INTO `t_acuerdos` (`id`, `operacion`, `cliente`, `nombre`, `facuerdo`, `fregistro`, `asesor`, `estado`, `valor`) 
  VALUES (NULL, '$operacion', '$tipo_cliente', 
  '$nombre_cliente', '$fecha_pago', '$fecha_registro', '$asesor', 'activo', '$valor');";
  $con = $obj->query($sql);

  if ($con) {
    $data['data'] = true;
  } else {
    $data['data'] = $sql;
  }
  return $data;
}





echo json_encode($return);
