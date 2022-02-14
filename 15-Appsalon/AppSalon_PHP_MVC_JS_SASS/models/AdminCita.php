<?php
namespace Model;

class AdminCita extends ActiveRecord {
    protected static $tabla = 'citasservicios';
    protected static $columnasDB = ['id', 'fecha', 'hora', 'cliente', 'email', 'telefono', 'servicio', 'precio'];

    public $id;
    public $fecha;
    public $hora;
    public $cliente;
    public $email;
    public $telefono;
    public $servicio;
    public $precio;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->hora = $args['hora'] ?? '';
        $this->cliente = $args['cliente'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->servicio = $args['servicio'] ?? '';
        $this->precio = $args['precio'] ?? '';
    }

    public static function getCitas($fecha = null, $hasta = null){
        if(isset($fecha) && !isset($hasta)){
            $hasta = $fecha;
        }
        // Consultar la base de datos
		$consulta = "SELECT citas.id, citas.fecha, citas.hora, CONCAT( usuarios.nombre, ' ', usuarios.apellido) as cliente, ";
		$consulta .= " usuarios.email, usuarios.telefono, servicios.nombre as servicio, servicios.precio  ";
		$consulta .= " FROM citas  ";
		$consulta .= " LEFT OUTER JOIN usuarios ";
		$consulta .= " ON citas.usuarioId=usuarios.id  ";
		$consulta .= " LEFT OUTER JOIN citasServicios ";
		$consulta .= " ON citasServicios.citaId=citas.id ";
		$consulta .= " LEFT OUTER JOIN servicios ";
		$consulta .= " ON servicios.id=citasServicios.servicioId ";
        if(isset($fecha) && !isset($hasta)){
            $consulta .= " WHERE fecha = '${fecha}'";
        }
        if(isset($fecha) && isset($hasta)){
            $consulta .= " WHERE fecha BETWEEN  '${fecha}' AND '${hasta}'";
        }
        $consulta .= " ORDER BY citas.fecha";

        $citas = self::sql($consulta);
        return $citas;
    }
}