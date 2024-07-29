<?php
include ("../conexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dni = strtoupper(htmlspecialchars($_POST['dni']));
    $permisos = strtoupper(htmlspecialchars($_POST['permisos']));
    $fechainicio = htmlspecialchars($_POST['fechainicio']);
    $time = ($_POST['time']);
    $motivo = strtoupper(htmlspecialchars($_POST['motivo']));

    $date = new DateTime($fechainicio);
    $date->modify("+$time days");
    $fechafin = $date->format('Y-m-d');
    
    
    

    // Verificar que todos los campos estén llenos
    if (empty($dni) || empty($permisos) || empty($fechainicio) || empty($fechafin) || empty($motivo) || empty($time)) {
        echo "Todos los campos son obligatorios.";
    } else {
        // Preparar la consulta SQL para insertar los datos
        $sql = "INSERT INTO novedadpermiso (identificacion, tipopermiso, fechainicio, fechafin, tiempo, motivo) VALUES (?, ?, ?, ?, ?, ?)";

        // Preparar y ejecutar la declaración
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssssss", $dni, $permisos, $fechainicio, $fechafin, $time, $motivo);

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
