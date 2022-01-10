<?php

require '../../includes/app.php';
use App\Propiedad;
use App\Vendedor;
use App\Database\DB;
use Intervention\Image\ImageManagerStatic as Image;
use App\Notification;

estaAutenticado();


// Validar la url por id válido
$id = $_GET['propiedad'];

$id = filter_var($id, FILTER_VALIDATE_INT);

if(!$id){
    header('Location: /admin');
}
$propiedad = Propiedad::find(($id));
// Comprobamos si existe la propiedad
if(is_null($propiedad)){
    header('Location: /admin?error='.Notification::PROPERTY_NOT_EXIST);
}
// Obtener los vendedores
$vendedores = Vendedor::all();

// Array con mensajes de errores
$errores = Propiedad::getErrors();


incluirTemplate('header');
?>
    <pre>
        <?php if($_SERVER["REQUEST_METHOD"] === 'POST') {
            // Asignar los atributos
            $args = $_POST['propiedad'];
            
            $propiedad->sincronizar($args);
            $errores = $propiedad->validar();

            // Revisar que el array de errores esté vacío
            if(empty($errores)){
                $hayImagen = !empty($_FILES['propiedad']['name']['imagen']);
                if($hayImagen){
                    $propiedad->setImagen($_FILES['propiedad']);                    
                }
                $resultado = $propiedad->guardar();
                if($resultado){
                    // Redireccionar al usuario
                    header('Location: /admin?resultado='.Notification::PROPERTY_UPDATED_SUCCESSFULLY);
                    exit;
                }else{
                    $errores[] = "Error ".DB::getDB()->errno." al insertar en la base de datos: ".DB::getDB()->error;
                }
                
            }
            
 
        }else if($_SERVER["REQUEST_METHOD"] === 'GET') {
            $id = filter_var($_GET['propiedad'], FILTER_VALIDATE_INT);
        }else {
            echo "No sé qué tipo de envío es";
        } ?>
        
    </pre>
    
    <main class="contenedor seccion">
        <h2>Actualizar Propiedad</h2>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?= $error; ?>
        </div>
        <?php endforeach; ?>
        <form class="formulario" method="POST" enctype="multipart/form-data">
        <?php include DIR_ROOT. "includes/templates/formulario_propiedades.php"; ?>
            
            <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
        </form>
    </main>

<?php
incluirTemplate('footer');