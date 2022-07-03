<div class="contenedor reestablecer">
	<?php include DIR_ROOT. '/views/templates/nombre-sitio.php' ?>

	<div class="contenedor-sm">
		<p class="descripcion-pagina">Coloca tu nuevo password</p>

		<form action="/reestablecer" class="formulario" method="POST">
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
