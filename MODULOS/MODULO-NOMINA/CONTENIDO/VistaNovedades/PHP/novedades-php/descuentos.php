<?php
include ("../conexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dni = strtoupper(htmlspecialchars($_POST['dni']));
    $monto = ($_POST['monto']);
    $concepto = strtoupper(htmlspecialchars($_POST['concepto']));
    $periodo = strtoupper(htmlspecialchars($_POST['periodo']));
    $fechainicio = ($_POST['fechainicio']);
    $fechafin = ($_POST['fechafin']);
    
    

    // Verificar que todos los campos estén llenos
    if (empty($dni) || empty($monto) || empty($concepto) ||  empty($periodo) || empty($fechainicio) || empty($fechafin)) {
        echo "Todos los campos son obligatorios.";
    } else {
        // Preparar la consulta SQL para insertar los datos
        $sql = "INSERT INTO novedaddescuento (identificacion, monto, concepto, periodo, fechainicio, fechafin) VALUES (?, ?, ?, ?, ?, ?)";

        // Preparar y ejecutar la declaración
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssssss", $dni, $monto, $concepto, $periodo, $fechainicio, $fechafin);

            if ($stmt->execute()) {
                echo "Registro insertado correctamente.";
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error: " . $conn->error;
        }
    }

    $conn->close();
}
?>
