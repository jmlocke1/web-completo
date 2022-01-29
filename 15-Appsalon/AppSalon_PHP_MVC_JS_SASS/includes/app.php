<?php 
require __DIR__ . '/../vendor/autoload.php';
require 'funciones.php';
require_once "config/Config.php";
//require 'database.php';
use Model\Database\DB;
DB::conectarDB();


// Conectarnos a la base de datos
use Model\ActiveRecord;
ActiveRecord::setDB(DB::getDB());