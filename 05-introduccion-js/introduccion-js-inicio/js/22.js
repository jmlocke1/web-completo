// Estructuras de control
const puntaje = 1000;

if(puntaje === 1000){
    console.log("Sí, el puntaje es mayor que 1000");
    console.log("Sí, el puntaje es 1000");
}else{
    console.log("No, el puntaje no es 1000");
}
    
var item = localStorage.getItem('key');
if(item === null){
    console.log("Vamos a almacenar el valor en localstorage");
    localStorage.setItem('key', 'Hola mundo');
}else{
    console.log(`El valor de la clave vale: ${localStorage.getItem('key')}`);
}

