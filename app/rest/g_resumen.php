<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('content-type: application/json; charset=utf-8');
http_response_code(200);

$return=null;

switch ($_SERVER['REQUEST_METHOD']){
  case 'GET':
      $return = SELECT_RESUMEN();
    break;
  case 'POST':
      $return = INSERT_RESUMEN();
    break;

}

function SELECT_RESUMEN(){
  $operacion = $_GET['o'];
  switch ($_GET['p']) {
    case 'init':
      $data['process'] = 'Select resumen init';
      $data['resumen'] = SELECT_RESUMEN_INIT($operacion);
      break;
    case 'all':
      $data['process'] = 'Select resumen all';
      $data['resumen'] = SELECT_RESUMEN_ALL($operacion);
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
function SELECT_RESUMEN_INIT($operacion){
  $obj = new conn;
  $sql = "SELECT * FROM `t_resumen`
  WHERE `t_resumen`.`operacion` = '$operacion' ORDER BY `t_resumen`.`id` DESC
  LIMIT 3";
  $con = $obj->query($sql);
  $num = mysqli_num_rows($con);
  $data['num'] = $num;
  if ($num >= 1) {
    while ($d = mysqli_fetch_assoc($con)) {
      $data['data'][] =  array_map(CODING, $d);
    }
  } else {
    $data['data'] = false;
  }
  return $data;
}
// SELECT  ALL
function SELECT_RESUMEN_ALL($operacion){
  $obj = new conn;
  $sql = "SELECT * FROM `t_resumen`
  WHERE `t_resumen`.`operacion` = '$operacion' ORDER BY `t_resumen`.`id` DESC";
  $con = $obj->query($sql);
  $num = mysqli_num_rows($con);
  $data['num'] = $num;
  if ($num >= 1) {
    while ($d = mysqli_fetch_assoc($con)) {
      $data['data'][] = array_map(CODING, $d);
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
function INSERT_RESUMEN(){
  date_default_timezone_set('America/Bogota');
  $fingreso =  mb_strtoupper($_POST['fingreso']);
  $cedula =  mb_strtoupper($_POST['cedula']);
  $nombre =  format_post($_POST['nombre']);
  $operacion =  mb_strtoupper($_POST['operacion']);
  $tipo =  mb_strtoupper($_POST['tipo']);
  $canal =  mb_strtoupper($_POST['canal']);
  $telefono =  mb_strtoupper($_POST['telefono']);
  $contacto =  mb_strtoupper($_POST['contacto']);
  $acuerdo =  mb_strtoupper($_POST['acuerdo']);
  $ncuotas =  mb_strtoupper($_POST['ncuotas']);
  $vcredito =  mb_strtoupper($_POST['vcredito']);
  $vnegociado =  mb_strtoupper($_POST['vnegociado']);
  $condonado =  mb_strtoupper($_POST['condonado']);
  $asesor =  mb_strtoupper($_POST['asesor']);
  $fregistro = date('Ymd');
  $obj = new conn;
  $sql = "INSERT INTO `t_resumen` (`id`, `fingreso`,  `cedula`,  `nombre`,  `operacion`,  `tipo`,  `canal`,  `telefono`,  `contacto`,  `acuerdo`,  `ncuotas`,  `vcredito`,  `vnegociado`,  `condonado`,  `asesor`,  `fregistro`) 
  VALUES                        (NULL,  '$fingreso', '$cedula', '$nombre', '$operacion', '$tipo', '$canal', '$telefono', '$contacto', '$acuerdo', '$ncuotas', '$vcredito', '$vnegociado', '$condonado', '$asesor', '$fregistro');";
  $con = $obj->query($sql);

  if ($con) {
    $data['data'] = true;
  } else {
    $data['data'] = $sql;
  }
  return $data;
}




echo json_encode($return);



























