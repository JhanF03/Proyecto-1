<?php 
	include("conexion.php");


	if (isset($_POST['btn-download'])) {
		$fecha1 = $_POST['fechai'];
		$fecha2 = $_POST['fechaf'];
		$flatfile = $_POST['name-flatfile'];
		if (!empty($mouth) || !empty($flatfile)) {
			$flatfile = preg_replace('/[^a-zA-Z0-9_\-]/', '_', $flatfile);
			header('Content-Type:text/csv; charset=latin1');
			header('Content-Disposition: attachment; filename="'. $flatfile .'.csv" ');

			$salida=fopen('php://output', 'w');

			fputcsv($salida, array('Tipo_Documento_Beneficiario','Nit_Beneficiario','Nombre_Beneficiario','Valor_Aprobado'));

			$archivoPlano=$conn->query("SELECT * FROM tablaproveedores WHERE fechacausacion BETWEEN '$fecha1' AND '$fecha2'");
			while($result=$archivoPlano->fetch_assoc()){
				fputcsv($salida, array($result['tipodoc'],
										$result['ndocbeneficiariocuentabancaria'],
										$result['nombredetercero'],
										$result['aprobacionparcial']));
			}
		}
	}

	


 ?>
