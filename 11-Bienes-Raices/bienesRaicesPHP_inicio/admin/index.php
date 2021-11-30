<?php

// Muestra mensaje condicional
// $resultado = isset($_GET['resultado']) ? (int)filter_var( $_GET['resultado'], FILTER_SANITIZE_NUMBER_INT)  : 0;
$resultado = (int)filter_var( $_GET['resultado'], FILTER_SANITIZE_NUMBER_INT) ?? 0;
var_dump($_GET);
var_dump($resultado);
require '../includes/funciones.php';
incluirTemplate('header');
?>

    <main class="contenedor">
        <h2>Administrador de Bienes Raices</h2>
        <?php if($resultado === 1): ?>
        <p class="alerta exito">Anuncio creado correctamente</p>
        <?php endif; ?>
        <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>

        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>1</td>
                    <td>Casa en la playa</td>
                    <td><img src="/imagenes/37608246e4fe3296343cf6424ba0f89c.jpg" class="imagen-tabla" alt="Imagen del anuncio" title="Imagen del anuncio"> </td>
                    <td>$120000</td>
                    <td class="alinear-centro">
                        <a href="#" class="boton-rojo-block">Eliminar</a>
                        <a href="#" class="boton-verde-block">Actualizar</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </main>

<?php
incluirTemplate('footer');