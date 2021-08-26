const usuarioAutenticado = new Promise( (resolve, reject) => {
    const auth = false;
    if(auth){
        resolve('Usuario Autenticado'); // El promise se cumple
    }else{
        reject('No se puedo iniciar sesión');  // El promise no se cumple
    }
});
usuarioAutenticado
    .then( resultado => console.log(`Desde el promise, el mensaje es: ${resultado}`))
    .catch(error => console.log(error))

/* 
En los promises existen 3 valores:
Pending:    No se ha cumplido, pero tampoco se ha rechazado
Fullfilled: Ya se cumplió
rejected:   Ha sido rechazado
*/