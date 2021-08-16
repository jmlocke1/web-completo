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

// forEach
meses.forEach(function(mes){
	if(mes === 'Marzo'){
		console.log(mes, 'sí existe');
	}
});

// Comprobar si un elemento existe con includes
let resultado = meses.includes("Diciembre");
console.log("¿Diciembre existe?:", resultado);
resultado = meses.includes("Marzo");
console.log("¿Marzo existe?:", resultado);

// Para un array múltiple no funciona bien includes
// Some es ideal para array de objetos
let nombreProducto = 'Celular';
resultado = carrito.some(function(producto){
	return producto.nombre === nombreProducto;
});
console.log('¿Existe', nombreProducto, 'entre los objetos de carrito?', resultado);
nombreProducto = 'Celular Pro';
resultado = carrito.some(function(producto){
	return producto.nombre === nombreProducto;
});
console.log('¿Existe', nombreProducto, 'entre los objetos de carrito?', resultado);