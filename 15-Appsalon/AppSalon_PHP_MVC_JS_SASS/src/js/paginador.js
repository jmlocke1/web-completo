export class Paginador {
	maxPaginas = 3;
	pagina;
	constructor(pagina) {
		if (pagina) {
			this.pagina = pagina;
		} else {
			this.pagina = 1;
			localStorage.setItem('paso', 1);
		}
		
	}

	get PaginaActual() {
		return this.pagina ;
	}

	setPaginaActual(pagina) {
		if (pagina > this.maxPaginas || pagina < 1) {
			return 'Error. Se ha superado el máximo de páginas';
		} else {
			this.pagina = pagina;
			localStorage.setItem('paso', this.pagina);
		}
	}

	get isFirstPage() {
		return this.pagina === 1;
	}

	get isLastPage() {
		return this.pagina === this.maxPaginas;
	}

	incrementa() {
		if (this.isLastPage) {
			this.setPaginaActual(1);
		} else {
			this.setPaginaActual(this.pagina + 1);
		}
	}

	decrementa() {
		if (this.isFirstPage) {
			this.setPaginaActual(this.maxPaginas);
		} else {
			this.setPaginaActual(this.pagina - 1);
		}
	}

}