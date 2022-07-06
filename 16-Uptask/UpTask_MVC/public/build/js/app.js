/**
 * Función que selecciona automáticamente la opción adecuada en el sidebar menu, 
 * en función del script que se esté ejecutando
 * 
 * @returns {undefined}
 */
 function seleccionaMenu(){
    // Primero cogemos la url actual del script en ejecución
    let urlActual=window.location.pathname;
    // Ahora seleccionamos el elemento que contiene esa ruta
    let itemActual = document.querySelector("a[href='"+urlActual+"']");
    // Añadimos la clase active
    if(itemActual !== null){
        itemActual.classList.add("activo");
    }
}

if(document.addEventListener){
	window.addEventListener('load',seleccionaMenu,false);
}else{
	window.attachEvent('onload',seleccionaMenu);
}