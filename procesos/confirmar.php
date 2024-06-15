<?php
require('../conexion/conexion.php');

if (isset($_GET['email']) && isset($_GET['token'])) {
    $email = $_GET['email'];
    $token = $_GET['token'];

    $sql = "SELECT id_cliente FROM verificar_correo WHERE correo = ? AND token = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$email, $token]);
    $id_cliente = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($stmt->rowCount() > 0) {
        $update_sql = "UPDATE cliente SET nivel = 1 WHERE id_cliente = :id";
        $update_stmt = $conexion->prepare($update_sql);
        $update_stmt->bindParam(':id', $id_cliente[0]['id_cliente']);
        if ($update_stmt->execute()) {
            echo "Tu cuenta ha sido confirmada. Ahora puedes iniciar sesión.";
        } else {
            echo "Error al confirmar tu cuenta.";
        }
    } else {
        echo "Enlace de confirmación inválido o la cuenta ya está confirmada.";
    }
} else {
    echo "Datos incompletos.";
}
?>
