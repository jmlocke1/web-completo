<h1 class="nombre-pagina">Servicios</h1>
<p class="descripcion-pagina">Administración de Servicios</p>

<?php include DIR_ROOT.'/includes/templates/barra.php'; ?>

<?php include DIR_ROOT.'/includes/templates/alertas.php'; ?>

<ul class="servicios">
<?php foreach($servicios as $servicio){ ?>
    <li>
        <p>Nombre: <span><?= $servicio->nombre; ?></span></p>
        <p>Precio: <span>$ <?= $servicio->precio; ?></span></p>
        <div class="acciones">
            <a class="boton" href="/servicios/actualizar?id=<?= $servicio->id; ?>">Actualizar</a>

            <form action="/servicios/eliminar" method="POST">
                <input type="hidden" name="id" value="<?= $servicio->id; ?>">
                <input type="submit" value="Borrar" class="boton-eliminar">
            </form>
        </div>
    </li>

<?php } ?>
</ul>