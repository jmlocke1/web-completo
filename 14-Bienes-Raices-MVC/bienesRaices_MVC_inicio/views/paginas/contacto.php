<main class="contenedor seccion">
        <h2>Contacto</h2>
        <?php if(isset($mensaje)){ ?>
        <p class="alerta exito"><?= $mensaje; ?></p>
        <?php } ?>
        <picture>
            <source srcset="build/img/destacada3.avif" type="image/avif">
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <img width="200" height="300" loading="lazy" src="build/img/destacada3.jpg" alt="Imagen de contacto" title="Imagen de contacto">
        </picture>

        <h2>Llene el formulario de contacto</h2>

        <form action="/contacto" method="POST" class="formulario">
            <fieldset>
                <legend>Información Personal</legend>
                <label for="nombre">Nombre *</label>
                <input type="text" placeholder="Tu Nombre" name="contacto[nombre]" id="nombre" value="<?= $respuestas['nombre'] ?? ''; ?>" required>

                <label for="mensaje">Mensaje: *</label>
                <textarea name="contacto[mensaje]" id="mensaje" required><?= $respuestas['mensaje'] ?? ''; ?></textarea>
            </fieldset>

            <fieldset>
                <legend>Información sobre la propiedad</legend>

                <label for="opciones">Vende o Compra: *</label>
                <select name="contacto[tipo]" id="tipo" required>
                    <option value="" disabled <?= $tipo['seleccione'] ?? 'selected'; ?>>-- Seleccione --</option>
                    <option value="Compra" <?= $tipo['compra'] ?? ''; ?>>Compra</option>
                    <option value="Vende" <?= $tipo['vende'] ?? ''; ?>>Vende</option>
                </select>

                <label for="presupuesto">Precio o Presupuesto *</label>
                <input type="number" placeholder="Tu Precio o Presupuesto" name="contacto[precio]" id="precio" required value="<?= $respuestas['precio'] ?? ''; ?>">
            </fieldset>

            <fieldset>
                <legend>Información sobre la propiedad</legend>

                <p>¿Cómo desea ser contactado?</p>

                <div class="forma-contacto">
                    <label for="contactar-telefono">Teléfono</label>
                    <input type="radio" value="telefono" name="contacto[contacto]" id="contactar-telefono" required <?= $telefono ?? ''; ?>>

                    <label for="contactar-email">E-mail</label>
                    <input type="radio" value="email" name="contacto[contacto]" id="contactar-email" required <?= $email ?? ''; ?>>
                </div>
                <hr>
                <div id="contacto"></div>
                
            </fieldset>

            <input type="submit" value="enviar" class="boton-verde">
        </form>
    </main>