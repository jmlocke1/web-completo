document.addEventListener('DOMContentLoaded', function() {
    iniciarApp();
});

function iniciarApp() {
    crearGaleria();
}

function crearGaleria() {
    const galeria = document.querySelector('.galeria-imagenes');
    let imagen
    for(let i = 1; i <= 12; i++) {
        imagen = document.createElement('picture');
        imagen.innerHTML = `
            <source srcset="build/img/thumb/${i}.avif" type="image/avif">
            <source srcset="build/img/thumb/${i}.webp" type="image/webp"> 
            <img width="200" height="300" loading="lazy" src="build/img/thumb/${i}.jpg" alt="Imagen ${i} de la galería" title="Imagen ${i} de la galería">
        `;
        imagen.onclick = function() {
            mostrarImagen(i);
        }
        galeria.appendChild(imagen);
    }
}

function mostrarImagen(id) {
    imagen = document.createElement('PICTURE');
    imagen.innerHTML = `
        <source srcset="build/img/grande/${id}.avif" type="image/avif">
        <source srcset="build/img/grande/${id}.webp" type="image/webp"> 
        <img width="200" height="300" loading="lazy" src="build/img/grande/${id}d.jpg" alt="Imagen ${id} de la galería" title="Imagen ${id} de la galería">
    `;
    
    const overlay = document.createElement('DIV');
    overlay.appendChild(imagen);
    overlay.classList.add('overlay');

    const body = document.querySelector('body');
    body.appendChild(overlay);
}