<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('content-type: application/json; charset=utf-8');
http_response_code(200);

switch ($_SERVER['REQUEST_METHOD']){
  case 'GET':
      $return = SELECT_CLIENTE();
    break;
  case 'POST':
      $return = PROCESS_DATA();
    break;

  case 'PUT':
      $return = UPDATE_CLIENTE();
    break;

  case 'DELETE':
      $return = DELETE_CLIENTE();
    break;
}

function SELECT_CLIENTE(){
  if (isset($_GET['c'])) {
    $cedula = $_GET['c'];
    $data['process'] = 'Select Cédula';
    $data['clientes'] = SELECT_CLIENTE_CEDULA($cedula);
  } else {
    $data['process'] = 'Select All';
    $data['clientes'] = SELECT_CLIENTE_ALL();
  }
  return $data;
}

function SELECT_CLIENTE_ALL(){
  $obj = new conn;
  $sql = "SELECT * FROM `clientes`";
  $con = $obj->query($sql);
  $num = mysqli_num_rows($con);
  $data['num'] = $num;
  if ($num >= 1) {
    while ($d = mysqli_fetch_assoc($con)) {
      $data['data'][] = array_map(null, $d);
    }
  } else {
    $data['data'] = FALSE;
  }
  return $data;
}

function SELECT_CLIENTE_CEDULA($cedula){
  $obj = new conn;
  $sql = "SELECT * FROM `clientes` WHERE `cedula` = '$cedula' ";
  $con = $obj->query($sql);
  $num = mysqli_num_rows($con);
  $data['num'] = $num;
  $data['sql'] = $sql;
  if ($num >= 1) {
    while ($d = mysqli_fetch_assoc($con)) {
      $data['data'][] = array_map(null, $d);
    }
  } else {
    $data['data'] = FALSE;
  }
  return $data;
}

function PROCESS_DATA(){
  if (isset($_GET['f'])) {
    $data['process'] = 'update file cliente';
    $data['clientes'] = UPDATE_FILE_CLIENTE();
  } else {
    $data['process'] = 'insert cliente';
    $data['clientes'] = INSERT_CLIENTE();
  }
  return $data;
}

function INSERT_CLIENTE(){
  $cedula     = mb_strtoupper($_POST['cedula']);
  $nombre     = mb_strtoupper($_POST['nombre']);
  $telefono   = mb_strtoupper($_POST['telefono']);
  $correo     = mb_strtoupper($_POST['correo']);
  $direccion  = mb_strtoupper($_POST['direccion']);
  $obj=new conn;
  $sql="INSERT INTO `clientes` (`cedula`,  `nombre`, `telefono`, `correo`,  `direccion`) 
  VALUES ('$cedula', '$nombre', '$telefono', '$correo',  '$direccion');";
  $result=$obj->query($sql);
  SAVE_FILE($cedula);
  $data['sql']=$sql;
  $data['result']=$result;
  return $data;
}

function UPDATE_CLIENTE(){
  $put_data = array();
  get_data_put($put_data);
  $cedula=$put_data['cedula'];
  $nombre=$put_data['nombre'];
  $telefono=$put_data['telefono'];
  $correo=$put_data['correo'];
  $direccion=$put_data['direccion'];
  $cedula     = mb_strtoupper($cedula);
  $nombre     = mb_strtoupper($nombre);
  $telefono   = mb_strtoupper($telefono);
  $correo     = mb_strtoupper($correo);
  $direccion  = mb_strtoupper($direccion);
  $obj=new conn;
  $sql="UPDATE `clientes` SET 
  `nombre` = '$nombre', 
  `telefono` = '$telefono', 
  `correo` = '$correo', 
  `direccion` = '$direccion'
   WHERE `clientes`.`cedula` = '$cedula'";
  $result=$obj->query($sql);
  $data['update']='data_cliente';
  $data['sql']=$sql;
  $data['result']=$result;
  return $data;
}

function UPDATE_FILE_CLIENTE(){
  $cedula     = mb_strtoupper($_POST['cedula']);
  SAVE_FILE($cedula);
  $data['update']='file_cliente';
  return $data;
}

function DELETE_CLIENTE(){
  $cedula  = mb_strtoupper($_GET['c']);
  $obj=new conn;
  $sql="DELETE FROM `clientes` WHERE `clientes`.`cedula` = '$cedula' ";
  $result=$obj->query($sql);
  $data['sql']=$sql;
  $data['result']=$result;
  return $data;
}

function SAVE_FILE($cedula){
  move_uploaded_file($_FILES['file']['tmp_name'], 'file/'.$cedula.'.pdf');
}

echo json_encode($return);