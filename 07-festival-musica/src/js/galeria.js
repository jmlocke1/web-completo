document.addEventListener('DOMContentLoaded', function() {
    crearGaleria();
});

function crearGaleria() {
    const galeria = document.querySelector('.galeria-imagenes');
    for(let i = 1, imagen, lista; i <= 12; i++) {
        imagen = document.createElement('IMG');
        imagen.src = `build/img/thumb/${i}.webp`;

        lista = document.createElement('LI');
        lista.appendChild(imagen);
        galeria.appendChild(lista);
    }
}