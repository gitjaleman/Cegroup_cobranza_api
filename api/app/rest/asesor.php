<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('content-type: application/json; charset=utf-8');
http_response_code(200);

$return=null;

switch ($_SERVER['REQUEST_METHOD']){
  case 'GET':
      $return = SELECT_ASESOR();
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

function SELECT_ASESOR(){
  $data = null;
  $data['prueba']=$_GET['d'];
switch ($_GET['d']) {
  case 'data':
    $cedula = $_GET['c'];
    $data['process'] = 'Select Cedula';
    $data['asesor'] = SELECT_ASESOR_CEDULA($cedula);
    break;
  case 'login':
    $user = $_GET['u'];
    $pass = $_GET['p'];
    $data['process'] = 'Select login';
    $data['asesor'] = SELECT_ASESOR_LOGIN($user,$pass);
    break;
  default:
    $data['process'] = 'Select all';
    $data['asesor'] = SELECT_ASESOR_ALL();
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

// SELECT  CEDULA
function SELECT_ASESOR_CEDULA($cedula){
  $obj = new conn;
  $sql = "SELECT * FROM `asesor` WHERE `cedukla` = '$cedula' ";
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
function SELECT_ASESOR_LOGIN($user,$pass){
  $obj = new conn;
  $sql = "SELECT * FROM `asesor` WHERE `username`= '$user' AND `password` = '$pass' ";
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
// SELECT  ALL
function SELECT_ASESOR_ALL(){
  $obj = new conn;
  $sql = "SELECT * FROM `asesor`";
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