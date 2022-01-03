<?php
namespace App\Database;
class DB {
    protected static $db;

    public static function getDB(){
        if(!isset(self::$db)){
            return self::conectarDB();
        }else{
            return self::$db;
        }
    }

    private static function conectarDB() {
        self::$db = new \mysqli('localhost', 'usprueba', 'usprueba', 'bienes_raices');
    
        if(self::$db->connect_errno) {
            echo "Error. No se pudo conectar: ".self::$db->connect_error;
            exit;
        }
        return self::$db;
    }
}