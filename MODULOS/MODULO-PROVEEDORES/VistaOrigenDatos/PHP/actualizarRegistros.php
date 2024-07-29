<?php
include("conexion.php");
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

foreach ($_POST['agentec'] as $id => $agentec) {
    $estadoagentec = $agentec;
    $comentario = $_POST['comentarioagentec'][$id];

    $update_fields = [];
    $params = [];
    $update_fields[] = "dirfinanciera = 0";

    if (!empty($estadoagentec) && $estadoagentec != "Seleccionar") {
        $update_fields[] = "agentec = ?";
        $params[] = $estadoagentec;
    }
    if (!empty($comentario)) {
        $update_fields[] = "comentarioagentec = ?";
        $params[] = $comentario;
    }

    if (!empty($update_fields)) {
        $params[] = $id;
        $sql = "UPDATE tablaproveedores SET " . implode(", ", $update_fields) . " WHERE id = ?";
        $stmt = $conn->prepare($sql);
        
        // Vincular parámetros dinámicamente según la cantidad de campos a actualizar
        $types = str_repeat("s", count($params) - 1) . "i";
        $stmt->bind_param($types, ...$params);

        if ($stmt->execute()) {
            // Redirigir después de la ejecución exitosa
            header("Location: ../Origen.php");
        } else {
            echo "Error al actualizar el registro con ID $id: " . $conn->error . "<br>";
        }
        $stmt->close();
    }
}
$conn->close();
?>
