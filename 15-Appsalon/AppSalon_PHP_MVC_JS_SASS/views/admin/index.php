<h1 class="nombre-pagina">Panel de Administración</h1>

<?php include TEMPLATES_URL."/barra.php"; ?>

<h2>Buscar Citas</h2>
<div class="busqueda">
	<form action="" class="formulario">
		<div class="campo">
			<label for="fecha">Fecha Desde: </label>
			<input type="date" name="fecha" id="fecha" value="<?= $fecha; ?>">
		</div>
		<div class="campo">
			<label for="fecha-hasta">Fecha Hasta: </label>
			<input type="date" name="fecha-hasta" id="fecha-hasta" value="<?= $fechaHasta; ?>">
		</div>
	</form>
</div>
<?php 
	if(count($citas) === 0){
		echo "<h2>No hay Citas en estas fechas</h2>";
	}
 ?>
<div class="citas-admin">
	<ul class="citas">
		<?php 
		$idCita = '';
		$cierraFila = false;
		$total = 0;
		foreach( $citas as $key => $cita ){
			if($cierraFila && $idCita!== $cita->id){
				echo "</li>";
			}
			if($idCita !== $cita->id){
		?>
			<li>
				<p>ID: <span><?= $cita->id; ?></span></p>
				<p>Fecha: <span><?= $cita->fecha; ?></span></p>
				<p>Hora: <span><?= $cita->hora; ?></span></p>
				<p>Cliente: <span><?= $cita->cliente; ?></span></p>
				<p>Email: <span><?= $cita->email; ?></span></p>
				<p>Teléfono: <span><?= $cita->telefono; ?></span></p>

				<h3>Servicios</h3>
			<?php 
				$idCita = $cita->id;
				$cierraFila = true;
			} // Fin de if 
			?>
				<p class="servicio"><?= $cita->servicio . " - " . $cita->precio; ?></p>
			
		<?php 
			$actual = $cita->id;
			$proximo = $citas[$key + 1]->id ?? 0;
			$total += floatval( $cita->precio );
			if(esUltimo($actual, $proximo)){
		?>
				<p>Total: <span> <?= $total; ?></span></p>
				<form action="/api/eliminar" method="POST">
					<input type="hidden" name="id" value="<?= $cita->id; ?>">
					<input type="submit" value="Eliminar" class="boton-eliminar">
				</form>
		<?php
				$total = 0;
			}
		} // Fin de foreach 
	?>
	</ul>
	
</div>

<?php 
	$script = "<script type='module' src='build/js/buscador.js'></script>";
?>