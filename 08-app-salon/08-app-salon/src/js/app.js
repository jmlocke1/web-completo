let pagina = 1;
document.addEventListener('DOMContentLoaded', function() {
	iniciarApp();
});

function iniciarApp() {
	mostrarServicios();

	// Resalta el Div Actual según el tab al que se presiona
	mostrarSeccion();

	// Oculta o muestra una sección según el tab al que se presiona
	cambiarSeccion();

	// Paginación siguiente y anterior
	paginaAnterior();

	paginaSiguiente();
}

function mostrarSeccion() {
	const seccionActual = document.querySelector(`#paso-${pagina}`);
	seccionActual.classList.add('mostrar-seccion');

	// Resalta el tab actual
	const tab = document.querySelector(`[data-paso="${pagina}"]`);
	tab.classList.add('actual');
}

function cambiarSeccion() {
	const enlaces = document.querySelectorAll('.tabs button');

	enlaces.forEach( enlace => {
		enlace.addEventListener('click', e => {
			e.preventDefault();
			pagina = parseInt(e.target.dataset.paso);

			// Eliminar mostrar-seccion de la seccion anterior
			document.querySelector('.mostrar-seccion').classList.remove('mostrar-seccion');

			// Agrega mostrar-seccion donde dimos click
			const seccion = document.querySelector(`#paso-${pagina}`);
			seccion.classList.add('mostrar-seccion');

			// Eliminar actual de la sección anterior
			document.querySelector('.tabs .actual').classList.remove('actual');

			// Eliminar la clase actual en el tab anterior
			

			// Agregar la clase actual en el nuevo tab
			const actual = document.querySelector(`[data-paso="${pagina}"]`);
			actual.classList.add("actual");
		});
	});
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


function seleccionarServicio(servicio) {
	let elemento;
	if(servicio.target.tagName == 'P'){
		elemento = servicio.target.parentElement;
	}else {
		elemento = servicio.target;
	}
	if(elemento.classList.contains('seleccionado')) {
		elemento.classList.remove('seleccionado');
	}else{
		elemento.classList.add('seleccionado');
	}
}

function paginaSiguiente() {
	const paginaSiguiente = document.querySelector('#siguiente');
	paginaSiguiente.addEventListener('click', () => {
		pagina++;
		console.log(pagina);
		switch (pagina) {
			case 3:
				console.log('Has llegado a la página 3');
				break;
			case 4:
				console.log('Página mayor que 3, pasamos a página 1');
				pagina = 1;
			default:
				break;
		}
	});
}

function paginaAnterior() {
	const paginaSiguiente = document.querySelector('#anterior');
	paginaSiguiente.addEventListener('click', () => {
		pagina--;
		console.log(pagina);
		switch (pagina) {
			case 1:
				console.log('Has llegado a la página 1');
				break;
			case 0:
				console.log('Página menor que 0, pasamos a página 3');
				pagina = 3;
			default:
				break;
		}
	});
}