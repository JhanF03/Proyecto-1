<?php
include("conexion.php");

function actualizarValores($conn, $id, $aprobacionparcial) {
    $sql = "SELECT valorapagar, saldonopago FROM tablaproveedores WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($convalorapagar, $consaldonopago);
    
    if ($stmt->fetch()) {
        $stmt->close();
        $poraprobado = intval($aprobacionparcial);

        $vaprobado = ($convalorapagar * $poraprobado) / 100;
        $vnoaprobado = $convalorapagar - $vaprobado;
        $UpdateSaldoNoPagado = $vnoaprobado + $consaldonopago;

        $sql_update = "UPDATE tablaproveedores SET valorapagar = ?, saldonopago = ? WHERE id = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("ddi", $vaprobado, $UpdateSaldoNoPagado, $id);

        if ($stmt_update->execute()) {
            $stmt_update->close();
            return "Valores actualizados correctamente para el registro con ID $id.";
        } else {
            $stmt_update->close();
            return "Error al actualizar valores para el registro con ID $id: " . $conn->error;
        }
    } else {
        $stmt->close();
        return "Error: No se encontró el registro con ID $id.";
    }
}

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (isset($_POST['gerenciab'])) {
    foreach ($_POST['gerenciab'] as $id => $gerenciab) {
        $comentario = $_POST['comentario'][$id];
        $aprobacionparcial = $_POST['aprobacionparcial'][$id] ?? null;

        if (!empty($aprobacionparcial)) {
            $update_result = actualizarValores($conn, $id, $aprobacionparcial);
            echo $update_result . "<br>";
        }

        $update_fields = [];
        $params = [];
        $param_types = '';

        if (!empty($gerenciab) && $gerenciab != "Seleccionar") {
            $update_fields[] = "gerenciabarranquilla = ?";
            $params[] = $gerenciab;
            $param_types .= 's';
        }
        if (!empty($comentario)) {
            $update_fields[] = "comentariob = ?";
            $params[] = $comentario;
            $param_types .= 's';
        }

        if (!empty($update_fields)) {
            $params[] = $id;
            $param_types .= 'i';
            $sql = "UPDATE tablaproveedores SET " . implode(", ", $update_fields) . " WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param($param_types, ...$params);

            if ($stmt->execute()) {
                // No redirigir inmediatamente
            } else {
                echo "Error al actualizar el registro con ID $id: " . $conn->error . "<br>";
            }
            $stmt->close();
        }
    }
    header("Location: ../aprobador3.php");
    exit();
} else {
    header("Location: ../aprobador3.php");
    exit();
}

$conn->close();
?>