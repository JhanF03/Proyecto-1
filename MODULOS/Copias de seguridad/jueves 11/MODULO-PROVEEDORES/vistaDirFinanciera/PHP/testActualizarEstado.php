<?php
include("conexion.php");

// Función para calcular y actualizar valoraprobado
function actualizarValorAprobado($conn, $id, $aprobacionparcial) {
    // Consultar valortotal desde la base de datos
    $sql = "SELECT valortotal FROM tablaproveedores WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($valortotal);

    if ($stmt->fetch()) {
        $stmt->close(); // Cerrar el statement después de la consulta
        // Calcular valoraprobado
        $valoraprobado = intval($valortotal) * intval($aprobacionparcial) / 100;

        // Actualizar valoraprobado en la base de datos
        $sql_update = "UPDATE tablaproveedores SET valoraprobado = ? WHERE id = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("di", $valoraprobado, $id);

        if ($stmt_update->execute()) {
            $stmt_update->close(); // Cerrar el statement después de ejecutar
            return "Valor aprobado actualizado correctamente para el registro con ID $id.";
        } else {
            $stmt_update->close(); // En caso de error, cerrar el statement antes de retornar
            return "Error al actualizar valor aprobado para el registro con ID $id: " . $conn->error;
        }
    } else {
        $stmt->close(); // Cerrar el statement si no se encuentra el registro
        return "Error: No se encontró el registro con ID $id.";
    }
}

// Función para calcular y actualizar valor a pagar
function actualizarValorAPagar($conn, $id) {
    // Consultar valorbase, valorneto y valoraprobado desde la base de datos
    $sql = "SELECT valorbase, valorneto, valoraprobado FROM tablaproveedores WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($valorbase, $valorneto, $valoraprobado);

    if ($stmt->fetch()) {
        $stmt->close(); // Cerrar el statement después de la consulta
        // Calcular descuentos totales y valor a pagar
        $descuentos = intval($valorbase) - intval($valorneto);
        $valorapagar = intval($valoraprobado) - $descuentos;

        // Actualizar valorapagar en la base de datos
        $sql_update = "UPDATE tablaproveedores SET valorapagar = ? WHERE id = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("di", $valorapagar, $id);

        if ($stmt_update->execute()) {
            $stmt_update->close(); // Cerrar el statement después de ejecutar
            return "Valor a pagar actualizado correctamente para el registro con ID $id.";
        } else {
            $stmt_update->close(); // En caso de error, cerrar el statement antes de retornar
            return "Error al actualizar valor a pagar para el registro con ID $id: " . $conn->error;
        }
    } else {
        $stmt->close(); // Cerrar el statement si no se encuentra el registro
        return "Error: No se encontró el registro con ID $id.";
    }
}

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Iterar sobre los datos del formulario
foreach ($_POST['dirfinanciera'] as $id => $dirfinanciera) {
    // Obtener los valores del formulario
    $comentario = $_POST['comentario'][$id];
    $aprobacionparcial = $_POST['aprobacionparcial'][$id];

    // Solo procesar si dirfinanciera tiene un valor o si aprobacionparcial tiene un valor
    if (!empty($dirfinanciera) || !empty($aprobacionparcial)) {
        // Si dirfinanciera tiene un valor y aprobacionparcial está vacío, asignar 100 a aprobacionparcial
        if (!empty($dirfinanciera) && empty($aprobacionparcial)) {
            $aprobacionparcial = 100;
        }

        // Llamar a la función para actualizar valoraprobado si aprobacionparcial no está vacío
        if (!empty($aprobacionparcial)) {
            $update_result = actualizarValorAprobado($conn, $id, $aprobacionparcial);
            echo $update_result . "<br>"; // Mostrar resultado de la actualización de valoraprobado
        }

        // Llamar a la función para actualizar valorapagar
        $update_result_pagar = actualizarValorAPagar($conn, $id);
        echo $update_result_pagar . "<br>"; // Mostrar resultado de la actualización de valorapagar

        // Actualizar aprobacionparcial, comentario y dirfinanciera según la lógica existente
        $update_fields = [];
        $params = [];

        // Siempre actualizar gerenciacartagena a 0 para el registro actual
        $update_fields[] = "gerenciacartagena = 0";

        if (!empty($dirfinanciera)) {
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

        // Preparar la consulta de actualización si hay campos para actualizar
        if (!empty($update_fields)) {
            $params[] = $id;
            $sql = "UPDATE tablaproveedores SET " . implode(", ", $update_fields) . " WHERE id = ?";
            $stmt = $conn->prepare($sql);

            // Enlazar parámetros dinámicamente según la cantidad de campos a actualizar
            $types = str_repeat("s", count($params) - 1) . "i";
            $stmt->bind_param($types, ...$params);

            // Ejecutar la consulta de actualización
            if ($stmt->execute()) {
                // Redirigir a la página deseada después de la ejecución exitosa
                header("Location: ../aprobador1.php");
            } else {
                // Mostrar mensaje de error si la consulta falla
                echo "Error al actualizar el registro con ID $id: " . $conn->error . "<br>";
            }
            $stmt->close();
        }
    }
}

$conn->close();
?>
