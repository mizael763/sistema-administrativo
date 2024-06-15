<?php
session_start();
include ('../conexion/conexion.php'); // Asegúrate de tener tu archivo de conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = $_POST['user'];
    $contrasena = $_POST['pass'];

    try {
        // Preparar la consulta para seleccionar el usuario
        $sql = "SELECT * FROM cliente WHERE correo = :correo";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
        $stmt->execute();

        // Verificar si se encontró el usuario
        if ($stmt->rowCount() > 0) {
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            // Verificar la contraseña
            if (password_verify($contrasena, $usuario['contrasena'])) {
                if($usuario['nivel']!=0){
                    if($usuario['estado']==1){
                        $_SESSION['id_user'] = $usuario['id_cliente']; 
                        $_SESSION['user'] = $usuario['nombre'];
                        $_SESSION['rol'] = $usuario['nivel'];
                        $response['dato'] = true;
                    } else {
                        $response['mensaje'] = "Tu cuenta esta suspendida";
                    }
                } else {
                    $response['mensaje'] = 'Falta verificar su correo';
                }
            } else {
                $response['mensaje'] = 'Contraseña incorrecta';
            }
        } else {
            $response['mensaje'] = 'Correo no existe';
        }
        echo json_encode($response);
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
} else {
    echo 'Método de solicitud no válido';
}
?>
