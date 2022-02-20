<?php
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=acuerdos.xls");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);

	class conn extends mysqli{
		function __construct(){
			parent::__construct("localhost","root_cegroup","Cegroup.2022*","db_cegroup");
			if (mysqli_connect_error()) {
				print("error de conexion");
			}
		}
	}

$obj = new conn;
$sql = "SELECT * FROM `gestion` WHERE `fecha` BETWEEN '2022-02-01' AND '2022-02-28' ";
?>

<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>OPERACION</th>
      <th>NOMBRE</th>
      <th>AGENTE</th>
      <th>FECHA</th>
      <th>HORA</th>
      <th>GESTION</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $con = $obj->query($sql);
    $num = 1;
    while ($d = mysqli_fetch_assoc($con)) {
    ?>
    <tr>
      <th><?php echo $d['id']; ?></th>
      <td><?php echo $d['operacion']; ?></td>
      <td><?php echo $d['nombre']; ?></td>
      <td><?php echo $d['agente'] ?></td>
      <td><?php echo $d['fecha']; ?></td>
      <td><?php echo $d['hora'] ?></td>
      <td><?php echo utf8_decode($d['gestion']); ?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>