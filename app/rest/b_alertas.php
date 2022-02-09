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
  $t = $_GET['t'];
   switch ($t) {
      case 'all':
        $data['data'] = SELECT_ALERTAS_ALL();
        break;
      case 'operacion':
        $data['data'] = SELECT_ALERTAS_OPERACION();
        break;
      case 'fecha':
        $data['data'] = SELECT_ALERTAS_FECHA();
        break;
      case 'hoy':
        $data['data'] = SELECT_ALERTAS_HOY();
        break;

   }
   return $data;
 }




///////////////////
//               //
//    SELECT     //
//               //
///////////////////
function SELECT_ALERTAS_ALL(){
  $a = $_GET['a'];
  $obj = new conn;
  $sql = "SELECT * FROM `t_alertas` WHERE `asesor` = '$a' ORDER BY `fecha` ASC , `num`";
  $con = $obj->query($sql);
  $num = mysqli_num_rows($con);
  $data['sql'] = $sql;
  $data['num'] = $num;
  if ($num >= 1) {
    while ($d = mysqli_fetch_assoc($con)) {
      $data['data'][] = array_map(CODING, $d);
    }
  } else {
    $data['data'] = FALSE;
  }
  return $data;
}



function SELECT_ALERTAS_OPERACION(){
  $a = $_GET['a'];
  $o = $_GET['o'];
  $obj = new conn;
  $sql = "SELECT * FROM `t_alertas` WHERE `asesor` = '$a' AND `operacion` = '$o' ORDER BY `fecha` ASC , `num`";
  $con = $obj->query($sql);
  $num = mysqli_num_rows($con);
  $data['sql'] = $sql;
  $data['num'] = $num;
  if ($num >= 1) {
    while ($d = mysqli_fetch_assoc($con)) {
      $data['data'][] = array_map(CODING, $d);
    }
  } else {
    $data['data'] = FALSE;
  }
  return $data;
}



function SELECT_ALERTAS_FECHA(){
  $a = $_GET['a'];
  $f = $_GET['f'];
  $obj = new conn;
  $sql = "SELECT * FROM `t_alertas` WHERE `asesor` = '$a' AND `fecha` = '$f'  ";
  $con = $obj->query($sql);
  $num = mysqli_num_rows($con);
  $data['sql'] = $sql;
  $data['num'] = $num;
  if ($num >= 1) {
    while ($d = mysqli_fetch_assoc($con)) {
      $data['data'][] = array_map(CODING, $d);
    }
  } else {
    $data['data'] = FALSE;
  }
  return $data;
}

function SELECT_ALERTAS_HOY(){
  $a = $_GET['a'];
  $h = $_GET['h'];
  date_default_timezone_set('America/Bogota');
  $f = date('Ymd');

  $obj = new conn;
  $sql = "SELECT * FROM `t_alertas` WHERE `asesor`='$a' AND `fecha`<'$f' 
  UNION 
  SELECT * FROM `t_alertas` WHERE `asesor`='$a' AND `fecha` = '$f' AND `num` <= '$h' ORDER BY `fecha` ASC , `num`";
  $con = $obj->query($sql);
  $num = mysqli_num_rows($con);
  $data['sql'] = $sql;
  $data['num'] = $num;
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