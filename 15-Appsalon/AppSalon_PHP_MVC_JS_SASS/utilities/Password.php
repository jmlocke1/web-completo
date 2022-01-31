<?php
namespace MVC\Utilities;
/**
 * Clase que genera una contraseña segura mediante métodos estáticos
 *
 * @author josemi
 */
class Password {
    
    /**
     * Función que genera una contraseña segura codificada con un algoritmo 
     * variable. Se recomienda dejar espacio en la base de datos de, al menos,
     * 255 caracteres.
     * 
     * @param string $password
     * @param int   $cost   Coste del algoritmo
     * @return string   Cadena con la contraseña codificada
     */
    public static function hash(string $password, int $cost = \Config::PASSWORD_COST) {
        return password_hash($password, PASSWORD_DEFAULT, ['cost' => $cost]);
    }
    
    /**
     * Función que verifica una contraseña comparándola con el hash codificado
     * que se suministra como segundo parámetro. No se debe aportar el algoritmo
     * ni la sal, pues ya deben estar incluidos en el hash.
     * 
     * @param string $password
     * @param string $hash
     * @return boolean  
     */
    public static function verify(string $password, string $hash){
        return password_verify($password, $hash);
    }
    
    public static function needsRehash($password, $hash, $cost = \Config::PASSWORD_COST){
        if(password_needs_rehash($hash, PASSWORD_DEFAULT, ['cost' => $cost])){
            return self::hash($password, $cost);
        }else{
            return false;
        }
    }
}
