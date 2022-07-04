<div class="contenedor olvide">
	<?php include DIR_ROOT. '/views/templates/nombre-sitio.php' ?>

	<div class="contenedor-sm">
		<p class="descripcion-pagina">Recupera tu Acceso a UpTask</p>
		<?php include DIR_ROOT. '/views/templates/alertas.php' ?>

		<form action="/olvide" class="formulario" method="POST">
			<div class="campo">
				<label for="email">Email</label>
				<input type="email" name="email" id="email" placeholder="Tu Email">
			</div>

			<input type="submit" value="Enviar Instrucciones" class="boton">
		</form>

		<div class="acciones">
			<a href="/">¿Ya tienes una cuenta?. Iniciar Sesión</a>
			<a href="/crear">¿Aún no tienes una cuenta?. Obtener una</a>
		</div>
	</div> <!-- .contenedor-sm -->
</div>