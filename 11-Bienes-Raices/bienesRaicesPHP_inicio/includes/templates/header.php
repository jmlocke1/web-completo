<?php
if(!isset($_SESSION)) {
    session_start();
}
$auth = $_SESSION['login'] ?? false;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices - <?= getTitle() ?></title>
    <link rel="stylesheet" href="/build/css/app.css">
    <script src="/build/js/bundle.min.js" defer></script>
</head>
<body>
    <header class="header<?= $inicio ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/">
                    <img class="logo-header" src="/build/img/logo.svg" alt="Logotipo de la aplicación">
                </a>

                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="Icono Menú Responsive">
                </div>
                <div class="derecha">
                    <img src="/build/img/dark-mode.svg" alt="Icono del modo oscuro del tema" class="dark-mode-boton">
                    <nav class="navegacion">
                        <a href="/nosotros.php">Nosotros</a>
                        <a href="/anuncios.php">Anuncios</a>
                        <a href="/blog.php">Blog</a>
                        <a href="/contacto.php">Contacto</a>
                    <?php if($auth): ?>
                        <a href="/cerrar-sesion.php">Cerrar Sesión</a>
                    <?php endif; ?>
                    </nav>
                </div>
                
            </div> <!--.barra-->
            <?php if($inicio): ?>
            <h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>
            <?php endif ?>
        </div>
    </header>