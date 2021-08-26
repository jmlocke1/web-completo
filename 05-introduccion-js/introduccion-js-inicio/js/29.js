class Persona {
    constructor(id, nombre, apellido, edad){
        this.id = id;
        this.nombre = nombre;
        this.apellido = apellido;
        this.edad = edad;
    }
}

class Empleado extends Persona{
    constructor(id, nombre, apellido, edad, cargo, salario){
        super(id, nombre, apellido, edad);
        this.cargo = cargo;
        this.salario = salario;
    }
}

class Proveedor extends Persona{
    constructor(id, nombre, apellido, edad, empresa, tipoProductos){
        super(id, nombre, apellido, edad);
        this.empresa = empresa;
        this.tipoProductos = tipoProductos;
    }
    getEmpresa(){
        return this.empresa;
    }
    setEmpresa(empresa){
        this.empresa = empresa;
    }
    getTipoProductos(){
        return this.tipoProductos;
    }
    setTipoProductos(tipoProductos){
        this.tipoProductos = tipoProductos;
    }
}

const empleado1 = new Empleado(1, 'José Miguel', 'Izquierdo Martínez', 55, 'Gerente', 2500);
const proveedor1 = new Proveedor(2, 'Paco', 'Porras Porrero', 55, 'Porrez y Cia.', 'Productos de limpieza');
console.log(empleado1, proveedor1);

const numero1 = 20;
const numero3 = 30;

console.log(numero1);
try{
    console.log(numero2);
}catch(error){
    console.log(error);
}
console.log(numero3);

