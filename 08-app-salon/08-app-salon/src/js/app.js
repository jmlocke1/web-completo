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

		// Generar el HTML
		servicios.forEach(servicio => {
			const { id, nombre, precio } = servicio;

			// DOM Scripting
		});
	} catch (error) {
		console.log('Fichero no encontrado: ');
		console.log(error);
	}
}