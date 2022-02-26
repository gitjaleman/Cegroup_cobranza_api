<?php 
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=ACUERDOS.xls");
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
    $sql="SELECT * FROM `t_acuerdos`";
  }else{
    $sql="SELECT * FROM `t_acuerdos` WHERE `asesor` = '$asesor' ";
  }
  $result = EJECUTE_CONSULT($sql);
  return $result;
}

function  SELECT_FECHA(){
  $asesor = $_GET['a'];
  $fecha = $_GET['f'];
  if($asesor=='all'){
    $sql="SELECT * FROM `t_acuerdos` WHERE `facuerdo` = '$fecha'";
  }else{
    $sql="SELECT * FROM `t_acuerdos` WHERE `asesor` = '$asesor' AND  `facuerdo` = '$fecha'  ";
  }
  $result = EJECUTE_CONSULT($sql);
  return $result;
}

function  SELECT_RANGO(){
  $asesor = $_GET['a'];
  $f1 = $_GET['f1'];
  $f2 = $_GET['f2'];
  if($asesor=='all'){
    $sql="SELECT * FROM `t_acuerdos` WHERE `facuerdo`   BETWEEN '$f1' AND '$f2'";
  }else{
    $sql="SELECT * FROM `t_acuerdos` WHERE `asesor` = '$asesor' AND  `facuerdo`   BETWEEN '$f1' AND '$f2' ORDER BY  `facuerdo` DESC";
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
      <th>CLIENTE</th>
      <th>NOMBRE</th>
      <th>FECHA ACUERDO</th>
      <th>FECHA REGISTRO</th>
      <th>ASESOR</th>
      <th>VALOR</th>
      <th>ESTADO</th>
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
      <td><?php echo $d['cliente']; ?></td>
      <td><?php echo utf8_decode($d['nombre']); ?></td>
      <td><?php echo $d['facuerdo']; ?></td>
      <td><?php echo $d['fregistro']; ?></td>
      <td><?php echo $d['asesor']; ?></td>
      <td><?php echo $d['valor']; ?></td>
      <td><?php echo $d['estado']; ?></td>
    </tr>
    <?php $num++; }  ?>
  </tbody>
</table>