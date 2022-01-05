<?php

require '../../includes/app.php';
use App\Propiedad;
use App\Database\DB;

estaAutenticado();
$db = DB::getDB();

// Consultar para obtener los vendedores
$query = "SELECT id, nombre, apellido, telefono FROM vendedores";
$vendedores = mysqli_query($db, $query);

// Array con mensajes de errores
$errores = [];
// Inicializamos las variables vacías

$titulo = '';
$precio = '';
$descripcion = '';
$habitaciones = '';
$wc = '';
$estacionamiento = '';
$vendedorId = '';
incluirTemplate('header');
?>
    <pre>
        <?php if($_SERVER["REQUEST_METHOD"] === 'POST') {
            // echo "<pre>";
            // var_dump($_POST);
            // var_dump($_FILES);
            // echo "</pre>";
            $id = $_POST['id'];
            $titulo = mysqli_real_escape_string( $db, $_POST['titulo']);
            $precio = mysqli_real_escape_string( $db, $_POST['precio']);
            $descripcion = mysqli_real_escape_string( $db, $_POST['descripcion']);
            $habitaciones = mysqli_real_escape_string( $db, $_POST['habitaciones']);
            $wc = $_POST['wc'];
            $estacionamiento = mysqli_real_escape_string( $db, $_POST['estacionamiento']);
            $vendedorId = mysqli_real_escape_string( $db, $_POST['vendedorId']);
            $creado = $_POST['creado'];

            // Asignar files hacia una variable
            $imagen = strlen($_FILES['imagen']['name']) > 0 ? $_FILES['imagen'] : null;
            echo "FILES tiene el valor:";
            var_dump($_FILES['imagen']);
            if(!$titulo) {
                $errores[] = "Debes añadir un título";
            }
            if(!$precio) {
                $errores[] = "El precio es obligatorio";
            }
            if(strlen( $descripcion ) < 50) {
                $errores[] = "La descripción es obligatoria y debe tener al menos 50 caracteres";
            }
            if(!$habitaciones) {
                $errores[] = "El número de habitaciones es obligatorio";
            }
            if(!$wc) {
                $errores[] = "El número de baños es obligatorio";
            }
            if(!$estacionamiento) {
                $errores[] = "El número de estacionamientos es obligatorio";
            }
            if(!$vendedorId) {
                $errores[] = "Elige un vendedor";
            }

            if(isset($imagen)){
                // Validar por tamaño (2 MB máximo)
                $medida = 1024 * 1024 * 2;

                if($imagen['size'] > $medida){
                    $errores[] = 'La imagen es muy pesada. No debe pasar de 2 MB';
                }
            }
            


            // Revisar que el array de errores esté vacío
            if(empty($errores)){
                
                if(isset($imagen)){
                    
                    /** SUBIDA DE ARCHIVOS */

                    // Crear carpeta

                    if(!is_dir(Config::CARPETA_IMAGENES)){
                        mkdir(Config::CARPETA_IMAGENES);
                    }

                    // Generar un nombre único
                    $nombreImagen = getImageName($imagen['name']);

                    // Subir la imagen

                    move_uploaded_file($imagen['tmp_name'], Config::CARPETA_IMAGENES.$nombreImagen);
                    // Eliminar la imagen anterior
                    $antiguaImagen = getImageFromDB($id);
                    unlink(Config::CARPETA_IMAGENES . $antiguaImagen);
                }
                

                // Insertar en la base de datos
                $campoImagen = isset($nombreImagen) ? "imagen='$nombreImagen', " : '';
                $query = "UPDATE propiedades SET titulo='$titulo', precio=$precio, $campoImagen descripcion='$descripcion', habitaciones=$habitaciones, wc=$wc, estacionamiento=$estacionamiento, creado='$creado', vendedorId=$vendedorId";
                $query .= " WHERE id=$id";
                

                $resultado = mysqli_query($db, $query);
                echo '<br>';
                if($resultado){
                    // Redireccionar al usuario
                    header('Location: /admin?resultado=2');
                    exit;
                }else{
                    header('Location: /admin?error=2');
                    exit;
                }
            }
            
 
        }else if($_SERVER["REQUEST_METHOD"] === 'GET') {
            $id = filter_var($_GET['propiedad'], FILTER_VALIDATE_INT);
            
            // Obtener registro de la base de datos
            $query = "SELECT * FROM propiedades WHERE id='$id'";
            $resultadoConsulta = mysqli_query($db, $query);
            // Se comprueba el id y el resultado. id debe ser entero y 
            // existir en la base de datos
            if(!$id || $resultadoConsulta->num_rows === 0) {
                header('Location: /admin?error=1');
                exit;
            }
            
            $propiedad = mysqli_fetch_assoc($resultadoConsulta);

            // Asignar valores a las variables
            $titulo = $propiedad['titulo'];
            $precio = $propiedad['precio'];
            $descripcion = $propiedad['descripcion'];
            $habitaciones = $propiedad['habitaciones'];
            $wc = $propiedad['wc'];
            $estacionamiento = $propiedad['estacionamiento'];
            $vendedorId = $propiedad['vendedorId'];
            $creado = $propiedad['creado'];

            // Asignar files hacia una variable
            $imagen = $propiedad['imagen'];
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
        <form action="/admin/propiedades/actualizar.php" class="formulario" method="POST" enctype="multipart/form-data">
        <?php include DIR_ROOT. "includes/templates/formulario_propiedades.php"; ?>
            
            <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
        </form>
    </main>

<?php
incluirTemplate('footer');