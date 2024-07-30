<?php
	session_start();
	include('../PHP/conexion.php');

	if (!isset($_SESSION['usuario'])) {
	    header("Location: ../../../INICIO-DE-SESION/index.html");
	    exit;
	}

	$usuario = $_SESSION['usuario'];
	$sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
	$resultado = mysqli_query($conn, $sql);

	if (!$resultado) {
    	die('Error en la consulta: ' . mysqli_error($conn));
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Dashboard</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
	<link rel="stylesheet" href="../CSS/estilos-index.css">
	<link rel="stylesheet" href="../CSS/animacionCarga.css">
	<link rel="stylesheet" href="../CSS/estilos-btnLaterales.css">
	<link rel="stylesheet" href="../CSS/estilos-descarga-archivoplano.css">
</head>
<body>
	<div class="cont-body">
		<div class="cont-nav">
			<div id="sub-cont-nav1" class="sub-cont-nav">

			</div>
			<div id="sub-cont-nav2" class="sub-cont-nav">
				<span>Portal Financiero</span>
			</div>
			<div id="sub-cont-nav3" class="sub-cont-nav">
				<div class="cont-btn-nav3">
					<a href="#"><span class="material-symbols-outlined">settings</span></a>
					<a href="./PHP/cerrarSesion.php">Cerrar Sesión</a>	
				</div>
			</div>
		</div>
		<div class="cont-ubi-elementos-principales">
			<nav class="nav-lateral">
				<div id="spaces">
					<?php 
						if ($resultado && mysqli_num_rows($resultado) > 0) {
				            while ($datos = mysqli_fetch_object($resultado)) {
				            echo "<span>" .$datos->usuario. " " .$datos->nombre . "</span>";
				            }
				        } else {
				            echo "<span>Invitado</span>";
				        }
					?>
				</div>
				<div id="cont-menu">
					 <div class="sidebar">
				        <a id="op-main"  onclick="toggleMenu('menu1')" style="cursor: pointer;"> <span class="material-symbols-outlined">menu_open</span>Operaciones</a>
				        <div id="menu1" class="submenu">
				            <a href="../Origen.php"> <span id="ico" class="material-symbols-outlined">home</span> <span id="txt">Home</span> </a>
				            <a href="#"> <span id="ico" class="material-symbols-outlined">history</span><span id="txt">Historico</span> </a>
				        </div>
				    </div>
				</div>
				<div>
					<img src="https://lottie.host/18b6f466-25e0-444b-9943-bf29a5989483/dCZV5TKBH1.json" alt="">
				</div>
			</nav>
			<div class="cont-datos">
				<div class="ubi-tabla-datos">
					<div class="cont-form-flat-file">
						<div id="cont-legend">
							<div id="cont-span">
								<span>Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto.</span>
							</div>
						</div>
						<div id="cont-form">
							<form action="../PHP/pruebaFlatFile.php" method="post">
								<div class="cont-element">
									 <div class="cont-label-select">
									 	<span>Fecha Inicial</span>
									 	<input type="date" name="fechai"></iput>
									 	<span>Fecha Final</span>
									 	<input type="date" name="fechaf"></iput>
									 </div>
									 <div class="cont-label-input">
									 	<span>Nombre del Archivo</span>
									 	<input name="name-flatfile" type="text" placeholder="FileName">
									 </div>
									 <div class="cont-btn-download">
										<input name="btn-download" type="submit" id="donwload-flat-ile" value="Download">
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>	
			</div>
		</div>
	</div>
	<div id="contenedor_carg">
		<div id="carga"></div>
	</div>
    <script src="../JS/animacionCarga.js"></script>

    <script>
        function toggleMenu(menuId) {
            var menu = document.getElementById(menuId);
            if (menu.style.display === 'block') {
                menu.style.display = 'none';
            } else {
                menu.style.display = 'block';
            }
        }
    </script>
</body>
</html>