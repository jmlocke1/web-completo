/// <references types="cypress" />

describe('Carga la página Principal', () =>{
    it('Prueba el Header de la página principal', () => {
        cy.visit('/');

        cy.get('[data-cy="heading-sitio"]')
    });
});