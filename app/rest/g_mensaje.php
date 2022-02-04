<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('content-type: application/json; charset=utf-8');
http_response_code(200);

$return=null;

switch ($_SERVER['REQUEST_METHOD']){
  case 'GET':
      $return = SELECT_MENSAJE();
    break;

}





///////////////////
//               //
//    SELECT     //
//               //
///////////////////


function SELECT_MENSAJE(){
  $a = $_GET['a'];
  $obj = new conn;
  $sql = "SELECT * FROM `t_mensaje` WHERE `asesor` = '$a'";
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






echo json_encode($return);