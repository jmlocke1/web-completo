<?php
use App\Notification;
use App\Propiedad;
require 'includes/app.php';
$id = isset($_GET['id']) ? filter_var($_GET['id'], FILTER_VALIDATE_INT) : '';
$error = isset($_GET['error']) ?  filter_var($_GET['error'], FILTER_VALIDATE_INT) : '';

if(!$error){
    $propiedad = Propiedad::find($id);
}

if((!$id || !$propiedad) && !$error) {
    $page = getReferer();
    debuguear($page);
    echo $page;
    header('Location: /anuncio.php?error='.Notification::PROPERTY_NOT_EXIST);
    exit;
}else {
    
}

incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <?php if(!$error): ?>
        <h2><?= $propiedad->titulo; ?></h2>

        <img loading="lazy" src="/imagenes/<?= $propiedad->imagen; ?>" alt="Imagen de la <?= $propiedad->titulo; ?>" title="Imagen de la <?= $propiedad->titulo; ?>">
    
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
        <?php else: ?>
        <div class="alerta error">
            
            <?php 
            echo Notification::errorNotification($error);
            header("refresh:3 url=/"); 
            
            ?>
            
        </div>
        <?php endif; ?>
    </main>
    
<?php
incluirTemplate('footer');