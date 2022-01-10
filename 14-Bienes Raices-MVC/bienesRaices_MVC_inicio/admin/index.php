<?php
require '../includes/app.php';
use App\Propiedad;
use App\Vendedor;
use App\Database\DB;
use App\Notification;
// $db = DB::getDB();
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
			header('location: /admin?resultado='.Notification::PROPERTY_REMOVED_SUCCESSFULLY);
		}else{
			header('location: /admin?error='.Notification::PROPERTY_COULD_NOT_BE_REMOVED);
		}
    }else if($id && $tipo === 'vendedor'){
        $vendedor = Vendedor::find($id);
        $resultado = $vendedor->eliminar();
        if($resultado){
			header('location: /admin?resultado='.Notification::SELLER_REMOVED_SUCCESSFULLY);
		}else{
            $_SESSION['error'] = DB::getDB()->error;
			header('location: /admin?error='.Notification::SELLER_COULD_NOT_BE_DELETED);
		}
    }
}

incluirTemplate('header');
?>

    <main class="contenedor">
        <h2>Administrador de Bienes Raices</h2>
        <?php if($resultado): ?>
            <p class="alerta exito"><?= s(Notification::successNotification($resultado)); ?></p>
        <?php endif; ?>
        
        <!-- Errores -->
        <?php if($error): ?>
            <p class="alerta error"><?= s(Notification::successNotification($error)); ?></p>
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
                            <input type="submit" class="boton-rojo-block w-100" value="Eliminar" title="Elimina el vendedor <?= $vendedor->id; ?>- <?= $vendedor->nombre; ?>">
                        </form>
                        
                        <a href="vendedores/actualizar.php?vendedor=<?= $vendedor->id; ?>"  class="boton-amarillo-block w-100" title="Actualiza los datos del vendedor <?= $vendedor->id; ?>- <?= $vendedor->nombre; ?>">Actualizar</a>
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