<?php 
include("conexion.php");

if (isset($_POST['btn-download'])) {
    $fecha1 = $_POST['fechai'];
    $fecha2 = $_POST['fechaf'];
    $flatfile = $_POST['name-flatfile'];

    if (!empty($fecha1) && !empty($fecha2) && !empty($flatfile)) {
        $flatfile = preg_replace('/[^a-zA-Z0-9_\-]/', '_', $flatfile);
        
        // Verificación inicial en las columnas especificadas
        $verificacion = $conn->query("
            SELECT COUNT(*) as count FROM tablaproveedores 
            WHERE fechacausacion BETWEEN '$fecha1' AND '$fecha2' 
            AND dirfinanciera IN (2, 3, 4) 
            AND gerenciacartagena IN (2, 3, 4) 
            AND gerenciabarranquilla IN (2, 3, 4)
        ");
        
        $verificacion_result = $verificacion->fetch_assoc();
        
        if ($verificacion_result['count'] > 0) {
            // Procede con la descarga del reporte
            header('Content-Type: text/csv; charset=latin1');
            header('Content-Disposition: attachment; filename="'. $flatfile .'.csv"');

            $salida = fopen('php://output', 'w');
            fputcsv($salida, array('Tipo_Documento_Beneficiario','Nit_Beneficiario','Nombre_Beneficiario','Valor_A_Pagar'));

            $archivoPlano = $conn->query("
                SELECT * FROM tablaproveedores 
                WHERE fechacausacion BETWEEN '$fecha1' AND '$fecha2'
                AND dirfinanciera IN (2, 3, 4) 
                AND gerenciacartagena IN (2, 3, 4) 
                AND gerenciabarranquilla IN (2, 3, 4)
            ");
            
            while($result = $archivoPlano->fetch_assoc()) {
                fputcsv($salida, array(
                    $result['tipodoc'],
                    $result['ndocbeneficiariocuentabancaria'],
                    $result['nombredetercero'],
                    $result['valorapagar']
                ));
            }
            fclose($salida);
        } else {
            // Muestra mensaje de no hay aprobaciones
            echo "No hay aprobaciones para la fecha indicada.";
        }
    } else {
        echo "Por favor, complete todos los campos.";
    }
}
?>
