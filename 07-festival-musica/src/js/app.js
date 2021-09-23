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