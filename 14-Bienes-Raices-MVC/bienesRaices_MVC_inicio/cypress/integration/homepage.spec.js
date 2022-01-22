/// <references types="cypress" />

describe('Carga la página Principal', () =>{
    it('Prueba el Header de la página principal', () => {
        cy.visit('/');

        cy.get('[data-cy="heading-sitio"]').should('exist');
        
        cy.get('[data-cy="heading-sitio"]').invoke('text').should('equal', 'Venta de Casas y Departamentos Exclusivos de Lujo');
        cy.get('[data-cy="heading-sitio"]').invoke('text').should('not.equal', 'Bienes Raices');
    });
    it('Prueba el bloque de los iconos principales', () => {
        cy.get('[data-cy="heading-nosotros"]').should('exist');
        cy.get('[data-cy="heading-nosotros"]').should('have.prop', 'tagName').should('equal', 'H2');
        cy.get('[data-cy="heading-nosotros"]').invoke('text').should('equal', 'Más sobre nosotros');
        cy.get('[data-cy="heading-nosotros"]').invoke('text').should('not.equal', 'Bienes Raices');
    });
});