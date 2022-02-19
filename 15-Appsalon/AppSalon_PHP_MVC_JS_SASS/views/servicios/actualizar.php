<h1 class="nombre-pagina">Actualizar Servicio</h1>
<p class="descripcion-pagina">Modifica los valores del formulario</p>

<?php include DIR_ROOT.'/includes/templates/barra.php'; ?>
<?php include DIR_ROOT.'/includes/templates/alertas.php'; ?>

<form method="POST" class="formulario">
    <?php include DIR_ROOT. '/views/servicios/formulario.php'; ?>

    <input class="boton" type="submit" value="Actualizar">
</form>

