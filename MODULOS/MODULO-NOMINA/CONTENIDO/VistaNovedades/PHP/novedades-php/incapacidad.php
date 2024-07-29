<?php
include ("../conexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dni = strtoupper(htmlspecialchars($_POST['dni']));
    $tipoincapacidad = strtoupper(htmlspecialchars($_POST['tipoincapacidad']));
    $descripcion = strtoupper(htmlspecialchars($_POST['descripcion']));
    $time = ($_POST['time']);
    $estado = strtoupper(htmlspecialchars($_POST['estado']));
    $nota = strtoupper(htmlspecialchars($_POST['nota']));
    $fechainicio = ($_POST['fechainicio']);
    
    $date = new DateTime($fechainicio);
    $date->modify("+$time days");
    $fechafin = $date->format('Y-m-d');
    
    

    // Verificar que todos los campos estén llenos
    if (empty($dni) || empty($tipoincapacidad) || empty($descripcion) || empty($time) || empty($estado) || empty($nota) || empty($fechainicio) || empty($fechafin)) {
        echo "Todos los campos son obligatorios.";
    } else {
        // Preparar la consulta SQL para insertar los datos
        $sql = "INSERT INTO novedadincapacidad (identificacion, tipoincapacidad, descripcion, tiempo, estadopago, nota, fechainicio, fechafin) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        // Preparar y ejecutar la declaración
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssssssss", $dni, $tipoincapacidad, $descripcion, $time, $estado, $nota, $fechainicio, $fechafin);

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
