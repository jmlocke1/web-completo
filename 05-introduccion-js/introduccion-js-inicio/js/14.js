// Arrays o vectores

const numeros = [10,20,30,40,50];
console.table(numeros);

// Se puede crear un Array con new Array()
const meses = new Array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo');
console.table(meses);

// Acceder a los elementos de un array
console.log(numeros[1]);

meses.forEach(function(mes){
	console.log(mes);
});

// Añadir elementos al array con push. Agrega elementos al final del array
// Uno a uno
numeros.push(60);
// Varios a la vez
numeros.push(70,80);
// Añadir elementos al inicio con unshift
numeros.unshift(-10,-20,-30);

console.table(numeros);
// Eliminar el último elemento del array
// meses.pop();
// Eliminar el primer elemento del array
// meses.shift();

// Eliminar a partir del elemento 2 un elemento
// meses.splice(2, 1);
// console.table(meses);
// Hoy en día se recomienda no modificar el array original
// Para modificar el array se puede usar el Rest Operator o Spread Operator
const nuevoMeses = [...meses, 'Junio'];
console.table(nuevoMeses);