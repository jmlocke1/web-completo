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

// Reduce
resultado = carrito.reduce(function(total, producto) {
	return total + producto.precio;
}, 0);
console.log("El total de los productos es:", resultado);

// Filter
let precio = 400;
resultado = carrito.filter(function(producto){
	return producto.precio > precio;
});
console.log(`Filter. Los elementos del carrito cuyo precio es mayor que ${precio} son:`);
console.table(resultado);

resultado = carrito.filter(function(producto){
	return producto.nombre !== 'Celular';
});
console.log("Los elementos del carrito que no son celulares son:");
console.table(resultado);
