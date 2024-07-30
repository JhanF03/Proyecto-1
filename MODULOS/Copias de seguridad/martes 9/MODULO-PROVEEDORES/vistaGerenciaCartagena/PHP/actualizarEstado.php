<?php
include("conexion.php");

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

foreach ($_POST['gerenciac'] as $id => $gerenciac) {
    $comentario = $_POST['comentario'][$id];

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

    // Siempre actualizar gerenciabarranquilla a 0
    $update_fields[] = "gerenciabarranquilla = 0";

    if (!empty($update_fields)) {
        $params[] = $id; // Añadir el ID al final de los parámetros
        $sql = "UPDATE tablaproveedores SET " . implode(", ", $update_fields) . " WHERE id = ?";
        $stmt = $conn->prepare($sql);
        
        // Construir la cadena de tipos dinámicamente
        $types = str_repeat("s", count($params) - 1) . "i"; // -1 porque el último es el ID que es entero

        // Unir los parámetros en bind_param
        $bind_params = array_merge([$types], $params);

        // Llamar a bind_param con los parámetros desempaquetados
        call_user_func_array([$stmt, 'bind_param'], $bind_params);

        if ($stmt->execute()) {
            header("Location: ../aprobador2.php");
        } else {
            echo "Error al actualizar el registro con ID $id: " . $conn->error . "<br>";
        }

        $stmt->close();
    }
}

$conn->close();
?>
