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
    ponerACero()        // Pone a cero los campos de fecha y hora
    // Cambia la sección cuando se presionan los tabs
    mostrarSeccion();   // Muestra y oculta las secciones
    tabs();             // Cambia la sección cuando se presionen los tabs
    botonesPaginador(); // Agrega o quita los botones del paginador
    paginaSiguiente();
    paginaAnterior();

    consultarAPI();     // Consulta la API en el Backend de PHP
    nombreCliente();    // Añade el nombre del cliente al objeto de cita
    seleccionarFecha(); // Añade la fecha de la cita en el objeto
    seleccionarHora();  // añade la hora de la cita en el objeto

    mostrarResumen();   // Muestra el resumen de la cita
}

function ponerACero() {
    document.querySelector('#fecha').value = '';
    document.querySelector('#hora').value = '';
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
        mostrarResumen();
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
}

function nombreCliente() {
    cita.nombre = document.querySelector('#nombre').value;
}

function seleccionarFecha() {
    const inputFecha = document.querySelector('#fecha');
    inputFecha.addEventListener('input', function (e) {
        const dia = new Date(e.target.value).getUTCDay();
        if ([6, 0].includes(dia)) {
            e.target.value = '';
            mostrarAlerta('Fines de semana no abrimos', 'error', '.formulario');
        } else {
            cita.fecha = e.target.value;
        }
    })
}

function seleccionarHora() {
    const inputHora = document.querySelector('#hora');
    inputHora.addEventListener('input', function (e) {
        const horaCita = e.target.value;
        const hora = horaCita.split(":")[0];
        if (hora < 10 || hora > 18) {
            mostrarAlerta("Hora no válida", 'error', '.formulario');
            e.target.value = '';
        } else {
            cita.hora = e.target.value;
        }
    });
}

function mostrarAlerta(mensaje, tipo, elemento, desaparece = true) {
    const alerta = document.createElement('DIV');
    alerta.textContent = mensaje;
    
    alerta.classList.add('alerta');
    alerta.classList.add(tipo);

    const referencia = document.querySelector(elemento);
    // Previene que se genere más de una alerta
    // alerta.classList.add = 'weekend';
    const alertasAnteriores = document.querySelectorAll('.alerta');
    alertasAnteriores.forEach(alertaAnterior => { 
        if (alertaAnterior.textContent === mensaje) {
            alertaAnterior.remove();
        }
    });
    referencia.appendChild(alerta);
    if (desaparece) {
        // Eliminar la alerta pasados 3 segundos
        setTimeout(() => {
            alerta.remove();
        }, 3000);
    }
    
}

function mostrarResumen() {
    let error = false;
    if (cita.fecha === '') {
        mostrarAlerta('Introduzca la fecha del servicio, por favor', 'error', '.contenido-resumen');
        error = true;
    }
    if (cita.hora === '') {
        mostrarAlerta('Introduzca la hora del servicio, por favor', 'error', '.contenido-resumen');
        error = true;
    }
    if (cita.servicios.length === 0) {
        mostrarAlerta('Debe seleccionar al menos un servicio', 'error', '.contenido-resumen');
        error = true;
    }
    if(!error){
        mostrarAlerta('Cita reservada correctamente', 'exito', '.contenido-resumen');
        // Formatear el div de resumen
        formateaResumen();
    }
}

function formateaResumen() {
    const resumen = document.querySelector('.contenido-resumen');
    const { nombre, fecha, hora, servicios } = cita;

    // Heading para Servicios en Resumen
    const headingServicios = document.createElement('H3');
    headingServicios.textContent = 'Resumen de servicios';
    resumen.appendChild(headingServicios);

    servicios.forEach(servicio => {
        const { id, precio, nombre } = servicio;
        const contenedorServicio = document.createElement('DIV');
        contenedorServicio.classList.add('contenedor-servicio');

        const textoServicio = document.createElement('P');
        textoServicio.textContent = nombre;

        const precioServicio = document.createElement('P');
        precioServicio.innerHTML = `<span>Precio:</span> $${precio}`;

        contenedorServicio.appendChild(textoServicio);
        contenedorServicio.appendChild(precioServicio);

        resumen.appendChild(contenedorServicio);
    });
    // Heading para Cita en Resumen
    const headingCita = document.createElement('H3');
    headingCita.textContent = 'Resumen de Cita';
    resumen.appendChild(headingCita);

    const nombreCliente = document.createElement('P');
    nombreCliente.innerHTML = `<span>Nombre:</span> ${nombre}`;

    const fechaCita = document.createElement('P');
    fechaCita.innerHTML = `<span>Fecha:</span> ${fecha}`;

    const horaCita = document.createElement('P');
    horaCita.innerHTML = `<span>Hora:</span> ${hora} Horas`;

    resumen.appendChild(nombreCliente);
    resumen.appendChild(fechaCita);
    resumen.appendChild(horaCita);
}