<?php include __DIR__ . '/header-dashboard.php'; ?>
	<div class="contenedor-sm">
		<?php include __DIR__ . '/../templates/alertas.php'; ?>

		<form action="/crear-proyecto" method="POST" class="formulario">
			<?php include __DIR__ . '/formulario-proyecto.php'; ?>
			<input type="submit" value="Crear Proyecto">
		</form>
	</div>

<?php include __DIR__ . '/footer-dashboard.php'; ?>