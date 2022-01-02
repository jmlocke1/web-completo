<?php 

    // Incluye el header
    require 'includes/app.php';
    use App\Admin;

    $errores = Admin::getErrores();

    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Instanciar admin
        $admin = new Admin($_POST['admin']);
        $errores = $admin->validar();
        
        if(empty($errores)) {

            // Revisar si el usuario existe.
            $resultado = $admin->existeUsuario();

            // Asignar el resultado del arreglo de resultado
            [$existe, $resultado] = $resultado;
            
            if( $existe ) {
                // Usuario existe, verificar su password
                $resultado = $admin->verificarPassword($resultado);
                [$auth] = $resultado;

                // Verificar si el password es correcto o no
                if(!$auth) {
                    return header('Location: /admin');
                } else {
                    $errores = $resultado[1];
                }
            } else {
                $errores = $resultado;
            }
        }

    }



    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesión</h1>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form method="POST" class="formulario" novalidate>
            <fieldset>
                <legend>Email y Password</legend>

                <label for="email">E-mail</label>
                <input type="email" name="admin[email]" placeholder="Tu Email" id="email">

                <label for="password">Password</label>
                <input type="password" name="admin[password]" placeholder="Tu Password" id="password">
            </fieldset>
        
            <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
        </form>
    </main>

<?php 
    incluirTemplate('footer');
?>