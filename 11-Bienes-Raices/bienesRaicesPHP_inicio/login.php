<?php
require 'includes/funciones.php';

// Autenticar el usuario
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "<pre>";
    var_dump($_POST);
    echo "</pre>";
}
incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h2>Iniciar sesión</h2>

        <form method="POST" action="" class="formulario">
        <fieldset>
                <legend>Email y Password</legend>
               

                <label for="email">E-mail</label>
                <input type="email" name="email" placeholder="Tu Email" id="email">

                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Tu Password" id="password">
            </fieldset>

            <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
        </form>
    </main>

<?php
incluirTemplate('footer');