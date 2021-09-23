document.addEventListener('DOMContentLoaded', function() {
	scrollNav();
	navegacionFija();
});

function navegacionFija() {
	const barra = document.querySelector('.header');
	// Registrar el Intersection Observer
	const observer = new IntersectionObserver( function(entries) {
		if(entries[0].isIntersecting) {
			barra.classList.remove('fijo');
		}else{
			barra.classList.add('fijo');
		}
	});

	// Elemento a observar
	observer.observe(document.querySelector('.video'));
}

function scrollNav() {
	const enlaces = document.querySelectorAll('.navegacion-principal a');
	enlaces.forEach( enlace => {
		enlace.addEventListener('click', clickHandler);
	});
}

function clickHandler(e) {
	e.preventDefault();
	const seccion = document.querySelector(e.target.attributes.href.value);
	const header = document.querySelector('.header');
	const headerHeight = header.offsetHeight;
	let offsetTop = seccion.offsetTop;
	if(window.scrollY >= 0 && window.scrollY <= headerHeight){
		offsetTop -= headerHeight;
	}
	scroll({
		top: offsetTop - headerHeight,
		behavior: 'smooth'
	});
}
/*
https://www.udemy.com/course/desarrollo-web-completo-con-html5-css3-js-php-y-mysql/learn/lecture/24148644#questions/14505582
Hola Gisela.

Cuando leí tu pregunta caí en la cuenta de eso, no me había dado ni cuenta. Después de varias horas dándole vueltas, he obtenido una solución que funciona incluso en móviles.

El tema es que con la implementación actual, cuando se desplaza la pantalla al elemento, éste se queda en la parte superior de la pantalla.
*/
document.addEventListener('DOMContentLoaded', function() {
    crearGaleria();
});

function crearGaleria() {
    const galeria = document.querySelector('.galeria-imagenes');
    for(let i = 1, imagen, lista; i <= 12; i++) {
        imagen = document.createElement('IMG');
        imagen.src = `build/img/thumb/${i}.webp`;
        imagen.dataset.imagenId = i;

        // Añadir la función de mostrarImagen
        imagen.onclick = mostrarImagen;
        lista = document.createElement('LI');
        lista.appendChild(imagen);
        galeria.appendChild(lista);
    }
}

function mostrarImagen(e) {
    const totalImages = 12;
    let id = parseInt(e.target.dataset.imagenId);
    const imagen = getImage(id);
    
    const overlay = document.createElement('DIV');
    //overlay.appendChild(imagen);
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
        if(id === 0){
            id = totalImages;
        }else if(id === 13){
            id = 1;
        }
        return id;
    }
}
