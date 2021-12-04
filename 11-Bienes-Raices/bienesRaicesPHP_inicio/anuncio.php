<?php
require 'includes/funciones.php';
$id = filter_var($_GET['id'], FILTER_VALIDATE_INT);

// Obtener registro de la base de datos
$query = "SELECT * FROM propiedades WHERE id='$id'";
$resultadoConsulta = mysqli_query($db, $query);
// Se comprueba el id y el resultado. id debe ser entero y 
// existir en la base de datos
if(!$id || $resultadoConsulta->num_rows === 0) {
    header('Location: /anuncios.php?error=1');
    exit;
}
$propiedad = mysqli_fetch_assoc($resultadoConsulta);
incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
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
    </main>
    
<?php
incluirTemplate('footer');