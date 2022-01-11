<?php
require '../../includes/app.php';

use App\Propiedad;
use App\Vendedor;
use App\Database\DB;
use Intervention\Image\ImageManagerStatic as Image;
use App\Notification;

estaAutenticado();


// Obtener los vendedores
$vendedores = Vendedor::all();

$errores = Propiedad::getErrors();


incluirTemplate('header');
?>
    <pre>
        <?php 
        if($_SERVER["REQUEST_METHOD"] === 'POST') {
            $propiedad = new Propiedad($_POST['propiedad']);
            
            $propiedad->setImagen($_FILES['propiedad']);

            $propiedad->validar();
            $errores = Propiedad::getErrors();
            
            // Revisar que el array de errores esté vacío
            if(empty($errores)){
                // Insertar en la base de datos
                $resultado = $propiedad->guardar();
                if($resultado){
                    // Redireccionar al usuario
                    header('Location: /admin?resultado='.Notification::AD_CREATED_SUCCESSFULLY);
                }else{
                    $errores[] = "Error ".DB::getDB()->errno." al insertar en la base de datos: ".DB::getDB()->error;
                }
            }
            
 
        }else if($_SERVER["REQUEST_METHOD"] === 'GET') {
            //echo "GET: ",var_dump($_GET);
        }else {
            //echo "No sé qué tipo de envío es";
        } 
        if(!isset($propiedad)){
            $propiedad = new Propiedad();
        }
        ?>
        
    </pre>
    
    <main class="contenedor seccion">
        <h2>Crear</h2>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?= $error; ?>
        </div>
        <?php endforeach; ?>
        <form action="/admin/propiedades/crear.php" class="formulario" method="POST" enctype="multipart/form-data">
            <?php include DIR_ROOT. "includes/templates/formulario_propiedades.php"; ?>
            <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>
    </main>

<?php
incluirTemplate('footer');