	<main class="contenedor">
        <h2>Casas y Deptos en Venta</h2>

        <!-- Errores -->
        <?php if(isset($mensajeError)): ?>
            <p class="alerta error"><?= $mensajeError; ?></p>
        <?php endif; ?>
		
        <?php include 'listado.php'; ?>
        
    </main>