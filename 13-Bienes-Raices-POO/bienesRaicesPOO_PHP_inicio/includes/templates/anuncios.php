<?php
//use App\Database\DB;
//require_once __DIR__ . '/../funciones.php';
//$db = DB::getDB();
use App\Propiedad;
if(isset($limite)){
    $propiedades = Propiedad::get($limite);
}else{
    $propiedades = Propiedad::all();
}




?>

<div class="contenedor-anuncios">
    <?php foreach($propiedades as $propiedad): ?>
            <div class="anuncio">
                    
                <img loading="lazy" src="/imagenes/<?= $propiedad->imagen; ?>"  alt="Imagen de la propiedad <?= $propiedad->titulo; ?>" title="Imagen de la propiedad <?= $propiedad->titulo; ?>">
                
                <div class="contenido-anuncio">
                    <h3 title="<?= $propiedad->titulo; ?>"><?= $propiedad->titulo; ?></h3>
                    
                    <p class="anuncio-descripcion"><?= $propiedad->descripcion; ?></p>
                    
                    <p class="precio">$<?= $propiedad->precio; ?></p>
                    <ul class="iconos-caracteristicas">
                        <li>
                            <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono WC">
                            <p><?= $propiedad->wc; ?></p>
                        </li>
                        <li>
                            <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                            <p><?= $propiedad->estacionamiento; ?></p>
                        </li>
                        <li>
                            <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono dormitorio">
                            <p><?= $propiedad->habitaciones; ?></p>
                        </li>
                    </ul>
                    <a href="anuncio.php?id=<?= $propiedad->id; ?>" class="boton-amarillo-block">Ver Propiedad</a>
                </div> <!--.contenido-anuncio-->
            </div><!--.anuncio-->
    <?php endforeach; ?>
        </div><!--.contenedor-anuncio-->