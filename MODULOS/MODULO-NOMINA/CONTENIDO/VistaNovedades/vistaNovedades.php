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
	<link rel="stylesheet" href="../../CSS/estilos-index.css">
	<link rel="stylesheet" href="../../CSS/animacionCarga.css">
	<link rel="stylesheet" href="../../CSS/nav-lateral.css">
	<link rel="stylesheet" href="../../CSS/estilos-novedades.css">
	<link rel="stylesheet" href="CCS/columnas.css">
	<link rel="stylesheet" href="CCS/tablanovedades.css">


	<script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const selectNovedades = document.querySelector('select[name="tablanovedades"]');
            const divsNovedades = document.querySelectorAll('.tabla-consulta-novedades');

            selectNovedades.addEventListener('change', function() {
                const selectedValue = this.value;

                divsNovedades.forEach(div => {
                    if (div.id === selectedValue) {
                        div.style.display = 'block';
                    } else {
                        div.style.display = 'none';
                    }
                });
            });
        });
    </script>
</head>
<body>
	<div class="cont-body">
		<div class="cont-nav">
			<div id="sub-cont-nav1" class="sub-cont-nav">
				<img src="../../IMG/Logo.png" style=" width: auto; height: 80%;">
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
					<a href="PHP/cerrarSesion.php" style=" font-size: 20px;">Cerrar Sesión</a>	
				</div>
			</div>
		</div>
		<div class="cont-ubi-elementos-principales">
			<nav class="nav-lateral">
				<div id="spaces">
					<img src="../../IMG/icono-billetera.png" alt="">
					<span>Modulo Nomina</span>
				</div>
				<div id="cont-menu">
					<div class="sidebar">
						<a href="vistaNovedades.php" id="op-main" onclick="showMenu('menu1')">
			               <span id="icon-sidebar" class="material-symbols-outlined">Home</span>
			               <span id="txt-sidebar" >Home</span>
			            </a>
		        	</div>
				</div>
			</nav>
			<div class="cont-datos">
				<div class="cont-tabla-resultado">

				   <div id="element-labels">
				    	<div id="form-novedades">
				    		<div id="cont-select-novedad">
				    			<div id="select-novedad">
				    				<span style="font-size: 13px;">Novedades</span>
				    				<select id="label-select" name="novedadesnomina">
					                    <option selected>Seleccionar</option>
					                    <option id="ingreso" value="ingreso" >Ingreso</option>
					                    <option id="retiro" value="retiro" >Retiro</option>
					                    <option id="suspecion" value="suspecion" >Suspeción</option>
					                    <option id="permisos" value="permisos" >Permiso</option>
					                    <option id="descuento" value="descuento" >Descuento</option>
					                    <option id="incapacidades" value="incapacidades" >Incapacidades</option>
					                    <option id="licencia" value="licencia" >Licencias</option>
					                    <option id="vacaciones" value="vacaciones" >Vacaciones</option>
					                    <option id="bonificacion" value="bonificacion" >Bonificación</option>
					                    <option id="horasextra" value="horasextra" >Horas Extra</option>
					                    <option id="fsp" value="fsp" >FSP</option>
					                    <option id="optometria" value="optometria" >Optometria</option>
					                    <option id="prestamos" value="prestamos" >Prestamos</option>
					                    <option id="otros" value="otros" >Otros</option>
					                </select>
						    </div>
				    		</div>
				    		<div id="labels-novedad">
				    			<div id="cont-labels-novedades">

				    				<div id="ingreso" class="div-content-novedad">
				    					<form action="PHP/novedades-php/ingreso.php" method="post">
				    						<div id="ubi-labels-form">
				    							<div id="cont-input-data" class="div-empresa">
						    						<div class="div-fechas">
						    						</div>
						    						<div class="div-fechas">
						    							<span >Empresa</span>
							    						<select class="input-select" name="empresa" id="">
							    							<option selected>Seleccionar</option>
							    							<option value="asesorias">Asesorias</option>
							    							<option value="logistic">Logistic</option>
							    							<option value="transpormax">Transpormax</option>
							    							<option value="servitransporte">Servitransporte</option>
							    						</select>
						    						</div>
						    					</div>
						    					<div id="cont-input-data">
						    						<input class="ipntu-novedades-empleados" type="text" name="nombres" id="id" placeholder="Nombres">
						    						<input class="ipntu-novedades-empleados" type="text" name="apellidos" id="id" placeholder="Apellidos">
						    					</div>
						    					<div id="cont-input-data">
						    						<select class="input-select" name="sexo" id="">
						    							<option selected>Sexo</option>
						    							<option value="femenino">Femenino</option>
						    							<option value="maculino">Masculino</option>
						    						</select>
						    						<select class="input-select" name="tipodocumento" id="">
						    							<option selected>Documento</option>
						    							<option value="cc">CC</option>
						    							<option value="ce">CE</option>
						    							<option value="ppt">PPT</option>
						    							<option value="ps">PS</option>
						    							<option value="pt">PT</option>
						    						</select>
						    					</div>
						    					<div id="cont-input-data">
						    						<input class="ipntu-novedades-empleados" name="dni" type="text" id="id" placeholder="No Documento">
						    						<select class="input-select" name="cargo">
						    							<option selected>Cargo</option>
													   <option value="abogada">Abogada</option>
													   <option value="analista de informacion">Analista de Informacion</option>
													   <option value="analista de facturación">Analista Facturación</option>
													   <option value="analista financiera">Analista Financiera</option>
													   <option value="asistente administrativo">Asistente Administrativo</option>
													   <option value="aux administrativo">Aux Administrativo</option>
													   <option value="aux compras">Aux Compras</option>
													   <option value="aux contable">Aux Contable</option>
													   <option value="aux juridico">Aux Juridico</option>
													   <option value="aux mantenimiento">Aux Mantenimiento</option>
													   <option value="aux operación">Aux Operación</option>
													   <option value="aux planillas">Aux Planillas</option>
													   <option value="aux pqr">Aux Pqr</option>
													   <option value="aux rrhh">Aux Rrhh</option>
													   <option value="aux ruta">Aux Ruta</option>
													   <option value="aux sitpam">Aux Sitpam</option>
													   <option value="conductor">Conductor</option>
													   <option value="conductor bus">Conductor Bus</option>
													   <option value="coordinador">Coordinador</option>
													   <option value="coordinador administrativo">Coordinador Administrativo</option>
													   <option value="coordinador mecanico">Coordinador Mecanico</option>
													   <option value="coordinador operación">Coordinador Operación</option>
													   <option value="coordinador pqr">Coordinador Pqr</option>
													   <option value="coordinador rrhh">Coordinador Rrhh</option>
													   <option value="coordinador st">Coordinador St</option>
													   <option value="coordinadora contable">Coordinadora Contable</option>
													   <option value="coordinadora financiera">Coordinadora Financiera</option>
													   <option value="director financiero">Director Financiero</option>
													   <option value="director juridico">Director Juridico</option>
													   <option value="director rrhh">Director Rrhh</option>
													   <option value="gerente">Gerente</option>
													   <option value="gestora rrhh">Gestora Rrhh</option>
													   <option value="mecanico">Mecanico</option>
													   <option value="oficios varios">Oficios Varios</option>
													</select>
						    					</div>
						    					<div id="cont-input-data">
						    						<select class="input-select" name="nivel" id="">
						    							<option selected>Nivel</option>
						    							<option value="junior">Junior</option>
						    							<option value="master">Master</option>
						    							<option value="senior">Senior</option>
						    						</select>
						    						<select class="input-select" name="estado" id="">
						    							<option selected>Estado</option>
						    							<option value="activo">Activo</option>
						    							<option value="anulado">Anulado</option>
						    							<option value="inactivo">Inactivo</option>
						    						</select>
						    					</div>
						    					<div id="cont-input-data">
						    						<input class="ipntu-novedades-empleados" name="domicilio" type="text" id="id" placeholder="Domicilio">
						    						<select class="input-select" name="tipocontrato" id="">
						    							<option selected>Contrato</option>
						    							<option value="junior">Fijo</option>
						    							<option value="master">Indefinido</option>
						    							<option value="senior">Obra Labor</option>
						    						</select>
						    					</div>
						    					<div id="cont-input-data">
						    						<select class="input-select" name="proyecto">
						    							<option selected>Proyecto</option>
						    							<option value="transversal">Transversal</option>
													   <option value="consorcio">Consorcio</option>
													   <option value="medellin">Medellin</option>
													   <option value="general">General</option>
													   <option value="coo-sucre">Coo-sucre</option>
													   <option value="coo-mag">Coo-mag</option>
													   <option value="caj-bolivar">Caj-bolivar</option>
													   <option value="emssanar">Emssanar</option>
													   <option value="coo-atlantico">Coo-atlantico</option>
													   <option value="coo-cordoba">Coo-cordoba</option>
													   <option value="mut-atlantico">Mut-atlantico</option>
													   <option value="coo-cali">Coo-cali</option>
													   <option value="mut-bolivar">Mut-bolivar</option>
													   <option value="mut-mag">Mut-mag</option>
													   <option value="mut-cordoba">Mut-cordoba</option>
													   <option value="caj-guajira">Caj-guajira</option>
													   <option value="caj-meta">Caj-meta</option>
													   <option value="coo-cauca">Coo-cauca</option>
													</select>
													<div id="fechas-ubi" class="div-fechas">
														<span>Fecha Ingreso</span>
														<input name="fechaingreso" type="date" id="id">
													</div>
						    					</div>
						    					<div id="cont-input-data">
						    						<div class="div-fechas">
						    							<span>Fecha Retiro</span>
						    							<input name="fecharetiro" type="date" id="id">
						    						</div>
						    						<input class="ipntu-novedades-empleados" name="ncuenta" type="text" placeholder="NO Cuenta">
						    					</div>
						    					<div id="cont-input-data">
						    						<select class="input-select" name="tcuenta" id="">
						    							<option selected>T-Cuenta</option>
						    							<option value="ahorros">Ahorros</option>
						    							<option value="corrientes">Corriente</option>
						    							<option value="bajomonto">Bajo Monto</option>
						    						</select>
						    						<input class="ipntu-novedades-empleados" name="banco" type="text" id="id" placeholder="Banco">
						    					</div>
						    					<div id="cont-input-data">
						    						<input class="ipntu-novedades-empleados" name="salariobase" type="number" id="id" placeholder="Salario Base">
						    						<input class="ipntu-novedades-empleados" name="bono" type="number" id="id" placeholder="Bono">
						    					</div>
						    					<div id="cont-input-data">
						    						<div id="fechas-ubi" class="div-fechas"> 
						    							<span>Nacimiento</span>
						    							<input name="fechanacimiento" type="date" id="id">
						    						</div>
						    						<input class="ipntu-novedades-empleados" name="telefono" type="text" id="id" placeholder="Telefono">
						    					</div>
						    					<div id="cont-input-data">
						    						<input class="ipntu-novedades-empleados" name="email" type="text" id="id" placeholder="Correo">
						    						<input class="ipntu-novedades-empleados" name="direccion" type="text" id="id" placeholder="Dirección">
						    					</div>
						    					<div id="cont-input-data">
						    						<input class="ipntu-novedades-empleados" name="arl" type="text" id="id" placeholder="ARL">
						    						<input class="ipntu-novedades-empleados" name="eps" type="text" id="id" placeholder="EPS">
						    					</div>
						    					<div id="cont-input-data">
						    						<input class="ipntu-novedades-empleados" name="afp" type="text" id="id" placeholder="AFP">
						    						<input class="ipntu-novedades-empleados" name="ccf" type="text" id="id" placeholder="CCF">
						    					</div>
				    						</div>
					    					<div id="btn-action-novedad">
								    			<button class="btn-save" type="submit">
								    				<img src="IMG/save.png" alt="">
								    			</button>
								    		</div>
				    					</form>
				    				</div>
				    				
				    				<div id="retiro" class="div-content-novedad">
				    					<form action="PHP/novedades-php/retiro.php" method="post">
				    						<div id="ubi-labels-form">
				    							<div id="cont-input-data">
						    						<input class="ipntu-novedades-empleados" name="dni" type="text" placeholder="Identificación">
						    						<div id="fechas-ubi" class="div-fechas">
						    							<span>Fecha Retiro</span>
						    							<input name="fecharetiro" type="date">
						    						</div>
						    					</div>
						    					<div id="cont-input-data">
						    						<textarea class="ipntu-novedades-empleados" name="motivoretiro" id="" placeholder="Motivo"></textarea>
						    						<select class="input-select" name="estado" id="">
						    							<option selected>Estado</option>
						    							<option value="activo">Activo</option>
						    							<option value="anulado">Anulado</option>
						    							<option value="inactivo">Inactivo</option>
						    						</select>
						    					</div>
				    						</div>
				    						<div id="btn-action-novedad">
									    		<button class="btn-save" type="submit">
									    			<img src="IMG/save.png" alt="">
									    		</button>
									    	</div>
					    				</form>
					    			</div>
					    				
				    				<div id="suspecion" class="div-content-novedad">
				    					<form action="PHP/novedades-php/suspencion.php" method="post">
				    						<div id="ubi-labels-form">
				    							<div id="cont-input-data">
						    						<input class="ipntu-novedades-empleados" name="dni" type="text" placeholder="Identificación">
						    						<div id="fechas-ubi" class="div-fechas">
						    							<span>Fecha Inicio</span>
						    							<input class="ipntu-novedades-empleados" name="fechainicio" type="date">
						    						</div>
						    					</div>
						    					<div id="cont-input-data">
						    						<div id="fechas-ubi" class="div-fechas">
						    							<span>Fecha Fin</span>
						    							<input class="ipntu-novedades-empleados" name="fechafin" type="date" readonly>
						    						</div>
						    						<input class="ipntu-novedades-empleados" name="tiempoendias" type="number" placeholder="Tiempo en días">
						    					</div>
						    					<div id="cont-input-data" >
						    						<textarea class="ipntu-novedades-empleados" id="textarea" name="motivo" placeholder="Motivo"></textarea>
						    					</div>
				    						</div>
					    					<div id="btn-action-novedad">
								    			<button class="btn-save" type="submit">
								    				<img src="IMG/save.png" alt="">
								    			</button>
								    		</div>
					    				</form>
					    			</div>
					    				
				    				<div id="permisos" class="div-content-novedad">
				    					<form action="PHP/novedades-php/permiso.php" method="post">
				    						<div id="ubi-labels-form">
				    							<div id="cont-input-data">
						    						<input class="ipntu-novedades-empleados" name="dni" type="text" placeholder="Identificación">
						    						<select class="ipntu-novedades-empleados" name="permisos" id="">
						    							<option selected>Tipo de permiso</option>
						    							<option value="permiso no re">Permiso no remunera</option>
						    							<option value="permiso remunerado">Permiso remunerado</option>
						    							<option value="dia de familia">Día de la familia</option>
						    							<option value="dia cumpleaños">Día Cumpleaños</option>
						    							<option value="graduacion">Graduación</option>
						    						</select>
						    					</div>
						    					<div id="cont-input-data">
						    						<div id="fechas-ubi" class="div-fechas">
						    							<span>Fecha Inicial</span>
						    							<input class="ipntu-novedades-empleados" name="fechainicio" type="date">
						    						</div>
						    						<div id="fechas-ubi" class="div-fechas">
						    							<span>Fecha Fin</span>
						    							<input class="ipntu-novedades-empleados" name="fechafin" type="date" readonly>
						    						</div>
						    					</div>
						    					<div id="cont-input-data">
						    						<textarea class="ipntu-novedades-empleados" name="motivo" id="" placeholder="Motivo" style="resize: none;"></textarea>
						    						<input class="ipntu-novedades-empleados" name="time" type="number" placeholder="Tiempo (Días)">
						    					</div>
				    						</div>
					    					<div id="btn-action-novedad">
								    			<button class="btn-save" type="submit">
								    				<img src="IMG/save.png" alt="">
								    			</button>
								    		</div>
					    				</form>
					    			</div>
					    				
				    				<div id="descuento" class="div-content-novedad">
				    					<form action="PHP/novedades-php/descuentos.php" method="post">
				    						<div id="ubi-labels-form">
				    							<div id="cont-input-data">
						    						<input class="ipntu-novedades-empleados" name="dni" type="text" placeholder="Identificación">
						    						<input class="ipntu-novedades-empleados" name="monto" type="number" placeholder="Monto">
						    					</div>
						    					<div id="cont-input-data">
						    						<textarea class="ipntu-novedades-empleados" name="concepto" id="" placeholder="Concepto" style="resize: none;"></textarea>
						    						<select class="ipntu-novedades-empleados" name="periodo" id="">
						    							<option selected>Modalidad</option>
						    							<option value="quincenal">Quincenal</option>
						    							<option value="mensual">Mensual</option>
						    						</select>
						    					</div>
						    					<div id="cont-input-data">
						    						<div id="fechas-ubi" class="div-fechas">
						    							<span>Fecha Inicial</span>
						    							<input class="ipntu-novedades-empleados" name="fechainicio" type="date">
						    						</div>
						    						<div id="fechas-ubi" class="div-fechas">
						    							<span>Fecha Final</span>
						    							<input class="ipntu-novedades-empleados" name="fechafin" type="date">
						    						</div>
						    					</div>
				    						</div>
					    					<div id="btn-action-novedad">
								    			<button class="btn-save" type="submit">
								    				<img src="IMG/save.png" alt="">
								    			</button>
								    		</div>
					    				</form>
					    			</div>
					    				
				    				<div id="incapacidades" class="div-content-novedad" >
				    					<form action="PHP/novedades-php/incapacidad.php" method="post">
				    						<div id="ubi-labels-form">
				    							<div id="cont-input-data">
						    						<input class="ipntu-novedades-empleados" name="dni" type="text" placeholder="Identificación">
						    						<select class="ipntu-novedades-empleados" name="tipoincapacidad" id="">
						    							<option selected>T - Incapacidad</option>
						    							<option value="Enfermedad general">Enfermedad General</option>
						    							<option value="Enfermedad laboral">Enfermedad Laboral</option>
						    							<option value="Accidente no laboral">Accidente General</option>
						    							<option value="Accidente laboral">Accidente Laboral</option>
						    						</select>
						    					</div>
						    					<div id="cont-input-data">
						    						<textarea class="ipntu-novedades-empleados" name="descripcion" id="" placeholder="Descripción" style="resize: none;"></textarea>
						    						<input class="ipntu-novedades-empleados" name="time" type="number" placeholder="Tiempo (Días)">
						    					</div>
						    					<div id="cont-input-data">
						    						<select class="ipntu-novedades-empleados" name="estado" id="">
						    							<option selected> Estado </option>
						    							<option value="ig cliente asumido">IG-CLIENTE ASUMIDO</option>
						    							<option value="ig cliente pago">IG-CLIENTE PAGO</option>
						    						</select>
						    						<textarea class="ipntu-novedades-empleados" name="nota" id="" placeholder="Nota" style="resize: none;"></textarea>
						    					</div>
						    					<div id="cont-input-data">
						    						<div id="fechas-ubi" class="div-fechas">
						    							<span>Fecha Inicial</span>
						    							<input class="ipntu-novedades-empleados" name="fechainicio" type="date">
						    						</div>
						    						<div id="fechas-ubi" class="div-fechas">
						    							<span>Fecha Final</span>
						    							<input class="ipntu-novedades-empleados" name="fechafin" type="date" readonly>
						    						</div>
						    					</div>
				    						</div>
					    					<div id="btn-action-novedad">
								    			<button class="btn-save" type="submit">
								    				<img src="IMG/save.png" alt="">
								    			</button>
								    		</div>
					    				</form>
					    			</div>
					    				
				    				<div id="licencia" class="div-content-novedad" >
				    					<form action="PHP/novedades-php/licencias.php" method="post">
				    						<div id="ubi-labels-form">
				    							<div id="cont-input-data">
						    						<input class="ipntu-novedades-empleados" name="dni" type="text" placeholder="Identificación">
						    						<select class="ipntu-novedades-empleados" name="tipolicencia" id="">
						    							<option selected>T - Licencia</option>
						    							<option value="Maternidad">Licencia Maternidad</option>
						    							<option value="Paternidad">Licencia Partenidad</option>
						    						</select>
						    					</div>
						    					<div id="cont-input-data">
						    						<textarea class="ipntu-novedades-empleados" name="descripcion" id="" placeholder="Descripción" style="resize: none;"></textarea>
						    						<input class="ipntu-novedades-empleados" name="time" type="number" placeholder="Tiempo (Días)">
						    					</div>
						    					<div id="cont-input-data">
						    						<div id="fechas-ubi" class="div-fechas">
						    							<span>Fecha Inicial</span>
						    							<input class="ipntu-novedades-empleados" name="fechainicio" type="date">
						    						</div>
						    						<div id="fechas-ubi" class="div-fechas">
						    							<span>Fecha Final</span>
						    							<input class="ipntu-novedades-empleados" name="fechafin" type="date" readonly>
						    						</div>
						    					</div>
				    						</div>
					    					<div id="btn-action-novedad">
								    			<button class="btn-save" type="submit">
								    				<img src="IMG/save.png" alt="">
								    			</button>
								    		</div>
					    				</form>
					    			</div>
					    				
				    				<div id="vacaciones" class="div-content-novedad" >
				    					<form action="PHP/novedades-php/vacaciones.php" method="post">
				    						<div id="ubi-labels-form">
				    							<div id="cont-input-data">
						    						<input class="ipntu-novedades-empleados" name="dni" type="text" placeholder="Identificación">
						    						<select class="ipntu-novedades-empleados" name="modalidad" id="">
						    							<option selected>Modalidad</option>
						    							<option value="pago">Pago</option>
						    							<option value="disfrute">Disfrute</option>
						    						</select>
						    					</div>
						    					<div id="cont-input-data">
						    						<textarea class="ipntu-novedades-empleados" name="descripcion" id="" placeholder="Descripción" style="resize: none;"></textarea>
						    						<input class="ipntu-novedades-empleados" name="time" type="number" placeholder="Tiempo (Días)">
						    					</div>
						    					<div id="cont-input-data">
						    						<div id="fechas-ubi" class="div-fechas">
						    							<span>Fecha Inicial</span>
						    							<input class="ipntu-novedades-empleados" name="fechainicio" type="date">
						    						</div>
						    						<div id="fechas-ubi" class="div-fechas">
						    							<span>Fecha Final</span>
						    							<input class="ipntu-novedades-empleados" name="fechafin" type="date" readonly>
						    						</div>
						    					</div>
				    						</div>
					    					<div id="btn-action-novedad">
									    		<button class="btn-save" type="submit">
									    			<img src="IMG/save.png" alt="">
									    		</button>
									    	</div>
					    				</form>
					    			</div>
					    				
				    				<div id="bonificacion" class="div-content-novedad">
				    					<form action="PHP/novedades-php/bonificaciones.php" method="post">
				    						<div id="ubi-labels-form">
				    							<div id="cont-input-data">
						    						<input class="ipntu-novedades-empleados" name="dni" type="text" placeholder="Identificación">
						    						<select class="ipntu-novedades-empleados" name="tbono" id="">
						    							<option selected>T - Bono</option>
						    							<option value="bonourbano">Urbano</option>
						    							<option value="bonointermunicipal">Intermunicipal</option>
						    						</select>
						    					</div>
						    					<div id="cont-input-data">
						    						<input class="ipntu-novedades-empleados" name="monto" type="number" placeholder="Monto">
						    						<textarea class="ipntu-novedades-empleados" name="nota" id="" placeholder="Nota" style="resize: none;"></textarea>
						    					</div>
				    						</div>
						    				<div id="btn-action-novedad">
								    			<button class="btn-save" type="submit">
								    				<img src="IMG/save.png" alt="">
								    			</button>
								    		</div>
					    				</form>
					    			</div>

					    			<div id="horasextra" class="div-content-novedad">
				    					<form action="PHP/novedades-php/horasextra.php" method="post">
				    						<div id="ubi-labels-form">
				    							<div id="cont-input-data">
						    						<input class="ipntu-novedades-empleados" name="dni" type="text" placeholder="Identificación">
						    						<select class="ipntu-novedades-empleados" name="the" id="">
						    							<option selected>T - Hora Extra</option>
						    							<option value="hedo">HEDO</option>
						    							<option value="heno">HENO</option>
						    							<option value="rn">RN</option>
						    							<option value="rf">RF</option>
						    							<option value="hed df">HED/DF</option>
						    							<option value="hen df">HEN/DF</option>
						    							<option value="rdn f">RND/F</option>
						    							<option value="hd">HD</option>
						    						</select>
						    					</div>
						    					<div id="cont-input-data">
						    						<input class="ipntu-novedades-empleados" name="cantidad" type="number" placeholder="Cantidad">
						    						<div id="fechas-ubi" class="div-fechas">
						    							<span>Fecha</span>
						    							<input class="ipntu-novedades-empleados" name="fecha" type="date">
						    						</div>
						    					</div>
						    					<div id="cont-input-data" >
						    						<textarea class="ipntu-novedades-empleados" id="textarea" name="descripcion" placeholder="Descripción"></textarea>
						    					</div>
				    						</div>
						    				<div id="btn-action-novedad">
								    			<button class="btn-save" type="submit">
								    				<img src="IMG/save.png" alt="">
								    			</button>
								    		</div>
					    				</form>
					    			</div>

					    			<div id="fsp" class="div-content-novedad">
				    					<form action="PHP/novedades-php/retiro.php" method="post">
				    						<div id="ubi-labels-form">
				    							<div id="cont-input-data">
						    						<input class="ipntu-novedades-empleados" name="dni" type="text" placeholder="Identificación">
						    						<input class="ipntu-novedades-empleados" name="monto" type="number" placeholder="Monto">
						    					</div>
				    						</div>
				    						<div id="btn-action-novedad">
									    		<button class="btn-save" type="submit">
									    			<img src="IMG/save.png" alt="">
									    		</button>
									    	</div>
					    				</form>
					    			</div>

					    			<div id="optometria" class="div-content-novedad">
				    					<form action="PHP/novedades-php/optometria.php" method="post">
				    						<div id="ubi-labels-form">
				    							<div id="cont-input-data">
						    						<input class="ipntu-novedades-empleados" name="dni" type="text" placeholder="Identificación">
						    						<input class="ipntu-novedades-empleados" name="monto" type="number" placeholder="Monto">
						    					</div>
				    						</div>
				    						<div id="btn-action-novedad">
									    		<button class="btn-save" type="submit">
									    			<img src="IMG/save.png" alt="">
									    		</button>
									    	</div>
					    				</form>
					    			</div>

					    			<div id="prestamos" class="div-content-novedad">
				    					<form action="PHP/novedades-php/prestamos.php" method="post">
				    						<div id="ubi-labels-form">
				    							<div id="cont-input-data">
						    						<input class="ipntu-novedades-empleados" name="dni" type="text" placeholder="Identificación">
						    						<input class="ipntu-novedades-empleados" name="cuotas" type="number" placeholder="Cuotas">
						    					</div>
						    					<div id="cont-input-data">
						    						<input class="ipntu-novedades-empleados" type="number" name="montoprestamo" placeholder="Monto Prestamo">
						    						<textarea class="ipntu-novedades-empleados" name="nota" id="" placeholder="Nota" style="resize: none;"></textarea>
						    					</div>
				    						</div>
				    						<div id="btn-action-novedad">
									    		<button class="btn-save" type="submit">
									    			<img src="IMG/save.png" alt="">
									    		</button>
									    	</div>
					    				</form>
					    			</div>

					    			<div id="otros" class="div-content-novedad">
				    					<form action="PHP/novedades-php/otros.php" method="post">
				    						<div id="ubi-labels-form">
				    							<div id="cont-input-data">
						    						<input class="ipntu-novedades-empleados" name="dni" type="text" placeholder="Identificación">
						    						<div id="fechas-ubi" class="div-fechas">
						    							<span>Fecha Concepto</span>
						    							<input name="fechaotros" type="date">
						    						</div>
						    					</div>
						    					<div id="cont-input-data">
						    						<input class="ipntu-novedades-empleados" name="montootros" type="number" placeholder="Monto Otros">
						    						<textarea class="ipntu-novedades-empleados" name="descripcion" id="" placeholder="Descripción"></textarea>
						    					</div>
				    						</div>
				    						<div id="btn-action-novedad">
									    		<button class="btn-save" type="submit">
									    			<img src="IMG/save.png" alt="">
									    		</button>
									    	</div>
					    				</form>
					    			</div>
				    			</div>
				    		</div>
				    	</div>
				   </div>


				   <div id="content-data">
					   	<form id="form-tablas" action="" method="" id="">
					   		<div id="cont-consulta">
					   			<div id="consulta-datos">
					   				<!-- <input type="text" name="identificacion" id="input-dni" placeholder="Identificación">
					   				<input type="submit" value="Conusltar" id="btn-consulta"> -->
					   			</div>
					   			<div id="selector-novedad-tabla">
						    		<span style="font-size: 13px;">Novedades</span>
						    		<select id="selector-novedad" name="tablanovedades">
							            <option selected>Seleccionar</option>
							            <option id="ingreso" value="ingreso" >Ingreso</option>
							            <option id="retiro" value="retiro" >Retiro</option>
							            <option id="suspecion" value="suspecion" >Suspeción</option>
							            <option id="permisos" value="permisos" >Permiso</option>
							            <option id="descuento" value="descuento" >Descuento</option>
							            <option id="incapacidades" value="incapacidades" >Incapacidades</option>
							            <option id="licencia" value="licencia" >Licencias</option>
							            <option id="vacaciones" value="vacaciones" >Vacaciones</option>
							            <option id="bonificacion" value="bonificacion" >Bonificación</option>
							            <option id="he" value="he" >Horas Extras</option>
							        </select>
								</div>
					   		</div>

					   		<div id="contenedor-tablas">

					   			<div id="ingreso" class="tabla-consulta-novedades" >
						   			<table>
								    	<thead class="titulo-tabla-resultado">
									        <tr class="fila-titulo-resultado">
									            <th id="menudesplegable">
											            <a href="#" id="icoeye" onclick="toggleMenu(event)"><span class="material-symbols-outlined">visibility_off</span></a>
											            <div id="dropdownMenu" class="dropdown-content">
											                <label><input id="dato1" type="checkbox" onclick="toggleColumnVisibility(event, )" checked> EMPRESA</label>
											                <label><input id="dato2" type="checkbox" onclick="toggleColumnVisibility(event, 2)" checked> NOMBRES</label>
											                <label><input id="dato3" type="checkbox" onclick="toggleColumnVisibility(event, 3)" checked> APELLIDOS</label>
											                <label><input id="dato4" type="checkbox" onclick="toggleColumnVisibility(event, 4)" checked> SEXO</label>
											                <label><input id="dato5" type="checkbox" onclick="toggleColumnVisibility(event, 5)" checked> TIPO DOC</label>
											                <label><input id="dato6" type="checkbox" onclick="toggleColumnVisibility(event, 6)" checked> N°</label>
											                <label><input id="dato7" type="checkbox" onclick="toggleColumnVisibility(event, 7)" checked> CARGO</label>
											                <label><input id="dato8" type="checkbox" onclick="toggleColumnVisibility(event, 8)" checked> NIVEL</label>
											                <label><input id="dato9" type="checkbox" onclick="toggleColumnVisibility(event, 9)" checked> ESTADO</label>
											                <label><input id="dato10" type="checkbox" onclick="toggleColumnVisibility(event, 10)" checked> DOMICILIO</label>
											                <label><input id="dato11" type="checkbox" onclick="toggleColumnVisibility(event, 11)" checked> TIPO CONTRATO</label>
											                <label><input id="dato12" type="checkbox" onclick="toggleColumnVisibility(event, 12)" checked> PROYECTO</label>
											                <label><input id="dato13" type="checkbox" onclick="toggleColumnVisibility(event, 13)" checked> FEHCA INGRESO</label>
											                <label><input id="dato14" type="checkbox" onclick="toggleColumnVisibility(event, 14)" checked> FECHA RETIRO</label>
											                <label><input id="dato15" type="checkbox" onclick="toggleColumnVisibility(event, 15)" checked> MOTIVO RETIRO</label>
											                <label><input id="dato16" type="checkbox" onclick="toggleColumnVisibility(event, 16)" checked> N° CUENTA</label>
											                <label><input id="dato17" type="checkbox" onclick="toggleColumnVisibility(event, 17)" checked> TIPO CUENTA</label>
											                <label><input id="dato18" type="checkbox" onclick="toggleColumnVisibility(event, 18)" checked> BANCO</label>
											                <label><input id="dato19" type="checkbox" onclick="toggleColumnVisibility(event, 19)" checked> FEHCA NACIMIENTO</label>
											                <label><input id="dato20" type="checkbox" onclick="toggleColumnVisibility(event, 20)" checked> TELFONO</label>
											                <label><input id="dato21" type="checkbox" onclick="toggleColumnVisibility(event, 21)" checked> CORREO</label>
											                <label><input id="dato22" type="checkbox" onclick="toggleColumnVisibility(event, 22)" checked> DIRECCION</label>
											                <label><input id="dato23" type="checkbox" onclick="toggleColumnVisibility(event, 23)" checked> ARL</label>
											                <label><input id="dato24" type="checkbox" onclick="toggleColumnVisibility(event, 24)" checked> EPS</label>
											                <label><input id="dato25" type="checkbox" onclick="toggleColumnVisibility(event, 25)" checked> AFP</label>
											                <label><input id="dato26" type="checkbox" onclick="toggleColumnVisibility(event, 26)" checked> CCF</label>
														    <div id="content-close">
														        <a id="closeMenu" href="vistaNovedades.php">Restablecer</a>
											                </div>   	
											            </div>
											    </th>

									            <th id="dato1" class="consulta-Resultado-Datos id">EMPRESA</th>
									            <th id="dato2" class="consulta-Resultado-Datos id">NOMBRES</th>
									            <th id="dato3" class="consulta-Resultado-Datos id">APELLIDOS</th>
									            <th id="dato4" class="consulta-Resultado-Datos id">SEXO</th>
									            <th id="dato5" class="consulta-Resultado-Datos id">TIPO DOC</th>
									            <th id="dato6" class="consulta-Resultado-Datos id">N°</th>
									            <th id="dato7" class="consulta-Resultado-Datos id">CARGO</th>
									            <th id="dato8" class="consulta-Resultado-Datos id">NIVEL</th>
									            <th id="dato9" class="consulta-Resultado-Datos id">ESTADO</th>
									            <th id="dato10" class="consulta-Resultado-Datos id">DOMICILIO</th>
									            <th id="dato11" class="consulta-Resultado-Datos id">TIPO CONTRATO</th>
									            <th id="dato12" class="consulta-Resultado-Datos id">PROYECTO</th>
									            <th id="dato13" class="consulta-Resultado-Datos id">FEHCA INGRESO</th>
									            <th id="dato14" class="consulta-Resultado-Datos id">FECHA RETIRO</th>
									            <th id="dato15" class="consulta-Resultado-Datos id">MOTIVO RETIRO</th>
									            <th id="dato16" class="consulta-Resultado-Datos id">N° CUENTA</th>
									            <th id="dato17" class="consulta-Resultado-Datos id">TIPO CUENTA</th>
									            <th id="dato18" class="consulta-Resultado-Datos id">BANCO</th>
									            <th id="dato19" class="consulta-Resultado-Datos id">FEHCA NACIMIENTO</th>
									            <th id="dato20" class="consulta-Resultado-Datos id">TELFONO</th>
									            <th id="dato21" class="consulta-Resultado-Datos id">CORREO</th>
									            <th id="dato22" class="consulta-Resultado-Datos id">DIRECCION</th>
									            <th id="dato23" class="consulta-Resultado-Datos id">ARL</th>
									            <th id="dato24" class="consulta-Resultado-Datos id">EPS</th>
									            <th id="dato25" class="consulta-Resultado-Datos id">AFP</th>
									            <th id="dato26" class="consulta-Resultado-Datos id">CCF</th>
									        </tr>
									    </thead>
									    <tbody>
									            <?php
									                include("PHP/conexion.php");
									                $query = "SELECT * FROM tablaempleados" ;
									                $resultado = mysqli_query($conn, $query);
									                while ($datos = mysqli_fetch_object($resultado)) {
									                   	echo "<tr class='tb-resultado-datos'>";
									                   	echo "<th id='menudesplegable'></th>";
									                    echo "<th id='dato1' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->empresa) . "</th>";
									                    echo "<th id='dato2' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->nombres) . "</th>";
									                    echo "<th id='dato3' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->apellidos) . "</th>";
									                    echo "<th id='dato4' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->sexo) . "</th>";
									                    echo "<th id='dato5' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->tipoidentificacion) . "</th>";
									                    echo "<th id='dato6' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->identificacion) . "</th>";
									                    echo "<th id='dato7' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->cargo) . "</th>";
									                    echo "<th id='dato8' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->nivel) . "</th>";
									                    echo "<th id='dato9' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->estado) . "</th>";
									                    echo "<th id='dato10' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->domicilio) . "</th>";
									                    echo "<th id='dato11' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->tipocontrato) . "</th>";
									                    echo "<th id='dato12' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->proyecto) . "</th>";
									                    echo "<th id='dato13' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->ingreso) . "</th>";
									                    echo "<th id='dato14' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->retiro) . "</th>";
									                    echo "<th id='dato15' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->motivoretiro) . "</th>";
									                    echo "<th id='dato16' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->ncuenta) . "</th>";
									                    echo "<th id='dato17' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->tipocuenta) . "</th>";
									                    echo "<th id='dato18' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->banco) . "</th>";
									                    echo "<th id='dato19' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->fechanacimiento) . "</th>";
									                    echo "<th id='dato20' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->telefono) . "</th>";
									                    echo "<th id='dato21' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->correo) . "</th>";
									                    echo "<th id='dato22' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->direccion) . "</th>";
									                    echo "<th id='dato23' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->arl) . "</th>";
									                    echo "<th id='dato24' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->eps) . "</th>";
									                    echo "<th id='dato25' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->afp) . "</th>";
									                    echo "<th id='dato26' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->ccf) . "</th>";
									                    echo "</tr>";
									                }
									            ?>
									    </tbody>
								    </table>
						   		</div>

						   		<div id="retiro" class="tabla-consulta-novedades" style="display: none;">
						   			<table>
							    		<thead class="titulo-tabla-resultado">
								            <tr class="fila-titulo-resultado">
								                <th id="dato1" class="consulta-Resultado-Datos id">NOMBRES</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">APELLIDOS</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">TIPO DOC</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">N°</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">FECHA RETIRO</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">MOTIVO</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">ESTADO</th>
								            </tr>
								        </thead>
								        <tbody>
								            <?php
								                include("./PHP/conexion.php");
								                $query = "SELECT * FROM tablaempleados WHERE estado IN('Anulado', 'Inactivo')" ;
								                $resultado = mysqli_query($conn, $query);
								                while ($datos = mysqli_fetch_object($resultado)) {
								                   	echo "<tr class='tb-resultado-datos'>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->nombres) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->apellidos) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->tipoidentificacion) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->identificacion) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->retiro) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->motivoretiro) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->estado) . "</th>";
								                    echo "</tr>";
								                }
								            ?>
								        </tbody>
							    	</table>
						   		</div>

						   		<div id="suspecion" class="tabla-consulta-novedades" style="display: none;">
						   			<table>
							    		<thead class="titulo-tabla-resultado">
								            <tr class="fila-titulo-resultado">
								            	<th id="dato1" class="consulta-Resultado-Datos id">NOMBRES</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">APELLIDOS</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">TIPO DOC</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">N°</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">FECHA INICIO</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">FECHA FIN</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">TIEMPO (DÍAS)</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">MOTIVO</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">ESTADO</th>
								            </tr>
								        </thead>
								        <tbody>
										    <?php
										        include("./PHP/conexion.php");

										        $query = "SELECT  te.nombres,te.apellidos,te.tipoidentificacion,te.identificacion,ns.fechainicio,ns.fechafin,ns.tiempo,ns.motivo,te.estado
										        			FROM tablaempleados te JOIN novedadsuspencion ns ON te.identificacion = ns.identificacion";

										        $resultado = mysqli_query($conn, $query);

										        if (!$resultado) {
										            echo "Error en la consulta: " . mysqli_error($conn);
										            exit;
										        }

										        while ($datos = mysqli_fetch_object($resultado)) {
										            echo "<tr class='tb-resultado-datos'>";
										            echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->nombres) . "</th>";
										            echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->apellidos) . "</th>";
										            echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->tipoidentificacion) . "</th>";
										            echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->fechainicio) . "</th>";
										            echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->fechafin) . "</th>";
										            echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->tiempo) . "</th>";
										            echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->motivo) . "</th>";
										            echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->estado) . "</th>";
										            echo "</tr>";
										        }
										    ?>
										</tbody>

							    	</table>
						   		</div>

						   		<div id="permisos" class="tabla-consulta-novedades" style="display: none;">
						   			<table>
							    		<thead class="titulo-tabla-resultado">
								            <tr class="fila-titulo-resultado">

								                <th id="dato1" class="consulta-Resultado-Datos id">NOMBRES</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">APELLIDOS</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">TIPO DOC</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">N°</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">TIPO DE PERMISO</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">FECHA INICIO</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">FECHA FIN</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">MOTIVO</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">TIEMPO (DÍAS)</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">ESTADO</th>
								            </tr>
								        </thead>
								        <tbody>
								            <?php
								                include("./PHP/conexion.php");
								                $query = "SELECT
								                te.nombres,
								                te.apellidos,
								                te.tipoidentificacion,
								                te.identificacion,
								                te.estado,
								                np.tipopermiso,
								                np.fechainicio,
								                np.fechafin,
								                np.motivo,
								                np.tiempo
								                
										        FROM tablaempleados te 
										        JOIN novedadpermiso np ON te.identificacion = np.identificacion";

								                $resultado = mysqli_query($conn, $query);
								                while ($datos = mysqli_fetch_object($resultado)) {
								                   	echo "<tr class='tb-resultado-datos'>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->nombres) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->apellidos) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->tipoidentificacion) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->identificacion) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->tipopermiso) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->fechainicio) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->fechafin) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->motivo) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->tiempo) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->estado) . "</th>";
								                    echo "</tr>";
								                }
								            ?>
								        </tbody>
							    	</table>
						   		</div>

						   		<div id="descuento" class="tabla-consulta-novedades" style="display: none;">
						   			<table>
							    		<thead class="titulo-tabla-resultado">
								            <tr class="fila-titulo-resultado">
								                <th id="dato1" class="consulta-Resultado-Datos id">NOMBRES</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">APELLIDOS</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">TIPO DOC</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">N°</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">ESTADO</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">MONTO</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">CONCEPTO</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">MODALIDAD</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">FECHA INICIO</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">FECHA FIN</th>
								            </tr>
								        </thead>
								        <tbody>
								            <?php
								                include("./PHP/conexion.php");
								                $query = "SELECT
								                te.nombres,
								                te.apellidos,
								                te.tipoidentificacion,
								                te.identificacion,
								                te.estado,
								                nd.monto,
								                nd.concepto,
								                nd.periodo,
								                nd.fechainicio,
								                nd.fechafin
								                
										        FROM tablaempleados te 
										        JOIN novedaddescuento nd ON te.identificacion = nd.identificacion";

								                $resultado = mysqli_query($conn, $query);
								                while ($datos = mysqli_fetch_object($resultado)) {
								                   	echo "<tr class='tb-resultado-datos'>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->nombres) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->apellidos) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->tipoidentificacion) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->identificacion) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->estado) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->monto) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->concepto) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->periodo) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->fechainicio) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->fechafin) . "</th>";
								                    echo "</tr>";
								                }
								            ?>
								        </tbody>
							    	</table>
						   		</div>

						   		<div id="incapacidades" class="tabla-consulta-novedades" style="display: none;">
						   			<table>
							    		<thead class="titulo-tabla-resultado">
								            <tr class="fila-titulo-resultado">
								                <th id="dato1" class="consulta-Resultado-Datos id">NOMBRES</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">APELLIDOS</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">TIPO DOC</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">N°</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">ESTADO</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">TIPO DE INCAPACIDAD</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">DESCRIPCIÓN</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">TIEMPO (DÍAS)</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">ESTADO</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">NOTA</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">FECHA INICIO</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">FECHA FIN</th>
								                <th id="dato1" class="consulta-Resultado-Datos id"></th>
								            </tr>
								        </thead>
								        <tbody>
								        	<form action="" method="post">
								        		<?php
									                include("./PHP/conexion.php");
									                $query = "SELECT
									                te.nombres,
									                te.apellidos,
									                te.tipoidentificacion,
									                te.identificacion,
									                te.estado,
									                ni.tipoincapacidad,
									                ni.descripcion,
									                ni.tiempo,
									                ni.estadopago,
									                ni.nota,
									                ni.fechainicio,
									                ni.fechafin
									                
											        FROM tablaempleados te 
											        JOIN novedadincapacidad ni ON te.identificacion = ni.identificacion";

									                $resultado = mysqli_query($conn, $query);
									                while ($datos = mysqli_fetch_object($resultado)) {

									                   	echo "<tr class='tb-resultado-datos'>";
									                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->nombres) . "</th>";
									                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->apellidos) . "</th>";
									                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->tipoidentificacion) . "</th>";
									                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->identificacion) . "</th>";
									                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->estado) . "</th>";
									                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->tipoincapacidad) . "</th>";
									                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->descripcion) . "</th>";
									                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->tiempo) . "</th>";
									                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->estadopago) . "</th>";
									                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->nota) . "</th>";
									                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->fechainicio) . "</th>";
									                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->fechafin) . "</th>";
									                    echo "<th >";
									                    echo "<input id='btn-actualizar-incapacidad' type='submit' value='Guardar'>";
									                    echo "</th>";
									                    echo "</tr>";
									                }
									            ?>
								        	</form>
								        </tbody>
							    	</table>
						   		</div>

						   		<div id="licencia" class="tabla-consulta-novedades" style="display: none;">
						   			<table>
							    		<thead class="titulo-tabla-resultado">
								            <tr class="fila-titulo-resultado">
								            	<th id="dato1" class="consulta-Resultado-Datos id">EMPRESA</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">NOMBRES</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">APELLIDOS</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">TIPO DOC</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">N°</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">ESTADO</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">TIPO DE LICENCIA</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">DESCRIPCIÓN</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">TIEMPO (DÍAS)</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">FECHA INICIO</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">FECHA FIN</th>
								            </tr>
								        </thead>
								        <tbody>
								            <?php
								                include("./PHP/conexion.php");
								                $query = "SELECT
								                te.empresa,
								                te.nombres,
								                te.apellidos,
								                te.tipoidentificacion,
								                te.identificacion,
								                te.estado,
								                nl.tipolicencia,
								                nl.descripcion,
								                nl.tiempo,
								                nl.fechainicio,
								                nl.fechafin
								                
										        FROM tablaempleados te 
										        JOIN novedadlicencias nl ON te.identificacion = nl.identificacion";

								                $resultado = mysqli_query($conn, $query);
								                while ($datos = mysqli_fetch_object($resultado)) {
								                   	echo "<tr class='tb-resultado-datos'>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->nombres) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->apellidos) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->tipoidentificacion) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->identificacion) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->estado) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->tipolicencia) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->descripcion) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->tiempo) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->fechainicio) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->fechafin) . "</th>";
								                    echo "</tr>";
								                }
								            ?>
								        </tbody>
							    	</table>
							    </div>

						   		<div id="vacaciones" class="tabla-consulta-novedades" style="display: none;">
						   			<table>
							    		<thead class="titulo-tabla-resultado">
								            <tr class="fila-titulo-resultado">
								            	<th id="dato1" class="consulta-Resultado-Datos id">EMPRESA</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">NOMBRES</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">APELLIDOS</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">TIPO DOC</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">N°</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">ESTADO</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">MODALIDAD</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">DESCRIPCIÓN</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">TIEMPO (DÍAS)</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">FECHA INICIO</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">FECHA FIN</th>
								            </tr>
								        </thead>
								        <tbody>
								            <?php
								                include("./PHP/conexion.php");
								                $query = "SELECT
								                te.empresa,
								                te.nombres,
								                te.apellidos,
								                te.tipoidentificacion,
								                te.identificacion,
								                te.estado,
								                nv.modalidad,
								                nv.descripcion,
								                nv.tiempo,
								                nv.fechainicio,
								                nv.fechafin
								                
										        FROM tablaempleados te 
										        JOIN novedadvacaciones nv ON te.identificacion = nv.identificacion";

								                $resultado = mysqli_query($conn, $query);
								                while ($datos = mysqli_fetch_object($resultado)) {
								                   	echo "<tr class='tb-resultado-datos'>";
								                   	echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->empresa) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->nombres) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->apellidos) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->tipoidentificacion) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->identificacion) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->estado) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->modalidad) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->descripcion) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->tiempo) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->fechainicio) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->fechafin) . "</th>";
								                    echo "</tr>";
								                }
								            ?>
								        </tbody>
							    	</table>
							    	
						   		</div>

						   		<div id="bonificacion" class="tabla-consulta-novedades" style="display: none;">
						   			<table>
							    		<thead class="titulo-tabla-resultado">
								            <tr class="fila-titulo-resultado">
								            	<th id="dato1" class="consulta-Resultado-Datos id">EMPRESA</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">NOMBRES</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">APELLIDOS</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">TIPO DOC</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">N°</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">ESTADO</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">TIPO DE BONO</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">MONTO</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">NOTA</th>
								            </tr>
								        </thead>
								        <tbody>
								            <?php
								                include("./PHP/conexion.php");
								                $query = "SELECT
								                te.empresa,
								                te.nombres,
								                te.apellidos,
								                te.tipoidentificacion,
								                te.identificacion,
								                te.estado,
								                nb.tipobono,
								                nb.monto,
								                nb.nota
								                
										        FROM tablaempleados te 
										        JOIN novedadbono nb ON te.identificacion = nb.identificacion";

								                $resultado = mysqli_query($conn, $query);
								                while ($datos = mysqli_fetch_object($resultado)) {
								                   	echo "<tr class='tb-resultado-datos'>";
								                   	echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->empresa) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->nombres) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->apellidos) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->tipoidentificacion) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->identificacion) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->estado) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->tipobono) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->monto) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->nota) . "</th>";
								                }
								            ?>
								        </tbody>
							    	</table>
						   		</div>

						   		<div id="he" class="tabla-consulta-novedades" style="display: none;">
						   			<table>
							    		<thead class="titulo-tabla-resultado">
								            <tr class="fila-titulo-resultado">
								            	<th id="dato1" class="consulta-Resultado-Datos id">EMPRESA</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">NOMBRES</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">APELLIDOS</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">TIPO DOC</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">N°</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">ESTADO</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">TIPO HE</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">FECHA</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">CANTIDAD</th>
								                <th id="dato1" class="consulta-Resultado-Datos id">DESCRIPCION</th>
								            </tr>
								        </thead>
								        <tbody>
								            <?php
								                include("./PHP/conexion.php");
								                $query = "SELECT
								                te.empresa,
								                te.nombres,
								                te.apellidos,
								                te.tipoidentificacion,
								                te.identificacion,
								                te.estado,
								                nhe.tipohoraextra,
								                nhe.fecha,
								                nhe.cantidad,
								                nhe.descripcion
								                
										        FROM tablaempleados te 
										        JOIN novedadhoraextra nhe ON te.identificacion = nhe.identificacion";

								                $resultado = mysqli_query($conn, $query);
								                while ($datos = mysqli_fetch_object($resultado)) {
								                   	echo "<tr class='tb-resultado-datos'>";
								                   	echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->empresa) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->nombres) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->apellidos) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->tipoidentificacion) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->identificacion) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->estado) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->tipohoraextra) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->fecha) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->cantidad) . "</th>";
								                    echo "<th id='dato38' class='consulta-Resultado-Datos'>" . htmlspecialchars($datos->descripcion) . "</th>";
								                    echo "</tr>";
								                }
								            ?>
								        </tbody>
							    	</table>
						   		</div>
					   		</div>

					   	</form>
				   </div>

				</div>
			</div>
		</div>
	</div>
	<div id="contenedor_carg">
		<div id="carga"></div>
	</div>
	<script src="../../JS/animacionCarga.js"></script>
   <script>
		document.addEventListener('DOMContentLoaded', (event) => {
			const selectNovedades = document.querySelector('select[name="novedadesnomina"]');
			const divsNovedades = document.querySelectorAll('.div-content-novedad');

			 selectNovedades.addEventListener('change', function() {
			   const selectedValue = this.value;
			        
			   divsNovedades.forEach(div => {
			      if (div.id === selectedValue) {
			         div.style.display = 'block';
			      } else {
			         div.style.display = 'none';
			      }
			   });
			});
		});
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