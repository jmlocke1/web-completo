export class Paginador {
	maxPaginas = 3;
	pagina;
	constructor(pagina) {
		this.pagina = pagina;
	}

	get PaginaActual() {
		return this.pagina ;
	}

	setPaginaActual(pagina) {
		if (pagina > this.maxPaginas) {
			return 'Error. Se ha superado el máximo de páginas';
		} else {
			this.pagina = pagina;
		}
		
	}

}