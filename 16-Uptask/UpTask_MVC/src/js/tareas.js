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
			if(e.target.classList.contains('cerrar-modal')){
				const formulario = document.querySelector('.formulario');
				formulario.classList.add('cerrar');
				setTimeout(() => {
					modal.remove();
				}, 800);
				
			}
			if (e.target.classList.contains('submit-nueva-tarea')) {
				submitFormularioNuevaTarea();
			}
		});
		document.querySelector('.dashboard').appendChild(modal);
	}

	function submitFormularioNuevaTarea() {
		const tarea = document.querySelector('#tarea').value.trim();
		const referencia = document.querySelector('.formulario legend');
		
		const textoAlerta = 'El nombre de la tarea es Obligatorio';
		if ((tarea === '')) {
			// Primero elimina una alerta igual
			const alertas = document.querySelectorAll("form .alerta");
			removeSameAlert(alertas, textoAlerta);
			mostrarAlerta(textoAlerta, 'error', referencia);
			return;
		}
		agregarTarea(tarea);
	}

	/**
	 * Función que previene que se muestre una alerta igual en un array de elementos del dom
	 * 
	 * @param {*} alertas 		Array de elementos del DOM que contienen una alerta
	 * @param {*} textoAlerta 	Texto a comparar, si se encuentra un elemento con el mismo texto, se elimina del DOM
	 */
	function removeSameAlert(alertas, textoAlerta){
		alertas.forEach(element => {
			if(textoAlerta === element.textContent){
				element.remove();
			}
		});
	}

	function mostrarAlerta(mensaje, tipo, referencia) {
		const alerta = document.createElement('DIV');
		alerta.classList.add('alerta', tipo);
		alerta.textContent = mensaje;
		referencia.parentElement.insertBefore(alerta, referencia.nextElementSibling);
		// Eliminar la alerta después de 5 segundos
		setTimeout(() => {
			alerta.remove();
		}, 5000);
	}

	// Consultar el Servidor para añadir una nueva tarea al proyecto actual
	async function agregarTarea(tarea){
		// Construir la petición
		const datos = new FormData();
		datos.append('nombre', tarea);

		try {
			const url = 'https://uptask.test/api/tarea';
			const respuesta = await fetch(url, {
				method: 'POST',
				body: datos
			});
			const resultado = await respuesta.json();
			console.log(resultado);
		} catch (error) {
			console.log(error);
		}
	}
})();
