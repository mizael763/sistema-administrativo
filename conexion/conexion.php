<?php
/*
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "el_punto_de_hierro";

try {
    // Crear la conexi��n PDO
    $conexion = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Configurar el modo de error para que PDO lance excepciones en caso de errores
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // Si hay alg��n error en la conexi��n, mostrar el mensaje de error
    echo "Conexiion fallida: " . $e->getMessage();
}*/
$dsn = 'mysql:host=localhost;dbname=el_punto_de_hierro;charset=utf8mb4';
$username = 'root';
$password = '';

$conn = 'lros jwaj lkel dpzo';
try {
    $conexion = new PDO($dsn, $username, $password);
    // Establecer el modo de error de PDO a excepción
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Error de conexión: ' . $e->getMessage();
}
?>