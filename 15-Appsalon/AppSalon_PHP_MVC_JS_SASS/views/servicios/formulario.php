<div class="campo">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" id="nombre" placeholder="Nombre Servicio" value="<?= $servicio->nombre; ?>">
</div>

<div class="campo">
    <label for="precio">Precio</label>
    <input type="number" step="0.01" name="precio" id="precio" placeholder="Precio Servicio" value="<?= $servicio->precio; ?>">
</div>