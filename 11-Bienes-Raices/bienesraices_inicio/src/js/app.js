let oldSize = window.innerWidth;

document.addEventListener('DOMContentLoaded', function() {
    eventListeners();
});

function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click', navegacionResponsive);
    window.addEventListener('resize', cambioTamano);
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

// function heightTransition( elemento ) {
//     elemento.classList.add('alturaTemporal');
//     setTimeout(() => {
//         elemento.classList.remove('alturaTemporal');
//     }, 500);
// }

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