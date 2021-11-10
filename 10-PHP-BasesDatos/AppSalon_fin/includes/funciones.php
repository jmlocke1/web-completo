<?php

function obtenerServicios(): array {
    try {
        // Importar una conexión
        require 'database.php';
        // $db->set_charset("utf8");
        // Escribir el código SQL
        $sql = "SELECT * FROM servicios";
        $consulta = mysqli_query($db, $sql);
        // Obtener los resultados
        $servicios = [];
        while( $row = mysqli_fetch_assoc( $consulta ) ) {
            $servicios[] = $row;
        }
        // echo '<pre>';
        // var_dump( $servicios );
        // echo '</pre>';
        return $servicios;

    } catch (\Throwable $th) {
        // throw $th;

        var_dump($th);
    }
} 

obtenerServicios();