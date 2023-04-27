<div class="barra-mobile">
	<h1>UpTask</h1>

	<div class="menu">
		<img src="build/img/menu.svg" alt="Botón que abre el menú" id="mobile-menu">
	</div>
</div>

<div class="barra">
	<p>Hola: <span><?= $_SESSION['nombre']; ?></span></p>

	<a href="/logout" class="cerrar-sesion">Cerrar Sesión</a>
</div>