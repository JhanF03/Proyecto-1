<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_FILES['adjuntar'])) {
        die('No se ha adjuntado ningún archivo.');
    }

    $file = $_FILES['adjuntar'];
    $allowedTypes = ['text/csv', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
    
    if (!in_array($file['type'], $allowedTypes)) {
        die('Por favor, suba un archivo CSV o Excel.');
    }

    if ($file['error'] !== UPLOAD_ERR_OK) {
        die('Error al subir el archivo.');
    }

    $filename = $file['tmp_name'];
    $handle = fopen($filename, 'r');
    if ($handle === false) {
        die('No se pudo abrir el archivo.');
    }

    include("conexion.php");
    if (!$conn) {
        die('Conexión a la base de datos fallida.');
    }

    $stmt = $conn->prepare("INSERT INTO tablaproveedores (estado, empresa, conceptoproyeccion, ccosto, eps, fechacausacion, fechaprogramacion, mesdeprogramacion, mesdelserv, nfaccc, referencia, concepto, subconcepto, tipodoc, ndocbeneficiariocuentabancaria, nombredetercero, observacionodetalledelmovimiento, placa, ruta, fechadebitoauto, valorbase, iva, sobretasa, valortotal, conceptoderetencion, baseminimaenpesos,   porcrete, valorrete, valorneto, anticipo, abono, descuento, valorapagar, fechapago, valorpagado, observacion, consumosemanal, cscreferencia) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        if (count($data) < 38) {
            die('Número incorrecto de columnas en el archivo CSV.');
        }

        list($estado, $empresa, $conceptoproyeccion, $ccosto, $eps, $fechacausacion, $fechaprogramacion, $mesdeprogramacion, $mesdelserv, $nfaccc, $referencia, $concepto, $subconcepto, $tipodoc, $ndocbeneficiariocuentabancaria, $nombredetercero, $observacionodetalledelmovimiento, $placa, $ruta, $fechadebitoauto, $valorbase, $iva, $sobretasa, $valortotal, $conceptoderetencion, $baseminimaenpesos, $porcrete, $valorrete, $valorneto, $anticipo, $abono, $descuento, $valorapagar, $fechapago, $valorpagado, $observacion, $consumosemanal, $cscreferencia) = array_map('trim', $data);

        $fechacausacion_dt = DateTime::createFromFormat('Y-m-d', $fechacausacion);
        if ($fechacausacion_dt === false) {
            die('Formato de fecha inválido en fecha de causación: ' . $fechacausacion);
        }

        $fechaprogramacion_dt = DateTime::createFromFormat('Y-m-d', $fechaprogramacion);
        if ($fechaprogramacion_dt === false) {
            die('Formato de fecha inválido en fecha de programación: ' . $fechaprogramacion);
        }

        $fechadebitoauto_dt = DateTime::createFromFormat('Y-m-d', $fechadebitoauto);
        if ($fechadebitoauto_dt === false) {
            die('Formato de fecha inválido en fecha de débito automático: ' . $fechadebitoauto);
        }

        $fechapago_dt = DateTime::createFromFormat('Y-m-d', $fechapago);
        if ($fechapago_dt === false) {
            die('Formato de fecha inválido en fecha de pago: ' . $fechapago);
        }

        $stmt->bind_param('ssssssssssssssssssssssssssssssssssssss',
            $estado, $empresa, $conceptoproyeccion, $ccosto, $eps, $fechacausacion_dt->format('Y-m-d'), $fechaprogramacion_dt->format('Y-m-d'), $mesdeprogramacion, $mesdelserv, $nfaccc, $referencia, $concepto, $subconcepto, $tipodoc, $ndocbeneficiariocuentabancaria, $nombredetercero, $observacionodetalledelmovimiento, $placa, $ruta, $fechadebitoauto_dt->format('Y-m-d'), $valorbase, $iva, $sobretasa, $valortotal, $conceptoderetencion, $baseminimaenpesos, $porcrete, $valorrete, $valorneto, $anticipo, $abono, $descuento, $valorapagar, $fechapago_dt->format('Y-m-d'), $valorpagado, $observacion, $consumosemanal, $cscreferencia);

        if (!$stmt->execute()) {
            die('Error al insertar datos: ' . $stmt->error);
        }
    }

    fclose($handle);
    header("Location: ../contenido/importeExitoso.php");
    exit();
}
?>
