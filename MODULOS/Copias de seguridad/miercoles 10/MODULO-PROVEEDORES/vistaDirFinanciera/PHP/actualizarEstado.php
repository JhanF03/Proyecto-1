<?php
include("conexion.php");
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

foreach ($_POST['dirfinanciera'] as $id => $dirfinanciera) {
    $comentario = $_POST['comentario'][$id];

    $update_fields = [];
    $params = [];
    
    // Siempre actualizar gerenciacartagena a 0 para el registro actual
    $update_fields[] = "gerenciacartagena = 0";
    
    if (!empty($dirfinanciera) && $dirfinanciera != "Seleccionar") {
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
        
        // Bind parameters dynamically based on the number of update fields
        $types = str_repeat("s", count($params) - 1) . "i";
        $stmt->bind_param($types, ...$params);

        if ($stmt->execute()) {
            header("Location: ../aprobador1.php");
        } else {
            echo "Error al actualizar el registro con ID $id: " . $conn->error . "<br>";
        }
        $stmt->close();
    }
}
$conn->close();
?>
