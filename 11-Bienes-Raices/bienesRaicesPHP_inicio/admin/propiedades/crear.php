<?php
require '../../includes/funciones.php';
$db = conectarDB();


incluirTemplate('header');
?>
    <pre>
        <?php if($_SERVER["REQUEST_METHOD"] === 'POST') {
            echo "POST: ",var_dump($_POST);

            $titulo = $_POST['titulo'];
            $precio = $_POST['precio'];
            $descripcion = $_POST['descripcion'];
            $habitaciones = $_POST['habitaciones'];
            $wc = $_POST['wc'];
            $estacionamiento = $_POST['estacionamiento'];
            $vendedorId = $_POST['vendedorId'];

            // Insertar en la base de datos
            $query = " INSERT INTO propiedades (titulo, precio, descripcion, habitaciones, wc, estacionamiento, vendedorId) ";
            $query .= " VALUES ( '$titulo', '$precio', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$vendedorId')";
            // echo $query;

            $resultado = mysqli_query($db, $query);
            if($resultado){
                echo 'Insertado correctamente';
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

        <form action="/admin/propiedades/crear.php" class="formulario" method="POST">
            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Título Propiedad">

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio Propiedad">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" name="imagen" accept="image/jpeg, image/png">

                <label for="descripcion">Descripción:</label>
                <textarea name="descripcion" id="descripcion" cols="30" rows="10"></textarea>
            </fieldset>

            <fieldset>
                <legend>Información de la Propiedad</legend>

                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9">

                <label for="wc">Baños:</label>
                <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="9">

                <label for="estacionamiento">Estacionamiento:</label>
                <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 3" min="1" max="9">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <select name="vendedorId" id="vendedorId">
                    <option value="1">Jose</option>
                    <option value="2">Karen</option>
                </select>
            </fieldset>
            <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>
    </main>

<?php
incluirTemplate('footer');