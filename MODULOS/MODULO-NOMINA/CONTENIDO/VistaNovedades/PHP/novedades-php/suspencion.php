<?php
include ("../conexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dni = strtoupper(htmlspecialchars($_POST['dni']));
    $fechainicio = htmlspecialchars($_POST['fechainicio']);
    $tiempoendias = htmlspecialchars($_POST['tiempoendias']);

    $date = new DateTime($fechainicio);
    $date->modify("+$tiempoendias days");
    $fechafin = $date->format('Y-m-d');
    
    $motivo = strtoupper(htmlspecialchars($_POST['motivo']));

    // Verificar que todos los campos estén llenos
    if (empty($dni) || empty($fechainicio) || empty($tiempoendias) || empty($motivo)) {
        echo "Todos los campos son obligatorios.";
    } else {
        // Preparar la consulta SQL para insertar los datos
        $sql = "INSERT INTO novedadsuspencion (identificacion, fechainicio, fechafin, tiempo, motivo) VALUES (?, ?, ?, ?, ?)";

        // Preparar y ejecutar la declaración
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sssss", $dni, $fechainicio, $fechafin, $tiempoendias, $motivo);

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
