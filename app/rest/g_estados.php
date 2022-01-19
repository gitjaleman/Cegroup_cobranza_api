<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('content-type: application/json; charset=utf-8');
http_response_code(200);

$return=null;

switch ($_SERVER['REQUEST_METHOD']){
  case 'GET':
      $return = SELECT_ESTADOS();
    break;

}

function SELECT_ESTADOS(){
  $data['process'] = 'Select estados';
  $data['estados'] = SELECT_ESTADOS_ALL();
  $data['subs'] = SELECT_ESTADOS_SUBS();
  return $data;
}




///////////////////
//               //
//    SELECT     //
//               //
///////////////////

// SELECT  INIT
function SELECT_ESTADOS_ALL(){
  $obj = new conn;
  $sql = "SELECT * FROM `t_estados`";
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
function SELECT_ESTADOS_SUBS(){
  $obj = new conn;
  $sql = "SELECT * FROM `t_subs`";
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