<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('content-type: application/json; charset=utf-8');
http_response_code(200);

$return=null;

switch ($_SERVER['REQUEST_METHOD']){
  case 'GET':
      $return = SELECT_GESTION();
    break;
  case 'POST':
      $return = INSERT_GESTION();
    break;

}

function SELECT_GESTION(){
  $operacion = $_GET['o'];
  switch ($_GET['p']) {
    case 'init':
      $data['process'] = 'Select gestion init';
      $data['gestion'] = SELECT_GESTION_INIT($operacion);
      break;
    case 'all':
      $data['process'] = 'Select gestion all';
      $data['gestion'] = SELECT_GESTION_ALL($operacion);
      break;
  }
  return $data;
}





///////////////////
//               //
//    SELECT     //
//               //
///////////////////

// SELECT  INIT
function SELECT_GESTION_INIT($operacion){
  $obj = new conn;
  $sql = "SELECT * FROM `t_gestiones` 
  WHERE `t_gestiones`.`operacion` = '$operacion' 
  ORDER BY  `t_gestiones`.`id` DESC 
  LIMIT 3 ";
  $con = $obj->query($sql);
  $num = mysqli_num_rows($con);
  $data['num'] = $num;
  if ($num >= 1) {
    while ($d = mysqli_fetch_assoc($con)) {
      $data['data'][] =  $d;
    }
  } else {
    $data['data'] = false;
  }
  return $data;
}
// SELECT  ALL
function SELECT_GESTION_ALL($operacion){
  $obj = new conn;
  $sql = "SELECT * FROM `t_gestiones` 
  WHERE `t_gestiones`.`operacion` = '$operacion' 
  ORDER BY  `t_gestiones`.`id` DESC ";
  $con = $obj->query($sql);
  $num = mysqli_num_rows($con);
  $data['num'] = $num;
  if ($num >= 1) {
    while ($d = mysqli_fetch_assoc($con)) {
      $data['data'][] = $d;
    }
  } else {
    $data['data'] = false;
  }
  return $data;
}


///////////////////
//               //
//    INSERT     //
//               //
///////////////////

// INSERT  
function INSERT_GESTION(){
  date_default_timezone_set('America/Bogota');
  $fecha = date('Ymd');
  $hora = date('h:i:s A');
  $gestion =  mb_strtoupper($_POST['gestion']);
  $operacion =  mb_strtoupper($_POST['operacion']);
  $nombre =  mb_strtoupper($_POST['nombre']);
  $asesor =  mb_strtoupper($_POST['asesor']);
  $obj = new conn;
  $sql = "INSERT INTO `t_gestiones` 
  (`id`, `operacion`, `asesor`,`nombre`, `fecha`, `hora`, `gestion`) 
  VALUES 
  (NULL, '$operacion', '$asesor', '$nombre', '$fecha', '$hora', '$gestion')";
  $con = $obj->query($sql);

  if ($con) {
    $data['data'] = true;
    $sql2 = "UPDATE `t_procesos` SET `fgestion` = '$fecha' ,  `asesor` = '$asesor' 
    WHERE `t_procesos`.`operacion` =  '$operacion' ";
    $obj->query($sql2);
  } else {
    $data['data'] = $sql;
  }
  return $data;
}




echo json_encode($return);