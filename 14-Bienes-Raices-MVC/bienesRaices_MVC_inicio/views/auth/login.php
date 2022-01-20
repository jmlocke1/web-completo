    <main class="contenedor seccion contenido-centrado">
        <h2>Iniciar sesión</h2>

    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?= $error; ?>
        </div>
    <?php endforeach;  ?>
        <form method="POST" action="login" class="formulario">
        <fieldset>
                <legend>Email y Password</legend>
               

                <label for="email">E-mail *</label>
                <input type="email" name="email" placeholder="Tu Email" id="email" required>

                <label for="password">Password *</label>
                <input type="password" name="password" placeholder="Tu Password" id="password" required>
            </fieldset>

            <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
        </form>
    </main>