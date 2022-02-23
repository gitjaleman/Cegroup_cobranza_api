<?php 
set_time_limit(60000000000);
include("../lib/DB.php");
$obj=new conn;
chmod("asignar.csv", 0777);
$fp = fopen("asignar.csv","r");

$num=1;
while ($d=fgetcsv($fp,100000000, ";")){
	$operacion=$d[0];
	$asesor=$d[1];

	$sql="INSERT INTO `t_asignacion` (`id`, `operacion`, `asesor`) VALUES (NULL, '$operacion', '$asesor');";
	$r=$obj->query($sql);
	if($r){
		echo $num."<br>";
		$num++;
	}else{
	  echo $sql;
	  echo "<br>";
	}

}

fclose($fp);
?>