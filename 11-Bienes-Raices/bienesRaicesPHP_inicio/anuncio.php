<?php

require 'includes/funciones.php';
$id = isset($_GET['id']) ? filter_var($_GET['id'], FILTER_VALIDATE_INT) : '';
$error = filter_var($_GET['error'], FILTER_VALIDATE_INT);
// Obtener registro de la base de datos
$query = "SELECT * FROM propiedades WHERE id='$id'";
$resultadoConsulta = mysqli_query($db, $query);
if((!$id || $resultadoConsulta->num_rows === 0) && !$error) {
    $page = getReferer();
    header('Location: /anuncio.php?error=1');
    exit;
}
$propiedad = mysqli_fetch_assoc($resultadoConsulta);
incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <?php if(!$error): ?>
        <h2><?= $propiedad['titulo']; ?></h2>

        <img loading="lazy" src="/imagenes/<?= $propiedad['imagen']; ?>" alt="Imagen de la <?= $propiedad['titulo']; ?>" title="Imagen de la <?= $propiedad['titulo']; ?>">
    
        <div class="resumen-propiedad">
            <p class="precio">$<?= $propiedad['precio']; ?></p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img loading="lazy" src="build/img/icono_wc.svg" alt="icono WC">
                    <p><?= $propiedad['wc']; ?></p>
                </li>
                <li>
                    <img loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p><?= $propiedad['estacionamiento']; ?></p>
                </li>
                <li>
                    <img loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono dormitorio">
                    <p><?= $propiedad['habitaciones']; ?></p>
                </li>
            </ul>
            <p><?= $propiedad['descripcion']; ?></p>
        </div>
        <?php else: ?>
        <div class="alerta error">
            La propiedad no existe.
            <?= $error; ?>
        </div>
        <?php endif; ?>
    </main>
    
<?php
incluirTemplate('footer');