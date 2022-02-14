<h1 class="nombre-pagina">Panel de Administración</h1>

<?php include TEMPLATES_URL."/barra.php"; ?>

<h2>Buscar Citas</h2>
<div class="busqueda">
	<form action="" class="formulario">
		<div class="campo">
			<label for="fecha">Fecha</label>
			<input type="date" name="fecha" id="fecha" value="<?= $fecha; ?>">
		</div>
	</form>
</div>

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
			echo "<p>Total: <span> $total</span></p>";
			$total = 0;
		}
		} // Fin de foreach 
	?>
	</ul>
	
</div>