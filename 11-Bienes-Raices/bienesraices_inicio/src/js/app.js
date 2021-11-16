document.addEventListener('DOMContentLoaded', function() {
    eventListeners();
});

function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click', navegacionResponsive);
    // window.addEventListener('resize', cambioTamano);
}

function cambioTamano() {
    const navegacion = document.querySelector('.navegacion');
    if(window.innerWidth > 768) {
        navegacion.classList.contains('mostrar') ? navegacion.classList.remove('mostrar') : '';
    } 
}

function navegacionResponsive() {
    const navegacion = document.querySelector('.navegacion');
    if(navegacion.classList.contains('mostrar')) {
        navegacion.classList.remove('mostrar');
    } else {
        navegacion.classList.add('mostrar');
    }
}