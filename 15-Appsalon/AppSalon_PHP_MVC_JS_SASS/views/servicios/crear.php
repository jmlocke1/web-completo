<h1 class="nombre-pagina">Nuevo Servicio</h1>
<p class="descripcion-pagina">Llena todos los campos para añadir un nuevo servicio</p>

<?php include DIR_ROOT.'/includes/templates/barra.php'; ?>
<?php include DIR_ROOT.'/includes/templates/alertas.php'; ?>

<form action="/servicios/crear" method="POST" class="formulario">
    <?php include DIR_ROOT. '/views/servicios/formulario.php'; ?>

    <input class="boton" type="submit" value="Guardar Servicio">
</form>