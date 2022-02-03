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
    $return = INSERT_TELEFONO();
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
   WHERE  `t_telefonos`.`operacion` = '$operacion' ORDER BY `t_telefonos`.`id` DESC";
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


///////////////////
//               //
//    INSERT     //
//               //
///////////////////


function INSERT_TELEFONO(){
  $operacion =  mb_strtoupper($_POST['operacion']);
  $asesor =  mb_strtoupper($_POST['asesor']);
  $telefono =  mb_strtoupper($_POST['telefono']);
  $detalle =  format_post($_POST['detalle']);
  $obj = new conn;
  $sql = "INSERT INTO `t_telefonos` 
  (`id`, `operacion`, `asesor`,`telefono`, `detalle`) 
  VALUES 
  (NULL, '$operacion', '$asesor', '$telefono', '$detalle')";
  $con = $obj->query($sql);

  if ($con) {
    $data['data'] = true;
  } else {
    $data['data'] = $sql;
  }
  return $data;
}





echo json_encode($return);
