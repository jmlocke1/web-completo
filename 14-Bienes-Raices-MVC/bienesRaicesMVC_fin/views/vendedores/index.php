
<main class="contenedor seccion">
    <h1>Administrador de Vendedores</h1>
    <?php 
        $mensaje = mostrarNotificacion( intval( $resultado) );
        if($mensaje) { ?>
            <p class="alerta exito"><?php echo s($mensaje); ?></p>
        <?php } 
    ?>

    <?php include __DIR__ . '/../navegacion.php'; ?>


</main>