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

// function darkMode(){
     
           
//     const prefiereDarkMode = window.matchMedia('(prefers-color-scheme-dark)');
//     if (prefiereDarkMode.matches) {
//         document.body.classList.add('dark-mode');
//     } else {
//         document.body.classList.remove('dark-mode');
//     }
        
//     prefiereDarkMode.addEventListener('change', function() {
//         if (prefiereDarkMode.matches) {
//             document.body.classList.add('dark-mode');
//         } else {
//             document.body.classList.remove('dark-mode');
//         }
//     });
 
//     console.log(prefiereDarkMode.matches);
//         //Boton DarkMode
//     const botonDarkMode = document.querySelector('.dark-mode-boton');
//     botonDarkMode.addEventListener('click', function(){
//         document.body.classList.toggle('dark-mode'); 
 
//         //Para que el modo elegido se quede guardado en local-storage
//         if (document.body.classList.contains('dark-mode')) {
//             localStorage.setItem('modo-oscuro','true');
//         } else {
//             localStorage.setItem('modo-oscuro','false');
//         }
//     });
 
//     //Obtenemos el modo del color actual
//     if (localStorage.getItem('modo-oscuro') === 'true') {
//         document.body.classList.add('dark-mode');
//     } else {
//         document.body.classList.remove('dark-mode');
//     }
// }

function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click', navegacionResponsive);
    window.addEventListener('resize', cambioTamano);
    darkMode();
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