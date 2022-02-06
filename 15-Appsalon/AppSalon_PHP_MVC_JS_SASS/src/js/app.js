import { Paginador } from './paginador.js';

const pagina = new Paginador(parseInt(localStorage.getItem('paso')));

const cita = {
    nombre: '',
    fecha: '',
    hora: '',
    servicios: []
}
document.addEventListener('DOMContentLoaded', function () {
    iniciarApp();
});

function iniciarApp() {
    // Cambia la sección cuando se presionan los tabs
    mostrarSeccion();   // Muestra y oculta las secciones
    tabs();             // Cambia la sección cuando se presionen los tabs
    botonesPaginador(); // Agrega o quita los botones del paginador
    paginaSiguiente();
    paginaAnterior();

    consultarAPI();     // Consulta la API en el Backend de PHP
    nombreCliente();    // Añade el nombre del cliente al objeto de cita
    seleccionarFecha(); // Añade la fecha de la cita en el objeto
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
            pagina.setPaginaActual( parseInt(e.target.dataset.paso) );
            localStorage.setItem('paso', pagina.PaginaActual);
            //mostrarSeccion();
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
    mostrarSeccion();
}



function paginaAnterior() {
    const paginaAnterior = document.querySelector('#anterior');
    paginaAnterior.addEventListener('click', function () {
        pagina.decrementa();
        //mostrarSeccion();
        botonesPaginador();
    } );
    
}

function paginaSiguiente() {
    const paginaSiguiente = document.querySelector('#siguiente');
    paginaSiguiente.addEventListener('click', function () {
        pagina.incrementa();
        //mostrarSeccion();
        botonesPaginador();
    } );
}

async function consultarAPI() {
    try {
        const url = 'https://appsalon.test/api/servicios';
        const resultado = await fetch(url);
        const servicios = await resultado.json();
        mostrarServicios(servicios);
    } catch (error) {
        console.log(error);
    }
}

function mostrarServicios(servicios) {
    const containerServicios = document.querySelector('#servicios');
    servicios.forEach(servicio => {
        const { id, nombre, precio } = servicio;
        const nombreServicio = document.createElement('P');
        nombreServicio.classList.add('nombre-servicio');
        nombreServicio.textContent = nombre;

        const precioServicio = document.createElement('P');
        precioServicio.classList.add('precio-servicio');
        precioServicio.textContent = `$${precio}`;
        
        const servicioDiv = document.createElement('DIV');
        servicioDiv.classList.add('servicio');
        servicioDiv.dataset.idServicio = id;
        servicioDiv.appendChild(nombreServicio);
        servicioDiv.appendChild(precioServicio);
        servicioDiv.onclick = () => {
            seleccionarServicio(servicio);
        };
        containerServicios.appendChild(servicioDiv);
    });
}

function seleccionarServicio(servicio) {
    const { id } = servicio;
    const { servicios } = cita;

    // Identificar el elemento al que se le da click
    const divServicio = document.querySelector(`[data-id-servicio="${id}"]`);
    // Comprobar si un servicio ya fue agregado
    if (servicios.some(agregado => agregado.id === id)) {
        // Eliminarlo
        cita.servicios = servicios.filter(agregado => agregado.id !== id);
        divServicio.classList.remove('seleccionado');
    } else {
        // Agregarlo
        cita.servicios = [...servicios, servicio];
        divServicio.classList.add('seleccionado');
    }
    console.log(cita);
}

function nombreCliente() {
    cita.nombre = document.querySelector('#nombre').value;
}

function seleccionarFecha() {
    const inputFecha = document.querySelector('#fecha');
    inputFecha.addEventListener('input', function (e) {
        const dia = new Date(e.target.value).getUTCDay();
        console.log('Día: ', dia);
        if ([6, 0].includes(dia)) {
            e.target.value = '';
            mostrarAlerta('Fines de semana no abrimos', 'error');
            console.log('Estamos en alerta');
        } else {
            cita.fecha = e.target.value;
        }
    })
}

function mostrarAlerta(mensaje, tipo) {
    const alerta = document.createElement('DIV');
    alerta.textContent = mensaje;
    
    alerta.classList.add('alerta');
    alerta.classList.add(tipo);

    const formulario = document.querySelector('.formulario');
    // Previene que se genere más de una alerta
    alerta.id = 'weekend';
    const alertaAnterior = document.querySelector('#weekend');
    if (alertaAnterior) {
        alertaAnterior.remove();
    }
    formulario.appendChild(alerta);
    // Eliminar la alerta pasados 3 segundos
    setTimeout(() => {
        alerta.remove();
    }, 3000);
}