select citas.fecha, citas.hora, 
    concat(clientes.apellido, ', ',clientes.nombre) as 'Nombre Cliente', 
    clientes.telefono, servicios.nombre as 'Servicio' 
from 
    citas inner join clientes inner join citasservicios 
    inner join servicios 
on 
    clientes.id = citas.clienteid and citas.id=citasservicios.citaid and citasservicios.servicioid=servicios.id;

select citas.fecha, citas.hora, 
    concat(clientes.apellido, ', ',clientes.nombre) as 'Nombre Cliente', 
    clientes.telefono, servicios.nombre as 'Servicio' 
from 
    citas right join clientes left join citasservicios 
    left join servicios 
on 
    clientes.id = citas.clienteid and citas.id=citasservicios.citaid and citasservicios.servicioid=servicios.id;

-- Consulta más ordenada
select citas.fecha, citas.hora, 
    concat(clientes.apellido, ', ',clientes.nombre) as 'Nombre Cliente', 
    clientes.telefono, clientes.email, servicios.nombre as 'Servicio' 
from citasservicios
INNER JOIN citas ON citas.id=citasservicios.citaid
INNER JOIN clientes ON citas.clienteid=clientes.id
INNER JOIN servicios ON citasservicios.servicioid=servicios.id;

-- Consulta con LEFT JOIN
select citas.fecha, citas.hora, 
    concat(clientes.apellido, ', ',clientes.nombre) as 'Nombre Cliente', 
    clientes.telefono, clientes.email, servicios.nombre as 'Servicio' 
from citasservicios
LEFT JOIN citas ON citas.id=citasservicios.citaid
LEFT JOIN clientes ON citas.clienteid=clientes.id
LEFT JOIN servicios ON citasservicios.servicioid=servicios.id;

-- Consulta con RIGHT JOIN
select citas.fecha, citas.hora, 
    concat(clientes.apellido, ', ',clientes.nombre) as 'Nombre Cliente', 
    clientes.telefono, clientes.email, servicios.nombre as 'Servicio' 
from citasservicios
RIGHT JOIN citas ON citas.id=citasservicios.citaid
RIGHT JOIN clientes ON citas.clienteid=clientes.id
RIGHT JOIN servicios ON citasservicios.servicioid=servicios.id;