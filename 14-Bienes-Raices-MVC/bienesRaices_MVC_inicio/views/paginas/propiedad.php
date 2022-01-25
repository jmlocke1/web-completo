<main class="contenedor seccion contenido-centrado">
        
        <h2 data-cy="titulo-propiedad"><?= $propiedad->titulo; ?></h2>

        <img loading="lazy" src="/build/imagenes/<?= $propiedad->imagen; ?>" alt="Imagen de la <?= $propiedad->titulo; ?>" title="Imagen de la <?= $propiedad->titulo; ?>">
    
        <div class="resumen-propiedad">
            <p class="precio">$<?= $propiedad->precio; ?></p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img loading="lazy" src="build/img/icono_wc.svg" alt="icono WC">
                    <p><?= $propiedad->wc; ?></p>
                </li>
                <li>
                    <img loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p><?= $propiedad->estacionamiento; ?></p>
                </li>
                <li>
                    <img loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono dormitorio">
                    <p><?= $propiedad->habitaciones; ?></p>
                </li>
            </ul>
            <p><?= $propiedad->descripcion; ?></p>
        </div>
        
    </main>