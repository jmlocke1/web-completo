<?php
require 'includes/app.php';
incluirTemplate('header');
?>


    <main class="contenedor">
        <h2>Conoce sobre Nosotros</h2>
        <blockquote>Texto de prueba</blockquote>
        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.avif" type="image/avif">
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <img width="200" height="300" loading="lazy" src="build/img/nosotros.jpg" alt="Sobre Nosotros" title="Sobre Nosotros">
                </picture>
            </div>
            
            <div class="texto-nosotros">
                <blockquote>
                    25 Años de experiencia
                </blockquote>
                <p>Proin consequat viverra sapien, malesuada tempor tortor feugiat vitae. In dictum felis et nunc aliquet molestie. Proin tristique commodo felis, sed auctor elit auctor pulvinar. Nunc porta, nibh quis convallis sollicitudin, arcu nisl semper mi, vitae sagittis lorem dolor non risus. Vivamus accumsan maximus est, eu mollis mi. Proin id nisl vel odio semper hendrerit. Nunc porta in justo finibus tempor. Suspendisse lobortis dolor quis elit suscipit molestie. Sed condimentum, erat at tempor finibus, urna nisi fermentum est, a dignissim nisi libero vel est. Donec et imperdiet augue. Curabitur malesuada sodales congue. Suspendisse potenti. Ut sit amet convallis nisi.</p>
                <p>Aliquam lectus magna, luctus vel gravida nec, iaculis ut augue. Praesent ac enim lorem. Quisque ac dignissim sem, non condimentum orci. Morbi a iaculis neque, ac euismod felis. Fusce augue quam, fermentum sed turpis nec, hendrerit dapibus ante. Cras mattis laoreet nibh, quis tincidunt odio fermentum vel. Nulla facilisi.</p>
            </div>
        </div>
    </main>
    <section class="contenedor">
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
    </section>
<?php
incluirTemplate('footer');