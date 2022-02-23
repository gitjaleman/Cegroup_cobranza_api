<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('content-type: application/json; charset=utf-8');
http_response_code(200);

$return=null;

switch ($_SERVER['REQUEST_METHOD']){
  case 'GET':
      $return = SELECT_ASESORES();
    break;
  case 'POST':
    $return = POST_ASESORES();
  break;
}

function SELECT_ASESORES(){
  $t = $_GET['t'];
  switch ($t) {
    case 'all':
      $data['asesores'] = SELECT_ASESORES_ALL();
      break;
    case 'texto':
      $data['asesores'] = SELECT_ASESORES_TEXTO();
      break;
    case 'cedula':
      $data['asesores'] = SELECT_ASESORES_CEDULA();
      break;
    case 'mensaje':
      $data['mensaje'] = SELECT_ASESORES_MENSAJE();
      break;
  }
  return $data;
}


function POST_ASESORES(){
  $t = $_GET['t'];
  switch ($t) {
    case 'insert':
      $data['insert'] = INSERT_ASESOR();
      break;
    case 'update':
      $data['update'] = UPDATE_ASESOR();
      break;
    case 'estado':
      $data['estado'] = ESTADO_ASESOR();
      break;
    case 'delete':
      $data['delete'] = DELETE_ASESOR();
      break;
    case 'mensaje_insert':
      $data['insert'] = INSERT_MENSAJE();
      break;
    case 'mensaje_delete':
      $data['delete'] = DELETE_MENSAJE();
      break;
  }
  return $data;
}



///////////////////
//               //
//    SELECT     //
//               //
///////////////////


function SELECT_ASESORES_ALL(){
  $obj = new conn;
  $sql = "SELECT * FROM `t_usuarios` WHERE `usertype` != 0 ORDER BY `estado` DESC ";
  $con = $obj->query($sql);
  $num = mysqli_num_rows($con);
  $data['sql'] = $sql;
  $data['num'] = $num;
  if ($num >= 1) {
    while ($d = mysqli_fetch_assoc($con)) {
      $data['data'][] =  array_map(CODING, $d);
    }
  } else {
    $data['data'] = FALSE;
    $data['sql'] = $sql;
  }
  return $data;
}

function SELECT_ASESORES_TEXTO(){
  $t = $_GET['v'];
  $obj = new conn;
  $sql = "SELECT * FROM `t_usuarios` WHERE `usertype` != 0 AND `nombre` LIKE '%$t%' ORDER BY `estado` DESC";
  $con = $obj->query($sql);
  $num = mysqli_num_rows($con);
  $data['sql'] = $sql;
  $data['num'] = $num;
  if ($num >= 1) {
    while ($d = mysqli_fetch_assoc($con)) {
      $data['data'][] =  array_map(CODING, $d);
    }
  } else {
    $data['data'] = FALSE;
    $data['sql'] = $sql;
  }
  return $data;
}


function SELECT_ASESORES_CEDULA(){
  $c = $_GET['v'];
  $obj = new conn;
  $sql = "SELECT * FROM `t_usuarios` WHERE `cedula` = '$c' ";
  $con = $obj->query($sql);
  $num = mysqli_num_rows($con);
  $data['sql'] = $sql;
  $data['num'] = $num;
  if ($num >= 1) {
    while ($d = mysqli_fetch_assoc($con)) {
      $data['data'][] =  array_map(CODING, $d);
    }
  } else {
    $data['data'] = FALSE;
    $data['sql'] = $sql;
  }
  return $data;
}




function SELECT_ASESORES_MENSAJE(){
  $a = $_GET['v'];
  $obj = new conn;
  $sql = "SELECT * FROM `t_mensaje` WHERE `asesor` = '$a' ";
  $con = $obj->query($sql);
  $num = mysqli_num_rows($con);
  $data['sql'] = $sql;
  $data['num'] = $num;
  if ($num >= 1) {
    while ($d = mysqli_fetch_assoc($con)) {
      $data['data'][] =  array_map(CODING, $d);
    }
  } else {
    $data['data'] = FALSE;
    $data['sql'] = $sql;
  }
  return $data;
}


///////////////////
//               //
//    INSERT     //
//               //
///////////////////

function INSERT_ASESOR(){
  $cedula     = mb_strtoupper($_POST['cedula']);
  $nombre     = mb_strtoupper($_POST['nombre']);
  $telefono   = mb_strtoupper($_POST['telefono']);
  $avatar     = $_POST['avatar'];
  $username   = mb_strtoupper($_POST['username']);
  $userpass   = md5(0);
  $obj=new conn;
  $sql="INSERT INTO `t_usuarios` (`cedula`, `nombre`, `telefono`, `avatar`, `username`, `userpass`, `usertype`, `posicion`, `estado`) 
  VALUES ('$cedula', '$nombre', '$telefono', '$avatar', '$username', '$userpass', '1', '0', 'TRUE')";
  $result=$obj->query($sql);
  $data['sql']=$sql;
  $data['result']=$result;
  return $data;
}






function INSERT_MENSAJE(){
  $asesor     = mb_strtoupper($_POST['asesor']);
  $mensaje    = format_post($_POST['mensaje']);
  $obj=new conn;
  $sql1 = "DELETE FROM `t_mensaje` WHERE `asesor` = '$asesor' ";
  $sql2 = "INSERT INTO `t_mensaje` (`id`, `asesor`, `mensaje`) VALUES (NULL, '$asesor', '$mensaje');";
  $obj->query($sql1);
  $result=$obj->query($sql2);
  $data['sql']=$sql2;
  $data['result']=$result;
  return $data;
}

function DELETE_MENSAJE(){
  $asesor     = mb_strtoupper($_POST['asesor']);
  $obj=new conn;
  $sql = "DELETE FROM `t_mensaje` WHERE `asesor` = '$asesor' ";
  $result =$obj->query($sql);
  $data['sql']=$sql;
  $data['result']=$result;
  return $data;
}



///////////////////
//               //
//    UPDATE     //
//               //
///////////////////


function UPDATE_ASESOR(){
  $cedula     = mb_strtoupper($_POST['cedula']);
  $nombre     = mb_strtoupper($_POST['nombre']);
  $telefono   = mb_strtoupper($_POST['telefono']);
  $username   = mb_strtoupper($_POST['username']);
  $obj=new conn;
  $sql="UPDATE `t_usuarios` SET 
  `nombre` = '$nombre', 
  `telefono` = '$telefono', 
  `username` = '$username' 
  WHERE `t_usuarios`.`cedula` =  '$cedula' ";
  $result=$obj->query($sql);
  $data['sql']=$sql;
  $data['result']=$result;
  return $data;
}

function ESTADO_ASESOR(){
  $cedula     = mb_strtoupper($_POST['cedula']);
  $estado     = $_POST['estado'];
  $obj=new conn;
  $sql="UPDATE `t_usuarios` SET 
  `estado` = '$estado'
  WHERE `t_usuarios`.`cedula` =  '$cedula' ";
  $result=$obj->query($sql);
  $data['sql']=$sql;
  $data['result']=$result;
  return $data;
}

function DELETE_ASESOR(){
  $cedula     = mb_strtoupper($_POST['cedula']);
  $obj=new conn;
  $sql="DELETE FROM `t_usuarios` WHERE `t_usuarios`.`cedula` =  '$cedula'  ";
  $result=$obj->query($sql);
  $data['sql']=$sql;
  $data['result']=$result;
  return $data;
}


echo json_encode($return);