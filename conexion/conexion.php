<?php
$dsn = 'mysql:host=localhost;dbname=el_punto_de_hierro;charset=utf8mb4';
$username = 'root';
$password = '';

$conn = '';//quite la contraseña de acseso a mi correo
try {
    $conexion = new PDO($dsn, $username, $password);
    // Establecer el modo de error de PDO a excepción
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Error de conexión: ' . $e->getMessage();
}
?>
