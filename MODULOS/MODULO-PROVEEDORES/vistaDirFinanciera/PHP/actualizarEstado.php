<?php
include("conexion.php");
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

foreach ($_POST['dirfinanciera'] as $id => $dirfinanciera) {
    $comentario = $_POST['comentario'][$id];
    $dirfinanciera = $_POST['dirfinanciera'][$id];

    if (!empty($dirfinanciera)) {
        $update_fields = []; // Reiniciar el array de campos a actualizar
        $params = []; // Reiniciar el array de parámetros

        $update_fields[] = "gerenciacartagena = 0";

        if (!empty($dirfinanciera)) {
            $update_fields[] = "dirfinanciera = ?";
            $params[] = $dirfinanciera;
        }
        if (!empty($comentario)) {
            $update_fields[] = "comentariodir = ?";
            $params[] = $comentario;
        }

        if (!empty($update_fields)) {
            $params[] = $id;
            $sql = "UPDATE tablaproveedores SET " . implode(", ", $update_fields) . " WHERE id = ?";
            $stmt = $conn->prepare($sql);

            $types = str_repeat("s", count($params) - 1) . "i";
            $stmt->bind_param($types, ...$params);

            if ($stmt->execute()) {
                // Podrías mover la redirección fuera del bucle si deseas redirigir solo una vez después de procesar todos los registros
                // header("Location: ../aprobador1.php");
            } else {
                echo "Error al actualizar el registro con ID $id: " . $conn->error . "<br>";
            }
            $stmt->close();
        }
    }
}

$conn->close();

// Redirigir después de procesar todos los registros
header("Location: ../aprobador1.php");
?>
