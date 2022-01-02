<?php

// Importar la conexión
require '../includes/funciones.php';
if( !estaAutenticado() ) {
    header('Location: /');
    exit;
}
// Escribir el query
$query = "SELECT * FROM propiedades";

// Consultar la BD
$resultadoConsulta = mysqli_query($db, $query);


// Muestra mensaje condicional
$resultado = isset($_GET['resultado']) ? (int)filter_var( $_GET['resultado'], FILTER_SANITIZE_NUMBER_INT)  : 0;
$error = isset($_GET['error']) ? (int)filter_var( $_GET['error'], FILTER_SANITIZE_NUMBER_INT)  : 0;
//$resultado = (int)filter_var( $_GET['resultado'], FILTER_SANITIZE_NUMBER_INT) ?? 0;

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
    if($id) {
        // $query = "DELETE FROM propiedades WHERE id=${id}";
        // $result = mysqli_query($db, $query);
        $result = deleteProperty($id);
        if($result){
            header('Location: /admin');
        }
    }
}
//$error = 2;
incluirTemplate('header');
?>

    <main class="contenedor">
        <h2>Administrador de Bienes Raices</h2>
        
        <?php if($resultado === 1): ?>
            <p class="alerta exito">Anuncio creado correctamente</p>
        <?php elseif($resultado === 2): ?>
            <p class="alerta exito">Propiedad actualizada correctamente</p>
        <?php endif; ?>

        <!-- Errores -->
        <?php if($error === 1): ?>
            <p class="alerta error">Esa propiedad no existe</p>
        <?php elseif($error === 2): ?>
            <p class="alerta error">La propiedad no se pudo actualizar</p>
        <?php endif; ?>

        <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>

        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
            <?php while($propiedad = mysqli_fetch_assoc($resultadoConsulta)): ?>
                <tr>
                    <td><?= $propiedad['id']; ?></td>
                    <td><?= $propiedad['titulo']; ?></td>
                    <td><img src="/imagenes/<?= $propiedad['imagen'] ?>" class="imagen-tabla" alt="Imagen de la <?= $propiedad['titulo']; ?>" title="Imagen de la <?= $propiedad['titulo']; ?>"> </td>
                    <td>$<?= $propiedad['precio']; ?></td>
                    <td class="form-admin-action">
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?= $propiedad['id'] ?>">
                            <input type="submit" class="boton-rojo-block w-100" value="Eliminar" title="Elimina la propiedad <?= $propiedad['id']; ?>- <?= $propiedad['titulo']; ?>">
                        </form>
                        
                        <a href="propiedades/actualizar.php?propiedad=<?= $propiedad['id']; ?>"  class="boton-amarillo-block w-100" title="Actualiza los datos de la propiedad <?= $propiedad['id']; ?>- <?= $propiedad['titulo']; ?>">Actualizar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </main>

<?php
// Cerrar la conexión
// mysqli_close($db);

incluirTemplate('footer');