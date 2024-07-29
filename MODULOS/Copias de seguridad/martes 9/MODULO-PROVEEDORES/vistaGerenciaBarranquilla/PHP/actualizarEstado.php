<?php
include("conexion.php");
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

foreach ($_POST['gerenciab'] as $id => $gerenciab) {
    $comentario = $_POST['comentario'][$id];

    $update_fields = [];
    $params = [];
    if (!empty($gerenciab) && $gerenciab != "Seleccionar") {
        $update_fields[] = "gerenciabarranquilla = ?";
        $params[] = $gerenciab;
    }
    if (!empty($comentario)) {
        $update_fields[] = "comentariob = ?";
        $params[] = $comentario;
    }

    if (!empty($update_fields)) {
        $params[] = $id;
        $sql = "UPDATE tablaproveedores SET " . implode(", ", $update_fields) . " WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param(str_repeat("s", count($update_fields)) . "i", ...$params);

        if ($stmt->execute()) {
            header("Location: ../aprobador3.php");
        } else {
            echo "Error al actualizar el registro con ID $id: " . $conn->error . "<br>";
        }
        $stmt->close();
    }
}
$conn->close();
?>

