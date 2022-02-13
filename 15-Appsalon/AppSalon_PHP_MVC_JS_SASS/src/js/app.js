import { Paginador } from './paginador.js';
import { config } from './config.js';
// const pagina = new Paginador(parseInt(localStorage.getItem('paso')));
const pagina = new Paginador(1);

const cita = {
    id: '',
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

    idCliente();
    nombreCliente();    // Añade el nombre del cliente al objeto de cita
    seleccionarFecha(); // Añade la fecha de la cita en el objeto
    seleccionarHora();  // añade la hora de la cita en el objeto

    mostrarResumen();   // Muestra el resumen de la cita
}

function ponerACero() {
    document.querySelector('#fecha').value = '';
    document.querySelector('#hora').value = '';
    cita.fecha = '';
    cita.hora = '';
    cita.servicios = [];
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

function idCliente() {
    cita.id = document.querySelector('#id').value;
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

    const fechaFormateada = formatearFecha(fecha);

    const fechaCita = document.createElement('P');
    fechaCita.innerHTML = `<span>Fecha:</span> ${fechaFormateada}`;

    const horaCita = document.createElement('P');
    horaCita.innerHTML = `<span>Hora:</span> ${hora} Horas`;

    // Botón para crear una cita
    const botonReservarCita = document.createElement('BUTTON');
    botonReservarCita.classList.add('boton');
    botonReservarCita.textContent = 'Reservar Cita';
    botonReservarCita.onclick = reservarCita;

    resumen.appendChild(nombreCliente);
    resumen.appendChild(fechaCita);
    resumen.appendChild(horaCita);
    resumen.appendChild(botonReservarCita);
}

function formatearFecha(fecha, codificacion = 'es-ES') {
    // Formatear la fecha en español
    const fechaObj = new Date(fecha);
    const mes = fechaObj.getMonth();
    const dia = fechaObj.getDate();
    const year = fechaObj.getFullYear();
    const fechaUTC = new Date(Date.UTC(year, mes, dia));
    const fechaFormateada = fechaUTC.toLocaleDateString(codificacion, {
        weekday: "long",
        day: "numeric",
        month: "long",
        year: "numeric"
    });
    return fechaFormateada;
}

async function reservarCita() {
    const { id, fecha, hora, servicios } = cita;
    const datos = new FormData();
    const idServicios = servicios.map(servicio => servicio.id);
    
    
    datos.append('usuarioid', id);
    datos.append('fecha', fecha);
    datos.append('hora', hora);
    datos.append('servicios', idServicios);
    // console.log([...datos]);
    
    try {
        const url = window.location.origin + '/api/citas';
        const respuesta = await fetch(url, {
            method: 'POST',
            body: datos
        });

        const resultado = await respuesta.json();
        console.log(resultado);
        if (resultado.resultado) {
            let mensaje = `Tu cita para el día ${cita.fecha} a las ${cita.hora} ha sido creada correctamente`;
            if (resultado.servicios.errores) {
                let serviciosFallidos = Object.keys(resultado.servicios.errores).length;
                mensaje += `, pero ${serviciosFallidos} servicios no se han podido guardar`;
            }
            Swal.fire({
                icon: 'success',
                title: 'Cita creada correctamente.',
                text: mensaje
            }).then(() => {
                window.location.reload();
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Hubo un error al guardar la cita: '+ resultado.error
            }).then(() => {
                window.location.reload();
            });
        }
    } catch (error) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Hay un problema con el servidor: '+ error
        }).then(() => {
            window.location.reload();
        });
    }
    
}