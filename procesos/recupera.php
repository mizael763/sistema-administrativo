<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

require('../conexion/conexion.php');
$correo = $_POST['correorecuperacion'];
try{
    $sql = "SELECT id_cliente FROM `cliente` WHERE correo = :correo";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
    $stmt->execute();
    $resultado = $stmt->fetch();
    if($resultado){
        $id_cliente = $resultado['id_cliente'];
        $sql2 = "SELECT token FROM `verificar_correo` WHERE id_cliente = :id";
        $stmt2 = $conexion->prepare($sql2);
        $stmt2->bindParam(':id', $id_cliente, PDO::PARAM_INT);
        $stmt2->execute();
        $resultado2 = $stmt2->fetch();
        if($resultado2){
            $token = $resultado2['token'];
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'mizaelcriales478@gmail.com';
                $mail->Password   = $conn;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;
                // Remitente y destinatario
                $mail->setFrom('mizaelcriales478@gmail.com', 'Tu Nombre');
                $mail->addAddress($correo); // Destinatario
                // Contenido del correo
                $mail->isHTML(true);
                $mail->Subject = 'Recuperar cuenta';
                $mail->Body    = "Haz clic en el siguiente enlace para recuperar cambiar tu contraseña: <a href='http://localhost/chuquilluri/usuario/cambiar.php?email=$correo&token=$token'>Recuperar</a>";

                if($mail->send()){
                    echo 'Revisa tu correo para el link de recuperacion.';
                }
            } catch (Exception $e) {
                echo "El mensaje no pudo ser enviado. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            echo 'Falta verificar su correo.';
        }
    } else {
        echo 'Correo incorrecto.';
    }
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
    
?>