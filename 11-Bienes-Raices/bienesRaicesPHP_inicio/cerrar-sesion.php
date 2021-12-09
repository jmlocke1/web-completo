<?php 
require 'includes/funciones.php';
echo "<pre>";
var_dump($_SESSION);
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    var_dump($params);
    var_dump(session_name());
    // setcookie(session_name(), '', time() - 42000,
    //     $params["path"], $params["domain"],
    //     $params["secure"], $params["httponly"]
    // );
}

// Finalmente, destruir la sesión.
//session_destroy();
echo "<pre>";
?>