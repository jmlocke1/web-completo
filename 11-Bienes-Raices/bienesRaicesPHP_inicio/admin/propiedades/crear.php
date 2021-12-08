<?php
require '../../includes/funciones.php';
if( !estaAutenticado() ) {
    header('Location: /');
    exit;
}
// var_dump(setIdRecicled(20)) ;
// echo setIdRecicled(20);
// echo setIdRecicled(1);
// echo setIdRecicled(6);
// $id = getIdRecicledAndDelete();
// echo "El próximo id reciclado es: ", $id, "<br>";
// echo "<pre>";
// var_dump($id);
// echo "</pre>";
// $id = getIdRecicledAndDelete();
// echo "El próximo id reciclado es: ", $id, "<br>";
// echo "<pre>";
// var_dump($id);
// echo "</pre>";
// $id = getIdRecicledAndDelete();
// echo "El próximo id reciclado es: ", $id, "<br>";
// echo "<pre>";
// var_dump($id);
// echo "</pre>";
// $id = getIdRecicledAndDelete();
// echo "El próximo id reciclado es: ", $id, "<br>";
// echo "<pre>";
// var_dump($id);
// echo "</pre>";
// // echo deleteIdRecicled(5);
// exit;

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

            // var_dump($_POST);
            // var_dump($_FILES);
            
            $titulo = mysqli_real_escape_string( $db, $_POST['titulo']);
            $precio = mysqli_real_escape_string( $db, $_POST['precio']);
            $descripcion = mysqli_real_escape_string( $db, $_POST['descripcion']);
            $habitaciones = mysqli_real_escape_string( $db, $_POST['habitaciones']);
            $wc = $_POST['wc'];
            $estacionamiento = mysqli_real_escape_string( $db, $_POST['estacionamiento']);
            $vendedorId = mysqli_real_escape_string( $db, $_POST['vendedorId']);
            $creado = date('Y/m/d');

            // Asignar files hacia una variable
            $imagen = $_FILES['imagen'];
            
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
            if(!$imagen['name']) {
                $errores[] = 'La imagen es obligatoria';
            }

            // Validar por tamaño (2 MB máximo)
            $medida = 1024 * 1024 * 2;

            if($imagen['size'] > $medida){
                $errores[] = 'La imagen es muy pesada. No debe pasar de 2 MB';
            }

            //var_dump($errores);

            // Revisar que el array de errores esté vacío
            if(empty($errores)){

                /** SUBIDA DE ARCHIVOS */

                // Crear carpeta
                $carpetaImagenes = getImageFolder();

                if(!is_dir($carpetaImagenes)){
                    mkdir($carpetaImagenes);
                }

                // Generar un nombre único
                $nombreImagen = getImageName($imagen['name']);
                
                // Subir la imagen

                move_uploaded_file($imagen['tmp_name'], $carpetaImagenes."/".$nombreImagen);
                
                // Insertar en la base de datos
                // $query = " INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, creado, vendedorId) ";
                // $query .= " VALUES ( '$titulo', '$precio', '$nombreImagen', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$creado', '$vendedorId')";
                $resultado = createProperty(  $titulo,  $precio, $nombreImagen, $descripcion, $habitaciones, $wc, $estacionamiento, $creado, $vendedorId);
                echo "<pre>";
                var_dump($resultado);
                echo "</pre>";

                

                // $resultado = mysqli_query($db, $query);
                if($resultado){
                    // Redireccionar al usuario
                    header('Location: /admin?resultado=1');
                }
            }
            
 
        }else if($_SERVER["REQUEST_METHOD"] === 'GET') {
            echo "GET: ",var_dump($_GET);
        }else {
            echo "No sé qué tipo de envío es";
        } ?>
        
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
            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Título Propiedad" value="<?= $titulo; ?>">

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" value="<?= $precio; ?>">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" name="imagen" accept="image/jpeg, image/png">

                <label for="descripcion">Descripción:</label>
                <textarea name="descripcion" id="descripcion" cols="30" rows="10" minlength="50" maxlength="3000"><?= $descripcion; ?></textarea>
            </fieldset>

            <fieldset>
                <legend>Información de la Propiedad</legend>

                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?= $habitaciones; ?>">

                <label for="wc">Baños:</label>
                <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="9" value="<?= $wc; ?>">

                <label for="estacionamiento">Estacionamiento:</label>
                <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 3" min="1" max="9" value="<?= $estacionamiento; ?>">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <select name="vendedorId" id="vendedorId">
                    <option value="">-- Seleccione --</option>
                <?php while($vendedor = mysqli_fetch_assoc($vendedores)): ?>
                    <option <?= $vendedorId === $vendedor['id'] ? 'selected' : ''; ?>  value="<?= $vendedor['id']; ?>"><?= $vendedor['nombre']." ". $vendedor['apellido']; ?></option>
                <?php endwhile; ?>
                </select>
            </fieldset>
            <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>
    </main>

<?php
incluirTemplate('footer');