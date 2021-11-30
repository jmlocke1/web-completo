<?php

// Importar la conexión
require '../includes/funciones.php';
$db = conectarDB();

// Escribir el query
$query = "SELECT * FROM propiedades";

// Consultar la BD
$resultadoConsulta = mysqli_query($db, $query);


// Muestra mensaje condicional
// $resultado = isset($_GET['resultado']) ? (int)filter_var( $_GET['resultado'], FILTER_SANITIZE_NUMBER_INT)  : 0;
$resultado = (int)filter_var( $_GET['resultado'], FILTER_SANITIZE_NUMBER_INT) ?? 0;
var_dump($_GET);
var_dump($resultado);
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
            <?php while($propiedad = mysqli_fetch_assoc($resultadoConsulta)): ?>
                <tr>
                    <td><?= $propiedad['id']; ?></td>
                    <td><?= $propiedad['titulo']; ?></td>
                    <td><img src="/imagenes/<?= $propiedad['imagen'] ?>" class="imagen-tabla" alt="Imagen de la <?= $propiedad['titulo']; ?>" title="Imagen de la <?= $propiedad['titulo']; ?>"> </td>
                    <td>$<?= $propiedad['precio']; ?></td>
                    <td class="alinear-centro">
                        <a href="#" class="boton-rojo-block">Eliminar</a>
                        <a href="#" class="boton-verde-block">Actualizar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </main>

<?php
incluirTemplate('footer');