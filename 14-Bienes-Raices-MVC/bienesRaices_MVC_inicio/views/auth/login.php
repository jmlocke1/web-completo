    <main class="contenedor seccion contenido-centrado">
        <h2 data-cy="heading-login">Iniciar Sesión</h2>

    <?php foreach($errores as $error): ?>
        <div data-cy="alerta-login" class="alerta error"><?= $error; ?></div>
    <?php endforeach;  ?>
        <form data-cy="formulario-login" method="POST" action="login" class="formulario">
        <fieldset>
                <legend>Email y Password</legend>
               

                <label for="email">E-mail *</label>
                <input data-cy="email-login" type="email" name="email" placeholder="Tu Email" id="email" required>

                <label for="password">Password *</label>
                <input data-cy="password-login" type="password" name="password" placeholder="Tu Password" id="password" required>
            </fieldset>

            <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
        </form>
    </main>