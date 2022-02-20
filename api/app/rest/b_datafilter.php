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
  switch ($t) {
    case 'null':
      $data['data'] = SELECT_DATA_ASESOR();
      break;
    case 'estado':
      $data['data'] = SELECT_DATA_ESTADO();
      break;
    case 'cartera':
      $data['data'] = SELECT_DATA_CARTERA();
      break;
    case 'campana':
      $data['data'] = SELECT_DATA_CAMPANA();
      break;
  }
  return $data;
}



///////////////////
//               //
//    SELECT     //
//               //
///////////////////
function SELECT_DATA_ASESOR(){
  $a = $_GET['a'];
  date_default_timezone_set('America/Bogota');
  $hoy = date('Ymd');
  $obj = new conn;

  $sql = "SELECT  `t_procesos`.`estado`, `t_procesos`.`sub`, `t_procesos`.`fgestion`, `t_procesos`.`operacion`, `t_asignacion`.`asesor` FROM `t_procesos` INNER JOIN `t_asignacion` ON `t_asignacion`.`operacion` = `t_procesos`.`operacion` WHERE `t_asignacion`.`asesor` = '$a' AND `t_procesos`.`fgestion` != '$hoy'  ORDER BY `t_procesos`.`fgestion` ASC LIMIT 20";
  $con = $obj->query($sql);
  $num = mysqli_num_rows($con);
  $data['sql'] = $sql;
  $data['num'] = $num;
  $data['tipo'] = 'asesor';
  if ($num >= 1) {
    while ($d = mysqli_fetch_assoc($con)) {
      $data['data'][] = array_map(CODING, $d);
    }
  } else {
    $data['data'] = FALSE;
  }
  return $data;
}



function SELECT_DATA_ESTADO(){
  $e = $_GET['e'];
  $s = $_GET['s'];
  $a = $_GET['a'];
  date_default_timezone_set('America/Bogota');
  $hoy = date('Ymd');
  $obj = new conn;
  $sql = "SELECT  `t_procesos`.`estado`, `t_procesos`.`sub`, `t_procesos`.`fgestion`, `t_procesos`.`operacion`, `t_asignacion`.`asesor` FROM `t_procesos` INNER JOIN `t_asignacion` ON `t_asignacion`.`operacion` = `t_procesos`.`operacion` WHERE `t_asignacion`.`asesor` = '$a' AND `t_procesos`.`estado` = '$e' AND `t_procesos`.`sub` = '$s' AND `t_procesos`.`fgestion` != '$hoy' ORDER BY `t_procesos`.`fgestion` ASC ";
  $con = $obj->query($sql);
  $num = mysqli_num_rows($con);
  $data['num'] = $num;
  $data['sql'] = $sql;
  $data['tipo'] = 'estado';
  if ($num >= 1) {
    while ($d = mysqli_fetch_assoc($con)) {
      $data['data'][] = array_map(CODING, $d);
    }
  } else {
    $data['data'] = FALSE;
  }
  return $data;
}



function SELECT_DATA_CARTERA(){
  $c = $_GET['c'];
  $a = $_GET['a'];
  date_default_timezone_set('America/Bogota');
  $hoy = date('Ymd');
  $obj = new conn;
  $sql = "SELECT `t_procesos`.`estado`, `t_procesos`.`sub`, `t_procesos`.`fgestion`, `t_procesos`.`operacion`, `t_asignacion`.`asesor`,`t_cartera`.`cartera` FROM `t_procesos` INNER JOIN `t_asignacion` ON `t_asignacion`.`operacion` = `t_procesos`.`operacion` INNER JOIN `t_cartera` ON `t_cartera`.`operacion` = `t_procesos`.`operacion` WHERE `t_asignacion`.`asesor` = '$a' AND `t_cartera`.`cartera` = '$c' AND `t_procesos`.`fgestion` != '$hoy' ORDER BY `t_procesos`.`fgestion` ASC ";
  $con = $obj->query($sql);
  $num = mysqli_num_rows($con);
  $data['num'] = $num;
  $data['sql'] = $sql;
  $data['tipo'] = 'cartera';
  if ($num >= 1) {
    while ($d = mysqli_fetch_assoc($con)) {
      $data['data'][] = array_map(CODING, $d);
    }
  } else {
    $data['data'] = FALSE;
  }
  return $data;
}



function SELECT_DATA_CAMPANA(){
  $c = $_GET['c'];
  $a = $_GET['a'];
  date_default_timezone_set('America/Bogota');
  $hoy = date('Ymd');
  $obj = new conn;
  $sql = "SELECT `t_procesos`.`estado`, `t_procesos`.`sub`, `t_procesos`.`fgestion`, `t_procesos`.`operacion`, `t_asignacion`.`asesor`,`t_campana`.`campana` FROM `t_procesos` INNER JOIN `t_asignacion` ON `t_asignacion`.`operacion` = `t_procesos`.`operacion` INNER JOIN `t_campana` ON `t_campana`.`operacion` = `t_procesos`.`operacion`WHERE `t_asignacion`.`asesor` = '$a' AND `t_campana`.`campana` = '$c' AND `t_procesos`.`fgestion` != '$hoy' ORDER BY `t_procesos`.`fgestion` ASC ";
  $con = $obj->query($sql);
  $num = mysqli_num_rows($con);
  $data['num'] = $num;
  $data['sql'] = $sql;
  $data['tipo'] = 'campana';
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