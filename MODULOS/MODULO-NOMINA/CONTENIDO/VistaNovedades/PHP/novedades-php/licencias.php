<?php
include ("../conexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dni = strtoupper(htmlspecialchars($_POST['dni']));
    $tipolicencia = strtoupper(htmlspecialchars($_POST['tipolicencia']));
    $descripcion = strtoupper(htmlspecialchars($_POST['descripcion']));
    $time = ($_POST['time']);
    $fechainicio = ($_POST['fechainicio']);
    
    $date = new DateTime($fechainicio);
    $date->modify("+$time days");
    $fechafin = $date->format('Y-m-d');
    
    

    // Verificar que todos los campos estén llenos
    if (empty($dni) || empty($tipolicencia) || empty($descripcion) ||  empty($time) || empty($fechainicio) || empty($fechafin)) {
        echo "Todos los campos son obligatorios.";
    } else {
        // Preparar la consulta SQL para insertar los datos
        $sql = "INSERT INTO novedadlicencias (identificacion, tipolicencia, descripcion, tiempo, fechainicio, fechafin) VALUES (?, ?, ?, ?, ?, ?)";

        // Preparar y ejecutar la declaración
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssssss", $dni, $tipolicencia, $descripcion, $time, $fechainicio, $fechafin);

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