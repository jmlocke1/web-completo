
document.addEventListener('DOMContentLoaded', function() {
    comprobarImagen();
});
function comprobarImagen() {
    const imagen = document.querySelector('#imagen');
    if(imagen !== null) {
        imagen.addEventListener('change', comprobarTamano);
    }
}

function comprobarTamano() {
    const limite = 1024 * 1024 * 2; // 2 Megas
    const imagen = document.querySelector('#imagen');
    const infoimagen = createElementIfNotExist('infoimagen', imagen);
    const peso = imagen.files[0].size;
    if(peso > limite){
        infoimagen.textContent = `La imagen pesa: ${round(peso / 1024 / 1024)} Megabytes, y el máximo admitido es: ${round(limite /1024/1024)} Megabytes`;
        imagen.value = '';
    }
}

function round(num) {
    var m = Number((Math.abs(num) * 100).toPrecision(15));
    return Math.round(m) / 100 * Math.sign(num);
}

/**
 * Función que crea un elemento div para información con un atributo
 * id que lo identifica
 * Si el div ya existe en el DOM, se borra su contenido
 * @param {string}  name    - Identificador del div
 * @param {DomNode} element - Elemento del que se quiere mostrar la información
 * @returns     Devuelve un elemento div con un identificador
 */
function createElementIfNotExist(name, element){
    let divInfo = document.querySelector('#' + name);
    if(divInfo !== null){
        divInfo.textContent = '';
    }else {
        divInfo = document.createElement('DIV');
        divInfo.setAttribute('id', name);
        // Inserta el div delante del elemento a informar
        element.parentNode.insertBefore(divInfo, element);
    }
    return divInfo;
}