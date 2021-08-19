// function sumar(num1 = 0, num2 = 0) {
// 	return num1 + num2;
// }
// let resultado = sumar(2, 3);

// console.log(resultado);

let total = 0;

function agregarCarrito(precio) {
	return total + precio;
}

function calcularImpuesto(total){
	return 1.15 * total;
}
total = agregarCarrito(200);
total = agregarCarrito(400);
total = agregarCarrito(600);

console.log(`El total de la compra es: ${total}, P.V.P con Iva: ${calcularImpuesto(total)}`);