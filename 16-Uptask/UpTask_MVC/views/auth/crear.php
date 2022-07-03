<div class="contenedor crear">
	<?php include DIR_ROOT. '/views/templates/nombre-sitio.php' ?>

	<div class="contenedor-sm">
		<p class="descripcion-pagina">Crea tu cuenta en UpTask</p>

<?php include DIR_ROOT. '/views/templates/alertas.php' ?>

		<form action="/crear" class="formulario" method="POST">
            <div class="campo">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" id="nombre" placeholder="Tu Nombre" value="<?= $usuario->nombre; ?>">
			</div>
			<div class="campo">
				<label for="email">Email</label>
				<input type="email" name="email" id="email" placeholder="Tu Email"  value="<?= $usuario->email; ?>">
			</div>

			<div class="campo">
				<label for="password">Password</label>
				<input type="password" name="password" id="password" placeholder="Tu Password" >
			</div>

            <div class="campo">
				<label for="password2">Repetir Password</label>
				<input type="password" name="password2" id="password2" placeholder="Repite tu Password" >
			</div>

			<input type="submit" value="Crear Cuenta" class="boton">
		</form>

		<div class="acciones">
			<a href="/">¿Ya tienes una cuenta?. Iniciar Sesión</a>
			<a href="/olvide">¿Olvidaste tu Password?</a>
		</div>
	</div> <!-- .contenedor-sm -->
</div>