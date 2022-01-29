<h1 class="nombre-pagina">Crear Cuenta</h1>
<p class="descripcion-pagina">Llena el siguiente formulario para crear una cuenta</p>

<form action="/crear-cuenta" method="POST" class="formulario">
	<div class="campo">
		<label for="nombre">Nombre</label>
		<input type="text" name="nombre" id="nombre" placeholder="Tu Nombre" value="<?= s($usuario->nombre); ?>">
	</div>

	<div class="campo">
		<label for="apellido">Apellidos</label>
		<input type="text" name="apellido" id="apellido" placeholder="Tus apellidos" value="<?= s($usuario->apellido); ?>">
	</div>

	<div class="campo">
		<label for="telefono">Teléfono</label>
		<input type="tel" name="telefono" id="telefono" placeholder="Tu Teléfono" value="<?= s($usuario->telefono); ?>">
	</div>

	<div class="campo">
		<label for="email">E-mail</label>
		<input type="email" name="email" id="email" placeholder="Tu E-mail" value="<?= s($usuario->email); ?>">
	</div>

	<div class="campo">
		<label for="password">Password</label>
		<input type="password" name="password" id="password" placeholder="Tu Password">
	</div>

	<input type="submit" value="Crear Cuenta" class="boton">
</form>

<div class="acciones">
	<a href="/">¿Ya tienes una cuenta? Inicia Sesión.</a>
	<a href="/olvide">¿Olvidaste tu Password?</a>
</div>