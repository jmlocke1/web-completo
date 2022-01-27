/// <reference types="cypress" />



describe('Probar la Autenticación', () => {
    it('Prueba la Autenticación en /login', () => {
        cy.visit('/login');

        cy.get('[data-cy="heading-login"]').should('exist');
        cy.get('[data-cy="heading-login"]').should('have.text', 'Iniciar Sesión');

        cy.get('[data-cy="formulario-login"]').should('exist');

        // Ambos campos son obligatorios
        cy.get('[data-cy="formulario-login"]').submit();
        cy.get('[data-cy="alerta-login"]').should('exist');
        cy.get('[data-cy="alerta-login"]').eq(0).should('have.class', 'error');
        cy.get('[data-cy="alerta-login"]').eq(0).should('have.text', 'El email es obligatorio');

        cy.get('[data-cy="alerta-login"]').eq(1).should('have.class', 'error');
        cy.get('[data-cy="alerta-login"]').eq(1).should('have.text', 'El password es obligatorio');

        // Verificar que el usuario exista
        cy.get('[data-cy="email-login"]').should('exist');
        cy.get('[data-cy="email-login"]').type('corcororeo@correo.com');
        cy.get('[data-cy="password-login"]').type('123456');

        cy.get('[data-cy="formulario-login"]').submit();

        cy.get('[data-cy="alerta-login"]').eq(0).should('have.class', 'error');
        cy.get('[data-cy="alerta-login"]').eq(0).should('have.text', 'No existe el usuario');
        // Verificar el password
        cy.get('[data-cy="email-login"]').type('correo@correo.com');
        cy.get('[data-cy="password-login"]').type('12345');

        cy.get('[data-cy="formulario-login"]').submit();

        cy.get('[data-cy="alerta-login"]').eq(0).should('have.class', 'error');
        cy.get('[data-cy="alerta-login"]').eq(0).should('have.text', 'El Password es incorrecto');

        cy.get('[data-cy="email-login"]').type('correo@correo.com');
        cy.get('[data-cy="password-login"]').type('123456');

        cy.get('[data-cy="formulario-login"]').submit();
        
        cy.get('[data-cy="heading-admin"]').should('exist');
        cy.get('[data-cy="heading-admin"]').should('have.text', 'Administrador de Bienes Raices');

        cy.wait(3000);

        cy.visit('/login');
    });
});