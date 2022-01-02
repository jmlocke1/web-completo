<?php 
function verSession() {
    
    var_dump($_SESSION);
    var_dump(session_name());
    var_dump(session_id());
}
require 'includes/funciones.php';
echo "<pre>";
echo "<h2>Cerrar otra sesión desde una distinta, por ejemplo, de administrador</h2>";
var_dump($_SESSION);
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    var_dump($params);
    var_dump(session_name());
    var_dump(session_id());
    // setcookie(session_name(), '', time() - 42000,
    //     $params["path"], $params["domain"],
    //     $params["secure"], $params["httponly"]
    // );
}

// Finalmente, destruir la sesión.
//session_destroy();
$session_id_to_destroy = "h0i16r3hluv2ni9gb01u95s414";
// 1. commit session if it's started.
if (session_id()) {
    session_commit();
}

// 2. store current session id
if(!isset($_SESSION)) {
    session_start();
}
$current_session_id = session_id();
session_commit();

// 3. hijack then destroy session specified.
session_id($session_id_to_destroy);
session_start();
echo "Sesión a destruir:";
verSession();
$_SESSION = [];

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    var_dump($params);
    var_dump(session_name());
    var_dump(session_id());
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

session_destroy();
session_commit();

// 4. restore current session id. If don't restore it, your current session will refer to the session you just destroyed!
session_id($current_session_id);
session_start();
session_commit();

echo "<pre>";
?>