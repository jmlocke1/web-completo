// Métodos de propiedad

// Definiendo un objeto
const reproductor = {
	reproducir: function(id) {
		console.log(`Reproduciendo Canción con el id: ${id}`)
	},
	pausar: function() {
		console.log("Pausando...");
	},
	crearPlaylist: function(nombre) {
		console.log(`Creando la playlist: ${nombre}`);
	},
	reproducirPlaylist: function(nombre) {
		console.log(`Reproduciendo la playlist: ${nombre}`);
	}
}
// Añadir un método a posteriori
reproductor.borrarCancion = function(id) {
	console.log(`Eliminando la canción número ${id}`);
}
reproductor.reproducir(384);
reproductor.pausar();
reproductor.borrarCancion(20);
reproductor.crearPlaylist("Heavy Metal pa qué");
reproductor.reproducirPlaylist("Heavy Metal pa qué");