<?php
set_time_limit(60000000000);
include("../lib/DB.php");
chmod("db.csv", 0777);
$fp = fopen("db.csv", "r");

$num = 1;

function asesor($operacion, $asesor)
{
  $obj = new conn;
  $sql = "INSERT INTO `t_asignacion` (`id`, `operacion`, `asesor`) VALUES (NULL, '$operacion', '$asesor');";
  $r = $obj->query($sql);
  return  $r ? 'OK' : 'ERROR';
}
function campana($operacion, $campana)
{
  $obj = new conn;
  $sql = "INSERT INTO `t_campana` (`id`, `operacion`, `campana`) VALUES (NULL, '$operacion', '$campana');";
  $r = $obj->query($sql);
  return  $r ? 'OK' : 'ERROR';
}
function cartera($operacion, $cartera)
{
  $obj = new conn;
  $sql = "INSERT INTO `t_cartera` (`id`, `operacion`, `cartera`) VALUES (NULL, '$operacion', '$cartera');";
  $r = $obj->query($sql);
  return  $r ? 'OK' : 'ERROR';
}
function decil($operacion, $decil)
{
  $obj = new conn;
  $sql = "INSERT INTO `t_decil` (`id`, `operacion`, `decil`) VALUES (NULL, '$operacion', '$decil');";
  $r = $obj->query($sql);
  return  $r ? 'OK' : 'ERROR';
}
function saldo($operacion, $capital, $total)
{
  $obj = new conn;
  $sql = "INSERT INTO `t_saldos` (`id`, `operacion`, `capital`, `total`) VALUES (NULL, '$operacion', '$capital', '$total');";
  $r = $obj->query($sql);
  return  $r ? 'OK' : 'ERROR';
}

?>


<style>
  th,
  td {
    border: 1px solid #000;
    padding: 2px;
  }
</style>

<table>
  <thead>
    <tr>
      <th>#</th>
      <th>OPERACION</th>
      <th>ASESOR</th>
      <th>CAMPANA</th>
      <th>CARTERA</th>
      <th>DECIL</th>
      <th>SALDOS</th>
    </tr>
  </thead>
  <tbody>

    <?php
    while ($d = fgetcsv($fp, 100000000, ";")) {
      $operacion = $d[0];
      $asesor = mb_strtoupper(utf8_encode($d[1]));
      $campana = mb_strtoupper(utf8_encode($d[2]));
      $cartera = mb_strtoupper(utf8_encode($d[3]));
      $decil = $d[4];
      $capital = $d[5];
      $total = $d[6];

      echo '<tr>';
        echo '<td>'.$num.'</td>';
        echo '<td>'.$operacion.'</td>';
        echo '<td>'.asesor($operacion,$asesor).'</td>';
        echo '<td>'.campana($operacion,$campana).'</td>';
        echo '<td>'.cartera($operacion,$cartera).'</td>';
        echo '<td>'.decil($operacion,$decil).'</td>';
        echo '<td>'.saldo($operacion,$capital,$total).'</td>';
      echo '</tr>';






      $num++;
    }

    ?>


  </tbody>
</table>



<?php



fclose($fp);
?>