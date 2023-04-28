<?php include __DIR__ . '/header-dashboard.php'; ?>

<div class="contenedor-sm">
	<?php include_once __DIR__ . '/../templates/alertas.php'; ?>

	<a href="/perfil" class="enlace">Volver a perfil</a>
	<form class="formulario" method="POST" action="/cambiar-password">
		<div class="campo">
			<label for="password_actual">Password Actual</label>
			<input type="password" name="password_actual" placeholder="Tu Password Actual" required>
		</div>
		<div class="campo">
			<label for="password_nuevo">Password Nuevo</label>
			<input type="password" name="password_nuevo" placeholder="Tu Password Nuevo" required>
		</div>
		<input type="submit" value="Guardar Cambios">
	</form>
</div>

<?php include __DIR__ . '/footer-dashboard.php'; ?>