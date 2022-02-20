<?php 
set_time_limit(60000000000);
include("../lib/DB.php");
$obj=new conn;
chmod("proceso.csv", 0777);
$fp = fopen("proceso.csv","r");

$num=1;
while ($d=fgetcsv($fp,100000000, ";")){
	$operacion=$d[0];
	$estado=$d[1];
	$sub=$d[2];
	$fgestion=$d[3];
	$asesor=$d[4];

	$sql="INSERT INTO `t_procesos` (`id`, `operacion`, `estado`, `sub`, `fgestion`, `asesor`) 
	VALUES (NULL, '$operacion', '$estado', '$sub', '$fgestion', '$asesor');";
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