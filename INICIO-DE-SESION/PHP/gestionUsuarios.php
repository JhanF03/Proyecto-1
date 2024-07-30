<?php
include("conexion.php");
session_start(); // Iniciar la sesión

if (isset($_POST['usuario']) && isset($_POST['contrasena'])) {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    if (!empty($usuario) && !empty($contrasena)) {
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE usuario = ? AND contrasena = ?");
        $stmt->bind_param("ss", $usuario, $contrasena);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['usuario'] = $row['usuario'];
            $_SESSION['rol'] = $row['rol'];

            switch ($row['rol']) {
                case 1:
                    header("Location: ../../MODULOS/MODULO-PROVEEDORES/vistaDirFinanciera/aprobador1.php");
                    break;
                case 2:
                    header("Location: ../../MODULOS/MODULO-PROVEEDORES/vistaGerenciaCartagena/aprobador2.php");
                    break;
                case 3:
                    header("Location: ../../MODULOS/MODULO-PROVEEDORES/vistaGerenciaBarranquilla/aprobador3.php");
                    break;
                case 4:
                    header("Location: ../../MODULOS/MODULO-PROVEEDORES/VistaOrigenDatos/Origen.php");
                    break;
                default:
                    header("Location: ../CONTENIDO/error-rol.html");
                    break;
            }
            exit();
        } else {
            header("Location: ../CONTENIDO/pag-extras/error-credenciales.php");
            exit();
        }
        $stmt->close();
    } else {
        header("Location: ../CONTENIDO/pag-extras/error-credenciales.php");
        exit();
    }
} else {
    header("Location: ../CONTENIDO/pag-extras/error-credenciales.php");
    exit();
}
$conn->close();
?>
