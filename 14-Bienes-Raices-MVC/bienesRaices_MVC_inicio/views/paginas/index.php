<main class="contenedor">
        <h2 data-cy="heading-nosotros">Más sobre nosotros</h2>

        <?php include 'iconos.php'; ?>
    </main>

    <section class="seccion contenedor">
        <h2>Casas y Deptos en Venta</h2>

        <?php include 'listado.php'; ?>

        <div class="alinear-derecha">
            <a class="boton-verde" href="/propiedades" data-cy="todas-propiedades">Ver Todas</a>
        </div>
    </section>

    <section data-cy="imagen-contacto" class="imagen-contacto">
        <h2>Encuentra la casa de tus sueños</h2>
        <p>Llena el formulario de contacto y un asesor se pondrá en contacto contigo con la mayor brevedad</p>
        <a href="/contacto" class="boton-amarillo">Contáctanos</a>
    </section>

    <div class="contenedor seccion seccion-inferior">
        <section data-cy="blog" class="blog">
            <h3>Nuestro Blog</h3>

            <article class="entrada-blog">
                <picture>
                    <source srcset="build/img/blog1.avif" type="image/avif">
                    <source srcset="build/img/blog1.webp" type="image/webp">
                    <img width="200" height="300" loading="lazy" src="build/img/blog1.jpg" alt="Texto entrada blog" title="Texto entrada blog">
                </picture>
                <div class="texto-entrada">
                    <a href="blog/entrada" alt="Redirige a la entrada de blog ampliada" title="Redirige a la entrada de blog ampliada">
                        <h4>Terraza en el techo de tu casa</h4>
                        <p class="informacion-meta">Escrito el: <span>20/10/2021</span> por: <span>Admin</span></p>
                        <p>Consejos para construir una terraza en el techo de tu casa con los mejores materiales y ahorrando dinero</p>
                    </a>
                </div>
            </article>
            <article class="entrada-blog">
                <picture>
                    <source srcset="build/img/blog2.avif" type="image/avif">
                    <source srcset="build/img/blog2.webp" type="image/webp">
                    <img width="200" height="300" loading="lazy" src="build/img/blog2.jpg" alt="Texto entrada blog" title="Texto entrada blog">
                </picture>
                <div class="texto-entrada">
                    <a href="blog/entrada" alt="Redirige a la entrada de blog ampliada" title="Redirige a la entrada de blog ampliada">
                        <h4>Guía para la decoración de tu hogar.</h4>
                        <p class="informacion-meta">Escrito el: <span>20/10/2021</span> por: <span>Admin</span></p>
                        <p>Maximiza el espacio en tu hogar con esta guía, aprende a combinar muebles y colores para darle vida a tu espacio.</p>
                    </a>
                </div>
            </article>
        </section>

        <section data-cy="testimoniales" class="testimoniales">
            <h3>Testimoniales</h3>

            <div class="testimonial">
                <blockquote>
                    El personal se comportó de una excelente forma, muy buena atención y la casa que me ofrecieron cumple con todas mis expectativas.
                </blockquote>
                <p>- José Miguel Izquierdo</p>
            </div>
        </section>
    </div>