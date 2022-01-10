<?php

require '../../includes/app.php';
use App\Propiedad;
use App\Vendedor;
use App\Database\DB;
use App\Notification;

estaAutenticado();

//$vendedor = new Vendedor();

// Array con mensajes de errores
$errores = Vendedor::getErrors();

if($_SERVER["REQUEST_METHOD"] === 'POST') {
	// Crear una nueva instancia
	$vendedor = new Vendedor($_POST['vendedor']);
	// Validar que no haya campos vacíos
	$errores = $vendedor->validar();
	if(empty($errores)){
		$resultado = $vendedor->guardar();
		if($resultado){
			// Redireccionar al usuario
			header('Location: /admin?resultado='.Notification::SELLER_CREATED_SUCCESSFULLY);
		}else{
			$errores[] = "Error ".DB::getDB()->errno." al insertar en la base de datos: ".DB::getDB()->error;
		}
	}
}
if(!isset($vendedor)){
	$vendedor = new Vendedor();
}
incluirTemplate('header');
?>

	<main class="contenedor seccion">
        <h2>Registrar Vendedor(a)</h2>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?= $error; ?>
        </div>
        <?php endforeach; ?>
        <form action="/admin/vendedores/crear.php" class="formulario" method="POST">
            <?php include DIR_ROOT. "includes/templates/formulario_vendedores.php"; ?>
            <input type="submit" value="Registrar Vendedor(a)" class="boton boton-verde">
        </form>
    </main>

<?php
incluirTemplate('footer');