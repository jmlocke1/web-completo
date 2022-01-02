<?php include 'includes/header.php';
// CONSULTAS PREPARADAS
// Conectamos a la base de datos
$db = new mysqli('localhost', 'usprueba', 'usprueba', 'bienes_raices');

// Creamos el query
$query = "SELECT titulo from propiedades";

// Lo preparamos
$stmt = $db->prepare($query);

// Lo ejecutamos
$stmt->execute();

// Creamos la variable
$stmt->bind_result($titulo);

// Asignamos el resultado

// Imprimir el resultado
echo "<pre>";
while($stmt->fetch()){
	var_dump($titulo);
}
echo "</pre>";




include 'includes/footer.php';