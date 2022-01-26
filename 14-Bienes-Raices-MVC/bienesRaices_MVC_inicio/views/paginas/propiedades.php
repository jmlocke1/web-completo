	<main class="contenedor">
        <h2 data-cy="heading-propiedades">Casas y Deptos en Venta</h2>

        <!-- Errores -->
        <?php if(!empty($mensajeError)): ?>
            <p class="alerta error"><?= $mensajeError; ?></p>
        <?php endif; ?>
		
        <?php include 'listado.php'; ?>
        
    </main>