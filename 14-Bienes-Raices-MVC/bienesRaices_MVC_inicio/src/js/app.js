let oldSize = window.innerWidth;

document.addEventListener('DOMContentLoaded', function() {
    eventListeners();
    if(window.innerWidth <= 768){
        temporaryClass(document.querySelector('.navegacion'), 'visibilidadTemporal', 500);
    }

    //Eliminar texto de confirmación de CRUD en admin/index.php
    borraMensaje();
});

function borraMensaje() {
    const mensajeConfirmAll = document.querySelectorAll('.alerta');
    mensajeConfirmAll.forEach(function(mensajeConfirm) {
        if(mensajeConfirm !== null){
            setTimeout(function() {
                const padre = mensajeConfirm.parentElement;
                padre.removeChild(mensajeConfirm);
            }, 13500);
        }
    });
    
}

function darkMode() {
    // Comprueba si estaba habilidado dark mode
    let darkLocal = window.localStorage.getItem('dark');
    if(darkLocal === 'true') {
        document.body.classList.add('dark-mode');
    }
    // Añadimos el evento de click al botón de dark mode
    document.querySelector('.dark-mode-boton').addEventListener('click', darkChange);
}

function darkChange() {
    let darkLocal = window.localStorage.getItem('dark');

    if(darkLocal === null || darkLocal === 'false') {
        // No está inicializado darkLocal
        window.localStorage.setItem('dark', true);
        document.body.classList.add('dark-mode');
    } else {
        // Está activado darkMode, por lo que se desactiva
        window.localStorage.setItem('dark', false);
        document.body.classList.remove('dark-mode');
    }
}



function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click', navegacionResponsive);
    window.addEventListener('resize', cambioTamano);
    darkMode();

    // Muestra campos condicionales
    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');
    metodoContacto.forEach(input => input.addEventListener('click', mostrarMetodosContacto));
}

function mostrarMetodosContacto(e) {
    const contactoDiv = document.querySelector('#contacto');
    const tipo = e.target.id;
    if(tipo === 'contactar-telefono'){
        contactoDiv.innerHTML = `
            <label for="telefono">Número Teléfono</label>
            <input data-cy="input-telefono" type="tel" placeholder="Tu Teléfono" name="contacto[telefono]" id="telefono">
            <p>Elija la fecha y la hora para la llamada</p>

            <label for="fecha">Fecha:</label>
            <input data-cy="input-fecha" type="date" name="contacto[fecha]" id="fecha" >

            <label for="hora">Hora</label>
            <input data-cy="input-hora" type="time" name="contacto[hora]" id="hora" min="09:00" max="18:00">
        `;
    }else if(tipo === 'contactar-email'){
        contactoDiv.innerHTML = `
            <label for="email">E-mail *</label>
            <input type="email" placeholder="Tu Email" name="contacto[email]" id="email" required>
        `;
    }else{
        console.log('No sé qué habrás tocado, pero no lo conozco');
    }
}

function cambioTamano() {
    const navegacion = document.querySelector('.navegacion');
    let newSize = window.innerWidth;
    if( newSize <= 768 && newSize < oldSize && !navegacion.classList.contains('mostrar')) {
        temporaryClass(navegacion, 'visibilidadTemporal', 500);
    } 
    oldSize = newSize;
}

function navegacionResponsive() {
    const navegacion = document.querySelector('.navegacion');
    if(navegacion.classList.contains('mostrar')) {
        navegacion.classList.remove('mostrar');
        temporaryClass(navegacion, 'alturaTemporal', 500);
    } else {
        navegacion.classList.add('mostrar');
    }
}


/**
 * Función que añade a un elemento una clase temporalmente durante
 * el tiempo pasado por parámetro
 * 
 * @param {*} element       Nodo del DOM al que añadir la clase
 * @param {*} className     Nombre de la clase a añadir
 * @param {*} time          Tiempo que tiene que estar añadida la clase
 */
function temporaryClass ( element, className, time ) {
    element.classList.add(className);
    setTimeout(() => {
        element.classList.remove(className);
    }, time);
}