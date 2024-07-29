<?php
include ("../conexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dni = strtoupper(htmlspecialchars($_POST['dni']));
    $tbono = strtoupper(htmlspecialchars($_POST['tbono']));
    $monto = ($_POST['monto']);
    $nota = strtoupper(htmlspecialchars($_POST['nota']));
    
    

    // Verificar que todos los campos estén llenos
    if (empty($dni) || empty($tbono) || empty($monto) ||  empty($nota)) {
        echo "Todos los campos son obligatorios.";
    } else {
        // Preparar la consulta SQL para insertar los datos
        $sql = "INSERT INTO novedadbono (identificacion, tipobono, monto, nota) VALUES (?, ?, ?, ?)";

        // Preparar y ejecutar la declaración
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssss", $dni, $tbono, $monto, $nota);

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
