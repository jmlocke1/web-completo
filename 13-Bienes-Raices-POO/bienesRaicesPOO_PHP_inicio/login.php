<?php
require 'includes/funciones.php';

// Autenticar el usuario
$errores = [];
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    

    $email = mysqli_real_escape_string( $db, filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL) );
    $password = mysqli_real_escape_string( $db, $_POST['password'] );

    if(!$email) {
        $errores[] = "El email es obligatorio o no es válido";
    }
    if(!$password) {
        $errores[] = "El Password es obligatorio";
    }

    if(empty($errores)) {
        // Revisar si el usuario existe
        $query = "SELECT * FROM usuarios WHERE email='${email}'";
        $resultado = mysqli_query($db, $query);

        
        if($resultado->num_rows ) {
            // Revisar si el password es correcto
            $usuario = mysqli_fetch_assoc($resultado);
            // Verificar si el password es correcto o no
            $auth = password_verify($password, $usuario['password']);
            echo "<pre>";
            var_dump($auth);
            echo "</pre>";
            if($auth) {
                // El usuario está autenticado
                session_start();
                // Llenar el array de la sesión
                $_SESSION['usuario'] = $usuario['email'];
                $_SESSION['login'] = true;
                header('Location: /admin');
                exit;
            } else {
                $errores[] = "El password es incorrecto";
            }
        } else {
            $errores[] = "El Usuario no existe";
        }
    }
}
incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h2>Iniciar sesión</h2>

    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?= $error; ?>
        </div>
    <?php endforeach;  ?>
        <form method="POST" action="" class="formulario">
        <fieldset>
                <legend>Email y Password</legend>
               

                <label for="email">E-mail *</label>
                <input type="email" name="email" placeholder="Tu Email" id="email" required>

                <label for="password">Password *</label>
                <input type="password" name="password" placeholder="Tu Password" id="password" required>
            </fieldset>

            <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
        </form>
    </main>

<?php
incluirTemplate('footer');