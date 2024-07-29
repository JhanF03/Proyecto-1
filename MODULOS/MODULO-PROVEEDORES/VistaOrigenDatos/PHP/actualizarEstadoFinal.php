<?php
include("conexion.php");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recorrer cada par de id y estadoFinal en $_POST['estadoFinal']
foreach ($_POST['estadoFinal'] as $id => $estadoFinal) {
    // Validar que estadoFinal no esté vacío y no sea "Seleccionar"
    if (!empty($estadoFinal) && $estadoFinal != "Seleccionar") {
        // Preparar la consulta de actualización
        $sql = "UPDATE tablaproveedores SET estadofinal = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            // Asignar los parámetros y ejecutar la consulta
            $stmt->bind_param("si", $estadoFinal, $id);

            if ($stmt->execute()) {
                // Redirigir después de la ejecución exitosa
                header("Location: ../Origen.php");
                exit(); // Asegurarse de detener el script después de la redirección
            } else {
                echo "Error al actualizar el registro con ID $id: " . $stmt->error . "<br>";
            }

            $stmt->close();
        } else {
            echo "Error al preparar la consulta: " . $conn->error . "<br>";
        }
    }
}

$conn->close();
?>

