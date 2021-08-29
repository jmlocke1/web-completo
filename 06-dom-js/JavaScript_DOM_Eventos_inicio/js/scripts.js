(function inicioYa(number){
	console.log("El número introducido es:", number);
}(25));
// querySelector
const heading = document.querySelector('.header__texto h2');
heading.textContent = "Nuevo Heading";

// querySelectorAll
const enlaces = document.querySelectorAll('.header .navegacion a');

// Cambiar el texto de un enlace
enlaces[0].textContent = 'Nuevo texto para enlace';
/*
// Cambiar un enlace si se cumple una condición
enlaces[0].href = "#";
if(enlaces[1].textContent === 'Cursos'){
	enlaces[1].href = "#";
}
*/
// Añadir una clase a un enlace
enlaces[0].classList.add('nueva-clase');
enlaces.forEach(enlace => {
	enlace.classList.add('nueva-clase');
});
// Remover una clase
// enlaces[1].classList.remove('navegacion__enlace');

// getElementById
const heading2 = document.getElementById('heading');
console.log(heading2);

// Generar un nuevo enlace
let nuevoEnlace = document.createElement('a');
// Agregar el href
nuevoEnlace.href = 'http:worldcode.info';
// Agregar el texto
nuevoEnlace.textContent = 'Worldcode';
nuevoEnlace.target = '_blank';
nuevoEnlace.title = 'Worldcode, códigos de países y monedas. Se abre en nueva pestaña';

// Agregar la clase
nuevoEnlace.classList.add('navegacion__enlace');

const navegacionSuperior = document.querySelector('.header .navegacion');
/*
navegacionSuperior.appendChild(nuevoEnlace);
console.log('Insertando con appendChild',nuevoEnlace);
const navegacionInferior = document.querySelector('.footer .navegacion');
navegacionInferior.appendChild(nuevoEnlace);
*/
const navegacion = document.querySelectorAll(".navegacion");
     
console.log("navegacion:");
console.log(navegacion); //El arreglo tiene 2 elementos segun la consola indice 0 y 1
 
for(let i = 0; i<navegacion.length; i++) {
	// Generar un nuevo enlace
	nuevoEnlace = document.createElement('a');
	// Agregar el href
	nuevoEnlace.href = 'http:worldcode.info';
	// Agregar el texto
	nuevoEnlace.textContent = 'Worldcode';
	nuevoEnlace.target = '_blank';
	nuevoEnlace.title = 'Worldcode, códigos de países y monedas. Se abre en nueva pestaña';

	// Agregar la clase
	nuevoEnlace.classList.add('navegacion__enlace');
	navegacion[i].appendChild(nuevoEnlace); //Deberia tomar cada elemento del arreglo  y agregarle el nuevo enlace.
}
// Insertando un nuevo nodo creado con template String
let nuev = document.createElement('DIV');
let tit = 'Nuevo enlace dinámico', href='https://google.com', text='Enlace dinámico', target='_blank';
nuev.innerHTML = `<a title='${tit}' href='${href}' class='${"navegacion__enlace"}' target='${target}'>${text}</a>`;
nuevoEnlace = nuev.firstChild;
console.log('Antes de insertar enlace dinámico', nuev.firstChild);
//navegacionSuperior.appendChild(nuevoEnlace);
console.log('Después de insertar enlace dinámico', nuev.firstChild);
console.log('Después de insertar enlace dinámico', nuevoEnlace);
tit = 'Otro', href='https://web-completo.test', text='Web Completo', target='_blank';
nuev.innerHTML = `<a title='${tit}' href='${href}' class='${"navegacion__enlace"}' target='${target}'>${text}</a>`;
//navegacionSuperior.appendChild(nuev.firstChild);

// Eventos
function imprimir(){
	console.log(3);
}
window.onload = imprimir;
console.log(1);
// load espera a que el JS y los archivos que dependen del HTML estén listos
window.addEventListener('load', () => console.log(2));

// Solo espera por el HTML, pero no espera CSS o imágenes
document.addEventListener('DOMContentLoaded', () => console.log(4));

console.log(5);

window.onscroll = function() {
	console.log('scrolling...');
}

// Seleccionar elementos y asociarles un evento
const btnEnviar = document.querySelector('.boton--primario');
btnEnviar.addEventListener('click', function() {
	console.log('Enviando formulario');
});