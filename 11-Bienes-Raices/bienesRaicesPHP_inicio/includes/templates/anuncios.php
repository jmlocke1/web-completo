<?php
require_once __DIR__ . '/../funciones.php';

// Consultar
$limitarRegistros = isset($limite) ? "LIMIT $limite" : '';
$query = "SELECT * FROM propiedades $limitarRegistros";

// Obtener resultado
$resultado = mysqli_query($db, $query);


?>

<div class="contenedor-anuncios">
    <?php while($propiedad = mysqli_fetch_assoc($resultado)): ?>
            <div class="anuncio">
                    
                <img loading="lazy" src="/imagenes/<?= $propiedad['imagen']; ?>"  alt="Imagen de la propiedad <?= $propiedad['titulo']; ?>" title="Imagen de la propiedad <?= $propiedad['titulo']; ?>">
                
                <div class="contenido-anuncio">
                    <h3><?= $propiedad['titulo']; ?></h3>
                    <p><?= truncate($propiedad['descripcion'], TRUNCATE_LIMIT); ?></p>
                    <p class="precio">$<?= $propiedad['precio']; ?></p>
                    <ul class="iconos-caracteristicas">
                        <li>
                            <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono WC">
                            <p><?= $propiedad['wc']; ?></p>
                        </li>
                        <li>
                            <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                            <p><?= $propiedad['estacionamiento']; ?></p>
                        </li>
                        <li>
                            <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono dormitorio">
                            <p><?= $propiedad['habitaciones']; ?></p>
                        </li>
                    </ul>
                    <a href="anuncio.php?id=<?= $propiedad['id']; ?>" class="boton-amarillo-block">Ver Propiedad</a>
                </div> <!--.contenido-anuncio-->
            </div><!--.anuncio-->
    <?php endwhile; ?>
        </div><!--.contenedor-anuncio-->