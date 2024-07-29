<?php
	session_start();
	include('./PHP/conexion.php');

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
	<link rel="stylesheet" href="./CSS/estilos-index.css">
	<link rel="stylesheet" href="./CSS/animacionCarga.css">
	<link rel="stylesheet" href="./CSS/estilos-btnLaterales.css">
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
				            <a href="./CONTENIDO/vistaArchivoPlano.php"> <span id="ico" class="material-symbols-outlined">description</span> <span id="txt">Archivo Plano</span> </a>
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
					<div class="cont-filtro-importe">
						<div id="cont-filtro1" class="cont-filtros-consulta">
							<form action="./PHP/importar.php" method="post" enctype="multipart/form-data">
								<label class="btn-form-importar" for="adjuntar" class="file-label">Adjuntar</label>
    							<input type="file" id="adjuntar" name="adjuntar" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required style="display: none;">
    							<input class="btn-form-importar" type="submit" value="Importar">
							</form>
						</div>
						<div id="cont-filtro2" class="cont-filtros-consulta">
							<form action="" method="post">
								<span>Fecha Causión</span>
								<input class="datos-a-consultar" name="fechaCausacion" type="date">
								<input class="buttom-consultar" name="consultar" type="submit" value="Consultar">
								<div id="div-btn-clean">
									<a href="Origen.php" id="limpiar-tabla" ><span class="material-symbols-outlined">mop</span></a>
								</div>

							</form>
						</div>
					</div>
					<div class="cont-tabla-resultado">
						<table>
							<thead class="titulo-tabla-resultado">
								<tr class="fila-titulo-resultado">
									<th id="id" class="consulta-Resultado-Datos">ID</th>
								    <th id="dato1" class="consulta-Resultado-Datos">EMPRESA</th>
								    <th id="dato2" class="consulta-Resultado-Datos">CONCEPTO-PROYECCION</th>
								    <th id="dato3" class="consulta-Resultado-Datos">C-COSTO</th>
								    <th id="dato4" class="consulta-Resultado-Datos">EPS</th>
								    <th id="dato5" class="consulta-Resultado-Datos">FECHA-CAUSACION</th>
								    <th id="dato6" class="consulta-Resultado-Datos">FECHA-PROGRAMACION</th>
								    <th id="dato7" class="consulta-Resultado-Datos">MES-DE-PROGRAMACION</th>
								    <th id="dato8" class="consulta-Resultado-Datos">MES-DEL-SERV</th>
								    <th id="dato9" class="consulta-Resultado-Datos">N°FAC-CC</th>
								    <th id="dato10" class="consulta-Resultado-Datos">REFERENCIA</th>
								    <th id="dato11" class="consulta-Resultado-Datos">CONCEPTO</th>
								    <th id="dato12" class="consulta-Resultado-Datos">SUBCONCEPTO</th>
								    <th id="dato13" class="consulta-Resultado-Datos">TIPO-DOC</th>
								    <th id="dato14" class="consulta-Resultado-Datos">N°-DOC-BENEFICIARIO-CUENTA-BANCARIA</th>
								    <th id="dato15" class="consulta-Resultado-Datos">NOMBRE-DE-TERCERO</th>
								    <th id="dato16" class="consulta-Resultado-Datos">OBSERVACION-O-DETALLE-DEL-MOVIMIENTO</th>
								    <th id="dato17" class="consulta-Resultado-Datos">PLACA</th>
								    <th id="dato18" class="consulta-Resultado-Datos">RUTA</th>
								    <th id="dato19" class="consulta-Resultado-Datos">FECHA-DEBITO-AUTO</th>
								    <th id="dato20" class="consulta-Resultado-Datos">VALOR-BASE</th>
								    <th id="dato21" class="consulta-Resultado-Datos">IVA</th>
								    <th id="dato22" class="consulta-Resultado-Datos">SOBRETASA</th>
								    <th id="dato23" class="consulta-Resultado-Datos">VALOR-TOTAL</th>
								    <th id="dato24" class="consulta-Resultado-Datos">CONCEPTO-DE-RETENCIÓN</th>
								    <th id="dato25" class="consulta-Resultado-Datos">BASE-MÍNIMA-EN-PESOS</th>
								    <th id="dato26" class="consulta-Resultado-Datos">%-RETE</th>
								    <th id="dato27" class="consulta-Resultado-Datos">VALOR-RETE</th>
								    <th id="dato28" class="consulta-Resultado-Datos">VALOR-NETO</th>
								    <th id="dato29" class="consulta-Resultado-Datos">ANTICIPO</th>
								    <th id="dato30" class="consulta-Resultado-Datos">ABONO</th>
								    <th id="dato31" class="consulta-Resultado-Datos">DESCUENTO</th>
								    <th id="dato32" class="consulta-Resultado-Datos">VALOR-A-PAGAR</th>
								    <th id="dato33" class="consulta-Resultado-Datos">FECHA-PAGO</th>
								    <th id="dato34" class="consulta-Resultado-Datos">VALOR-PAGAGO</th>
								    <th id="dato35" class="consulta-Resultado-Datos">OBSERVACION</th>
								    <th id="dato36" class="consulta-Resultado-Datos">CONSUMO-SEMANAL</th>
								    <th id="dato37" class="consulta-Resultado-Datos">CSC-REFERENCIA</th>
								</tr>
							</thead>
							<tbody>
								<?php
									if ($_SERVER["REQUEST_METHOD"] == "POST") {
									    if (!empty($_POST['estadoSelect']) || !empty($_POST['fechaCausacion'])) {
									        
									        include("./PHP/conexion.php");
									        $FechaCausacion = mysqli_real_escape_string($conn, $_POST['fechaCausacion']);
									        $query = "SELECT * FROM tablaproveedores WHERE fechacausacion = '$FechaCausacion'";
									        $resultado = mysqli_query($conn, $query);
									        
									        if ($resultado && mysqli_num_rows($resultado) > 0) {
									            while ($datos = mysqli_fetch_object($resultado)) {
									                echo "<tr class='tb-resultado-datos'>";
									                echo "<th id='id' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->id) . "</th>";
									                echo "<th id='dato2' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->empresa) . "</th>";
									                echo "<th id='dato3' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->conceptoproyeccion) . "</th>";
									                echo "<th id='dato4' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->ccosto) . "</th>";
									                echo "<th id='dato5' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->eps) . "</th>";
									                echo "<th id='dato6' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->fechacausacion) . "</th>";
									                echo "<th id='dato7' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->fechaprogramacion) . "</th>";
									                echo "<th id='dato8' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->mesdeprogramacion) . "</th>";
									                echo "<th id='dato9' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->mesdelserv) . "</th>";
									                echo "<th id='dato10' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->nfaccc) . "</th>";
									                echo "<th id='dato11' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->referencia) . "</th>";
									                echo "<th id='dato12' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->concepto) . "</th>";
									                echo "<th id='dato13' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->subconcepto) . "</th>";
									                echo "<th id='dato14' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->tipodoc) . "</th>";
									                echo "<th id='dato15' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->ndocbeneficiariocuentabancaria) . "</th>";
									                echo "<th id='dato16' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->nombredetercero) . "</th>";
									                echo "<th id='dato17' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->observacionodetalledelmovimiento) . "</th>";
									                echo "<th id='dato18' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->placa) . "</th>";
									                echo "<th id='dato19' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->ruta) . "</th>";
									                echo "<th id='dato20' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->fechadebitoauto) . "</th>";
									                echo "<th id='dato21' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->valorbase) . "</th>";
									                echo "<th id='dato22' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->iva) . "</th>";
									                echo "<th id='dato23' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->sobretasa) . "</th>";
									                echo "<th id='dato24' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->valortotal) . "</th>";
									                echo "<th id='dato25' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->conceptoderetencion) . "</th>";
									                echo "<th id='dato26' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->baseminimaenpesos) . "</th>";
									                echo "<th id='dato27' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->porcrete) . "</th>";
									                echo "<th id='dato28' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->valorrete) . "</th>";
									                echo "<th id='dato29' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->valorneto) . "</th>";
									                echo "<th id='dato30' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->anticipo) . "</th>";
									                echo "<th id='dato31' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->abono) . "</th>";
									                echo "<th id='dato32' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->descuento) . "</th>";
									                echo "<th id='dato33' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->valorapagar) . "</th>";
									                echo "<th id='dato34' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->fechapago) . "</th>";
									                echo "<th id='dato35' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->valorpagado) . "</th>";
									                echo "<th id='dato36' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->observacion) . "</th>";
									                echo "<th id='dato37' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->consumosemanal) . "</th>";
									                echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->cscreferencia) . "</th>";
									                echo "</tr>";
									            }
									        } else {
									            ?>
									            <div id="sms-nohayregistros">
									                <div id="elementos-sms">
									                    <div id="span"><span>No se encontraron Registros</span></div>
									                    <div id="btn"><a href="Origen.php">Cerrar</a></div>
									                </div>
									            </div>
									            <?php
									        }
									        
									        mysqli_close($conn);
									    } else {
									        ?>
									        <div id="sms-nohayregistros">
									            <div id="elementos-sms">
									                <div id="span"><span>Complete los campos a consultar</span></div>
									                <div id="btn"><a href="Origen.php">Cerrar</a></div>
									            </div>
									        </div>
									        <?php
									    }
									}
								?>
							</tbody>
						</table>
					</div>
				</div>	
			</div>
		</div>
	</div>
	<div id="contenedor_carg">
		<div id="carga"></div>
	</div>
    <script src="JS/animacionCarga.js"></script>

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