<?php
namespace Model\Database;
//require_once dirname(dirname(__DIR__))."/includes/config/Config.php";
class DB {
    protected static $db;
    private $query;


    public function __construct($query = null){
        self::hayDB();
        if(isset($query)){
            $this->query = $query;
        }else{
            $this->query = "";
        }
    }

    public static function getDB(){
        self::hayDB();
        return self::$db;
    }

    /**
     * Devuelve una conexión a la base de datos
     */
    public static function conectarDB() {
        self::$db = new \mysqli(\Config::DB_HOST, \Config::DB_USER, \Config::DB_PASSWORD, \Config::DB_NAME);
        if(self::$db->connect_errno) {
            echo "Error. No se pudo conectar: ".self::$db->connect_error;
            exit;
        }
        return self::$db;
    }

    /**
     * Realiza una operación de inserción en la base de datos
     */
    public static function insert($query){
        self::hayDB();
        return self::$db->query($query);
    }

    public static function getQueryObject($query){
        self::hayDB();
        $result = self::$db->query($query);
        $data = [];
        while($row = $result->fetch_object()){
            $data[] = $row;
        }
        return $data;
    }

    public static function getQueryArray($query){
        self::hayDB();
        $result = self::$db->query($query);
        $data = [];
        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }
        return $data;
    }

    public static function close(){
        if(isset(self::$db)){
            mysqli_close(self::$db);
        }
    }

    /**
	 * Comprueba si tenemos conexión a la base de datos, de lo contrario obtiene una
	 */
	private static function hayDB(){
		if(!isset(self::$db)){
			self::conectarDB();
		}
	}

    public static function table($table){
        $newDB = new self( "SELECT * FROM {$table}" );
        return $newDB;
    }
}