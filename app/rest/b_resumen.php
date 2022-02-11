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
  $v = $_GET['v'];
  $a = $_GET['a'];
  $f1 = '2022-'.$v.'-01';
  $f2 = '2022-'.$v.'-31';
  $data['gestiones'] = PROCESS_DATA_GESTIONES($a,$f1,$f2);
  $data['acuerdos'] = PROCESS_DATA_ACUERDOS($a,$f1,$f2);
  $data['pagos'] = PROCESS_DATA_PAGOS($a,$f1,$f2);
  $data['resumen'] = PROCESS_DATA_RESUMEN($a,$f1,$f2);
  $data['base'] = PROCESS_DATA_BASE($a);
  $data['posicion'] = PROCESS_DATA_POSICION($a);
  return $data;
}


function PROCESS_DATA_GESTIONES($a,$f1,$f2){
  $obj = new conn;
  $sql = "SELECT `id` FROM `t_gestiones` WHERE `asesor` = '$a' AND `fecha` BETWEEN '$f1' AND '$f2' ";
  $con = $obj->query($sql);
  $num = mysqli_num_rows($con);
  $data['sql'] = $sql;
  $data['num'] = $num;
  return $data;
}


function PROCESS_DATA_ACUERDOS($a,$f1,$f2){
  $obj = new conn;
  $sql = "SELECT `id` FROM `t_acuerdos` WHERE `asesor` = '$a' AND `fregistro` BETWEEN '$f1' AND '$f2' ";
  $con = $obj->query($sql);
  $num = mysqli_num_rows($con);
  $data['sql'] = $sql;
  $data['num'] = $num;
  return $data;
}


function PROCESS_DATA_PAGOS($a,$f1,$f2){
  $obj = new conn;
  $sql = "SELECT SUM(pago) AS `pagos` FROM `t_pagos` WHERE `asesor` = '$a' AND `fecha` BETWEEN '$f1' AND '$f2' ";
  $con = $obj->query($sql);
  $num = mysqli_num_rows($con);
  $d = mysqli_fetch_assoc($con);
  if($d['pagos']>=1) {
    $pagos = $d['pagos'];
  } else {
    $pagos = 0;
  }
  
  $data['sql'] = $sql;
  $data['num'] = $num;
  $data['pagos'] = $pagos;
  return $data;
}

function PROCESS_DATA_RESUMEN($a,$f1,$f2){
  $obj = new conn;
  $sql = "SELECT `id` FROM `t_resumen` WHERE `asesor` = '$a' AND `fregistro` BETWEEN '$f1' AND '$f2' ";
  $con = $obj->query($sql);
  $num = mysqli_num_rows($con);
  $data['sql'] = $sql;
  $data['num'] = $num;
  return $data;
}

function PROCESS_DATA_BASE($a){
  $obj = new conn;
  $sql = "SELECT * FROM `t_asignacion`  WHERE `asesor` = '$a' ";
  $con = $obj->query($sql);
  $num = mysqli_num_rows($con);
  $data['sql'] = $sql;
  $data['num'] = $num;
  return $data;
}

function PROCESS_DATA_POSICION($a){
  $obj = new conn;
  $sql = "SELECT `posicion` FROM `t_usuarios`  WHERE `username` = '$a' ";
  $con = $obj->query($sql);
  $num = mysqli_num_rows($con);
  $d = mysqli_fetch_assoc($con);
  $data['sql'] = $sql;
  $data['num'] = $num;
  $data['posicion'] = $d['posicion'];
  return $data;
}

echo json_encode($return);