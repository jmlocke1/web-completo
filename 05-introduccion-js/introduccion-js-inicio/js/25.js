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

// ForEach
// carrito.forEach(function(producto){
//     console.log(`Producto: ${producto.nombre}, precio: ${producto.precio}`);
// });

// Con Arrow Function
// const array1 = carrito.forEach(producto => console.log(`Producto: ${producto.nombre}, precio: ${producto.precio}`));

// Map
const array1 = carrito.map(producto => `${producto.nombre} - ${producto.precio}`);
const array2 = carrito.forEach(producto => producto.nombre);

// La diferencia entre forEach y map es que map devuelve 
// un array, mientras que forEach no devuelve nada
// Esto devolverá un array con los nombres de los productos
console.log(array1);
// Esto devolverá undefined
console.log(array2);