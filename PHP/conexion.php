<?php 
	$servidor = 'localhost';
	$user = 'root';
	$pass = '';
	$bd = 'pre-financiera-proveedores';
	$conn = new mysqli($servidor, $user, $pass, $bd);

	if ($conn->conect_error) {
		die("Conexión fallida: " . $conn->connect_error);
	}

 ?>