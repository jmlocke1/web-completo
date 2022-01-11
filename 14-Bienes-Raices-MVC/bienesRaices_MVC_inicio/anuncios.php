<?php
require 'includes/app.php';
incluirTemplate('header');
?>

    <main class="contenedor">
        <h2>Casas y Deptos en Venta</h2>

        
        <?php 
        //$limite = 6;
        include 'includes/templates/anuncios.php'; 
        ?>
        
    </main>

<?php
incluirTemplate('footer');