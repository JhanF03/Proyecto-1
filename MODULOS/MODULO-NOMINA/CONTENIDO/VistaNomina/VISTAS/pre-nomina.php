<?php
	session_start();
	include('../PHP/conexion.php');

	if (!isset($_SESSION['usuario'])) {
	    header("Location: ../../../../../INICIO-DE-SESION/index.html");
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
	<title></title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
	<link rel="stylesheet" href="../CSS/vistanomina.css">
	<link rel="stylesheet" href="../CSS/animacionCarga.css">
	<link rel="stylesheet" href="../CSS/nav-lateral.css">
	<link rel="stylesheet" href="../CSS/columnas.css">
</head>
<body>
	<div class="cont-body">
		<div class="cont-nav">
			<div id="sub-cont-nav1" class="sub-cont-nav">
				<img src="../IMG/Logo.png" style=" width: auto; height: 80%;">
			</div>
			<div id="sub-cont-nav2" class="sub-cont-nav">
				<?php 
					if ($resultado && mysqli_num_rows($resultado) > 0) {
				        while ($datos = mysqli_fetch_object($resultado)) {
				        	echo "<span> Bienvenido " .$datos->nombre . "</span>";
				    	}
				    } else {
				        echo "<span>Invitado</span>";
				    }
				?>
			</div>
			<div id="sub-cont-nav3" class="sub-cont-nav">
				<div class="cont-btn-nav3">
					<a href="../PHP/cerrarSesion.php" style=" font-size: 20px;">Cerrar Sesión</a>	
				</div>
			</div>
		</div>
		<div class="cont-ubi-elementos-principales">
			<nav class="nav-lateral">
				<div id="spaces">
					<img src="../IMG/icono-billetera.png" alt="">
					<span>Modulo Nomina</span>
				</div>
				<div id="cont-menu">
					<div class="sidebar">
							<a href="../vistanomina.php" id="op-main" onclick="showMenu('menu1')">
			               <span id="icon-sidebar" class="material-symbols-outlined">Home</span>
			               <span id="txt-sidebar">Nomina</span>
			            </a>
			            <a href="liquidador.php" id="op-main" onclick="showMenu('menu1')">
			               <span id="icon-sidebar" class="material-symbols-outlined">request_quote</span>
			               <span id="txt-sidebar" >Liquidador</span>
			            </a>
		        	</div>
				</div>
			</nav>
			<div class="cont-datos">
				<div class="cont-tabla-resultado">
					<div id="formularioNominaPreNomina">
						<div class="contenedor-tablas-preNomina" id="formularioupdatenomina" >
							<form action="../PHP/actualizarValoresNomina.php" method="post" id="updateCamposNomina">
								<div id="div-contenedor-inputs-preNomina">
									<div id="div-update-preNomina">
										<div id="contenedor-input-update-preNomina">
											<span id="span-prenomina">Salario Base</span>
											<input type="number" name="salariobase" placeholder="">
										</div>
										<div id="contenedor-input-update-preNomina">
											<span id="span-prenomina">Identificación</span>
											<input type="number" name="dni" placeholder="">
										</div>
									</div>
									<div id="div-update-preNomina">
										<div id="contenedor-input-update-preNomina">
											<span id="span-prenomina">Auxilio Transporte</span>
											<input type="number" name="auxt" placeholder="">
										</div>
										<div id="contenedor-input-update-preNomina">
											<span id="span-prenomina">Total Suplementario</span>
											<input type="number" name="he" placeholder="">
										</div>
									</div>
									<div id="div-update-preNomina">
										<div id="contenedor-input-update-preNomina">
											<span id="span-prenomina">Optometria</span>
											<input type="number" name="optometria" placeholder="">
										</div>
										<div id="contenedor-input-update-preNomina">
											<span id="span-prenomina">Prestamos</span>
											<input type="number" name="prestamos" placeholder="">
										</div>
									</div>
									<div id="div-update-preNomina">
										<div id="contenedor-input-update-preNomina">
											<span id="span-prenomina">Bono</span>
											<input type="number" name="bono" placeholder="">
										</div>
										<div id="contenedor-input-update-preNomina">
											<span id="span-prenomina">Bono Extra</span>
											<input type="number" name="bonoextra" placeholder="">
										</div>
									</div>
									<div id="div-update-preNomina">
										<div id="contenedor-input-update-preNomina">
											<span id="span-prenomina">Vacaciones</span>
											<input type="number" name="vacaciones" placeholder="">
										</div>
										<div id="contenedor-input-update-preNomina">
											<span id="span-prenomina">Otros</span>
											<input type="number" name="otros" placeholder="">
										</div>
									</div>

								</div>
								<div id="contenedor-botones-preNomina">
									<div id="contenedor-btn-actualizar-preNomina">
										<input id="btn-actualizar-preNomina" type="submit" value="Actualizar">
									</div>
								</div>
							</form>
						</div>
						<div class="contenedor-tablas-preNomina" id="tablanomina" >
							<div id="contenedor-nomina">
								<table>
									<thead id="fila-titulo-tabla-nommina">
										<th id="menudesplegable">
										    <a href="#" id="icoeye" onclick="toggleMenu(event)"><span class="material-symbols-outlined">visibility_off</span></a>
										    <div id="dropdownMenu" class="dropdown-content">
										        <label><input id="dato1" type="checkbox" onclick="toggleColumnVisibility(event, )" checked> ID</label>
												<label><input id="dato2" type="checkbox" onclick="toggleColumnVisibility(event, 2)" checked> EMPRESA</label>
												<label><input id="dato3" type="checkbox" onclick="toggleColumnVisibility(event, 3)" checked> PROYECTO</label>
												<label><input id="dato4" type="checkbox" onclick="toggleColumnVisibility(event, 4)" checked> IDENTIFICACION</label>
												<label><input id="dato5" type="checkbox" onclick="toggleColumnVisibility(event, 5)" checked> NOMBRES Y APELLIDOS</label>
												<label><input id="dato6" type="checkbox" onclick="toggleColumnVisibility(event, 6)" checked> CARGO</label>
												<label><input id="dato7" type="checkbox" onclick="toggleColumnVisibility(event, 7)" checked> INGRESO</label>
												<label><input id="dato8" type="checkbox" onclick="toggleColumnVisibility(event, 8)" checked> SALARIO BASE</label>
												<label><input id="dato9" type="checkbox" onclick="toggleColumnVisibility(event, 9)" checked> AUX TRANSPORTE</label>
												<label><input id="dato10" type="checkbox" onclick="toggleColumnVisibility(event, 10)" checked> BONO</label>
												<label><input id="dato11" type="checkbox" onclick="toggleColumnVisibility(event, 11)" checked> INICIO</label>
												<label><input id="dato12" type="checkbox" onclick="toggleColumnVisibility(event, 12)" checked> FINAL</label>
												<label><input id="dato13" type="checkbox" onclick="toggleColumnVisibility(event, 13)" checked> CANT</label>
												<label><input id="dato14" type="checkbox" onclick="toggleColumnVisibility(event, 14)" checked> VALOR</label>
												<label><input id="dato15" type="checkbox" onclick="toggleColumnVisibility(event, 15)" checked> PERIODO</label>
												<label><input id="dato16" type="checkbox" onclick="toggleColumnVisibility(event, 16)" checked> PERIODO INICIO</label>
												<label><input id="dato17" type="checkbox" onclick="toggleColumnVisibility(event, 17)" checked> PERIODO FINAL</label>
												<label><input id="dato18" type="checkbox" onclick="toggleColumnVisibility(event, 18)" checked> DIAS</label>
												<label><input id="dato19" type="checkbox" onclick="toggleColumnVisibility(event, 19)" checked> SALARIO BASE DIA</label>
												<label><input id="dato20" type="checkbox" onclick="toggleColumnVisibility(event, 20)" checked> HORA</label>
												<label><input id="dato21" type="checkbox" onclick="toggleColumnVisibility(event, 21)" checked> AUXT CANT</label>
												<label><input id="dato22" type="checkbox" onclick="toggleColumnVisibility(event, 22)" checked> HEDO 125</label>
												<label><input id="dato23" type="checkbox" onclick="toggleColumnVisibility(event, 23)" checked> HEDO 125 CANT</label>
												<label><input id="dato24" type="checkbox" onclick="toggleColumnVisibility(event, 24)" checked> HENO 175</label>
												<label><input id="dato25" type="checkbox" onclick="toggleColumnVisibility(event, 25)" checked> HENO 175 CANT</label>
												<label><input id="dato26" type="checkbox" onclick="toggleColumnVisibility(event, 26)" checked> RN 035</label>
												<label><input id="dato27" type="checkbox" onclick="toggleColumnVisibility(event, 27)" checked> RN 035 CANT</label>
												<label><input id="dato28" type="checkbox" onclick="toggleColumnVisibility(event, 28)" checked> RF 075</label>
												<label><input id="dato29" type="checkbox" onclick="toggleColumnVisibility(event, 29)" checked> RF 075 CANT</label>
												<label><input id="dato30" type="checkbox" onclick="toggleColumnVisibility(event, 30)" checked> HEDDF 200</label>
												<label><input id="dato31" type="checkbox" onclick="toggleColumnVisibility(event, 31)" checked> HEDDF 200 CANT</label>
												<label><input id="dato32" type="checkbox" onclick="toggleColumnVisibility(event, 32)" checked> HENDF 250</label>
												<label><input id="dato33" type="checkbox" onclick="toggleColumnVisibility(event, 33)" checked> HENDF 250 CANT</label>
												<label><input id="dato34" type="checkbox" onclick="toggleColumnVisibility(event, 34)" checked> RNDF 210</label>
												<label><input id="dato35" type="checkbox" onclick="toggleColumnVisibility(event, 35)" checked> RNDF 210 CANT</label>
												<label><input id="dato36" type="checkbox" onclick="toggleColumnVisibility(event, 36)" checked> HD 175</label>
												<label><input id="dato37" type="checkbox" onclick="toggleColumnVisibility(event, 37)" checked> HD 175 CANT</label>
												<label><input id="dato38" type="checkbox" onclick="toggleColumnVisibility(event, 38)" checked> TOTAL SUPLEMENTARIO</label>
												<label><input id="dato39" type="checkbox" onclick="toggleColumnVisibility(event, 39)" checked> BONO EXTRA</label>
												<label><input id="dato40" type="checkbox" onclick="toggleColumnVisibility(event, 40)" checked> TOTAL DEVENGADO</label>
												<label><input id="dato41" type="checkbox" onclick="toggleColumnVisibility(event, 41)" checked> BASE SSSG</label>
												<label><input id="dato42" type="checkbox" onclick="toggleColumnVisibility(event, 42)" checked> PENSION</label>
												<label><input id="dato43" type="checkbox" onclick="toggleColumnVisibility(event, 43)" checked> SALUD</label>
												<label><input id="dato44" type="checkbox" onclick="toggleColumnVisibility(event, 44)" checked> FSP</label>
												<label><input id="dato45" type="checkbox" onclick="toggleColumnVisibility(event, 45)" checked> OPTOMETRIA</label>
												<label><input id="dato46" type="checkbox" onclick="toggleColumnVisibility(event, 46)" checked> PRESTAMOS</label>
												<label><input id="dato47" type="checkbox" onclick="toggleColumnVisibility(event, 47)" checked> OTROS</label>
												<label><input id="dato48" type="checkbox" onclick="toggleColumnVisibility(event, 48)" checked> VACACIONES</label>
												<label><input id="dato49" type="checkbox" onclick="toggleColumnVisibility(event, 49)" checked> TOTAL DEDUCCION</label>
												<label><input id="dato50" type="checkbox" onclick="toggleColumnVisibility(event, 50)" checked> TOTAL A PAGAR</label>
												<label><input id="dato51" type="checkbox" onclick="toggleColumnVisibility(event, 51)" checked> N° CUENTA</label>
												<label><input id="dato52" type="checkbox" onclick="toggleColumnVisibility(event, 52)" checked> TIPO CUENTA</label>
												<label><input id="dato53" type="checkbox" onclick="toggleColumnVisibility(event, 53)" checked> BANCO</label>
												<label><input id="dato54" type="checkbox" onclick="toggleColumnVisibility(event, 54)" checked> OBSERVACION</label>

											    <div id="content-close">
											        <a id="closeMenu" href="vistanomina.php">Restablecer</a>
											    </div>   	
										    </div>
										</th>
										<th id="dato1" class="consulta-Resultado-Datos">ID</th>
										<th id="dato2" class="consulta-Resultado-Datos">EMPRESA</th>
										<th id="dato3" class="consulta-Resultado-Datos">PROYECTO</th>
										<th id="dato4" class="consulta-Resultado-Datos">IDENTIFICACION</th>
										<th id="dato5" class="consulta-Resultado-Datos" style="min-width: 55vh;">NOMBRE APELLIDOS</th>
										<th id="dato6" class="consulta-Resultado-Datos">CARGO</th>
										<th id="dato7" class="consulta-Resultado-Datos">INGRESO</th>
										<th id="dato8" class="consulta-Resultado-Datos">SALARIO BASE</th>
										<th id="dato9" class="consulta-Resultado-Datos">AUXT</th>
										<th id="dato10" class="consulta-Resultado-Datos">BONO</th>
										<th id="dato11" class="consulta-Resultado-Datos">INICIO</th>
										<th id="dato12" class="consulta-Resultado-Datos">FINAL</th>
										<th id="dato13" class="consulta-Resultado-Datos">CANT</th>
										<th id="dato14" class="consulta-Resultado-Datos">VALOR SLV</th>
										<th id="dato15" class="consulta-Resultado-Datos">PERIODO</th>
										<th id="dato16" class="consulta-Resultado-Datos">PERIODO INICIO</th>
										<th id="dato17" class="consulta-Resultado-Datos">PERIODO FINAL</th>
										<th id="dato18" class="consulta-Resultado-Datos">DIAS</th>
										<th id="dato19" class="consulta-Resultado-Datos">SALARIO BASE DIA</th>
										<th id="dato20" class="consulta-Resultado-Datos">HORA</th>
										<th id="dato21" class="consulta-Resultado-Datos">AUXT CANT</th>
										<th id="dato22" class="consulta-Resultado-Datos">CANT</th>
										<th id="dato23" class="consulta-Resultado-Datos">HEDO125</th>
										<th id="dato24" class="consulta-Resultado-Datos">CANT</th>
										<th id="dato25" class="consulta-Resultado-Datos">HENO175</th>
										<th id="dato26" class="consulta-Resultado-Datos">CANT</th>
										<th id="dato27" class="consulta-Resultado-Datos">RN035</th>
										<th id="dato28" class="consulta-Resultado-Datos">CANT</th>
										<th id="dato29" class="consulta-Resultado-Datos">RF075</th>
										<th id="dato30" class="consulta-Resultado-Datos">CANT</th>
										<th id="dato31" class="consulta-Resultado-Datos" style="min-width: 30vh;">HEDDF200</th>
										<th id="dato32" class="consulta-Resultado-Datos">CANT</th>
										<th id="dato33" class="consulta-Resultado-Datos">HENDF250</th>
										<th id="dato34" class="consulta-Resultado-Datos">CANT</th>
										<th id="dato35" class="consulta-Resultado-Datos">RNDF210</th>
										<th id="dato36" class="consulta-Resultado-Datos">CANT</th>
										<th id="dato37" class="consulta-Resultado-Datos">HD175</th>
										<th id="dato38" class="consulta-Resultado-Datos" style="min-width: 40vh;">TOTAL SUPLEMENTARIO</th>
										<th id="dato39" class="consulta-Resultado-Datos" style="min-width: 35vh;">BONO EXTRA</th>
										<th id="dato40" class="consulta-Resultado-Datos" style="min-width: 35vh;">TOTAL DEVENGADO</th>
										<th id="dato41" class="consulta-Resultado-Datos">BASE SSG</th>
										<th id="dato42" class="consulta-Resultado-Datos">PENSION</th>
										<th id="dato43" class="consulta-Resultado-Datos">SALUD</th>
										<th id="dato44" class="consulta-Resultado-Datos">FSP</th>
										<th id="dato45" class="consulta-Resultado-Datos">OPTOMETRIA</th>
										<th id="dato46" class="consulta-Resultado-Datos">PRESTAMOS</th>
										<th id="dato47" class="consulta-Resultado-Datos">OTROS</th>
										<th id="dato48" class="consulta-Resultado-Datos">VACACIONES</th>
										<th id="dato49" class="consulta-Resultado-Datos" style="min-width: 35vh;">TOTAL DEDUCCION</th>
										<th id="dato50" class="consulta-Resultado-Datos" style="min-width: 35vh;">TOTAL A PAGAR</th>
										<th id="dato51" class="consulta-Resultado-Datos" style="min-width: 35vh;">NUMERO CUENTA</th>
										<th id="dato52" class="consulta-Resultado-Datos">TIPO CUENTA</th>
										<th id="dato53" class="consulta-Resultado-Datos">BANCO</th>
										<th id="dato54" class="consulta-Resultado-Datos">OBSERVACION</th>
									</thead>
									<tbody>
										<?php
										        include("../PHP/conexion.php");

										        $query = "SELECT * FROM nomina";
										        $resultado = mysqli_query($conn, $query);
										        if (!$resultado) {
										            echo "Error en la consulta: " . mysqli_error($conn);
										            exit;
										        }
										        while ($datos = mysqli_fetch_object($resultado)) {
										            echo "<tr class='tb-resultado-datos'>";
										            echo "<th id='menudesplegable'></th>";
												         echo "<th id='dato1' class='consulta-Resultado-Datos resultado'>" . htmlspecialchars($datos->id) . "</th>";
															echo "<th id='dato2' class='consulta-Resultado-Datos resultado'>" . htmlspecialchars($datos->empresa) . "</th>";
															echo "<th id='dato3' class='consulta-Resultado-Datos resultado'>" . htmlspecialchars($datos->proyecto) . "</th>";
															echo "<th id='dato4' class='consulta-Resultado-Datos resultado'>" . htmlspecialchars($datos->identificacion) . "</th>";
															echo "<th id='dato5' class='consulta-Resultado-Datos resultado' style='min-width: 55vh;'>" . htmlspecialchars($datos->nombreapellidos) . "</th>";
															echo "<th id='dato6' class='consulta-Resultado-Datos resultado'>" . htmlspecialchars($datos->cargo) . "</th>";
															echo "<th id='dato7' class='consulta-Resultado-Datos resultado'>" . htmlspecialchars($datos->ingreso) . "</th>";
															echo "<th id='dato8' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->salariobase) . "</th>";
															echo "<th id='dato9' class='consulta-Resultado-Datos resultado'>" . htmlspecialchars($datos->auxt) . "</th>";
															echo "<th id='dato10' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->bono) . "</th>";
															echo "<th id='dato11' class='consulta-Resultado-Datos resultado'>" . htmlspecialchars($datos->inicio) . "</th>";
															echo "<th id='dato12' class='consulta-Resultado-Datos resultado'>" . htmlspecialchars($datos->final) . "</th>";
															echo "<th id='dato13' class='consulta-Resultado-Datos resultado'>" . htmlspecialchars($datos->cant) . "</th>";
															echo "<th id='dato14' class='consulta-Resultado-Datos resultado'>" . htmlspecialchars($datos->valordescuentosvl) . "</th>";
															echo "<th id='dato15' class='consulta-Resultado-Datos resultado'>" . htmlspecialchars($datos->periodo) . "</th>";
															echo "<th id='dato16' class='consulta-Resultado-Datos resultado'>" . htmlspecialchars($datos->periodoinicio) . "</th>";
															echo "<th id='dato17' class='consulta-Resultado-Datos resultado'>" . htmlspecialchars($datos->periodofinal) . "</th>";
															echo "<th id='dato18' class='consulta-Resultado-Datos resultado'>" . htmlspecialchars($datos->dias) . "</th>";
															echo "<th id='dato19' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->salariobasedia) . "</th>";
															echo "<th id='dato20' class='consulta-Resultado-Datos resultado'>" . htmlspecialchars($datos->hora) . "</th>";
															echo "<th id='dato21' class='consulta-Resultado-Datos resultado'>" . htmlspecialchars($datos->auxtcant) . "</th>";
															echo "<th id='dato22' class='consulta-Resultado-Datos resultado'>" . htmlspecialchars($datos->hedo125cant) . "</th>";
															echo "<th id='dato23' class='consulta-Resultado-Datos resultado'>" . htmlspecialchars($datos->hedo125) . "</th>";
															echo "<th id='dato24' class='consulta-Resultado-Datos resultado'>" . htmlspecialchars($datos->heno175cant) . "</th>";
															echo "<th id='dato25' class='consulta-Resultado-Datos resultado'>" . htmlspecialchars($datos->heno175) . "</th>";
															echo "<th id='dato26' class='consulta-Resultado-Datos resultado'>" . htmlspecialchars($datos->rn035cant) . "</th>";
															echo "<th id='dato27' class='consulta-Resultado-Datos resultado'>" . htmlspecialchars($datos->rn035) . "</th>";
															echo "<th id='dato28' class='consulta-Resultado-Datos resultado'>" . htmlspecialchars($datos->rf075cant) . "</th>";
															echo "<th id='dato29' class='consulta-Resultado-Datos resultado'>" . htmlspecialchars($datos->rf075) . "</th>";
															echo "<th id='dato30' class='consulta-Resultado-Datos resultado'>" . htmlspecialchars($datos->heddf200cant) . "</th>";
															echo "<th id='dato31' class='consulta-Resultado-Datos resultado'  style='min-width: 30vh;'>" . htmlspecialchars($datos->heddf200) . "</th>";
															echo "<th id='dato32' class='consulta-Resultado-Datos resultado'>" . htmlspecialchars($datos->hendf250cant) . "</th>";
															echo "<th id='dato33' class='consulta-Resultado-Datos resultado'>" . htmlspecialchars($datos->hendf250) . "</th>";
															echo "<th id='dato34' class='consulta-Resultado-Datos resultado'>" . htmlspecialchars($datos->rndf210cant) . "</th>";
															echo "<th id='dato35' class='consulta-Resultado-Datos resultado'>" . htmlspecialchars($datos->rndf210) . "</th>";
															echo "<th id='dato36' class='consulta-Resultado-Datos resultado'>" . htmlspecialchars($datos->hd175cant) . "</th>";
															echo "<th id='dato37' class='consulta-Resultado-Datos resultado'>" . htmlspecialchars($datos->hd175) . "</th>";
															echo "<th id='dato38' class='consulta-Resultado-Datos resultado'  style='min-width: 40vh;'>" . htmlspecialchars($datos->totalsuplementario) . "</th>";
															echo "<th id='dato39' class='consulta-Resultado-Datos resultado'  style='min-width: 35vh;'>" . htmlspecialchars($datos->bonoextra) . "</th>";
															echo "<th id='dato40' class='consulta-Resultado-Datos resultado'  style='min-width: 35vh;'>" . htmlspecialchars($datos->totaldevengado) . "</th>";
															echo "<th id='dato41' class='consulta-Resultado-Datos resultado'>" . htmlspecialchars($datos->basesssg) . "</th>";
															echo "<th id='dato42' class='consulta-Resultado-Datos resultado'>" . htmlspecialchars($datos->pension) . "</th>";
															echo "<th id='dato43' class='consulta-Resultado-Datos resultado'>" . htmlspecialchars($datos->salud) . "</th>";
															echo "<th id='dato44' class='consulta-Resultado-Datos resultado'>" . htmlspecialchars($datos->fsp) . "</th>";
															echo "<th id='dato45' class='consulta-Resultado-Datos resultado'>" . htmlspecialchars($datos->optometria) . "</th>";
															echo "<th id='dato46' class='consulta-Resultado-Datos resultado'>" . htmlspecialchars($datos->prestamos) . "</th>";
															echo "<th id='dato47' class='consulta-Resultado-Datos resultado'>" . htmlspecialchars($datos->otros) . "</th>";
															echo "<th id='dato48' class='consulta-Resultado-Datos resultado'>" . htmlspecialchars($datos->vacaciones) . "</th>";
															echo "<th id='dato49' class='consulta-Resultado-Datos resultado' style='min-width: 35vh;'>" . htmlspecialchars($datos->totaldeduccion) . "</th>";
															echo "<th id='dato50' class='consulta-Resultado-Datos resultado' style='min-width: 35vh;'>" . htmlspecialchars($datos->totalpagar) . "</th>";
															echo "<th id='dato51' class='consulta-Resultado-Datos resultado' style='min-width: 35vh;'>" . htmlspecialchars($datos->numerocuenta) . "</th>";
															echo "<th id='dato52' class='consulta-Resultado-Datos resultado'>" . htmlspecialchars($datos->tipocuenta) . "</th>";
															echo "<th id='dato53' class='consulta-Resultado-Datos resultado'>" . htmlspecialchars($datos->banco) . "</th>";
															echo "<th id='dato54' class='consulta-Resultado-Datos resultado'>" . htmlspecialchars($datos->observacion) . "</th>";
										            echo "</tr>";
										        }
										    ?>
									</tbody>
								</table>
							</div>
							<div id="">
								<table>
									<thead>
										
									</thead>
									<tbody>
										<?php 

										 ?>
									</tbody>
								</table>
							</div>
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
		function toggleMenu(event) {
		    event.preventDefault();
		    var menu = document.getElementById('dropdownMenu');
		    if (menu.style.display === 'block') {
		        menu.style.display = 'none';
		    } else {
		        menu.style.display = 'block';
		    }
		}

		function toggleColumnVisibility(event, columnIndex) {
		    const checkBox = event.target;
		    const table = document.querySelector('table');
		    const rows = table.rows;

		    for (let row of rows) {
		        const cell = row.cells[columnIndex];
		        if (cell) {
		            cell.style.display = checkBox.checked ? '' : 'none';
		        }
		    }
		}
		function closeMenu(event) {
		    event.stopPropagation();
		    var menu = document.getElementById('dropdownMenu');
		    menu.style.display = 'none';
		}
   </script>
</body>
</html>