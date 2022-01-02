<?php
require 'includes/funciones.php';
incluirTemplate('header', ' inicio');
?>


<main class="contenedor">
        <h2>Más sobre nosotros</h2>

        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy">
                <h3>Seguridad</h3>

                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Totam eligendi doloribus sequi exercitationem. Repudiandae, ex ea voluptatum ad exercitationem, perferendis minima quo, consequuntur aut eos tenetur sint atque debitis quas quis blanditiis quibusdam dolor amet!</p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono precio" loading="lazy">
                <h3>Precio</h3>

                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Totam eligendi doloribus sequi exercitationem. Repudiandae, ex ea voluptatum ad exercitationem, perferendis minima quo, consequuntur aut eos tenetur sint atque debitis quas quis blanditiis quibusdam dolor amet!</p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono tiempo" loading="lazy">
                <h3>A Tiempo</h3>

                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Totam eligendi doloribus sequi exercitationem. Repudiandae, ex ea voluptatum ad exercitationem, perferendis minima quo, consequuntur aut eos tenetur sint atque debitis quas quis blanditiis quibusdam dolor amet!</p>
            </div>
        </div>
    </main>

    <section class="seccion contenedor">
        <h2>Casas y Deptos en Venta</h2>

        <?php 
        $limite = 3;
        include 'includes/templates/anuncios.php'; 
        ?>

        <div class="alinear-derecha">
            <a class="boton-verde" href="anuncios.php">Ver Todas</a>
        </div>
    </section>

    <section class="imagen-contacto">
        <h2>Encuentra la casa de tus sueños</h2>
        <p>Llena el formulario de contacto y un asesor se pondrá en contacto contigo con la mayor brevedad</p>
        <a href="contacto.php" class="boton-amarillo">Contáctanos</a>
    </section>

    <div class="contenedor seccion seccion-inferior">
        <section class="blog">
            <h3>Nuestro Blog</h3>

            <article class="entrada-blog">
                <picture>
                    <source srcset="build/img/blog1.avif" type="image/avif">
                    <source srcset="build/img/blog1.webp" type="image/webp">
                    <img width="200" height="300" loading="lazy" src="build/img/blog1.jpg" alt="Texto entrada blog" title="Texto entrada blog">
                </picture>
                <div class="texto-entrada">
                    <a href="entrada.php" alt="Redirige a la entrada de blog ampliada" title="Redirige a la entrada de blog ampliada">
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
                    <a href="entrada.php" alt="Redirige a la entrada de blog ampliada" title="Redirige a la entrada de blog ampliada">
                        <h4>Guía para la decoración de tu hogar.</h4>
                        <p class="informacion-meta">Escrito el: <span>20/10/2021</span> por: <span>Admin</span></p>
                        <p>Maximiza el espacio en tu hogar con esta guía, aprende a combinar muebles y colores para darle vida a tu espacio.</p>
                    </a>
                </div>
            </article>
        </section>

        <section class="testimoniales">
            <h3>Testimoniales</h3>

            <div class="testimonial">
                <blockquote>
                    El personal se comportó de una excelente forma, muy buena atención y la casa que me ofrecieron cumple con todas mis expectativas.
                </blockquote>
                <p>- José Miguel Izquierdo</p>
            </div>
        </section>
    </div>
<?php
incluirTemplate('footer');