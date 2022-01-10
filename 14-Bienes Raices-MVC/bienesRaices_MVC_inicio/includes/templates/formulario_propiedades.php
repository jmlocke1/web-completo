			<fieldset>
                <legend>Información General</legend>
               
                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="propiedad[titulo]" placeholder="Título Propiedad" value="<?= s($propiedad->titulo); ?>">

                <label for="precio">Precio:</label>
                <input type="number" step=".01" min="<?= Config::MIN_PRICE_VALUE; ?>" max="<?= Config::MAX_PRICE_VALUE; ?>" id="precio" name="propiedad[precio]" placeholder="Precio Propiedad" value="<?= s($propiedad->precio); ?>">
				<div class="imagen-muestra">
				<?php if($propiedad->imagen){ ?>
					<img src="/imagenes/<?= $propiedad->imagen ?>" alt="" class="imagen-small">
				<?php } ?>
					<div class="imagen-label">
						<label for="imagen">Imagen:</label>
						<input type="file" id="imagen" name="propiedad[imagen]" accept="image/jpeg, image/png">
					</div>
					
				</div>

                <label for="descripcion">Descripción:</label>
                <textarea name="propiedad[descripcion]" id="descripcion" cols="30" rows="10" minlength="50" maxlength="3000"><?= s($propiedad->descripcion); ?></textarea>
            </fieldset>

            <fieldset>
                <legend>Información de la Propiedad</legend>

                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" name="propiedad[habitaciones]" placeholder="Ej: 3" min="1" max="9" value="<?= s($propiedad->habitaciones); ?>">

                <label for="wc">Baños:</label>
                <input type="number" id="wc" name="propiedad[wc]" placeholder="Ej: 3" min="1" max="9" value="<?= s($propiedad->wc); ?>">

                <label for="estacionamiento">Estacionamiento:</label>
                <input type="number" id="estacionamiento" name="propiedad[estacionamiento]" placeholder="Ej: 3" min="1" max="9" value="<?= s($propiedad->estacionamiento); ?>">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>
                <label for="vendedor">Vendedor</label>
                <select name="propiedad[vendedorId]" id="vendedor">
                    <option selected value="">-- Seleccione --</option>
                <?php foreach ($vendedores as $vendedor) { ?>
                    <option <?= s($propiedad->vendedorId) == s($vendedor->id) ? 'selected' : ''; ?>  value="<?= s($vendedor->id); ?>"><?= s($vendedor->nombre)." ". s($vendedor->apellido); ?></option>
                <?php } ?>
                </select>
            </fieldset>