	<main class="contenedor seccion">
        <h2>Registrar Vendedor(a)</h2>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?= $error; ?>
        </div>
        <?php endforeach; ?>
        <form action="/vendedores/crear" class="formulario" method="POST">
            <?php include __DIR__. "/formulario.php"; ?>
            <input type="submit" value="Registrar Vendedor(a)" class="boton boton-verde">
        </form>
    </main>