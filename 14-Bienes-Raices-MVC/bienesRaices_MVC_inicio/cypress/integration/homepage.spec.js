/// <references types="cypress" />

describe('Carga la página Principal', () =>{
    it('Prueba el Header de la página principal', () => {
        cy.visit('/');

        cy.get('[data-cy="heading-sitio"]').should('exist');
        cy.get('[data-cy="heading-sitios"]').should('not.exist');
        
        cy.get('[data-cy="heading-sitio"]').invoke('text').should('equal', 'Venta de Casas y Departamentos Exclusivos de Lujo');
        cy.get('[data-cy="heading-sitio"]').invoke('text').should('not.equal', 'Bienes Raices');
    });
    it('Prueba el bloque de los iconos principales', () => {
        cy.get('[data-cy="heading-nosotros"]').should('exist');
        cy.get('[data-cy="heading-nosotros"]').should('have.prop', 'tagName').should('equal', 'H2');
        cy.get('[data-cy="heading-nosotros"]').invoke('text').should('equal', 'Más sobre nosotros');
        cy.get('[data-cy="heading-nosotros"]').invoke('text').should('not.equal', 'Bienes Raices');

        // Selecciona los iconos
        cy.get('[data-cy="iconos-nosotros"]').should('exist');
        cy.get('[data-cy="iconos-nosotros"]').find('.icono').should('have.length', 3);
        cy.get('[data-cy="iconos-nosotros"]').find('.icono').should('not.have.length', 4);
    });
    it('Prueba el bloque de propiedades en venta en index', () => {
        cy.get('[data-cy="contenedor-anuncios"]').should('exist');
        cy.get('[data-cy="contenedor-anuncios"]').find('.anuncio').should('have.length', 3);
        cy.get('[data-cy="contenedor-anuncios"]').find('.anuncio').should('not.have.length', 4);

        // Probar el enlace de las propiedades
        cy.get('[data-cy="enlace-propiedad"]').should('have.class', 'boton-amarillo-block');
    });
});