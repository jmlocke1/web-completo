document.addEventListener('DOMContentLoaded', function() {
	iniciarApp();
});

function iniciarApp() {
	mostrarServicios();
}

async function mostrarServicios() {
	try {
		const resultado = await fetch('./servicios.json');
		const db = await resultado.json();

		const {servicios} = db;
		//const listadoServicios = document.querySelector('#servicios');
		let servicioDiv = '';
		// Generar el HTML
		servicios.forEach(servicio => {
			const { id, nombre, precio } = servicio;

			// DOM Scripting
			/*
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

			// Inyectar precio y nombre al div de servicio
			servicioDiv.appendChild(nombreServicio);
			servicioDiv.appendChild(precioServicio);
			*/
			
			// Añadir el servicio al listado de servicios
			// listadoServicios.appendChild(servicioDiv);

			// Solución con innerHTML
			servicioDiv += `
					<div class="servicio" data-id-servicio="${id}">
						<p class="nombre-servicio">${nombre}</p>
						<p class="precio-servicio">$ ${precio}</p>
					</div>`;
		});
		// Insertamos el HTML
		document.querySelector('#servicios').innerHTML = servicioDiv;
	} catch (error) {
		console.log('Fichero no encontrado: ');
		console.log(error);
	}
	
}