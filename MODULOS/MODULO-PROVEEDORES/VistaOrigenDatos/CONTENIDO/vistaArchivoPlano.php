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
	<link rel="stylesheet" href="../CSS/Origen.css">
	<link rel="stylesheet" href="../CSS/animacionCarga.css">
	<link rel="stylesheet" href="../CSS/estilos-btnLaterales.css">
	<link rel="stylesheet" href="../CSS/estilos-descarga-archivoplano.css">
</head>
<body>
	<div class="cont-body">
		<div class="cont-nav">
			<div id="sub-cont-nav1" class="sub-cont-nav">
				<img src="../IMG/Logo.ico" style=" width: auto; height: 80%;">
			</div>
			<div id="sub-cont-nav2" class="sub-cont-nav">
				<?php 
					if ($resultado && mysqli_num_rows($resultado) > 0) {
				        while ($datos = mysqli_fetch_object($resultado)) {
				            echo "<span> Bienvenida " .$datos->nombre . "</span>";
				        }
				    } else {
				        echo "<span>Invitado</span>";
				    }
				?>
			</div>
			<div id="sub-cont-nav3" class="sub-cont-nav">
				<div class="cont-btn-nav3">
					<a href="./PHP/cerrarSesion.php">Cerrar Sesión</a>	
				</div>
			</div>
		</div>
		<div class="cont-ubi-elementos-principales">
			<nav class="nav-lateral">
				<div id="spaces">
					<span>Modulo Proveedores</span>
				</div>
				<div id="cont-menu">
					 <div class="sidebar">
				        <a id="op-main"  onclick="showMenu('menu1')" style="cursor: pointer;"> <span class="material-symbols-outlined">menu_open</span>Operaciones</a>
				        <div id="menu1" class="submenu">
				            <a href="../Origen.php"> <span id="ico" class="material-symbols-outlined">home</span> <span id="txt">Home</span> </a>
				            <a href="#"> <span id="ico" class="material-symbols-outlined">history</span><span id="txt">Historico</span> </a>
				        </div>
				    </div>
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
      function showMenu(menuId) {
         var menu = document.getElementById(menuId);
         var links = menu.querySelectorAll('a');

         if (menu.classList.contains('show')) {
            menu.classList.remove('show');
            links.forEach((link, index) => {
               link.style.transitionDelay = '0s';
            });
            setTimeout(() => {
               menu.style.display = 'none';
            }, 500);
         } else {
            menu.style.display = 'block';
            setTimeout(() => {
               menu.classList.add('show');
               links.forEach((link, index) => {
                  link.style.transitionDelay = `${index * 0.2}s`;
               });
            }, 0);
         }
      }
    </script>
</body>
</html>