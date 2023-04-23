(function(){
	obtenerTareas();
	let tareas = [];

	// Botón para mostrar el Modal de Agregar Tarea
	const nuevaTareaBtn = document.querySelector('#agregar-tarea');
	nuevaTareaBtn.addEventListener('click', function() {
		mostrarFormulario();
	});

	async function obtenerTareas(){
		try {
			const id = obtenerProyecto();
			const url = `/api/tareas?id=${id}`;
			const respuesta = await fetch(url);
			const resultado = await respuesta.json();
			tareas = resultado.tareas;
			mostrarTareas();
		} catch (error) {
			console.log(error);
		}
	}

	function mostrarTareas() {
		limpiarTareas();
		
		if(tareas.length === 0){
			const contenedorTareas = document.querySelector('#listado-tareas');

			const textoNotareas = document.createElement('LI');
			textoNotareas.textContent = 'No Hay Tareas';
			textoNotareas.classList.add('no-tareas');

			contenedorTareas.appendChild(textoNotareas);
			return;
		}
		const estados = {
			0: 'Pendiente',
			1: 'Completa'
		}
		tareas.forEach(tarea => {
			const contenedorTarea = document.createElement('LI');
			contenedorTarea.dataset.tareaId = tarea.id;
			contenedorTarea.classList.add('tarea');
			const nombreTarea = document.createElement('P');
			nombreTarea.textContent = tarea.nombre;
			nombreTarea.ondblclick = function() {
				mostrarFormulario(true, tarea);
			}

			const opcionesDiv = document.createElement('DIV');
			opcionesDiv.classList.add('opciones');

			// Botones
			const btnEstadoTarea = document.createElement('BUTTON');
			btnEstadoTarea.classList.add('estado-tarea');
			btnEstadoTarea.classList.add(`${estados[tarea.estado].toLowerCase()}`)
			btnEstadoTarea.textContent = estados[tarea.estado];
			btnEstadoTarea.dataset.estadoTarea = tarea.estado;
			btnEstadoTarea.title = "Doble click para cambiar el estado";
			btnEstadoTarea.ondblclick = function() {
				cambiarEstadoTarea({...tarea});
			};

			const btnEliminarTarea = document.createElement('BUTTON');
			btnEliminarTarea.classList.add('eliminar-tarea');
			btnEliminarTarea.dataset.idTarea = tarea.id;
			btnEliminarTarea.textContent = 'Eliminar';
			btnEliminarTarea.title = "Doble click para eliminar la tarea";
			btnEliminarTarea.ondblclick = function(){
				confirmarEliminarTarea({...tarea});
			}

			opcionesDiv.appendChild(btnEstadoTarea);
			opcionesDiv.appendChild(btnEliminarTarea);

			contenedorTarea.appendChild(nombreTarea);
			contenedorTarea.appendChild(opcionesDiv);

			const listadoTareas = document.querySelector('#listado-tareas');
			listadoTareas.appendChild(contenedorTarea);
		});
	}

	function mostrarFormulario(editar = false) {
		console.log(editar);
		const modal = document.createElement('DIV');
		modal.classList.add('modal');
		modal.innerHTML = `
		<form action="" class="formulario nueva-tarea">
			<legend>${editar ? 'Editar Tarea' : 'Añade una nueva tarea'}</legend>
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
		document.querySelector('#tarea').focus();
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
		datos.append('proyectoId', obtenerProyecto());

		try {
			const url = '/api/tarea';
			const respuesta = await fetch(url, {
				method: 'POST',
				body: datos
			});
			const resultado = await respuesta.json();

			const alertas = document.querySelectorAll("form .alerta");
			const textoAlerta = resultado.mensaje;
			removeSameAlert(alertas, textoAlerta);
			mostrarAlerta(textoAlerta, resultado.tipo, document.querySelector('.formulario legend'));

			if(resultado.tipo === 'exito'){
				const modal = document.querySelector('.modal');
				const add_button = document.querySelector('.opciones .submit-nueva-tarea');
				add_button.remove();
				setTimeout(() => {
					modal.remove();
				}, 3000);

				// Agregar el objeto de tarea al global de tareas
				const tareaObj = {
					id: String(resultado.id),
					nombre: tarea,
					estado: "0",
					proyectoId: resultado.proyectoId
				}
				tareas = [...tareas, tareaObj];
				mostrarTareas();
			}
		} catch (error) {
			console.log(error);
		}
	}

	function cambiarEstadoTarea(tarea){
		const nuevoEstado = tarea.estado === "1" ? "0" : "1";
		tarea.estado = nuevoEstado;
		actualizarTarea(tarea);
	}

	function obtenerDatosTarea(tarea){
		const {estado, id, nombre, proyectoId} = tarea;
		const datos = new FormData();
		datos.append('id', id);
		datos.append('nombre', nombre);
		datos.append('estado', estado);
		datos.append('proyectoId', obtenerProyecto());
		return datos;
	}

	async function actualizarTarea(tarea){
		const datos = obtenerDatosTarea(tarea);

		try {
			const url = '/api/tarea/actualizar';

			const respuesta = await fetch(url, {
				method: 'POST',
				body: datos
			});
			const resultado = await respuesta.json();
			if(resultado.respuesta.tipo === 'exito'){
				mostrarAlerta(
					resultado.respuesta.mensaje, 
					resultado.respuesta.tipo,
					document.querySelector('.contenedor-nueva-tarea')
				);

				tareas = tareas.map(tareaMemoria => {
					if(tareaMemoria.id === tarea.id){
						tareaMemoria.estado = tarea.estado;
					}
					return tareaMemoria;
				});
				mostrarTareas();
			}
			
		} catch (error) {
			console.log(error);
		}
	}

	function confirmarEliminarTarea(tarea){
		Swal.fire({
			title: `¿Eliminar Tarea "${tarea.nombre}"?`,
			showCancelButton: true,
			confirmButtonText: 'Sí',
			cancelButtonText: `No`,
		}).then((result) => {
			
			if (result.isConfirmed) {
				eliminarTarea(tarea);
			}
		})
	}

	async function eliminarTarea(tarea){
		const datos = obtenerDatosTarea(tarea);
		try {
			const url = `/api/tarea/eliminar`;
			const respuesta = await fetch(url, {
				method: 'POST',
				body: datos
			});
			const resultado = await respuesta.json();
			if(resultado.respuesta.tipo === "exito"){
				// mostrarAlerta(
				// 	resultado.respuesta.mensaje, 
				// 	resultado.respuesta.tipo,
				// 	document.querySelector('.contenedor-nueva-tarea')
				// );
				Swal.fire('Eliminado', resultado.respuesta.mensaje, 'success');
				tareas = tareas.filter( tareaMemoria => tareaMemoria.id !== tarea.id);
				mostrarTareas();
			}
		} catch (error) {
			console.log(error);
		}
	}

	/**
	 * Devuelve el id del proyecto obteniéndolo de la url
	 * 
	 * @returns string 	id del proyecto
	 */
	function obtenerProyecto() {
		const proyectoParams = new URLSearchParams(window.location.search);
		const proyecto = Object.fromEntries(proyectoParams.entries());
		return proyecto.id;
	}

	function limpiarTareas() {
		const listadoTareas = document.querySelector('#listado-tareas');

		while(listadoTareas.firstChild) {
			listadoTareas.removeChild(listadoTareas.firstChild);
		}
	}
})();
