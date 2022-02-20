<?php 
require __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();
require_once "config/Config.php";
require FUNCIONES_URL.'/funciones.php';
//require 'database.php';
use Model\Database\DB;
DB::conectarDB();


// Conectarnos a la base de datos
use Model\ActiveRecord;
//ActiveRecord::setDB(DB::getDB());