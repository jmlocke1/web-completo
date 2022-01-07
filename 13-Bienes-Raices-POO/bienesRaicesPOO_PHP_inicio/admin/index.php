<?php
require '../includes/app.php';
use App\Propiedad;
use App\Vendedor;
use App\Database\DB;
$db = DB::getDB();
// Importar la conexión

estaAutenticado();

// Implementar un método para obtener todas las propiedades utilizando Active Record
$propiedades = Propiedad::all();
$vendedores = Vendedor::all();

// Muestra mensaje condicional
$resultado = isset($_GET['resultado']) ? (int)filter_var( $_GET['resultado'], FILTER_SANITIZE_NUMBER_INT)  : 0;
$error = isset($_GET['error']) ? (int)filter_var( $_GET['error'], FILTER_SANITIZE_NUMBER_INT)  : 0;

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
    $tipo = filter_var($_POST['tipo'], FILTER_SANITIZE_STRING);
    if($id && $tipo === 'propiedad') {
        $propiedad = Propiedad::find($id);
        $resultado = $propiedad->eliminar();
        if($resultado){
			header('location: /admin?resultado='.Config::PROPERTY_REMOVED_SUCCESSFULLY);
		}else{
			header('location: /admin?error='.Config::PROPERTY_COULD_NOT_BE_REMOVED);
		}
    }else if($id && $tipo === 'vendedor'){
        $vendedor = Vendedor::find($id);
        $resultado = $vendedor->eliminar();
        if($resultado){
			header('location: /admin?resultado='.Config::SELLER_REMOVED_SUCCESSFULLY);
		}else{
            $_SESSION['error'] = DB::getDB()->error;
			header('location: /admin?error='.Config::SELLER_COULD_NOT_BE_DELETED);
		}
    }
}

incluirTemplate('header');
?>

    <main class="contenedor">
        <h2>Administrador de Bienes Raices</h2>
        
        <?php if($resultado === Config::AD_CREATED_SUCCESSFULLY): ?>
            <p class="alerta exito">Anuncio creado correctamente</p>
        <?php elseif($resultado === Config::PROPERTY_UPDATED_SUCCESSFULLY): ?>
            <p class="alerta exito">Propiedad actualizada correctamente</p>
        <?php elseif($resultado === Config::PROPERTY_REMOVED_SUCCESSFULLY): ?>
            <p class="alerta exito">Propiedad eliminada correctamente</p>
        <?php elseif($resultado === Config::SELLER_CREATED_SUCCESSFULLY): ?>
            <p class="alerta exito">Vendedor creado correctamente</p>
            <?php elseif($resultado === Config::SELLER_REMOVED_SUCCESSFULLY): ?>
            <p class="alerta exito">Vendedor eliminado correctamente</p>
        <?php endif; ?>

        <!-- Errores -->
        <?php if($error === Config::PROPERTY_NOT_EXIST): ?>
            <p class="alerta error">Esa propiedad no existe</p>
        <?php elseif($error === Config::PROPERTY_COULD_NOT_BE_UPDATED): ?>
            <p class="alerta error">La propiedad no se pudo actualizar</p>
        <?php elseif($error === Config::PROPERTY_COULD_NOT_BE_REMOVED): ?>
            <p class="alerta error">La propiedad no se pudo eliminar</p>
        <?php elseif($error === Config::SELLER_COULD_NOT_BE_DELETED): ?>
            <p class="alerta error">El vendedor no se pudo eliminar</p>
            <p class="alerta error">Error reportado: <?= $_SESSION['error']; ?></p>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <h2>Propiedades</h2>
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
            <?php foreach ($propiedades as $propiedad): ?>
                <tr>
                    <td><?= $propiedad->id; ?></td>
                    <td><?= $propiedad->titulo; ?></td>
                    <td><img src="/imagenes/<?= $propiedad->imagen; ?>" class="imagen-tabla" alt="Imagen de la <?= $propiedad->titulo; ?>" title="Imagen de la <?= $propiedad->titulo; ?>"> </td>
                    <td>$<?= $propiedad->precio; ?></td>
                    <td class="form-admin-action">
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?= $propiedad->id; ?>">
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="submit" class="boton-rojo-block w-100" value="Eliminar" title="Elimina la propiedad <?= $propiedad->id; ?>- <?= $propiedad->titulo; ?>">
                        </form>
                        
                        <a href="propiedades/actualizar.php?propiedad=<?= $propiedad->id; ?>"  class="boton-amarillo-block w-100" title="Actualiza los datos de la propiedad <?= $propiedad->id; ?>- <?= $propiedad->titulo; ?>">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Vendedores</h2>
        <a href="/admin/vendedores/crear.php" class="boton boton-amarillo">Nuevo(a) Vendedor</a>
        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
            <?php foreach ($vendedores as $vendedor): ?>
                <tr>
                    <td><?= $vendedor->id; ?></td>
                    <td><?= $vendedor->nombre . " " . $vendedor->apellido; ?></td>
                    <td><?= $vendedor->telefono; ?></td>
                    <td class="form-admin-action">
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?= $vendedor->id; ?>">
                            <input type="hidden" name="tipo" value="vendedor">
                            <input type="submit" class="boton-rojo-block w-100" value="Eliminar" title="Elimina la propiedad <?= $propiedad->id; ?>- <?= $propiedad->titulo; ?>">
                        </form>
                        
                        <a href="vendedores/actualizar.php?vendedor=<?= $propiedad->id; ?>"  class="boton-amarillo-block w-100" title="Actualiza los datos de la propiedad <?= $propiedad->id; ?>- <?= $propiedad->titulo; ?>">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </main>

<?php
// Cerrar la conexión
// mysqli_close($db);

incluirTemplate('footer');