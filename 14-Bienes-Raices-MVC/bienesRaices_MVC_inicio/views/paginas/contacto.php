<main class="contenedor seccion">
        <h2>Contacto</h2>

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
                <input type="text" placeholder="Tu Nombre" name="contacto[nombre]" id="nombre" required>

                <label for="email">E-mail *</label>
                <input type="email" placeholder="Tu Email" name="contacto[email]" id="email" required>

                <label for="telefono">Teléfono</label>
                <input type="tel" placeholder="Tu Teléfono" name="contacto[telefono]" id="telefono">

                <label for="mensaje">Mensaje: *</label>
                <textarea name="contacto[mensaje]" id="mensaje" required></textarea>
            </fieldset>

            <fieldset>
                <legend>Información sobre la propiedad</legend>

                <label for="opciones">Vende o Compra: *</label>
                <select name="contacto[tipo]" id="tipo" required>
                    <option value="" disabled selected>-- Seleccione --</option>
                    <option value="Compra">Compra</option>
                    <option value="Vende">Vende</option>
                </select>

                <label for="presupuesto">Precio o Presupuesto *</label>
                <input type="number" placeholder="Tu Precio o Presupuesto" name="contacto[precio]" id="precio" required>
            </fieldset>

            <fieldset>
                <legend>Información sobre la propiedad</legend>

                <p>¿Cómo desea ser contactado?</p>

                <div class="forma-contacto">
                    <label for="contactar-telefono">Teléfono</label>
                    <input type="radio" value="telefono" name="contacto[contacto]" id="contactar-telefono" required>

                    <label for="contactar-email">E-mail</label>
                    <input type="radio" value="email" name="contacto[contacto]" id="contactar-email" required>
                </div>

                <p>Si eligió teléfono, elija la fecha y la hora</p>

                <label for="fecha">Fecha:</label>
                <input type="date" name="contacto[fecha]" id="fecha">

                <label for="hora">Hora</label>
                <input type="time" name="contacto[hora]" id="hora" min="09:00" max="18:00">
            </fieldset>

            <input type="submit" value="enviar" class="boton-verde">
        </form>
    </main>