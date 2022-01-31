<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('content-type: application/json; charset=utf-8');
http_response_code(200);

$return = null;

switch ($_SERVER['REQUEST_METHOD']) {
  case 'GET':
    $return = SELECT_RESUMEN();
    break;

}

function SELECT_RESUMEN()
{
  $operacion = $_GET['o'];
  $data['process'] = 'Select resumen';
  $data['resumen'] = SELECT_RESUMEN_OPERACION($operacion);
  return $data;
}




///////////////////
//               //
//    SELECT     //
//               //
///////////////////


function SELECT_RESUMEN_OPERACION($operacion)
{
  $obj = new conn;
  $sql = "SELECT * FROM `t_resumen`
  WHERE `t_resumen`.`operacion` = '$operacion' ORDER BY `t_resumen`.`id` DESC";
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
