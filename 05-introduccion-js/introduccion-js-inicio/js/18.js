function sumar(num1 = 0, num2 = 0) {
	return num1 + num2;
}
function sumar2(num1, num2) {
	console.log( sumar(num1, num2) );
}
sumar2(10, 10);

// Expresión de la función
const sumar3 = function(num1, num2, num3) {
	console.log(sumar(num1, sumar( num2, num3)));
}
sumar3(20, 50, 30);
sumar2(35);