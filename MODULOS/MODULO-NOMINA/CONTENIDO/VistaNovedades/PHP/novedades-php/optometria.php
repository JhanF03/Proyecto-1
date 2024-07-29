<?php 
include("../conexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dni = $_POST['dni'];
    $montooptometria = $_POST['monto'];


    if (empty($dni) || empty($montooptometria)) {
        echo "Todos los campos son obligatorios.";
    } else {
        $conn->begin_transaction();

        try {
            $sql = "INSERT INTO novedadoptometria (identificacion, monto) VALUES (?, ?)";
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("id", $dni, $montooptometria);
                
                if ($stmt->execute()) {
                    $last_insert_id = $stmt->insert_id;
                } else {
                    throw new Exception("Error al insertar en novedadotros: " . $stmt->error);
                }

                $stmt->close();
            } else {
                throw new Exception("Error al preparar la declaración: " . $conn->error);
            }

            $sql_update = "UPDATE nomina SET optometria = ? WHERE identificacion = ?";
            if ($stmt_update = $conn->prepare($sql_update)) {
                $stmt_update->bind_param("ds", $montooptometria, $dni);

                if (!$stmt_update->execute()) {
                    throw new Exception("Error al actualizar en nomina: " . $stmt_update->error);
                }

                $stmt_update->close();
            } else {
                throw new Exception("Error al preparar la declaración de actualización: " . $conn->error);
            }

            // Confirmar la transacción
            $conn->commit();
            echo "Registro insertado y actualizado correctamente.";
        } catch (Exception $e) {
            // Revertir la transacción en caso de error
            $conn->rollback();
            echo "Error: " . $e->getMessage();
        }

        $conn->close();
    }
}
?>
