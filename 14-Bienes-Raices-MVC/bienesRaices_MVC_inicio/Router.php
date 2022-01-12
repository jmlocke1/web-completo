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
            debuguear($this->rutasGET[$urlActual]);
        }
    }
}