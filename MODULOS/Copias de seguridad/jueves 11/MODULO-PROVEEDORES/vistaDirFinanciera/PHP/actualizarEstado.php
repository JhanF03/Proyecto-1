<?php
include("conexion.php");
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

foreach ($_POST['dirfinanciera'] as $id => $dirfinanciera) {
    $comentario = $_POST['comentario'][$id];
    $aprobacionparcial = $_POST['aprobacionparcial'][$id]; // Campo aprobacionparcial

    // Obtener el valor total para el cálculo de valoraprobado (reemplaza esto con tu lógica para obtener $valorT)
    $valorT = $datos->valortotal; // Asegúrate de obtener correctamente el valor total para el cálculo

    // Calcular valoraprobado basado en aprobacionparcial y valorT
    $valoraprobado = $valorT * $aprobacionparcial / 100;

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
    if (!empty($aprobacionparcial)) {
        $update_fields[] = "aprobacionparcial = ?";
        $params[] = $aprobacionparcial;
    }
    if (!empty($valoraprobado)) {
        $update_fields[] = "valoraprobado = ?";
        $params[] = $valoraprobado;
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
