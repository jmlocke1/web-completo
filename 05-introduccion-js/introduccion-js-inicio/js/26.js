// This

const reservacion = {
    nombre:     'José Miguel',
    apellido:   'Izquierdo Martínez',
    total:      5000,
    pagado:     false,
    informacion: function(){
        console.log(`El cliente ${this.nombre} reservó y su cantidad a pagar es de ${this.total}`);
    }
};

reservacion.informacion();