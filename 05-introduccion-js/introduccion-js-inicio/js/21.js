// Arrow Function
const sumar2 = (n1, n2) => console.log(n1 + n2);

sumar2(2,6);

const aprendiendo = (tecnologia) => {
	console.log(`Aprendiendo ${tecnologia}`)
}

aprendiendo("JavaScript");

const meses = new Array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo');

const carrito = [
	{ nombre: 'Monitor 20 pulgadas', precio: 500 },
	{ nombre: 'Televisión 50 pulgadas', precio: 700 },
	{ nombre: 'Tablet', precio: 300 },
	{ nombre: 'Audífonos', precio: 200 },
	{ nombre: 'Teclado', precio: 50 },
	{ nombre: 'Celular', precio: 500 },
	{ nombre: 'Altavoces', precio: 300 },
	{ nombre: 'Laptop', precio: 800 }
];
console.log("El array meses es:");
console.table(meses);
console.log("El array carrito es:");
console.table(carrito);

// forEach
meses.forEach( mes => {
	if(mes === 'Marzo'){
		console.log(mes, 'sí existe');
	}
});

// Some es ideal para array de objetos
let nombreProducto = 'Celular';
resultado = carrito.some( producto =>  producto.nombre === nombreProducto);

console.log('¿Existe', nombreProducto, 'entre los objetos de carrito?', resultado);

nombreProducto = 'Celular Pro';
resultado = carrito.some( producto =>  producto.nombre === nombreProducto);
console.log('¿Existe', nombreProducto, 'entre los objetos de carrito?', resultado);

resultado = carrito.reduce((total, producto) =>	total + producto.precio, 0);

console.log(`El precio total de todos los productos es ${resultado}`);

console.log("Los productos con valor superior a 400 son:");
console.table(carrito.filter(producto => producto.precio >= 400));

resultado = carrito.filter( producto => producto.nombre !== 'Celular');
console.log("Los productos que no son celulares:");
console.table(resultado);
var sum = function sum() {
	var result = 0;
	[5, 5, 5].forEach(function addTo(number) { result += number; });
	return result;
  };