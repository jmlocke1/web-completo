<?php 
require 'includes/funciones.php';
// Primero borramos todos los datos del array
$_SESSION = [];
// Eliminamos las cookies de sesión del navegador
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    // var_dump($params);
    // var_dump(session_name());
    // var_dump(session_id());
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finalmente, destruir la sesión.
session_destroy();
header('Location: /');
?>