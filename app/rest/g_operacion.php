<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('content-type: application/json; charset=utf-8');
http_response_code(200);

$return = null;

switch ($_SERVER['REQUEST_METHOD']) {
  case 'GET':
    $return = SELECT_OPERACION();
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

function SELECT_OPERACION()
{
  $operacion = $_GET['o'];
  $data['process'] = 'Select Operacion';
  $data['operacion'] = SELECT_OPERACION_DATA($operacion);
  return $data;
}





///////////////////
//               //
//    SELECT     //
//               //
///////////////////

function SELECT_OPERACION_DATA($operacion)
{
  $obj = new conn;
  $sql = "SELECT 
  `t_base`.`operacion`, 
  `t_base`.`cuenta`, 
  `t_base`.`tcedula`, 
  `t_base`.`tnombre`, 
  `t_base`.`ttel1`, 
  `t_base`.`ttel2`, 
  `t_base`.`ccedula`, 
  `t_base`.`cnombre`, 
  `t_base`.`ctel1`, 
  `t_base`.`ctel2`, 
  `t_base`.`gcedula`, 
  `t_base`.`gnombre`, 
  `t_base`.`gtel1`, 
  `t_base`.`gtel2`, 
  `t_base`.`fvencimiento`, 
  `t_base`.`fingreso`, 
  `t_base`.`sucursal`, 
  `t_base`.`dependencia`, 
  `t_base`.`condicion`, 
  `t_asignacion`.`asesor`,
  `t_campana`.`campana`,
  `t_cartera`.`cartera`,
  `t_decil`.`decil`,
  `t_procesos`.`estado`,
  `t_procesos`.`sub`,
  `t_procesos`.`fgestion`,
  `t_saldos`.`capital`,
  `t_saldos`.`total` 

  FROM `t_base` 
  INNER JOIN `t_asignacion` ON `t_asignacion`.`operacion` = `t_base`.`operacion`
  INNER JOIN `t_campana` ON `t_campana`.`operacion` = `t_base`.`operacion`
  INNER JOIN `t_cartera` ON `t_cartera`.`operacion` = `t_base`.`operacion`
  INNER JOIN `t_decil` ON `t_decil`.`operacion` = `t_base`.`operacion`
  INNER JOIN `t_procesos` ON `t_procesos`.`operacion` = `t_base`.`operacion`
  INNER JOIN `t_saldos` ON `t_saldos`.`operacion` = `t_base`.`operacion`
   WHERE `t_base`.`operacion` = '$operacion'";
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
