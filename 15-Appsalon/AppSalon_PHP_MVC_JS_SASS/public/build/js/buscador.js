import { mostrarAlerta } from './utilidades.js';
var fechaDesde = '';
var fechaHasta = '';
document.addEventListener('DOMContentLoaded', function () { 
	iniciarApp();
});

function iniciarApp() {
	buscarPorFecha();
}

function buscarPorFecha() {
	const fechaInput = document.querySelector('#fecha');
	fechaDesde = fechaInput.value;
	const fechaInputHasta = document.querySelector('#fecha-hasta');
	fechaHasta = fechaInputHasta.value;
	
	fechaInput.addEventListener('input', function (e) {
		const fechaSeleccionada = e.target.value;
		
		if (fechaSeleccionada > fechaHasta) {
			mostrarAlerta('No puedes seleccionar una fecha posterior a fecha Hasta: ' + fechaHasta, 'error', '.formulario');
			e.target.value = fechaDesde;
		} else {
			fechaDesde = fechaSeleccionada;
			window.location = `?fecha-desde=${fechaDesde}&fecha-hasta=${fechaHasta}`;
		}
	});
	fechaInputHasta.addEventListener('input', function (e) {
		const fechaSeleccionada = e.target.value;
		
		if ( fechaSeleccionada < fechaDesde ) {
			mostrarAlerta('No puedes seleccionar una fecha anterior a fecha Desde: ' + fechaDesde, 'error', '.formulario');
			e.target.value = fechaHasta;
		} else {
			fechaHasta = fechaSeleccionada;
			window.location = `?fecha-desde=${fechaDesde}&fecha-hasta=${fechaHasta}`;
		}
	});
}