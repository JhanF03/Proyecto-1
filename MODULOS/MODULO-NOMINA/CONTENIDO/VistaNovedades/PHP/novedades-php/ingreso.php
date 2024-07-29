<?php
include ("../conexion.php");

function udpatenomina($conn) {
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $empresa = strtoupper($_POST['empresa']);
    $proyecto = strtoupper($_POST['proyecto']);
    $dni = strtoupper($_POST['dni']);
    $nombres = strtoupper($_POST['nombres']);
    $apellidos = strtoupper($_POST['apellidos']);
    $nombreCompleto = $nombres . ' ' . $apellidos;
    $cargo = strtoupper($_POST['cargo']);
    $salariobase = $_POST['salariobase'];
    $bono = $_POST['bono'];
    $fechaingreso = $_POST['fechaingreso'];
    $fecharetiro = $_POST['fecharetiro'];
    $ncuenta = strtoupper($_POST['ncuenta']);
    $tcuenta = strtoupper($_POST['tcuenta']);
    $banco = strtoupper($_POST['banco']);

    if ($salariobase < 2600000) {
        $auxt = 162000;
    } else {
        $auxt = null;
    }

    $sql = "INSERT INTO nomina (
        empresa,
        proyecto,
        identificacion,
        nombreapellidos,
        cargo,
        ingreso,
        salariobase,
        auxt,
        bono,
        numerocuenta,
        tipocuenta,
        banco
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    $stmt->bind_param(
        "ssssssddsiss",
        $empresa,
        $proyecto,
        $dni,
        $nombreCompleto,
        $cargo,
        $fechaingreso,
        $salariobase,
        $auxt,
        $bono,
        $ncuenta,
        $tcuenta,
        $banco
    );

    if ($stmt->execute()) {
    } else {
        echo "Error al insertar datos: " . $stmt->error;
    }
    $stmt->close();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $empresa = strtoupper($_POST['empresa']);
    $nombres = strtoupper($_POST['nombres']);
    $apellidos = strtoupper($_POST['apellidos']);
    $sexo = strtoupper($_POST['sexo']);
    $tipodocumento = strtoupper($_POST['tipodocumento']);
    $dni = strtoupper($_POST['dni']);
    $cargo = strtoupper($_POST['cargo']);
    $nivel = strtoupper($_POST['nivel']);
    $estado = strtoupper($_POST['estado']);
    $domicilio = strtoupper($_POST['domicilio']);
    $tipocontrato = strtoupper($_POST['tipocontrato']);
    $salariobase = $_POST['salariobase'];
    $bono = $_POST['bono'];
    $proyecto = strtoupper($_POST['proyecto']);
    $fechaingreso = $_POST['fechaingreso'];
    $fecharetiro = $_POST['fecharetiro'];
    $ncuenta = strtoupper($_POST['ncuenta']);
    $tcuenta = strtoupper($_POST['tcuenta']);
    $banco = strtoupper($_POST['banco']);
    $fechanacimiento = $_POST['fechanacimiento'];
    $telefono = strtoupper($_POST['telefono']);
    $email = strtoupper($_POST['email']);
    $direccion = strtoupper($_POST['direccion']);
    $arl = strtoupper($_POST['arl']);
    $eps = strtoupper($_POST['eps']);
    $afp = strtoupper($_POST['afp']);
    $ccf = strtoupper($_POST['ccf']);
    if (
        empty($empresa) || empty($nombres) || empty($apellidos) || empty($sexo) || empty($tipodocumento) ||
        empty($dni) || empty($cargo) || empty($nivel) || empty($estado) || empty($domicilio) || empty($tipocontrato) ||
        empty($proyecto) || empty($salariobase) || empty($fechaingreso) || empty($fecharetiro) || empty($ncuenta) || empty($tcuenta) ||
        empty($banco) || empty($fechanacimiento) || empty($telefono) || empty($email) || empty($direccion) ||
        empty($arl) || empty($eps) || empty($afp) || empty($ccf)
    ) {
        echo "Todos los campos son obligatorios.";
    } else {
        $sql = "INSERT INTO tablaempleados (
            empresa, nombres, apellidos, sexo,  tipoidentificacion, identificacion, cargo, nivel, estado, domicilio, tipocontrato, proyecto,
            ingreso, retiro, ncuenta,   tipocuenta, banco, salariobase, bono, fechanacimiento, telefono,    correo, direccion, arl, eps, afp, ccf
        ) VALUES (
            ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
        )";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param(
                "sssssssssssssssssssssssssss",
                $empresa, $nombres, $apellidos, $sexo, $tipodocumento, $dni, $cargo, $nivel, $estado, $domicilio,
                $tipocontrato, $proyecto, $fechaingreso, $fecharetiro, $ncuenta, $tcuenta, $banco, $salariobase, $bono,  $fechanacimiento,
                $telefono, $email, $direccion, $arl, $eps, $afp, $ccf
            );

            udpatenomina($conn);

            if ($stmt->execute()) {
                echo "Registro insertado correctamente.";
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
