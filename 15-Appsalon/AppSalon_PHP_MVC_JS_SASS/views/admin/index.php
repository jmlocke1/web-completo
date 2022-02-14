<h1 class="nombre-pagina">Panel de Administración</h1>

<?php include TEMPLATES_URL."/barra.php"; ?>

<h2>Buscar Citas</h2>
<div class="busqueda">
	<form action="" class="formulario">
		<div class="campo">
			<label for="fecha">Fecha</label>
			<input type="date" name="fecha" id="fecha">
		</div>
	</form>
</div>

<div class="citas-admin">
	<ul class="citas">
		<?php 
		$idCita = '';
		foreach( $citas as $cita ){ 
			if($idCita !== $cita->id){
		?>
			<li>
				<p>ID: <span><?= $cita->id; ?></span></p>
				<p>Hora: <span><?= $cita->hora; ?></span></p>
				<p>Cliente: <span><?= $cita->cliente; ?></span></p>
			<?php 
				$idCita = $cita->id;
			} // Fin de if 
			?>
			</li>
		<?php } // Fin de foreach ?>
	</ul>
	
</div>