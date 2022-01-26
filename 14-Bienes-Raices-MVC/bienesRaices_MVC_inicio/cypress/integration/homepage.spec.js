/// <reference types="cypress" />

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
        cy.get('[data-cy="enlace-propiedad"]').should('not.have.class', 'boton-amarillo');
        cy.get('[data-cy="enlace-propiedad"]').first().invoke('text').should('equal', 'Ver Propiedad');

        // Probar enlace a una propiedad
        cy.get('[data-cy="enlace-propiedad"]').first().click();
        cy.get('[data-cy="titulo-propiedad"]').should('exist');

        // cy.wait(100);
        cy.go('back');
    });

    it('Prueba el Routing hacia todas las Propiedades', () => {
        cy.get('[data-cy="todas-propiedades"]').should('exist');
        cy.get('[data-cy="todas-propiedades"]').should('have.class', 'boton-verde');
        cy.get('[data-cy="todas-propiedades"]').invoke('attr', 'href').should('equal', '/propiedades');

        cy.get('[data-cy="todas-propiedades"]').click();
        cy.get('[data-cy="heading-propiedades"]').invoke('text').should('equal', 'Casas y Deptos en Venta');
        // cy.wait(100);
        cy.go('back');
    });

    it('Prueba el bloque de contactos', () => {
        cy.get('[data-cy="imagen-contacto"]').should('exist');
        cy.get('[data-cy="imagen-contacto"]').find('H2').invoke('text').should('equal', 'Encuentra la casa de tus sueños');
        cy.get('[data-cy="imagen-contacto"]').find('P').invoke('text').should('equal', 'Llena el formulario de contacto y un asesor se pondrá en contacto contigo con la mayor brevedad');
        cy.get('[data-cy="imagen-contacto"]').find('A').invoke('attr', 'href')
            .then( href => {
                cy.visit(href),
                cy.get('[data-cy="heading-contacto"]').should('exist'),
                // cy.wait(100),
                // Al acceder con visit no podemos volver con go('back')
                cy.visit('/')
            });
    });

    it('Prueba los testimoniales y el blog', () => {
        cy.get('[data-cy="blog"]').should('exist');
        cy.get('[data-cy="blog"]').find('H3').invoke('text').should('equal', 'Nuestro Blog');
        cy.get('[data-cy="blog"]').find('H3').invoke('text').should('not.equal', 'Blog');
        cy.get('[data-cy="blog"]').find('IMG').should('have.length', 2);

        cy.get('[data-cy="testimoniales"]').should('exist');
        cy.get('[data-cy="testimoniales"]').find('H3').invoke('text').should('equal', 'Testimoniales');
        cy.get('[data-cy="testimoniales"]').find('H3').invoke('text').should('not.equal', 'Nuestros Testimoniales');
    });
});