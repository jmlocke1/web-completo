document.addEventListener('DOMContentLoaded', function() {
    crearGaleria();
});

function crearGaleria() {
    const galeria = document.querySelector('.galeria-imagenes');
    for(let i = 1, imagen, lista; i <= 12; i++) {
        imagen = document.createElement('IMG');
        imagen.src = `build/img/thumb/${i}.webp`;

        // Añadir la función de mostrarImagen
        //imagen.onclick = mostrarImagen;
        imagen.setPointerCapture(mostrarImagen);
        lista = document.createElement('LI');
        lista.appendChild(imagen);
        galeria.appendChild(lista);
    }
}

function mostrarImagen() {
    console.log('Diste click en una imagen');
}