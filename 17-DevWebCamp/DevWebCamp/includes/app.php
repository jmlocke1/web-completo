<?php 
require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use Model\ActiveRecord;
use Model\Database\DB;

// Añadir Dotenv
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

require 'funciones.php';
// require 'database.php';

// Conectarnos a la base de datos
DB::conectarDB();