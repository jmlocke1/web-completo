// POO

// Object literal
const producto = {
    nombre: 'tablet',
    precio: 500
}

// Object constructor
function Cliente(nombre, apellido){
    this.nombre = nombre;
    this.apellido = apellido;
}
Cliente.prototype.formatearCliente = function(){
    return `El Cliente ${this.nombre} ${this.apellido} está activo`;
}

function Producto(nombre, precio) {
    this.nombre = nombre;
    this.precio = precio;
}
// Crear funciones que solo se utilizan en un objeto en específico
Producto.prototype.formatearProducto = function(){
    return `El Producto ${this.nombre} tiene un precio de: ${this.precio} €`;
}

const producto2 = new Producto('Monitor curvo de 30"', 800);
const producto3 = new Producto('Portátil I7', 1800);
const cliente1 = new Cliente('José Miguel', 'Izquierdo Martínez');


// console.log(producto2, producto3);
console.log(producto2.formatearProducto());
console.log(producto3.formatearProducto());
console.log(cliente1.formatearCliente());