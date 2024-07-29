<?php
    session_start();
    $_SESSION = array();

    // Si se desea destruir la sesión completamente, también se debe destruir la cookie de sesión.
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    // Finalmente, destruir la sesión.
    session_destroy();

    // Redirigir al usuario a la página de inicio de sesión
    header("Location: ../../../../INICIO-DE-SESION/index.HTML");
    exit;
?>