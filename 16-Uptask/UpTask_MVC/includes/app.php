<?php

use Model\Database\DB as DB;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__.'/config/Config.php';
require 'funciones.php';
// Conectarnos a la base de datos
DB::conectarDB();
