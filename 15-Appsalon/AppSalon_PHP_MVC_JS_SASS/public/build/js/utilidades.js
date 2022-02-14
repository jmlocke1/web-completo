export function mostrarAlerta(mensaje, tipo, elemento, desaparece = true) {
    const alerta = document.createElement('DIV');
    alerta.textContent = mensaje;
    
    alerta.classList.add('alerta');
    alerta.classList.add(tipo);

    const referencia = document.querySelector(elemento);
    // Previene que se genere más de una alerta
    // alerta.classList.add = 'weekend';
    const alertasAnteriores = document.querySelectorAll('.alerta');
    alertasAnteriores.forEach(alertaAnterior => { 
        if (alertaAnterior.textContent === mensaje) {
            alertaAnterior.remove();
        }
    });
    referencia.appendChild(alerta);
    if (desaparece) {
        // Eliminar la alerta pasados 3 segundos
        setTimeout(() => {
            alerta.remove();
        }, 3000);
    }
    
}