<?php
	class conn extends mysqli{
		function __construct(){
			parent::__construct("localhost","root","","db_cegroup");
			//parent::__construct("localhost","user_cegroup","Password.2022","data_cegroup"); 
			if (mysqli_connect_error()) {
				print("error de conexion");
			}
		}
	}
?>