
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Dashboard</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
	<link rel="stylesheet" href="./CSS/estilos-index.css">
	<link rel="stylesheet" href="./CSS/animacionCarga.css">
	<link rel="stylesheet" href="./CSS/nav-lateral.css">
</head>
<body>
	<div class="cont-body">
		<div class="cont-nav">
			<div id="sub-cont-nav1" class="sub-cont-nav">
				<img src="IMG/Logo.png" style=" width: auto; height: 80%;">
			</div>
			<div id="sub-cont-nav2" class="sub-cont-nav">
			</div>
			<div id="sub-cont-nav3" class="sub-cont-nav">
				<div class="cont-btn-nav3">
					<a href="" style=" font-size: 20px;">Cerrar Sesión</a>	
				</div>
			</div>
		</div>
		<div class="cont-ubi-elementos-principales">
			<nav class="nav-lateral">
				<div id="spaces">
					<img src="IMG/icono-billetera.png" alt="">
					<span>Modulo Nomina</span>
				</div>
				<div id="cont-menu">
					<div class="sidebar">
						<a href="index.php" id="op-main" onclick="showMenu('menu1')">
			               <span id="icon-sidebar" class="material-symbols-outlined">Home</span>
			               <span id="txt-sidebar">Home</span>
			            </a>
			            <a href="CONTENIDO/VistaNovedades/vistaNovedades.php" id="op-main" onclick="showMenu('menu1')">
			               <span id="icon-sidebar" class="material-symbols-outlined">menu_open</span>
			               <span id="txt-sidebar" >Novedades</span>
			            </a>
			            <a href="CONTENIDO//VistaNomina/vistanomina.php" id="op-main" onclick="showMenu('menu1')">
			               <span id="icon-sidebar" class="material-symbols-outlined">payments</span>
			               <span id="txt-sidebar" >Nomina</span>
			            </a>
			            <!-- <div id="menu1" class="submenu">
			               <a href="./OTROS/aprobados.php">
			                  <span id="ico" class="material-symbols-outlined">check_circle</span>
			                  <span id="txt">Aprobaciones</span>
			               </a>
			               <a href="#">
			                  <span id="ico" class="material-symbols-outlined">history</span>
			                  <span id="txt">Historico</span>
			               </a>
			            </div> -->
		        	</div>
				</div>
			</nav>
			<div class="cont-datos">
				<div class="cont-tabla-resultado">
				    
				</div>
			</div>
		</div>
	</div>
	<div id="contenedor_carg">
		<div id="carga"></div>
	</div>
   	<script src="JS/animacionCarga.js"></script>
   	<!-- <script>
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
   	</script> -->
</body>
</html>