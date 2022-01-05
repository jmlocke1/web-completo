			<fieldset>
                <legend>Información General</legend>

                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Título Propiedad" value="<?= s($propiedad->titulo); ?>">

                <label for="precio">Precio:</label>
                <input type="number" step=".01" min="<?= Config::MIN_PRICE_VALUE; ?>" max="<?= Config::MAX_PRICE_VALUE; ?>" id="precio" name="precio" placeholder="Precio Propiedad" value="<?= s($propiedad->precio); ?>">
				<div class="imagen-muestra">
				<?php if($propiedad->imagen){ ?>
					<img src="/imagenes/<?= $propiedad->imagen ?>" alt="" class="imagen-small">
				<?php } ?>
					<div class="imagen-label">
						<label for="imagen">Imagen:</label>
						<input type="file" id="imagen" name="imagen" accept="image/jpeg, image/png">
					</div>
					
				</div>
                

				

                <label for="descripcion">Descripción:</label>
                <textarea name="descripcion" id="descripcion" cols="30" rows="10" minlength="50" maxlength="3000"><?= s($propiedad->descripcion); ?></textarea>
            </fieldset>

            <fieldset>
                <legend>Información de la Propiedad</legend>

                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?= s($propiedad->habitaciones); ?>">

                <label for="wc">Baños:</label>
                <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="9" value="<?= s($propiedad->wc); ?>">

                <label for="estacionamiento">Estacionamiento:</label>
                <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 3" min="1" max="9" value="<?= s($propiedad->estacionamiento); ?>">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <select name="vendedorId" id="vendedorId">
                    <option value="">-- Seleccione --</option>
                <?php while($vendedor = mysqli_fetch_assoc($vendedores)): ?>
                    <option <?= s($propiedad->vendedorId) === $vendedor['id'] ? 'selected' : ''; ?>  value="<?= $vendedor['id']; ?>"><?= $vendedor['nombre']." ". $vendedor['apellido']; ?></option>
                <?php endwhile; ?>
                </select>
            </fieldset>