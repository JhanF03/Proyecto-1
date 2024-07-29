<?php
include ("../conexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dni = strtoupper(htmlspecialchars($_POST['dni']));
    $tipohoraextra = strtoupper(htmlspecialchars($_POST['the']));
    $cantidad = ($_POST['cantidad']);
    $fecha = ($_POST['fecha']);
    $descripcion = strtoupper(htmlspecialchars($_POST['descripcion']));
    
    

    // Verificar que todos los campos estén llenos
    if (empty($dni) || empty($tipohoraextra) || empty($cantidad) ||  empty($fecha) ||  empty($descripcion)) {
        echo "Todos los campos son obligatorios.";
    } else {
        // Preparar la consulta SQL para insertar los datos
        $sql = "INSERT INTO novedadhoraextra (identificacion, tipohoraextra, fecha, cantidad, descripcion) VALUES (?, ?, ?, ?, ?)";

        // Preparar y ejecutar la declaración
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sssss", $dni, $tipohoraextra, $fecha, $cantidad, $descripcion);

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
