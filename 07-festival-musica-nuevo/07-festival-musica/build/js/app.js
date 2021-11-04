document.addEventListener('DOMContentLoaded', function() {
    iniciarApp();
});

function iniciarApp() {
    navegacionFija();
    crearGaleria();
    scrollNav();
}

function navegacionFija() {
    const barra = document.querySelector('.header');
    const sobreFestival = document.querySelector('.sobre-festival');
    let esFijo = false;
    window.addEventListener('scroll', function() {
        if( sobreFestival.getBoundingClientRect().bottom < 0){
            barra.classList.add('fijo');
        }else{
            barra.classList.remove('fijo');
        }
    });
}

function scrollNav() {
    const enlaces = document.querySelectorAll('.navegacion-principal a');

    enlaces.forEach( enlace => {
        enlace.addEventListener('click', function(e) {
            e.preventDefault();
            const seccionScroll = e.target.attributes.href.value;
            const seccion = document.querySelector(seccionScroll);
            seccion.scrollIntoView({ behavior: 'smooth'});
        });
        
    });
}

function crearGaleria() {
    const galeria = document.querySelector('.galeria-imagenes');
    let imagen;
    for(let i = 1; i <= 12; i++) {
        imagen = document.createElement('picture');
        imagen.innerHTML = getImage(i);
        imagen.onclick = function() {
            mostrarImagen(i);
        }
        galeria.appendChild(imagen);
    }
}

function mostrarImagen(idImage) {
    let id = idImage;
    imagen = document.createElement('PICTURE');
    imagen.innerHTML = getImage(id);
    
    // Crea el Overlay con la imagen
    const overlay = document.createElement('DIV');
    overlay.classList.add('overlay');

    // Botón para cerrar el modal
    const cerrarModal = document.createElement('P');
    cerrarModal.textContent = 'X';
    cerrarModal.classList.add('btn-cerrar');
    cerrarModal.onclick = remove;

    // Botones de navegación
    const btnIzquierda = creaBoton('<');
    const btnDerecha = creaBoton('>');

    // Se añaden los elementos al overlay
    overlay.appendChild(cerrarModal);
    overlay.appendChild(imagen);
    overlay.appendChild(btnIzquierda);
    overlay.appendChild(btnDerecha);

    // Añadirlo al HTML
    const body = document.querySelector('body');
    body.appendChild(overlay);
    body.classList.add('fijar-body');
    
    // Eventos de los botones
    btnIzquierda.onclick = () => {
        id = normalizeId(id - 1);
        imagen.innerHTML = getImage(id);
    }
    btnDerecha.onclick = () => {
        id = normalizeId(id + 1);
        imagen.innerHTML = getImage(id);
    }

    // Funciones internas
    function remove() {
        body.classList.remove('fijar-body');
        overlay.remove();
    }
    /**
     * Crea un botón para seleccionar la imagen siguiente o anterior
     * @param {*} simbolo 
     * @returns Retorna un elemento DOM p, con el botón de desplazamiento
     */
    function creaBoton(simbolo){
        const btn = document.createElement('P');
        btn.textContent = simbolo;
        const classBtn = (simbolo === '<') ? 'btn-izquierda' : 'btn-derecha';
        btn.classList.add(classBtn);

        return btn;
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
function getImage(id) {
    return `
        <source srcset="build/img/grande/${id}.avif" type="image/avif">
        <source srcset="build/img/grande/${id}.webp" type="image/webp"> 
        <img width="200" height="300" loading="lazy" src="build/img/grande/${id}d.jpg" alt="Imagen ${id} de la galería" title="Imagen ${id} de la galería">
    `;
}