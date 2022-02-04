let paso = 1;

document.addEventListener('DOMContentLoaded', function () {
    iniciarApp();
});

function iniciarApp() {
    // Cambia la sección cuando se presionan los tabs
    tabs();
}

function mostrarSeccion(paso) {
    console.log('Mostrando sección ', paso)
}
function tabs() {
    const botones = document.querySelectorAll('.tabs button');
    botones.forEach(boton => { 
        boton.addEventListener('click', function (e) {
            paso = parseInt(e.target.dataset.paso);
            mostrarSeccion(paso);
        });
    });
}