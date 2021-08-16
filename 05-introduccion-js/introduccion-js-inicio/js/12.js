// "use strict";
// Objetos
const producto = {
	nombreProducto: "Monitor 20 Pulgadas",
	precio : 300,
	disponible : true
};

// Se pueden añadir nuevas propiedades
// producto.imagen = "imagen.jpg";
// Congelar un objeto para que no se puedan añadir nuevas propiedades

Object.freeze(producto);
// No se pueden añadir propiedades, pero no da error. Al estar
// congelado, la propiedad no se añade
// Si declaramos modo estricto, sí que da error
// producto.imagen = "imagen.jpg";

// A un objeto congelado tampoco se le pueden cambiar propiedades
producto.precio = "NUEVO PRECIO";

// Se puede saber si un objeto está congelado
console.log("¿El objeto producto está congelado?", Object.isFrozen(producto));
console.log(producto);

// Object.seal
console.log("Objeto congelado con seal");
const producto2 = {
	nombreProducto: "Monitor 20 Pulgadas",
	precio : 300,
	disponible : true
};
Object.seal(producto2);
// Se pueden modificar las propiedades a un objeto congelado con seal
producto2.precio = "NUEVO PRECIO";
// No se permite eliminar ni añadir propiedades
producto2.imagen = "imagen.jpg";
delete producto2.precio;
console.log(producto2);