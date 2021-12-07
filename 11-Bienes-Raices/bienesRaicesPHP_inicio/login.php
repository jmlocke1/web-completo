<?php
require 'includes/funciones.php';

// Autenticar el usuario
$errores = [];
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "<pre>";
    var_dump($_POST);
    echo "</pre>";

    $email = mysqli_real_escape_string( $db, filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL) );
    $password = mysqli_real_escape_string( $db, $_POST['password'] );

    if(!$email) {
        $errores[] = "El email es obligatorio o no es válido";
    }
    if(!$password) {
        $errores[] = "El Password es obligatorio";
    }

    echo "<pre>";
    var_dump($errores);
    echo "</pre>";
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