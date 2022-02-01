<h1 class="nombre-pagina">Olvidé el Password</h1>
<p class="descripcion-pagina">Reestablece tu password escribiendo tu email a continuación</p>

<?php include_once DIR_ROOT.'includes/templates/alertas.php'; ?>

<form action="/olvide" class="formulario" method="POST">
	<div class="campo">
		<label for="email">E-mail</label>
		<input type="email" name="email" id="email" placeholder="Tu Email">
	</div>

	<input type="submit" value="Enviar Instrucciones" class="boton">
</form>

<div class="acciones">
	<a href="/">¿Ya tienes una cuenta? Inicia Sesión.</a>
	<a href="/crear-cuenta">¿Aún no tienes una cuenta? Crear una.</a>
</div>