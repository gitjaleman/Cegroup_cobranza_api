<?php 
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=GESTION.xls");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);

function  INIT(){
  switch ($_GET['t']) {
    case 'asesor':
      $result =  SELECT_ASESOR();
      break;
    case 'fecha':
      $result =  SELECT_FECHA();
      break;
    case 'rango':
      $result =  SELECT_RANGO();
      break;
  }
  return $result;
}

function  SELECT_ASESOR(){
  $asesor = $_GET['a'];
  if($asesor=='all'){
    $sql="SELECT * FROM `t_gestiones`";
  }else{
    $sql="SELECT * FROM `t_gestiones` WHERE `asesor` = '$asesor' ";
  }
  $result = EJECUTE_CONSULT($sql);
  return $result;
}

function  SELECT_FECHA(){
  $asesor = $_GET['a'];
  $fecha = $_GET['f'];
  if($asesor=='all'){
    $sql="SELECT * FROM `t_gestiones` WHERE `fecha` = '$fecha'";
  }else{
    $sql="SELECT * FROM `t_gestiones` WHERE `asesor` = '$asesor' AND  `fecha` = '$fecha' ";
  }
  $result = EJECUTE_CONSULT($sql);
  return $result;
}

function  SELECT_RANGO(){
  $asesor = $_GET['a'];
  $f1 = $_GET['f1'];
  $f2 = $_GET['f2'];
  if($asesor=='all'){
    $sql="SELECT * FROM `t_gestiones` WHERE `fecha`   BETWEEN '$f1' AND '$f2'";
  }else{
    $sql="SELECT * FROM `t_gestiones` WHERE `asesor` = '$asesor' AND  `fecha`   BETWEEN '$f1' AND '$f2' ORDER BY  `fecha` DESC";
  }
  $result = EJECUTE_CONSULT($sql);
  return $result;
}

function  EJECUTE_CONSULT($sql){
  include("../../../../lib/DB.php");
  $obj = new conn;
  $result = $obj->query($sql);
  return $result;
}

?>
<style>
  th,
  td {
    border: 1px solid;
  }
</style>
<table>
  <thead>
    <tr>
      <th>#</th>
      <th>OPERACION</th>
      <th>ASESOR</th>
      <th>NOMBRE</th>
      <th>FECHA</th>
      <th>HORA</th>
      <th>GESTION</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $result = INIT();
      $num = 1;
      while ($d = mysqli_fetch_assoc($result)) {
    ?>
    <tr>
      <th><?php echo $num; ?></th>
      <td><?php echo $d['operacion']; ?></td>
      <td><?php echo $d['asesor']; ?></td>
      <td><?php echo $d['nombre']; ?></td>
      <td><?php echo $d['fecha']; ?></td>
      <td><?php echo $d['hora']; ?></td>
      <td><?php echo utf8_decode($d['gestion']); ?></td>
    </tr>
    <?php $num++; }  ?>
  </tbody>
</table>