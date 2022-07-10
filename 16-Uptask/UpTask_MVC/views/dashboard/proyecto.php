<?php include __DIR__ . '/header-dashboard.php'; ?>

	<div class="contenedor-sm">
		<div class="contenedor-nueva-tarea">
			<button
				type="button"
				class="agregar-tarea"
				id="agregar-tarea"
			>&plus; Nueva Tarea</button>
			
		</div>
	</div>

<?php include __DIR__ . '/footer-dashboard.php'; ?>
<?php 
$script = '
	<script src="/build/js/tareas.js"></script>
';
?>