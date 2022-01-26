<?php
if(!isset($_SESSION)) {
    session_start();
}
$auth = $_SESSION['login'] ?? false;
if(!isset($inicio)){
	$inicio = false;
}

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
    <header class="header<?= $inicio ?? '' ?>">
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
                    <nav data-cy="navegacion-header" class="navegacion">
                        <a href="/nosotros">Nosotros</a>
                        <a href="/propiedades">Propiedades</a>
                        <a href="/blog">Blog</a>
                        <a href="/contacto">Contacto</a>
                    <?php if(!$auth): ?>
                        <a href="/login">Login</a>
                    <?php endif; ?>
                    <?php if($auth): ?>
                        <a href="/logout">Cerrar Sesión</a>
                        <a href="/admin">Admin</a>
                    <?php endif; ?>
                    </nav>
                </div>
                
            </div> <!--.barra-->
            <?php if($inicio): ?>
            <h1 data-cy="heading-sitio">Venta de Casas y Departamentos Exclusivos de Lujo</h1>
            <?php endif ?>
        </div>
    </header>

<?= $contenido; ?>

    <footer class="footer seccion">
        <div class="contenedor contenedor-footer">
            <nav data-cy="navegacion-footer" class="navegacion">
                <a href="/nosotros">Nosotros</a>
                <a href="/propiedades">Propiedades</a>
                <a href="/blog">Blog</a>
                <a href="/contacto">Contacto</a>
            <?php if(!$auth): ?>
                <a href="/login">Login</a>
            <?php endif; ?>
            <?php if($auth): ?>
                <a href="/logout">Cerrar Sesión</a>
                <a href="/admin">Admin</a>
            <?php endif; ?>
            </nav>
        </div>
        <p data-cy="copyright" class="copyright">Todos los derechos reservados <?= date('Y') ?> &copy;</p>
    </footer>
</body>
</html>