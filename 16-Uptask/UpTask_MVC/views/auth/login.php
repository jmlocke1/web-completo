<div class="contenedor login">
	<?php include DIR_ROOT. '/views/templates/nombre-sitio.php' ?>

	<div class="contenedor-sm">
		<p class="descripcion-pagina">Iniciar Sesión</p>
		<?php include DIR_ROOT. '/views/templates/alertas.php' ?>
		<form action="/" class="formulario" method="POST">
			<div class="campo">
				<label for="email">Email</label>
				<input type="email" name="email" id="email" placeholder="Tu Email" >
			</div>

			<div class="campo">
				<label for="password">Password</label>
				<input type="password" name="password" id="password" placeholder="Tu Password" >
			</div>

			<input type="submit" value="Iniciar Sesión" class="boton">
		</form>

		<div class="acciones">
		    <a href="/crear">¿Aún no tienes una cuenta?. Obtener una</a>
			<a href="/olvide">¿Olvidaste tu Password?</a>
		</div>
	</div> <!-- .contenedor-sm -->
</div>

