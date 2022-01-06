<?php
require '../../includes/app.php';

use App\Propiedad;
use App\Database\DB;
use Intervention\Image\ImageManagerStatic as Image;

estaAutenticado();


// Consultar para obtener los vendedores
$db = DB::getDB();
$query = "SELECT id, nombre, apellido, telefono FROM vendedores";
$vendedores = mysqli_query($db, $query);
    
$errores = Propiedad::getErrors();


incluirTemplate('header');
?>
    <pre>
        <?php 
        if($_SERVER["REQUEST_METHOD"] === 'POST') {
            $propiedad = new Propiedad($_POST['propiedad']);
            
            $propiedad->setImagen($_FILES['propiedad']);
            /** SUBIDA DE ARCHIVOS */
            
            // Asignar files hacia una variable
            // $imagen = $_FILES['propiedad']['imagen'];

            // // Generar un nombre único
            // $nombreImagen = getImageName($_FILES['propiedad']['name']['imagen']);
            
            // // Setear la imagen
            // // Realiza un resize a la imagen con intervention
            // if($_FILES['propiedad']['tmp_name']['imagen']){
            //     $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
            //     $propiedad->setImagen($nombreImagen);
            // }
            

            // Validar por tamaño (2 MB máximo)
            // $medida = 1024 * 1024 * 2;

            // if($imagen['size'] > $medida){
            //     $errores[] = 'La imagen es muy pesada. No debe pasar de 2 MB';
            // }

            $propiedad->validar();
            $errores = Propiedad::getErrors();
            
            // Revisar que el array de errores esté vacío
            if(empty($errores)){

                // // Crear carpeta

                // if(!is_dir(Config::CARPETA_IMAGENES)){
                //     mkdir(Config::CARPETA_IMAGENES);
                // }

                
                
                // Insertar en la base de datos
                $resultado = $propiedad->guardar();
                // $resultado = mysqli_query($db, $query);
                if($resultado){
                    // Guarda la imagen en el servidor
                    //$image->save(Config::CARPETA_IMAGENES.$nombreImagen);
                    // Redireccionar al usuario
                    header('Location: /admin?resultado=1');
                }else{
                    $errores[] = "Error $db->errno al insertar en la base de datos: $db->error";
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