<?php
require 'includes/app.php';
incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h2>Contacto</h2>

        <picture>
            <source srcset="build/img/destacada3.avif" type="image/avif">
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <img width="200" height="300" loading="lazy" src="build/img/destacada3.jpg" alt="Imagen de contacto" title="Imagen de contacto">
        </picture>

        <h2>Llene el formulario de contacto</h2>

        <form action="#" class="formulario">
            <fieldset>
                <legend>Información Personal</legend>
                <label for="nombre">Nombre</label>
                <input type="text" placeholder="Tu Nombre" id="nombre">

                <label for="email">E-mail</label>
                <input type="email" placeholder="Tu Email" id="email">

                <label for="telefono">Teléfono</label>
                <input type="tel" placeholder="Tu Teléfono" id="telefono">

                <label for="mensaje">Mensaje:</label>
                <textarea name="" id="mensaje"></textarea>
            </fieldset>

            <fieldset>
                <legend>Información sobre la propiedad</legend>

                <label for="opciones">Vende o Compra:</label>
                <select name="opciones" id="opciones">
                    <option value="" disabled selected>-- Seleccione --</option>
                    <option value="Compra">Compra</option>
                    <option value="Vende">Vende</option>
                </select>

                <label for="presupuesto">Teléfono</label>
                <input type="number" placeholder="Tu Precio o Presupuesto" id="presupuesto">
            </fieldset>

            <fieldset>
                <legend>Información sobre la propiedad</legend>

                <p>¿Cómo desea ser contactado?</p>

                <div class="forma-contacto">
                    <label for="contactar-telefono">Teléfono</label>
                    <input type="radio" value="telefono" name="contacto" id="contactar-telefono">

                    <label for="contactar-email">E-mail</label>
                    <input type="radio" value="email" name="contacto" id="contactar-email">
                </div>

                <p>Si eligió teléfono, elija la fecha y la hora</p>

                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha">

                <label for="hora">Hora</label>
                <input type="time" id="hora" min="09:00" max="18:00">
            </fieldset>

            <input type="submit" value="enviar" class="boton-verde">
        </form>
    </main>

<?php
incluirTemplate('footer');