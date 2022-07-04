<div class="contenedor reestablecer">
	<?php include DIR_ROOT. '/views/templates/nombre-sitio.php' ?>

	<div class="contenedor-sm">
		<p class="descripcion-pagina">Coloca tu nuevo password</p>

		<?php include DIR_ROOT. '/views/templates/alertas.php' ?>

		<?php if($mostrar): ?>
		<form class="formulario" method="POST">
			<div class="campo">
				<label for="password">Password</label>
				<input type="password" name="password" id="password" placeholder="Tu Password" >
			</div>

			<div class="campo">
				<label for="password2">Repetir Password</label>
				<input type="password" name="password2" id="password2" placeholder="Repite tu Password" >
			</div>
			<input type="submit" value="Restablecer Password" class="boton">
		</form>
		<?php endif; ?>

		<div class="acciones">
		    <a href="/crear">¿Aún no tienes una cuenta?. Obtener una</a>
			<a href="/olvide">¿Olvidaste tu Password?</a>
		</div>
	</div> <!-- .contenedor-sm -->
</div>
