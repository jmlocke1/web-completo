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
        if($metodo === 'GET'){
            $fn = $this->rutasGET[$urlActual] ?? null;
        }
        if($fn){
            echo "Existe $fn";
        }else{
            echo "Página no encontrada";
        }
        debuguear($_SERVER);
    }
}