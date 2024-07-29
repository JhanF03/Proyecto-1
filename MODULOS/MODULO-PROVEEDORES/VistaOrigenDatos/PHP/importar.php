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

    $stmt = $conn->prepare("INSERT INTO tablaproveedores (empresa, conceptoproyeccion, ccosto, eps, fechacausacion, fechaprogramacion, mesdeprogramacion, mesdelserv, nfaccc, referencia, concepto, subconcepto, tipodoc, ndocbeneficiariocuentabancaria, nombredetercero, observacionodetalledelmovimiento, placa, ruta, fechadebitoauto, valorbase, iva, sobretasa, valortotal, conceptoderetencion, baseminimaenpesos, porcrete, valorrete, valorneto, anticipo, abono, descuento, valorapagar, fechapago, valorpagado, observacion, consumosemanal, cscreferencia) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Saltar la primera línea si contiene los encabezados
    fgetcsv($handle, 1000, ";");

    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
        if (count($data) != 37) {
            die('Número incorrecto de columnas en el archivo CSV en la línea: ' . json_encode($data));
        }

        // Usar una variable intermedia para array_map
        $trimmedData = array_map('trim', $data);
        
        // Verificar que las fechas no estén vacías antes de crear el objeto DateTime
        if (empty($trimmedData[4]) || empty($trimmedData[5]) || empty($trimmedData[18]) || empty($trimmedData[32])) {
            header("Location: ../../OTROS/errorformatofecha.php");
            exit;
            /*die('Formato de fecha inválido en una de las fechas.');*/
        }
        $fechacausacion_dt = DateTime::createFromFormat('d/m/Y', $trimmedData[4])->format('Y-m-d');
        if ($fechacausacion_dt === false) {
            $errorMessage = 'Formato de fecha inválido en fecha de causación: ' . $trimmedData[4];
            header("Location: ../../OTROS/errorformatofecha.php" . urlencode($errorMessage));
            exit;
            /*die('Formato de fecha inválido en fecha de causación: ' . $trimmedData[10]);*/
        }
        $fechaprogramacion_dt = DateTime::createFromFormat('d/m/Y', $trimmedData[5])->format('Y-m-d');
        if ($fechaprogramacion_dt === false) {
            $errorMessage = 'Formato de fecha inválido en fecha de causación: ' . $trimmedData[5];
            header("Location: ../../OTROS/errorformatofecha.php" . urlencode($errorMessage));
            exit;
            /*die('Formato de fecha inválido en fecha de programación: ' . $trimmedData[11]);*/
        }
        $fechadebitoauto_dt = DateTime::createFromFormat('d/m/Y', $trimmedData[18])->format('Y-m-d');
        if ($fechadebitoauto_dt === false) {
            $errorMessage = 'Formato de fecha inválido en fecha de causación: ' . $trimmedData[18];
            header("Location: ../../OTROS/errorformatofecha.php" . urlencode($errorMessage));
            exit;
            /*die('Formato de fecha inválido en fecha de débito automático: ' . $trimmedData[24]);*/
        }
        $fechapago_dt = DateTime::createFromFormat('d/m/Y', $trimmedData[32])->format('Y-m-d');
        if ($fechapago_dt === false) {
            $errorMessage = 'Formato de fecha inválido en fecha de causación: ' . $trimmedData[32];
            header("Location: ../../OTROS/errorformatofecha.php" . urlencode($errorMessage));
            exit;
            /*die('Formato de fecha inválido en fecha de pago: ' . $trimmedData[38]);*/
        }
        $stmt->bind_param('sssssssssssssssssssssssssssssssssssss',
            $trimmedData[0], $trimmedData[1], $trimmedData[2], $trimmedData[3], $fechacausacion_dt, 
            $fechaprogramacion_dt, $trimmedData[6], $trimmedData[7], $trimmedData[8], $trimmedData[9],
            $trimmedData[10], $trimmedData[11], $trimmedData[12], $trimmedData[13], $trimmedData[14], 
            $trimmedData[15], $trimmedData[16], $trimmedData[17], $fechadebitoauto_dt, $trimmedData[19], 
            $trimmedData[20], $trimmedData[21], $trimmedData[22], $trimmedData[23], $trimmedData[24],
            $trimmedData[25], $trimmedData[26], $trimmedData[27], $trimmedData[28], $trimmedData[29],
            $trimmedData[30], $fechapago_dt, $trimmedData[32], $trimmedData[33], $trimmedData[34], 
            $trimmedData[35], $trimmedData[36]
        );

        if (!$stmt->execute()) {
            /*die('Error al insertar datos: ' . $stmt->error);*/
            $errorMessage = 'Error al insertar datos: ' . $stmt->error;
            header("Location: ../../OTROS/errorDesconocido.php" . urlencode($errorMessage));
            exit;
        }
    }

    fclose($handle);
    header("Location: ../../OTROS/importeExitoso.php");
    exit();
}
?>