
    <footer class="footer seccion">
        <div class="contenedor contenedor-footer">
            <nav class="navegacion">
                <a href="/nosotros.php">Nosotros</a>
                <a href="/anuncios.php">Anuncios</a>
                <a href="/blog.php">Blog</a>
                <a href="/contacto.php">Contacto</a>
            </nav>
        </div>
        <p class="copyright">Todos los derechos reservados <?= date('Y') ?> &copy;</p>
    </footer>
</body>
</html>
<?php 
if(isset($db)){
    mysqli_close($db);
}