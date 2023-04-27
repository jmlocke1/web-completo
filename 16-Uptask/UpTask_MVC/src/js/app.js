const $mobileMenuBtn = document.querySelector('#mobile-menu'),
        $cerrarMenuBtn = document.querySelector('#cerrar-menu'),
        $sidebar = document.querySelector('.sidebar');
console.log($sidebar)
if($mobileMenuBtn) {
    $mobileMenuBtn.addEventListener('click', function() {
        $sidebar.classList.add('mostrar');
    });
}
if($cerrarMenuBtn) {
    $cerrarMenuBtn.addEventListener('click', function() {
        $sidebar.classList.add('ocultar');
        setTimeout(() => {
            $sidebar.classList.remove('mostrar');
            $sidebar.classList.remove('ocultar');
        }, 1000);
        
    });
}

// Elimina la clase mostrar en un tamaño de tablet y mayores
window.addEventListener('resize', function() {
    const anchoPantalla = document.body.clientWidth;
    if(anchoPantalla >= 768 && $sidebar){
        $sidebar.classList.remove('mostrar')
    }
});

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