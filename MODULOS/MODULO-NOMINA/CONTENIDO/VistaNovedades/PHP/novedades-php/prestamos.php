<?php 
include("../conexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dni = $_POST['dni'];
    $cuotas = $_POST['cuotas'];
    $montoprestamo = $_POST['montoprestamo'];
    $nota = $_POST['nota'];

    $calculoValorCuota = $montoprestamo / $cuotas;
    $valorcuota = $calculoValorCuota;


    if (empty($dni) || empty($cuotas) || empty($montoprestamo) || empty($nota)) {
        echo "Todos los campos son obligatorios.";
    } else {
        $conn->begin_transaction();

        try {
            $sql = "INSERT INTO novedadprestamos (identificacion, cuotas, capital, valorcuota, nota) VALUES (?, ?, ?, ?, ?)";
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("sddds", $dni, $cuotas, $montoprestamo, $valorcuota, $nota);
                
                if ($stmt->execute()) {
                    $last_insert_id = $stmt->insert_id;
                } else {
                    throw new Exception("Error al insertar en novedadotros: " . $stmt->error);
                }

                $stmt->close();
            } else {
                throw new Exception("Error al preparar la declaración: " . $conn->error);
            }

            $sql_update = "UPDATE nomina SET prestamos = ? WHERE identificacion = ?";
            if ($stmt_update = $conn->prepare($sql_update)) {
                $stmt_update->bind_param("ds", $valorcuota, $dni);

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
