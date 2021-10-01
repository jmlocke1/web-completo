document.addEventListener('DOMContentLoaded', function() {
	iniciarApp();
});

function iniciarApp() {
	mostrarServicios();
	seleccionarServicios();
}

async function mostrarServicios() {
	try {
		const resultado = await fetch('./servicios.json');
		const db = await resultado.json();

		const {servicios} = db;
		const listadoServicios = document.querySelector('#servicios');
		//let servicioDiv = '';
		// Generar el HTML
		servicios.forEach(servicio => {
			const { id, nombre, precio } = servicio;

			// DOM Scripting
			
			// Generar nombre de servicio
			const nombreServicio = document.createElement('P');
			nombreServicio.textContent = nombre;
			nombreServicio.classList.add('nombre-servicio');
			// Generar precio
			const precioServicio = document.createElement('P');
			precioServicio.textContent = `$ ${precio}`;
			precioServicio.classList.add('precio-servicio');

			// Generar div contenedor de servicio
			const servicioDiv = document.createElement('DIV');
			servicioDiv.classList.add('servicio');
			servicioDiv.dataset.idServicio = id;

			// Selecciona un servicio para la cita
			servicioDiv.onclick = seleccionarServicio;
			console
			// Inyectar precio y nombre al div de servicio
			servicioDiv.appendChild(nombreServicio);
			servicioDiv.appendChild(precioServicio);
			
			
			// Añadir el servicio al listado de servicios
			listadoServicios.appendChild(servicioDiv);

			// Solución con innerHTML
			/*
			servicioDiv += `
					<div class="servicio" data-id-servicio="${id}">
						<p class="nombre-servicio">${nombre}</p>
						<p class="precio-servicio">$ ${precio}</p>
					</div>`;*/
		});
		// Insertamos el HTML
		//document.querySelector('#servicios').innerHTML = servicioDiv;
		
	} catch (error) {
		console.log('Fichero no encontrado: ');
		console.log(error);
	}
	
}

function seleccionarServicios() {
	const servicios = document.querySelectorAll('.servicio');
	servicios.forEach(servicio => {
		console.log(servicio);
		servicio.onclick = seleccionarServicio;
	});
	
}
function seleccionarServicio(servicio) {
	console.log(`Click en servicio: `, servicio.target);
}