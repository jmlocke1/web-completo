(function(){
	// Botón para mostrar el Modal de Agregar Tarea
	const nuevaTareaBtn = document.querySelector('#agregar-tarea');
	nuevaTareaBtn.addEventListener('click', mostrarFormulario);

	function mostrarFormulario() {
		const modal = document.createElement('DIV');
		modal.classList.add('modal');
		modal.innerHTML = `
		<form action="" class="formulario nueva-tarea">
			<legend>Añade una nueva tarea</legend>
			<div class="campo">
				<label for="tarea">Tarea</label>
				<input type="text" name="tarea" placeholder="Añadir Tarea al Proyecto Actual" id="tarea">
			</div>
			<div class="opciones">
				<input type="submit" class="submit-nueva-tarea" value="Añadir Tarea">
				<button type="button" class="cerrar-modal">Cancelar</button>
			</div>
		</form>
		`;
		setTimeout(() => {
			const formulario = document.querySelector('.formulario');
			formulario.classList.add('animar');
		}, 0);

		modal.addEventListener('click', function(e){
			e.preventDefault();
			console.log(e.target);
		});
		document.querySelector('body').appendChild(modal);
	}
})();
