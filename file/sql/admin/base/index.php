<?php 
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=BASE.xls");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);

function  INIT(){
  $asesor = $_GET['a'];
  $sql = "SELECT 
  `t_base`.`operacion`, 
  `t_base`.`cuenta`, 
  `t_base`.`tcedula`, 
  `t_base`.`tnombre`, 
  `t_base`.`ttel1`, 
  `t_base`.`ttel2`, 
  `t_base`.`ccedula`, 
  `t_base`.`cnombre`, 
  `t_base`.`ctel1`, 
  `t_base`.`ctel2`, 
  `t_base`.`gcedula`, 
  `t_base`.`gnombre`, 
  `t_base`.`gtel1`, 
  `t_base`.`gtel2`, 
  `t_base`.`fvencimiento`, 
  `t_base`.`fingreso`, 
  `t_base`.`sucursal`, 
  `t_base`.`dependencia`, 
  `t_base`.`condicion`, 
  `t_asignacion`.`asesor`,
  `t_campana`.`campana`,
  `t_cartera`.`cartera`,
  `t_decil`.`decil`,
  `t_procesos`.`estado`,
  `t_procesos`.`sub`,
  `t_procesos`.`fgestion`,
  `t_saldos`.`capital`,
  `t_saldos`.`total` 

  FROM `t_base` 
  INNER JOIN `t_asignacion` ON `t_asignacion`.`operacion` = `t_base`.`operacion`
  INNER JOIN `t_campana` ON `t_campana`.`operacion` = `t_base`.`operacion`
  INNER JOIN `t_cartera` ON `t_cartera`.`operacion` = `t_base`.`operacion`
  INNER JOIN `t_decil` ON `t_decil`.`operacion` = `t_base`.`operacion`
  INNER JOIN `t_procesos` ON `t_procesos`.`operacion` = `t_base`.`operacion`
  INNER JOIN `t_saldos` ON `t_saldos`.`operacion` = `t_base`.`operacion`
  WHERE `t_asignacion`.`asesor` = '$asesor'
  ";
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
      <th>CUENTA</th>
      <th>T CEDULA</th>
      <th>T NOMBRE</th>
      <th>T TEL1</th>
      <th>T TEL2</th>
      <th>C CEDULA</th>
      <th>C NOMBRE</th>
      <th>C TEL1</th>
      <th>C TEL2</th>
      <th>G CEDULA</th>
      <th>G NOMBRE</th>
      <th>G TEL1</th>
      <th>G TEL2</th>
      <th>F VENCIMIENTO</th>
      <th>F INGRESO</th>
      <th>SUCURSAL</th>
      <th>DEPENDENCIA</th>
      <th>CONDICION</th>
      <th>ASESOR</th>
      <th>CAMPANA</th>
      <th>CARTERA</th>
      <th>DECIL</th>
      <th>ESTADO</th>
      <th>SUB</th>
      <th>F GESTION</th>
      <th>CAPITAL</th>
      <th>TOTAL</th>
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
      <td><?php echo $d['cuenta']; ?></td>
      <td><?php echo $d['tcedula']; ?></td>
      <td><?php echo utf8_decode($d['tnombre']); ?></td>
      <td><?php echo $d['ttel1']; ?></td>
      <td><?php echo $d['ttel2']; ?></td>
      <td><?php echo $d['ccedula']; ?></td>
      <td><?php echo utf8_decode($d['cnombre']); ?></td>
      <td><?php echo $d['ctel1']; ?></td>
      <td><?php echo $d['ctel2']; ?></td>
      <td><?php echo $d['gcedula']; ?></td>
      <td><?php echo utf8_decode($d['gnombre']); ?></td>
      <td><?php echo $d['gtel1']; ?></td>
      <td><?php echo $d['gtel2']; ?></td>
      <td><?php echo $d['fvencimiento']; ?></td>
      <td><?php echo $d['fingreso']; ?></td>
      <td><?php echo $d['sucursal']; ?></td>
      <td><?php echo $d['dependencia']; ?></td>
      <td><?php echo $d['condicion']; ?></td>
      <td><?php echo $d['asesor']; ?></td>
      <td><?php echo $d['campana']; ?></td>
      <td><?php echo $d['cartera']; ?></td>
      <td><?php echo $d['decil']; ?></td>
      <td><?php echo $d['estado']; ?></td>
      <td><?php echo $d['sub']; ?></td>
      <td><?php echo $d['fgestion']; ?></td>
      <td><?php echo $d['capital']; ?></td>
      <td><?php echo $d['total']; ?></td>
    </tr>
    <?php $num++; }  ?>
  </tbody>
</table>