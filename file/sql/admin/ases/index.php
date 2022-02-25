<?php
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=asesores.xls");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);
include("../../../lib/DB.php");
$obj = new conn;
$sql = 'SELECT * FROM `t_usuarios` WHERE `usertype` != 0';
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
      <th><?php echo utf8_decode('CÉDULA'); ?></th>
      <th>NOMBRE</th>
      <th>TELÉFONO</th>
      <th>USUARIO</th>
      <th>ESTADO</th>
      <th><?php echo utf8_decode('POSICIÓN'); ?></th>
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
      <td><?php echo $d['cedula']; ?></td>
      <td><?php echo $d['nombre']; ?></td>
      <td><?php echo $d['telefono']; ?></td>
      <td><?php echo $d['username']; ?></td>
      <td><?php echo $d['estado']; ?></td>
      <td><?php echo $d['posicion']; ?></td>
    </tr>
    <?php
    $num++;
    }
    ?>
  </tbody>
</table>