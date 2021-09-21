
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

/*
function mostrarImagen(e){
	let id = parseInt(e.target.dataset.imagenId);
 
	const imagen = document.createElement('IMG');
	imagen.src = `build/img/grande/${id}.webp`;
 
	const overlay = document.createElement('DIV');
	overlay.appendChild(imagen);
	overlay.classList.add('overlay');
 
 
	//Boton para cerrar la imagen
	const cerrarImagen = document.createElement('P');
	cerrarImagen.textContent = 'X';
	cerrarImagen.classList.add('btn-cerrar');
 
	//Boton navegar izquierda
	const btnIzquierda = document.createElement('P');
	btnIzquierda.textContent = '<';
	btnIzquierda.classList.add('btn-izquierda');
 
	//Boton navegar derecha
	const btnDerecha = document.createElement('P');
	btnDerecha.textContent = ">";
	btnDerecha.classList.add('btn-derecha');
 
	overlay.appendChild(cerrarImagen);
	overlay.appendChild(btnIzquierda);
	overlay.appendChild(btnDerecha);
 
	//Mostrar en el HTML
	const body = document.querySelector('body');
	body.appendChild(overlay);
	body.classList.add('fijar');
 
	//Para cerrar la imagen
	cerrarImagen.onclick = function(){
		overlay.remove();	
		body.classList.remove('fijar');	
	}
 
	//Para movernos de izquierda a derecha.
	btnIzquierda.onclick = () => {
	id -= 1; //Reduciendo
		if(id > 0)
		{
			imagen.src = `build/img/grande/${id}.webp`;
			overlay.appendChild(imagen);
			overlay.appendChild(cerrarImagen);
		}else if(id < 0){
			id += 1;
		}
 
	}
 
	btnDerecha.onclick = () => {
	id += 1; //Aumentando
		if(id < 13)
		{
			imagen.src = `build/img/grande/${id}.webp`;
			overlay.appendChild(imagen);
			overlay.appendChild(cerrarImagen);
		}else if(id > 13){
			id -= 1;
		}
	}
 
}*/