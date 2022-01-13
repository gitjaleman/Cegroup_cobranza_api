<?php 
set_time_limit(60000000000);
include("../lib/DB.php");
$obj=new conn;
chmod("BASE.csv", 0777);
$fp = fopen("BASE.csv","r");

$num=1;
while ($d=fgetcsv($fp,100000000, ";")){
	$operacion=$d[0];
	$cuenta=$d[1];
     
  $tcedula=$d[2];
	$tnombre=mb_strtoupper(utf8_encode($d[3]));
	$ttel1=$d[4];
	$ttel2=$d[5];

	$ccedula=$d[6];
	$cnombre=mb_strtoupper(utf8_encode($d[7]));
	$ctel1=$d[8];
	$ctel2=$d[9];

	$gcedula=$d[10];
	$gnombre=mb_strtoupper(utf8_encode($d[11]));
	$gtel1=$d[12];
	$gtel2=$d[13];

	$fvencimiento=$d[14];
	$fingreso=$d[15];
	$sucursal=$d[16];
	$dependencia=$d[17];
	$condicion=$d[18];



	$sql="INSERT INTO `t_base` (`operacion`, `cuenta`, `tcedula`, `tnombre`, `ttel1`, `ttel2`, `ccedula`, `cnombre`, `ctel1`, `ctel2`, `gcedula`, `gnombre`, `gtel1`, `gtel2`, `fvencimiento`, `fingreso`, `sucursal`, `dependencia`, `condicion`) 
	VALUES (
	'$operacion', '$cuenta', 
	'$tcedula', '$tnombre', '$ttel1', '$ttel2', 
	'$ccedula', '$cnombre', '$ctel1', '$ctel2',
	'$gcedula', '$gnombre', '$gtel1', '$gtel2',
	'$fvencimiento', '$fingreso', '$sucursal', '$dependencia', '$condicion');";
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