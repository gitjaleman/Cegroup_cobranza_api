<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('content-type: application/json; charset=utf-8');
http_response_code(200);

$return = null;

switch ($_SERVER['REQUEST_METHOD']) {
  case 'GET':
    $return = SELECT_TELEFONO();
    break;
  case 'POST':
    $return = null;
    break;

  case 'PUT':
    $return = null;
    break;

  case 'DELETE':
    $return = null;
    break;
}

function SELECT_TELEFONO()
{
  $operacion = $_GET['o'];
  $data['process'] = 'Select Telefono';
  $data['telefonos'] = SELECT_TELEFONOS_DATA($operacion);
  return $data;
}





///////////////////
//               //
//    SELECT     //
//               //
///////////////////

function SELECT_TELEFONOS_DATA($operacion)
{
  $obj = new conn;
  $sql = "SELECT * FROM `t_telefonos`

   WHERE  `t_telefonos`.`operacion` = '$operacion'";
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
