<?php
namespace MVC;
class Router{
    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn){
        $this->rutasGET[$url] = $fn;
    }

    public function comprobarRutas(){
        $urlActual = $_SERVER['REDIRECT_URL'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];
        
        echo "Método: ", $metodo, ". URL Actual: ", $urlActual, " PathInfo: ", $_SERVER['REDIRECT_URL'], "<br>";
        
        if($metodo === 'GET'){
            echo $this->rutasGET[$urlActual], "<br>";
            debuguear($_SERVER);
        }
    }
}