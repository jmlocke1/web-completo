// Declaración de función

function sumar() {
	console.log( 10 * 10 );
}
sumar();

// Expresión de la función
const sumar2 = function() {
	console.log(3 + 3);
}
sumar2();

// IIFE
// Funciones que se llaman ellas mismas
(function() {
	console.log("Esto es una función que se llama a ella misma");
})();

// Hoisting de una función
// Las funciones normales pueden ser llamadas antes de su declaración