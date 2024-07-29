<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Financiera</title>
	<link rel="stylesheet" href="../VistaOrigenDatos/CSS/importeExitoso.css">
</head>
<body>

	<div id="cont-body">
		<div id="ubi-sms">
			<div id="sms-registro-exitoso">
				<?php
				    // Captura el dato específico que está mal (por ejemplo, $trimmedData[10])
				    $datoInvalido = $trimmedData[10];

				    // Muestra el mensaje de error y el dato específico si está disponible
				    if (!empty($datoInvalido)) {
				        echo '<span>¡¡Formato de fecha inválido:!!</span>';
				        echo '<span>' . htmlspecialchars($datoInvalido) . '</span>';
				    }
				?>
			</div>
			<div id="btn-regresar">
				<a href="..//VistaOrigenDatos/Origen.php"><span>Regresar</span></a>
			</div>
		</div>
	</div>

</body>
</html>