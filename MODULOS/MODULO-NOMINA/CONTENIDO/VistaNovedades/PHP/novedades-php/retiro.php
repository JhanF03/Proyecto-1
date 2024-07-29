<?php
include ("../conexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dni = strtoupper($_POST['dni']);
    $fecharetiro = $_POST['fecharetiro'];
    $motivoretiro = strtoupper($_POST['motivoretiro']);
    $estadoretiro = strtoupper($_POST['estadoretiro']);

    // Verificar que todos los campos estén llenos
    if (empty($dni) || empty($fecharetiro) || empty($motivoretiro) || empty($estadoretiro)) {
        echo "Todos los campos son obligatorios.";
    } else {
        // Preparar la consulta SQL para actualizar los datos
        $sql = "UPDATE tablaempleados SET retiro = ?, motivoretiro = ?, estado = ? WHERE identificacion = ?";

        // Preparar y ejecutar la declaración
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssss", $fecharetiro, $motivoretiro, $estadoretiro, $dni);

            if ($stmt->execute()) {
                echo "Registro actualizado correctamente.";
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error: " . $conn->error;
        }
    }

    $conn->close();
}
?>
