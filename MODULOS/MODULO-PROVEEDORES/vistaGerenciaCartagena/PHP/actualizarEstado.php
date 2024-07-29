<?php
include("conexion.php");

// Función para calcular y actualizar valoraprobado, valorapagar, y saldonopago
function actualizarValores($conn, $id, $aprobacionparcial) {
    $sql = "SELECT valortotal, saldonopago FROM tablaproveedores WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($valortotal, $saldonopago);

    if ($stmt->fetch()) {
        $stmt->close();

        // Calcular valores
        $valoraprobado = intval($valortotal) * intval($aprobacionparcial) / 100;
        $valorapagar = $valoraprobado + $saldonopago;
        $saldonoaprobado = $valortotal - $valoraprobado;

        // Actualizar valores
        $sql_update = "UPDATE tablaproveedores SET valorapagar = ?, saldonopago = ? WHERE id = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("ddi", $valorapagar, $saldonoaprobado, $id);

        if ($stmt_update->execute()) {
            $stmt_update->close();
        } else {
            $stmt_update->close();
            echo "Error al actualizar valores para el registro con ID $id: " . $conn->error . "<br>";
        }
    } else {
        $stmt->close();
        echo "Error: No se encontró el registro con ID $id.<br>";
    }
}

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (isset($_POST['gerenciac'])) {
    foreach ($_POST['gerenciac'] as $id => $gerenciac) {
        $comentario = $_POST['comentario'][$id];
        $aprobacionparcial = $_POST['aprobacionparcial'][$id];

        if (!empty($aprobacionparcial)) {
            actualizarValores($conn, $id, $aprobacionparcial);
        }

        $update_fields = [];
        $params = [];

        if (!empty($gerenciac) && $gerenciac != "Seleccionar") {
            $update_fields[] = "gerenciacartagena = ?";
            $params[] = $gerenciac;
        }
        if (!empty($comentario)) {
            $update_fields[] = "comentarioc = ?";
            $params[] = $comentario;
        }
        if (!empty($aprobacionparcial)) {
            $update_fields[] = "aprobacionparcial = ?";
            $params[] = $aprobacionparcial;
        }

        $update_fields[] = "gerenciabarranquilla = 0";

        if (!empty($update_fields)) {
            $params[] = $id;
            $sql = "UPDATE tablaproveedores SET " . implode(", ", $update_fields) . " WHERE id = ?";
            $stmt = $conn->prepare($sql);

            $types = str_repeat("s", count($params) - 1) . "i";
            $stmt->bind_param($types, ...$params);

            if ($stmt->execute()) {
                // No redirigir inmediatamente; manejar después del bucle
            } else {
                echo "Error al actualizar el registro con ID $id: " . $conn->error . "<br>";
            }

            $stmt->close();
        }
    }

    // Redirigir después de procesar todos los registros
    header("Location: ../aprobador2.php");
    exit();
} else {
    header("Location: ../aprobador2.php");
    exit();
}

$conn->close();
?>
