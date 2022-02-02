<?php
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=acuerdos.xls");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);
include("../../../lib/DB.php");
$obj = new conn;
$sql = $_GET['sql'];
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
      <th><?php echo utf8_decode('OPERACIÓN'); ?></th>
      <th>CLIENTE</th>
      <th>NOMBRE</th>
      <th>F_ACUERDO</th>
      <th>F_REGISTRO</th>
      <th>VALOR</th>
      <th>ESTADO</th>
      <th>ASESOR</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $con = $obj->query($sql);
    $num = 1;
    while ($d = mysqli_fetch_assoc($con)) {
    ?>
    <tr>
      <th><?php echo $num; ?></th>
      <td><?php echo $d['operacion']; ?></td>
      <td><?php echo $d['cliente']; ?></td>
      <td><?php echo utf8_decode($d['nombre']); ?></td>
      <td><?php echo $d['facuerdo']; ?></td>
      <td><?php echo $d['fregistro']; ?></td>
      <td><?php echo '$ '.number_format($d['valor'], 0, ',', '.'); ?></td>
      <td><?php echo $d['estado']; ?></td>
      <td><?php echo $d['asesor']; ?></td>
    </tr>
    <?php
    $num++;
    }
    ?>
  </tbody>
</table>