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
      $return = INSERT_ASESOR();
    break;

  case 'PUT':
      $return = UPDATE_ASESOR();
    break;

  case 'DELETE':
      $return = DELETE_ASESOR();
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

function INSERT_ASESOR(){
  $data = null;
  return $data;
}

function UPDATE_ASESOR(){
  $data = null;
  return $data;
}

function DELETE_ASESOR(){
  $data = null;
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
  ORDER BY  `t_gestiones`.`fecha` DESC 
  LIMIT 3 ";
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
function SELECT_GESTION_ALL($operacion){
  $obj = new conn;
  $sql = "SELECT * FROM `t_gestiones` 
  WHERE `t_gestiones`.`operacion` = '$operacion' 
  ORDER BY  `t_gestiones`.`fecha` DESC ";
  $con = $obj->query($sql);
  $num = mysqli_num_rows($con);
  $data['num'] = $num;
  if ($num >= 1) {
    while ($d = mysqli_fetch_assoc($con)) {
      $data['data'][] = $d;
    }
  } else {
    $data['data'] = FALSE;
  }
  return $data;
}








echo json_encode($return);