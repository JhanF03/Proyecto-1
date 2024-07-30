 <?php 
    $servidor ='localhost';
    $basedatos ='pre-financiera-proveedores';
    $usuario ='root'; // El usuario correcto
    $contrasena =''; // La contraseña correcta

    // Crear la conexión
    $conn = new mysqli($servidor, $usuario, $contrasena, $basedatos);

    // Comprobar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
?>