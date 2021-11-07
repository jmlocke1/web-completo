create table servicios (           
id INT(11) NOT NULL AUTO_INCREMENT,
nombre VARCHAR(60) NOT NULL,       
precio DECIMAL(6,2) NOT NULL,      
PRIMARY KEY (id)                   
);  
INSERT INTO servicios ( nombre, precio ) VALUES
    ('Corte de Cabello Niño', 60),
    ('Corte de Cabello Hombre', 80),
    ('Corte de Barba', 60),
    ('Peinado Mujer', 80),
    ('Peinado Hombre', 60),
    ('Tinte',300),
    ('Uñas', 400),
    ('Lavado de Cabello', 50),
    ('Tratamiento Capilar', 150);