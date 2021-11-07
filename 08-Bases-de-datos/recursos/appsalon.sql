CREATE TABLE clientes (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(60) NOT NULL,
    apellido VARCHAR(60) NOT NULL,
    telefono VARCHAR(15) NOT NULL,
    email VARCHAR(60) NOT NULL UNIQUE
)ENGINE=INNODB;

CREATE TABLE citas (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    fecha DATE NOT NULL,
    hora TIME NOT NULL,
    clienteid INT(11),
    FOREIGN KEY (clienteid)
        REFERENCES clientes(id)
        ON DELETE CASCADE,
    UNIQUE KEY (fecha, hora, clienteid)
)ENGINE=INNODB;

CREATE TABLE citasServicios (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    citaid INT(11) NOT NULL,
    servicioid INT(11) NOT NULL,
    FOREIGN KEY(citaid)
        REFERENCES citas(id)
        ON DELETE CASCADE,
    FOREIGN KEY(servicioid)
        REFERENCES servicios(id)
        ON DELETE CASCADE,
    UNIQUE KEY (citaid, servicioid)
)ENGINE=INNODB;

CREATE TABLE servicios (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(60) NOT NULL,
    precio DECIMAL(6,2) NOT NULL
)ENGINE=INNODB;

INSERT INTO clientes (nombre, apellido, telefono, email) VALUES
    ('Juan', 'De la Torre', '1839813910', 'juandelatorre@correo.com'),
    ('José Miguel', 'Izquierdo Martínez', '625 38 15 71', 'josemidaw@gmail.com')
    ('José Manuel', 'Izquierdo González', '625 38 15 72', 'josemadaw@gmail.com');

INSERT INTO citas 