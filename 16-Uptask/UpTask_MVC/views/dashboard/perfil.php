<?php include __DIR__ . '/header-dashboard.php'; ?>

<div class="contenedor-sm">
	<?php include_once __DIR__ . '/../templates/alertas.php'; ?>

	<a href="/cambiar-password" class="enlace">Cambiar Password</a>
	<form class="formulario" method="POST" action="/perfil">
		<div class="campo">
			<label for="nombre">Nombre</label>
			<input type="text" name="nombre" id="" value="<?= $usuario->nombre; ?>" placeholder="Tu nombre">
		</div>
		<div class="campo">
			<label for="email">Email</label>
			<input type="email" name="email" id="" value="<?= $usuario->email; ?>" placeholder="Tu email">
		</div>
		<input type="submit" value="Guardar Cambios">
	</form>
</div>

<?php include __DIR__ . '/footer-dashboard.php'; ?>