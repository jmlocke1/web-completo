<main class="contenedor">
        <h2>Administrador de Bienes Raices</h2>
        <?php if(isset($mensajeExito)): ?>
            <p class="alerta exito"><?= $mensajeExito; ?></p>
        <?php endif; ?>
        
        <!-- Errores -->
        <?php if(isset($mensajeError)): ?>
            <p class="alerta error"><?= $mensajeError; ?></p>
        <?php endif; ?>

        <h2>Propiedades</h2>
        <a href="/propiedades/crear" class="boton boton-verde">Nueva Propiedad</a>
        
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
                    <td><img src="/build/imagenes/<?= $propiedad->imagen; ?>" class="imagen-tabla" alt="Imagen de la <?= $propiedad->titulo; ?>" title="Imagen de la <?= $propiedad->titulo; ?>"> </td>
                    <td>$<?= $propiedad->precio; ?></td>
                    <td class="form-admin-action">
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?= $propiedad->id; ?>">
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="submit" class="boton-rojo-block w-100" value="Eliminar" title="Elimina la propiedad <?= $propiedad->id; ?>- <?= $propiedad->titulo; ?>">
                        </form>
                        
                        <a href="propiedades/actualizar?propiedad=<?= $propiedad->id; ?>"  class="boton-amarillo-block w-100" title="Actualiza los datos de la propiedad <?= $propiedad->id; ?>- <?= $propiedad->titulo; ?>">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
</main>