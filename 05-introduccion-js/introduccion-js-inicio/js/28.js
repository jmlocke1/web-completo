// Clases en JavaScript
class Producto {
    constructor (nombre, precio){
        this.nombre = nombre;
        this.precio = precio;
     }
     
     formatearProducto(){
        return `El producto ${this.getNombre()} tiene un precio de: ${this.getPrecio()}€ IVA incluído`;
     }
     getPrecio(){
         return this.precio * 1.21;
     }
     getNombre(){
         return this.nombre;
     }
     prueba(){
         throw new Error("El método prueba() debe ser implementado");
     }
}

const producto2 = new Producto('Monitor curvo de 30"', 800);
const producto3 = new Producto('Portátil I7', 1800);



console.log(producto2);
console.log(producto3);
console.log(producto2.formatearProducto());

class Libro extends Producto {
    constructor(nombre, precio, isbn){
        super(nombre, precio);
        this.isbn = isbn;
    }
    prueba(){
        return 'Esto es una prueba de método abstracto';
    }
    formatearProducto(){
        return `${super.formatearProducto()} y su ISBN es: ${this.isbn}`;
    }
    getPrecio(){
        return super.getPrecio() + " Y si hay en existencia";
    }
}

const libro = new Libro('JavaScript, la revolución', 128, '91928363');
console.log(libro.formatearProducto());
console.log(libro.prueba());
console.log("El precio del libro es:", libro.getPrecio());
//console.log(producto2.prueba());