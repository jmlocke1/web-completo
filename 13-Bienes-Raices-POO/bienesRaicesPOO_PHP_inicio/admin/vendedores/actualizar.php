<?php

require '../../includes/app.php';
use App\Propiedad;
use App\Vendedor;

estaAutenticado();

// Validar la url por id válido
$id = $_GET['vendedor'];

$id = filter_var($id, FILTER_VALIDATE_INT);

if(!$id){
    header('Location: /admin');
}
$vendedor = Vendedor::find($id);
// Comprobamos si existe el vendedor
if(is_null($vendedor)){
    header('Location: /admin?error='.Config::SELLER_NOT_EXIST);
}

// Array con mensajes de errores
$errores = Vendedor::getErrors();

if($_SERVER["REQUEST_METHOD"] === 'POST') {

}

incluirTemplate('header');
?>

	<main class="contenedor seccion">
        <h2>Actualizar Vendedor(a)</h2>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?= $error; ?>
        </div>
        <?php endforeach; ?>
        <form class="formulario" method="POST">
            <?php include DIR_ROOT. "includes/templates/formulario_vendedores.php"; ?>
            <input type="submit" value="Guardar Cambios" class="boton boton-verde">
        </form>
    </main>

<?php
incluirTemplate('footer');