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
	<link rel="stylesheet" href="../CSS/aprobador2.css">
	<link rel="stylesheet" href="../CSS/animacionCarga.css">
	<link rel="stylesheet" href="../CSS/estilos-btnLaterales.css">
	<link rel="stylesheet" href="../CSS/columnas.css">
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
				        	echo "<span> Bienvenido " .$datos->nombre . "</span>";
				        }
				    } else {
				        echo "<span>Invitado</span>";
				    }
				?>
			</div>
			<div id="sub-cont-nav3" class="sub-cont-nav">
				<div class="cont-btn-nav3">
					<a href="../PHP/cerrarSesion.php">Cerrar Sesión</a>	
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
				        <a id="op-main" href="#" onclick="showMenu('menu1')"> <span class="material-symbols-outlined">menu_open</span>Operaciones</a>
				        <div id="menu1" class="submenu">
				        	<a href="../aprobador2.php"> <span id="ico" class="material-symbols-outlined">home</span> <span id="txt">Home</span> </a>
				            <!-- <a href="./aprobados.php"> <span id="ico" class="material-symbols-outlined">check_circle</span> <span id="txt">Aprobaciones</span> </a> -->
				            <a href="Historico/historicopagos.php"> <span id="ico" class="material-symbols-outlined">history</span><span id="txt">Historico</span> </a>
				        </div>
				    </div>
				</div>
			</nav>
			<div class="cont-datos">
				<div class="cont-tabla-resultado">
				     <form action="./PHP/actualizarEstado.php" method="post">
				        <div class="cont-tabla">
				        	<table>
					                <thead class="titulo-tabla-resultado">
					                    <tr class="fila-titulo-resultado">
					                    	<th id="menudesplegable">
							                  <a href="#" id="icoeye" onclick="toggleMenu(event)"><span class="material-symbols-outlined">visibility_off</span></a>
							                  <div id="dropdownMenu" class="dropdown-content">
							                    	<label><input id="id" type="checkbox" onclick="toggleColumnVisibility(event, )" checked readonly> ID *</label>
										            <label><input id="dato2" type="checkbox" onclick="toggleColumnVisibility(event, 2)" checked> DIRFINANCIERA</label>
										            <label><input id="dato3" type="checkbox" onclick="toggleColumnVisibility(event, 3)" checked> CARTAGENA</label>
										            <label><input id="dato4" type="checkbox" onclick="toggleColumnVisibility(event, 4)" checked> BARRANQUILLA</label>
										            <label><input id="dato5" type="checkbox" onclick="toggleColumnVisibility(event, 5)" checked> COMENTARIO FINANCIERA</label>
										            <label><input id="dato6" type="checkbox" onclick="toggleColumnVisibility(event, 6)" checked> COMENTARIO CARTAGENA</label>
										            <label><input id="dato7" type="checkbox" onclick="toggleColumnVisibility(event, 7)" checked> COMENTARIO BARRANQUILLA</label>
										            <label><input id="dato8" type="checkbox" onclick="toggleColumnVisibility(event, 8)" checked> EMPRESA</label>
										            <label><input id="dato9" type="checkbox" onclick="toggleColumnVisibility(event, 9)" checked> CONCEPTO-PROYECCION</label>
										            <label><input id="dato10" type="checkbox" onclick="toggleColumnVisibility(event, 10)" checked> C-COSTO</label>
										            <label><input id="dato11" type="checkbox" onclick="toggleColumnVisibility(event, 11)" checked> EPS</label>
										            <label><input id="dato12" type="checkbox" onclick="toggleColumnVisibility(event, 12)" checked> FECHA-CAUSACION</label>
										            <label><input id="dato13" type="checkbox" onclick="toggleColumnVisibility(event, 13)" checked> FECHA-PROGRAMACION</label>
										            <label><input id="dato14" type="checkbox" onclick="toggleColumnVisibility(event, 14)" checked> MES-DE-PROGRAMACION</label>
										            <label><input id="dato15" type="checkbox" onclick="toggleColumnVisibility(event, 15)" checked> MES-DEL-SERV</label>
										            <label><input id="dato16" type="checkbox" onclick="toggleColumnVisibility(event, 16)" checked> N°FAC-CC</label>
										            <label><input id="dato17" type="checkbox" onclick="toggleColumnVisibility(event, 17)" checked> REFERENCIA</label>
										            <label><input id="dato18" type="checkbox" onclick="toggleColumnVisibility(event, 18)" checked> CONCEPTO</label>
										            <label><input id="dato19" type="checkbox" onclick="toggleColumnVisibility(event, 19)" checked> SUBCONCEPTO</label>
										            <label><input id="dato20" type="checkbox" onclick="toggleColumnVisibility(event, 20)" checked> TIPO-DOC</label>
										            <label><input id="dato21" type="checkbox" onclick="toggleColumnVisibility(event, 21)" checked> N°-DOC-BENEFICIARIO</label>
										            <label><input id="dato22" type="checkbox" onclick="toggleColumnVisibility(event, 22)" checked> NOMBRE-DE-TERCERO</label>
										            <label><input id="dato23" type="checkbox" onclick="toggleColumnVisibility(event, 23)" checked> OBSERVACION-DEL-MOVIMIENTO</label>
										            <label><input id="dato24" type="checkbox" onclick="toggleColumnVisibility(event, 24)" checked> PLACA</label>
										            <label><input id="dato25" type="checkbox" onclick="toggleColumnVisibility(event, 25)" checked> RUTA</label>
										            <label><input id="dato26" type="checkbox" onclick="toggleColumnVisibility(event, 26)" checked> FECHA-DEBITO-AUTO</label>
										            <label><input id="dato27" type="checkbox" onclick="toggleColumnVisibility(event, 27)" checked> VALOR-BASE</label>
										            <label><input id="dato28" type="checkbox" onclick="toggleColumnVisibility(event, 28)" checked> IVA</label>
										            <label><input id="dato29" type="checkbox" onclick="toggleColumnVisibility(event, 29)" checked> SOBRETASA</label>
										            <label><input id="dato30" type="checkbox" onclick="toggleColumnVisibility(event, 30)" checked> VALOR-TOTAL</label>
										            <label><input id="dato31" type="checkbox" onclick="toggleColumnVisibility(event, 31)" checked> CONCEPTO-DE-RETENCIÓN</label>
										            <label><input id="dato32" type="checkbox" onclick="toggleColumnVisibility(event, 32)" checked> BASE-MÍNIMA-EN-PESOS</label>
										            <label><input id="dato33" type="checkbox" onclick="toggleColumnVisibility(event, 33)" checked> %-RETE</label>
										            <label><input id="dato34" type="checkbox" onclick="toggleColumnVisibility(event, 34)" checked> VALOR-RETE</label>
										            <label><input id="dato35" type="checkbox" onclick="toggleColumnVisibility(event, 35)" checked> VALOR-NETO</label>
										            <label><input id="dato36" type="checkbox" onclick="toggleColumnVisibility(event, 36)" checked> ANTICIPO</label>
										            <label><input id="dato37" type="checkbox" onclick="toggleColumnVisibility(event, 37)" checked> ABONO</label>
										            <label><input id="dato38" type="checkbox" onclick="toggleColumnVisibility(event, 38)" checked> DESCUENTO</label>
										            <label><input id="dato39" type="checkbox" onclick="toggleColumnVisibility(event, 39)" checked> VALOR-A-PAGAR</label>
										            <label><input id="dato40" type="checkbox" onclick="toggleColumnVisibility(event, 40)" checked> FECHA-PAGO</label>
										            <label><input id="dato41" type="checkbox" onclick="toggleColumnVisibility(event, 41)" checked> VALOR-PAGADO</label>
										            <label><input id="dato42" type="checkbox" onclick="toggleColumnVisibility(event, 42)" checked> OBSERVACION</label>
										            <label><input id="dato43" type="checkbox" onclick="toggleColumnVisibility(event, 43)" checked> CONSUMO-SEMANAL</label>
										            <label><input id="dato44" type="checkbox" onclick="toggleColumnVisibility(event, 44)" checked> CSC-REFERENCIA</label>
										            <div id="content-option-select-check">
										            	<div id="div-1">
										            		<span> Seleccionar todo </span>
										            		<input type="checkbox" checked>
										            	</div>
										            	<div id="div-2">
										            		<a id="closeMenu" href="../aprobador3.php">X</a>
										            	</div>
							                     	</div>   	
							                  </div>
							               </th>
					                    <th id="id" class="consulta-Resultado-Datos id">ID</th>
					                    <th id="dato2" class="consulta-Resultado-Datos">DIRFINANCIERA</th>
					                    <th id="dato3" class="consulta-Resultado-Datos">CARTAGENA</th>
					                    <th id="dato4" class="consulta-Resultado-Datos">BARRANQUILLA</th>
					                    <th id="dato5" class="consulta-Resultado-Datos comfin">COMENTARIO-FINANCIERA</th>
					                    <th id="dato6" class="consulta-Resultado-Datos comcar">COMENTARIO-CARTAGENA</th>
					                    <th id="dato7" class="consulta-Resultado-Datos combar">COMENTARIO-BARRANQUILLA</th>
					                    <th id="dato8" class="consulta-Resultado-Datos">EMPRESA</th>
					                    <th id="dato9" class="consulta-Resultado-Datos">CONCEPTO-PROYECCION</th>
					                    <th id="dato10" class="consulta-Resultado-Datos">C-COSTO</th>
					                    <th id="dato11" class="consulta-Resultado-Datos">EPS</th>
					                    <th id="dato12" class="consulta-Resultado-Datos">FECHA-CAUSACION</th>
					                    <th id="dato13" class="consulta-Resultado-Datos">FECHA-PROGRAMACION</th>
					                    <th id="dato14" class="consulta-Resultado-Datos mdp">MES-DE-PROGRAMACION</th>
					                    <th id="dato15" class="consulta-Resultado-Datos mds">MES-DEL-SERV</th>
					                    <th id="dato16" class="consulta-Resultado-Datos nfc">N°FAC-CC</th>
					                    <th id="dato17" class="consulta-Resultado-Datos">REFERENCIA</th>
					                    <th id="dato18" class="consulta-Resultado-Datos">CONCEPTO</th>
					                    <th id="dato19" class="consulta-Resultado-Datos SUBCONCEPTO">SUBCONCEPTO</th>
					                    <th id="dato20" class="consulta-Resultado-Datos">TIPO-DOC</th>
					                    <th id="dato21" class="consulta-Resultado-Datos">DOC-BENEFICIARIO</th>
					                    <th id="dato22" class="consulta-Resultado-Datos">NOMBRE-DE-TERCERO</th>
					                    <th id="dato23" class="consulta-Resultado-Datos">OBSERVACION</th>
					                    <th id="dato24" class="consulta-Resultado-Datos PLACA">PLACA</th>
					                    <th id="dato25" class="consulta-Resultado-Datos RUTA">RUTA</th>
					                    <th id="dato26" class="consulta-Resultado-Datos">FECHA-DEBITO-AUTO</th>
					                    <th id="dato27" class="consulta-Resultado-Datos">VALOR-BASE</th>
					                    <th id="dato28" class="consulta-Resultado-Datos">IVA</th>
					                    <th id="dato29" class="consulta-Resultado-Datos">SOBRETASA</th>
					                    <th id="dato30" class="consulta-Resultado-Datos">VALOR-TOTAL</th>
					                    <th id="dato31" class="consulta-Resultado-Datos">CONCEPTO-DE-RETENCIÓN</th>
					                    <th id="dato32" class="consulta-Resultado-Datos">BASE-MÍNIMA-EN-PESOS</th>
					                    <th id="dato33" class="consulta-Resultado-Datos">PORCENTAJE-RETE</th>
					                    <th id="dato34" class="consulta-Resultado-Datos">VALOR-RETE</th>
					                    <th id="dato35" class="consulta-Resultado-Datos">VALOR-NETO</th>
					                    <th id="dato36" class="consulta-Resultado-Datos">ANTICIPO</th>
					                    <th id="dato37" class="consulta-Resultado-Datos">ABONO</th>
					                    <th id="dato38" class="consulta-Resultado-Datos">DESCUENTO</th>
					                    <th id="dato39" class="consulta-Resultado-Datos">SALDO NO PAGADO</th>
					                    <th id="dato39" class="consulta-Resultado-Datos">VALOR-A-PAGAR</th>
					                    <th id="dato40" class="consulta-Resultado-Datos">FECHA-PAGO</th>
					                    <th id="dato41" class="consulta-Resultado-Datos">VALOR-PAGADO</th>
					                    <th id="dato42" class="consulta-Resultado-Datos">OBSERVACION</th>
					                    <th id="dato43" class="consulta-Resultado-Datos">CONSUMO-SEMANAL</th>
					                    <th id="dato44" class="consulta-Resultado-Datos">CSC-REFERENCIA</th>
					                    </tr>
					                </thead>
					                <tbody>
					                    <?php
					                    include("../PHP/conexion.php");
					                    $query = "SELECT * FROM tablaproveedores";
					                    $resultado = mysqli_query($conn, $query);
					                    while ($datos = mysqli_fetch_object($resultado)) {

					                        echo "<tr class='tb-resultado-datos'>";
					                        echo "<th id='menudesplegable'></th>";
					                        echo "<th class='consulta-Resultado-Datos id'>" . htmlspecialchars($datos->id) . "</th>";
					                        
					                        $dirfinancieraValue = $datos->dirfinanciera;
											switch ($dirfinancieraValue) {
											    case 2:
											        $displayValue = "APROBADO";
											        break;
											    case 1:
											        $displayValue = "NO APROBADO";
											        break;
											    case 3:
											        $displayValue = "APROBACIÓN PARCIAL";
											        break;
											    case 4:
											        $displayValue = "RE-APROBADO";
											        break;
											    default:
											        $displayValue = "DESCONOCIDO";
											}

											echo "<th id='estados' class='consulta-Resultado-Datos'>" . htmlspecialchars($displayValue) . "</th>";

					                        $gerenciacValue = $datos->gerenciacartagena;
											switch ($gerenciacValue) {
											    case 2:
											        $displayGC = "APROBADO";
											        break;
											    case 1:
											        $displayGC = "NO APROBADO";
											        break;
											    case 3:
											        $displayGC = "APROBACIÓN PARCIAL";
											        break;
											    case 4:
											        $displayGC = "RE-APROBADO";
											        break;
											    default:
											        $displayGC = "DESCONOCIDO";
											}

											echo "<th id='estados' class='consulta-Resultado-Datos'>" . htmlspecialchars($displayGC) . "</th>";
											 $gerenciabValue = $datos->gerenciabarranquilla;
											switch ($gerenciabValue) {
											    case 2:
											        $displayGB = "APROBADO";
											        break;
											    case 1:
											        $displayGB = "NO APROBADO";
											        break;
											    case 3:
											        $displayGB = "APROBACIÓN PARCIAL";
											        break;
											    case 4:
											        $displayGB = "RE-APROBADO";
											        break;
											    default:
											        $displayGB = "DESCONOCIDO";
											}
					                        echo "<th id='estados' class='consulta-Resultado-Datos'>" . htmlspecialchars($displayGB) . "</th>";
					                        echo "<th id='comentarios' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->comentariodir) . "</th>";
					                        echo "<th id='comentarios' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->comentarioc) . "</th>";
					                        echo "<th id='comentarios' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->comentariob) . "</th>";
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
					                        echo "<th id='dato35' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->saldonopago) . "</th>";
					                        echo "<th id='dato33' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->valorapagar) . "</th>";
					                        echo "<th id='dato34' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->fechapago) . "</th>";
					                        echo "<th id='dato35' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->valorpagado) . "</th>";
					                        echo "<th id='dato36' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->observacion) . "</th>";
					                        echo "<th id='dato37' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->consumosemanal) . "</th>";
					                        echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->cscreferencia) . "</th>";

					                        echo "</tr>";
					                    }
					                    ?>
					                </tbody>
					        </table>
				        </div>
				        <div class="cont-btn-guardar">
				        	<div class="ubi-btn-guardar">
				        		<!-- <button type="submit"><span>Guardar</span></button> -->
				        	</div>
				        </div>
				    </form>
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