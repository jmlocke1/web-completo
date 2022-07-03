<?php
if(isset($alertas)):
	foreach ($alertas as $tipoAlerta => $alerta) :
		foreach ($alerta as $mensaje):
?>
		<div class="alerta <?= $tipoAlerta; ?>"><?= $mensaje; ?></div>
<?php 
		endforeach;
	endforeach;
endif;
?>