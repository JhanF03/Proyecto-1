<?php
include("conexion.php");
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dni = $_POST['dni'];

    // Construir la consulta SQL dinámicamente basándote en los campos no vacíos
    $fields_to_update = [];
    $params = [];
    $types = "";

    if (!empty($_POST['salariobase'])) {
        $fields_to_update[] = "salariobase = ?";
        $params[] = $_POST['salariobase'];
        $types .= "d";
    }
    if (!empty($_POST['auxt'])) {
        $fields_to_update[] = "auxt = ?";
        $params[] = $_POST['auxt'];
        $types .= "d";
    }
    if (!empty($_POST['he'])) {
        $fields_to_update[] = "totalsuplementario = ?";
        $params[] = $_POST['he'];
        $types .= "d";
    }
    if (!empty($_POST['optometria'])) {
        $fields_to_update[] = "optometria = ?";
        $params[] = $_POST['optometria'];
        $types .= "d";
    }
    if (!empty($_POST['prestamos'])) {
        $fields_to_update[] = "prestamos = ?";
        $params[] = $_POST['prestamos'];
        $types .= "d";
    }
    if (!empty($_POST['bono'])) {
        $fields_to_update[] = "bono = ?";
        $params[] = $_POST['bono'];
        $types .= "d";
    }
    if (!empty($_POST['bonoextra'])) {
        $fields_to_update[] = "bonoextra = ?";
        $params[] = $_POST['bonoextra'];
        $types .= "d";
    }
    if (!empty($_POST['vacacione'])) {
        $fields_to_update[] = "vacaciones = ?";
        $params[] = $_POST['vacacione'];
        $types .= "d";
    }
    if (!empty($_POST['otros'])) {
        $fields_to_update[] = "otros = ?";
        $params[] = $_POST['otros'];
        $types .= "d";
    }

    $params[] = $_POST['dni'];
    $types .= "d";

    if (!empty($fields_to_update)) {
        $sql = "UPDATE nomina SET " . implode(", ", $fields_to_update) . " WHERE identificacion = ?";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param($types, ...$params);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                echo "Registro actualizado exitosamente.";
            } else {
                echo "No se encontró el registro o no se hizo ninguna actualización.";
            }

            // Cerrar el statement
            $stmt->close();
        } else {
            echo "Error al preparar la consulta: " . $conn->error;
        }
    } else {
        echo "No se proporcionaron campos para actualizar.";
    }

    // Cerrar la conexión
    $conn->close();
}
?>
