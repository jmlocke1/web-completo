import { Paginador } from './paginador.js';
let paso = parseInt(localStorage.getItem('paso'));
const pagina = new Paginador(parseInt(localStorage.getItem('paso')));
if (!paso) {
    paso = 1;
    localStorage.setItem('paso', 1);
}

document.addEventListener('DOMContentLoaded', function () {
    iniciarApp();
});

function iniciarApp() {
    // Cambia la sección cuando se presionan los tabs
    mostrarSeccion();   // Muestra y oculta las secciones
    tabs();             // Cambia la sección cuando se presionen los tabs
    botonesPaginador(); // Agrega o quita los botones del paginador
}

function mostrarSeccion() {
    // Ocultar la sección que tenga la clase de mostrar
    const seccionAnterior = document.querySelector('.mostrar');
    if (seccionAnterior) {
        seccionAnterior.classList.remove('mostrar');
    }
    
    // Seleccionar la sección con el paso
    const seccion = document.querySelector(`#paso-${pagina.PaginaActual}`);
    seccion.classList.add('mostrar');

    // Quita la clase de actual al tab anterior
    const tabAnterior = document.querySelector('.actual');
    if (tabAnterior) {
        tabAnterior.classList.remove('actual');
    }

    // Resalta el tab actual
    const tab = document.querySelector(`[data-paso="${pagina.PaginaActual}"]`);
    tab.classList.add('actual');
}
function tabs() {
    const botones = document.querySelectorAll('.tabs button');
    botones.forEach(boton => { 
        boton.addEventListener('click', function (e) {
            paso = parseInt(e.target.dataset.paso);
            pagina.setPaginaActual( parseInt(e.target.dataset.paso) );
            localStorage.setItem('paso', pagina.PaginaActual);
            mostrarSeccion();
            botonesPaginador();
        });
    });
}
function botonesPaginador() {
    const paginaAnterior = document.querySelector('#anterior');
    const paginaSiguiente = document.querySelector('#siguiente');
    if ( pagina.isFirstPage ) {
        paginaAnterior.classList.add('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    } else if( pagina.isLastPage ) {
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.add('ocultar');
    } else {
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    }
    
}