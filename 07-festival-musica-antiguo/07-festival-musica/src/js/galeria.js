document.addEventListener('DOMContentLoaded', function() {
    crearGaleria();
});

function crearGaleria() {
    const galeria = document.querySelector('.galeria-imagenes');
    for(let i = 1, imagen, lista; i <= 12; i++) {
        imagen = document.createElement('IMG') ;
        imagen.src = `build/img/thumb/${i}.webp`;
        imagen.dataset.imagenId = i;

        // Añadir la función de mostrarImagen
        imagen.onclick = mostrarImagen;
        lista = document.createElement('LI' );
        lista.appendChild(imagen);
        galeria.appendChild(lista);
    }
}

function mostrarImagen(e) {
    let id = parseInt(e.target.dataset.imagenId);
    const imagen = getImage(id);
    
    const overlay = document.createElement('DIV');
    overlay.classList.add('overlay');

    // Cuando se da click, cerrar la imagen
    //overlay.onclick = remove;

    // Botón para cerrar la imagen
    const cerrarImagen = document.createElement('P');
    cerrarImagen.textContent = 'X';
    cerrarImagen.classList.add('btn-cerrar');

    // Cuando se presiona, se cierra la imagen
    cerrarImagen.onclick = remove;

    // Botones de navegación
    const btnIzquierda = creaBoton('<');
    const btnDerecha = creaBoton('>');

    overlay.appendChild(cerrarImagen);
    overlay.appendChild(imagen);
    overlay.appendChild(btnIzquierda);
    overlay.appendChild(btnDerecha);

    // Mostrar en el HTML
    const body = document.querySelector('body');
    body.appendChild(overlay);
    body.classList.add('fijar-body');

    btnIzquierda.onclick = () => {
        id = normalizeId(id - 1);
        imagen.src = `build/img/grande/${id}.webp`;
    }
    btnDerecha.onclick = () => {
        id = normalizeId(id + 1);
        imagen.src = `build/img/grande/${id}.webp`;
    }
    function remove() {
        overlay.remove();
        body.classList.remove('fijar-body');
    }
    function creaBoton(simbolo){
        const btn = document.createElement('P');
        btn.textContent = simbolo;
        const classBtn = (simbolo === '<') ? 'btn-izquierda' : 'btn-derecha';
        btn.classList.add(classBtn);

        return btn;
    }
    function getImage(id) {
        const imagen = document.createElement('IMG');
        imagen.src = `build/img/grande/${id}.webp`;
        return imagen;
    }
    function normalizeId(id){
        const totalImages = 12;
        if(id === 0){
            id = totalImages;
        }else if(id === 13){
            id = 1;
        }
        return id;
    }
}
