			<fieldset>
                <legend>Información General</legend>
               
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="vendedor[nombre]" placeholder="Nombre del vendedor" value="<?= s($vendedor->nombre); ?>">

				<label for="apellido">Apellido:</label>
                <input type="text" id="apellido" name="vendedor[apellido]" placeholder="Apellido del vendedor(a)" value="<?= s($vendedor->apellido); ?>">
			</fieldset>

			<fieldset>
				<legend>Información Extra</legend>

				<label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="vendedor[telefono]" placeholder="Teléfono del vendedor(a)" value="<?= s($vendedor->telefono); ?>">
			</fieldset>