<?php

    function hedo($conn) {
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }
        $sql = "SELECT
                nh.identificacion,
                nh.cantidad,
                n.salariobase
                FROM novedadhoraextra nh
                JOIN nomina n ON nh.identificacion = n.identificacion
                WHERE nh.tipohoraextra    = 'HEDO'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $dni = $row["identificacion"];
                $horasExtras = $row["cantidad"];
                $sueldo = $row["salariobase"];
                $sueldoPorHora = $sueldo / 240;
                $valorHorasExtras = $horasExtras * $sueldoPorHora * 1.25;

                $update_sql = "UPDATE nomina SET hedo125 = $valorHorasExtras, hedo125cant = $horasExtras WHERE identificacion = '$dni'";
                if ($conn->query($update_sql) !== TRUE) {
                    echo "Error actualizando el registro del DNI $dni: " . $conn->error;
                }
            }
            /*echo "Cálculo de horas extras HEDO completado correctamente.";*/
        } else {
            /*echo "No se encontraron datos de horas extras tipo HEDO.";*/
        }
    }

    function heno($conn) {
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }
        $sql = "SELECT
                nh.identificacion,
                nh.cantidad,
                n.salariobase
                FROM novedadhoraextra nh
                JOIN nomina n ON nh.identificacion = n.identificacion
                WHERE nh.tipohoraextra    = 'HENO'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $dni = $row["identificacion"];
                $horasExtras = $row["cantidad"];
                $sueldo = $row["salariobase"];
                $sueldoPorHora = $sueldo / 240;
                $valorHorasExtras = $horasExtras * $sueldoPorHora * 1.75;

                // Actualizar la columna hedo en nomina
                $update_sql = "UPDATE nomina SET heno175 = $valorHorasExtras, heno175cant = $horasExtras WHERE identificacion = '$dni'";
                if ($conn->query($update_sql) !== TRUE) {
                    /*echo "Error actualizando el registro del DNI $dni: " . $conn->error;*/
                }
            }
            /*echo "Cálculo de horas extras HENO completado correctamente.";*/
        } else {
            /*echo "No se encontraron datos de horas extras tipo HENO.";*/
        }
    }

    function rn($conn) {
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }
        $sql = "SELECT
                nh.identificacion,
                nh.cantidad,
                n.salariobase
                FROM novedadhoraextra nh
                JOIN nomina n ON nh.identificacion = n.identificacion
                WHERE nh.tipohoraextra    = 'RN'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $dni = $row["identificacion"];
                $horasExtras = $row["cantidad"];
                $sueldo = $row["salariobase"];
                $sueldoPorHora = $sueldo / 240;
                $valorHorasExtras = $horasExtras * $sueldoPorHora * 0.35;

                $update_sql = "UPDATE nomina SET rn035 = $valorHorasExtras, rn035cant = $horasExtras WHERE identificacion = '$dni'";
                if ($conn->query($update_sql) !== TRUE) {
                    /*echo "Error actualizando el registro del DNI $dni: " . $conn->error;*/
                }
            }
            /*echo "Cálculo de horas extras RN completado correctamente.";*/
        } else {
            /*echo "No se encontraron datos de horas extras tipo RN.";*/
        }
    }

    function rf($conn) {
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }
        $sql = "SELECT
                nh.identificacion,
                nh.cantidad,
                n.salariobase
                FROM novedadhoraextra nh
                JOIN nomina n ON nh.identificacion = n.identificacion
                WHERE nh.tipohoraextra    = 'RF'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $dni = $row["identificacion"];
                $horasExtras = $row["cantidad"];
                $sueldo = $row["salariobase"];
                $sueldoPorHora = $sueldo / 240;
                $valorHorasExtras = $horasExtras * $sueldoPorHora * 0.75;

                $update_sql = "UPDATE nomina SET rf075 = $valorHorasExtras, rf075cant = $horasExtras WHERE identificacion = '$dni'";
                if ($conn->query($update_sql) !== TRUE) {
                    echo "Error actualizando el registro del DNI $dni: " . $conn->error;
                }
            }
            /*echo "Cálculo de horas extras RF completado correctamente.";*/
        } else {
            /*echo "No se encontraron datos de horas extras tipo RF.";*/
        }
    }

    function heddf($conn) {
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }
        $sql = "SELECT
                nh.identificacion,
                nh.cantidad,
                n.salariobase
                FROM novedadhoraextra nh
                JOIN nomina n ON nh.identificacion = n.identificacion
                WHERE nh.tipohoraextra    = 'HEDDF'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $dni = $row["identificacion"];
                $horasExtras = $row["cantidad"];
                $sueldo = $row["salariobase"];
                $sueldoPorHora = $sueldo / 240;
                $valorHorasExtras = $horasExtras * $sueldoPorHora * 2.00;

                $update_sql = "UPDATE nomina SET heddf200 = $valorHorasExtras, heddf200cant = $horasExtras WHERE identificacion = '$dni'";
                if ($conn->query($update_sql) !== TRUE) {
                    echo "Error actualizando el registro del DNI $dni: " . $conn->error;
                }
            }
            echo "Cálculo de horas extras HEDDF completado correctamente.";
        } else {
            /*echo "No se encontraron datos de horas extras tipo HEDDF.";*/
        }
    }

    function hendf($conn) {
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }
        $sql = "SELECT
                nh.identificacion,
                nh.cantidad,
                n.salariobase
                FROM novedadhoraextra nh
                JOIN nomina n ON nh.identificacion = n.identificacion
                WHERE nh.tipohoraextra    = 'HENDF'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $dni = $row["identificacion"];
                $horasExtras = $row["cantidad"];
                $sueldo = $row["salariobase"];
                $sueldoPorHora = $sueldo / 240;
                $valorHorasExtras = $horasExtras * $sueldoPorHora * 2.50;
                $update_sql = "UPDATE nomina SET hendf250 = $valorHorasExtras, hendf250cant = $horasExtras WHERE identificacion = '$dni'";
                if ($conn->query($update_sql) !== TRUE) {
                    echo "Error actualizando el registro del DNI $dni: " . $conn->error;
                }
            }
            /*echo "Cálculo de horas extras HENDF completado correctamente.";*/
        } else {
            /*echo "No se encontraron datos de horas extras tipo HENDF.";*/
        }
    }

    function rndf($conn) {
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }
        $sql = "SELECT
                nh.identificacion,
                nh.cantidad,
                n.salariobase
                FROM novedadhoraextra nh
                JOIN nomina n ON nh.identificacion = n.identificacion
                WHERE nh.tipohoraextra    = 'RNDF'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $dni = $row["identificacion"];
                $horasExtras = $row["cantidad"];
                $sueldo = $row["salariobase"];
                $sueldoPorHora = $sueldo / 240;
                $valorHorasExtras = $horasExtras * $sueldoPorHora * 2.10;

                $update_sql = "UPDATE nomina SET rndf210 = $valorHorasExtras, rndf210cant = $horasExtras WHERE identificacion = '$dni'";
                if ($conn->query($update_sql) !== TRUE) {
                    echo "Error actualizando el registro del DNI $dni: " . $conn->error;
                }
            }
            echo "Cálculo de horas extras RNDF completado correctamente.";
        } else {
            /*echo "No se encontraron datos de horas extras tipo RNDF.";*/
        }
    }

    function hd($conn) {
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        $sql = "SELECT
                nh.identificacion,
                nh.cantidad,
                n.salariobase
                FROM novedadhoraextra nh
                JOIN nomina n ON nh.identificacion = n.identificacion
                WHERE nh.tipohoraextra    = 'HD'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $dni = $row["identificacion"];
                $horasExtras = $row["cantidad"];
                $sueldo = $row["salariobase"];
                $sueldoPorHora = $sueldo / 240;
                $valorHorasExtras = $horasExtras * $sueldoPorHora * 1.75;

                $update_sql = "UPDATE nomina SET hd175 = $valorHorasExtras, hd175cant = $horasExtras WHERE identificacion = '$dni'";
                if ($conn->query($update_sql) !== TRUE) {
                    echo "Error actualizando el registro del DNI $dni: " . $conn->error;
                }
            }
           /* echo "Cálculo de horas extras HD completado correctamente.";*/
        } else {
            /*echo "No se encontraron datos de horas extras tipo HD.";*/
        }
    }

    function sumahe($conn){
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }
        $sql = "SELECT 
                n.identificacion,
                n.hedo125,
                n.heno175,
                n.rn035,
                n.rf075,
                n.heddf200,
                n.hendf250,
                n.rndf210,
                n.hd175
                FROM nomina n";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $dni = $row["identificacion"];
                $hedo = $row["hedo125"];
                $heno = $row["heno175"];
                $rn = $row["rn035"];
                $rf = $row["rf075"];
                $heddf = $row["heddf200"];
                $hendf = $row["hendf250"];
                $rndf = $row["rndf210"];
                $hd = $row["hd175"];
                $sumatoria = $hedo + $heno + $rn + $rf + $heddf + $hendf + $rndf + $hd;
                $totalhe = $sumatoria;

                $update_sql = "UPDATE nomina SET totalsuplementario = $totalhe WHERE identificacion = '$dni'";
                if ($conn->query($update_sql) !== TRUE) {
                    echo "Error actualizando el registro del DNI $dni: " . $conn->error;
                }
            }
            /*echo "Sumatoria de horas extras actualizada correctamente.";*/
        } else {
            /*echo "No se encontraron registros para sumar.";*/
        }
    }

    function calculosuspencion ($conn){
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }
        $sql = "SELECT 
                    ns.identificacion, 
                    ns.tiempo, 
                    te.salariobase,
                    CASE 
                        WHEN te.salariobase < 2600000 THEN 162000 
                        ELSE 0 
                    END AS auxt
                FROM 
                    novedadsuspencion ns
                JOIN 
                    tablaempleados te ON ns.identificacion = te.identificacion";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $dni = $row["identificacion"];
                $salariobase = $row["salariobase"];
                $diassuspencion = $row["tiempo"];
                $auxt = $row["auxt"];

                $calculosalariopordia = $salariobase / 30;
                $salariopordia = $calculosalariopordia;

                $calculoAuxtPorDia = $auxt /30;
                $auxilioTransporte = $calculoAuxtPorDia;

                $calculoDiasNoPagados = $salariopordia * $diassuspencion;
                $diasNoPagados = $calculoDiasNoPagados;

                $calculoDiasNoPagadosAuxt = $auxilioTransporte * $diassuspencion;
                $diasNoPagadosAuxt = $calculoDiasNoPagadosAuxt;

                $calculosalariodiaapagar = $salariobase - $diasNoPagados;
                $salariodiaapagar = $calculosalariodiaapagar;

                $calculosalariodiaapagarAuxt = $auxilioTransporte - $diasNoPagadosAuxt;
                $salariodiaapagarAuxt = $calculosalariodiaapagarAuxt;

                $descuentoSuspencion = $salariodiaapagar + $salariodiaapagarAuxt;

                $update_sql = "UPDATE nomina SET valordescuentosvl = $descuentoSuspencion WHERE identificacion = '$dni'";
                if ($conn->query($update_sql) !== TRUE) {
                    echo "Error actualizando el registro del DNI $dni: " . $conn->error;
                }
            }
        } else {
            echo "Error en la sumatoria de las Horas Extras";
        }
    }

    function totaldevengado ($conn){
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }
        $sql = "SELECT 
                n.identificacion,
                n.bono,
                n.salariobase,
                n.auxt,
                n.totalsuplementario,
                n.bonoextra
                FROM nomina n";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $dni = $row["identificacion"];
                $salariobase = $row["salariobase"];
                $auxt = $row["auxt"];
                $bono = $row["bono"];
                $totalsuplementario = $row["totalsuplementario"];
                $bonoextra = $row["bonoextra"];

                $sumatoria = $salariobase+ $auxt + $bono + $totalsuplementario + $bonoextra;
                $totaldevengado = $sumatoria;

                $update_sql = "UPDATE nomina SET totaldevengado = $totaldevengado WHERE identificacion = '$dni'";
                if ($conn->query($update_sql) !== TRUE) {
                    echo "Error actualizando el registro del DNI $dni: " . $conn->error;
                }
            }
        } else {
            echo "Error en la sumatoria de las Horas Extras";
        }
    }

    function totaldeduccion ($conn){
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }
        $sql = "SELECT 
                n.identificacion,
                n.pension,
                n.salud,
                n.fsp,
                n.optometria,
                n.prestamos,
                n.otros
                FROM nomina n";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $dni = $row["identificacion"];
                $pension = $row["pension"];
                $salud = $row["salud"];
                $fsp = $row["fsp"];
                $optometria = $row["optometria"];
                $prestamos = $row["prestamos"];
                $otros = $row["otros"];

                $sumatoria = $pension+ $salud + $fsp + $optometria + $prestamos + $otros;
                $totaldeducciones = $sumatoria;

                $update_sql = "UPDATE nomina SET totaldeduccion = $totaldeducciones WHERE identificacion = '$dni'";
                if ($conn->query($update_sql) !== TRUE) {
                    echo "Error actualizando el registro del DNI $dni: " . $conn->error;
                }
            }
        } else {
            echo "Error en la sumatoria de las Horas Extras";
        }
    }

    function basesssg ($conn){
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }
        $sql = "SELECT 
                n.identificacion,
                n.salariobase,
                n.totalsuplementario
                FROM nomina n";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $dni = $row["identificacion"];
                $salariobase = $row["salariobase"];
                $totalsuplementario = $row["totalsuplementario"];

                $sumatoria = $salariobase + $totalsuplementario;
                $BaseSSSG = $sumatoria;

                $update_sql = "UPDATE nomina SET basesssg = $BaseSSSG WHERE identificacion = '$dni'";
                if ($conn->query($update_sql) !== TRUE) {
                    echo "Error actualizando el registro del DNI $dni: " . $conn->error;
                }
            }
        } else {
            echo "Error en la sumatoria de las Horas Extras";
        }
    }

    function saludPension ($conn){
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }
        $sql = "SELECT 
                n.identificacion,
                n.basesssg
                FROM nomina n";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $dni = $row["identificacion"];
                $basesssg = $row["basesssg"];

                $calculosalud = $basesssg * 0.04;
                $salud = $calculosalud;
                $calculopension = $basesssg * 0.04;
                $pension = $calculopension;
                

                $update_sql = "UPDATE nomina SET salud = $salud, pension = $pension WHERE identificacion = '$dni'";
                if ($conn->query($update_sql) !== TRUE) {
                    echo "Error actualizando el registro del DNI $dni: " . $conn->error;
                }
            }
        } else {
            echo "Error en la sumatoria de las Horas Extras";
        }
    }

    /*function prestamos ($conn){
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }
        $sql = "SELECT 
                n.identificacion,
                n.basesssg
                FROM nomina n";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $dni = $row["identificacion"];
                $basesssg = $row["basesssg"];

                $calculosalud = $basesssg * 0.04;
                $salud = $calculosalud;
                $calculopension = $basesssg * 0.04;
                $pension = $calculopension;
                

                $update_sql = "UPDATE nomina SET salud = $salud, pension = $pension WHERE identificacion = '$dni'";
                if ($conn->query($update_sql) !== TRUE) {
                    echo "Error actualizando el registro del DNI $dni: " . $conn->error;
                }
            }
        } else {
            echo "Error en la sumatoria de las Horas Extras";
        }
    }*/

    function totalapagar ($conn){
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }
        $sql = "SELECT 
                n.identificacion,
                n.totaldevengado,
                n.totaldeduccion,
                n.vacaciones
                FROM nomina n";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $dni = $row["identificacion"];
                $totaldevengado = $row["totaldevengado"];
                $totaldeduccion = $row["totaldeduccion"];
                $vacaciones = $row["vacaciones"];

                $sumatoria = ($totaldevengado - $totaldeduccion) + $vacaciones;
                $totalapagar = $sumatoria;

                $update_sql = "UPDATE nomina SET totalpagar = $totalapagar WHERE identificacion = '$dni'";
                if ($conn->query($update_sql) !== TRUE) {
                    echo "Error actualizando el registro del DNI $dni: " . $conn->error;
                }
            }
        } else {
            echo "Error en la sumatoria de las Horas Extras";
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['calcular'])) {
        include("conexion.php");

        hedo($conn);
        heno($conn);
        rn($conn);
        rf($conn);
        heddf($conn);
        hendf($conn);
        rndf($conn);
        hd($conn);

        sumahe($conn);
        calculosuspencion($conn);
        totaldevengado($conn);
        basesssg($conn);
        saludPension($conn);
        totaldeduccion($conn);
        totalapagar($conn);


        $conn->close();
    }
?>