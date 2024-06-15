<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

    require ('../conexion/conexion.php');
    $nombre = $_POST['nombre'];
    $correo = $_POST['email'];
    $telefono = $_POST['tel'];
    $direccion = $_POST['direccion'];
    $contrasenaHash = password_hash($_POST['pass'], PASSWORD_BCRYPT);
    $token = bin2hex(random_bytes(50));
    echo  $nombre.', '.$correo.', '.$telefono.', '.$direccion.', '.$_POST['pass'];
    try {
        $verificar = "SELECT * FROM cliente WHERE correo = :correo";
        $stmt1 = $conexion->prepare($verificar);
        $stmt1->bindParam(':correo', $correo, PDO::PARAM_STR);
        $stmt1->execute();
        if ($stmt1->rowCount() > 0) {
            echo 'Correo ya existe';
        } else {
            $sql = "INSERT INTO cliente (nombre, correo, contrasena, telefono, direccion) VALUES (:nombre, :correo, :contrasena, :telefono, :direccion)";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
            $stmt->bindParam(':contrasena', $contrasenaHash, PDO::PARAM_STR);
            $stmt->bindParam(':telefono', $telefono, PDO::PARAM_INT);
            $stmt->bindParam(':direccion', $direccion, PDO::PARAM_STR);
            //-----------------------
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'mizaelcriales478@gmail.com'; // Tu dirección de correo de Gmail
                $mail->Password   = $conn; // Tu contraseña de Gmail o una contraseña de aplicación si tienes 2FA
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;
                // Remitente y destinatario
                $mail->setFrom('mizaelcriales478@gmail.com', 'Tu Nombre');
                $mail->addAddress($correo); // Destinatario
                // Contenido del correo
                $mail->isHTML(true);
                $mail->Subject = 'Confirma tu registro';
                $mail->Body    = "Haz clic en el siguiente enlace para confirmar tu registro: <a href='http://localhost/chuquilluri/procesos/confirmar.php?email=$correo&token=$token'>Confirmar Registro</a>";

                if($mail->send()){
                    $stmt->execute();
                    $ultimoId = $conexion->lastInsertId();
                    $confirmacion = "INSERT INTO verificar_correo (id_cliente, correo, token) VALUES (:id_cliente, :correo, :token)";
                    $stmt2 = $conexion->prepare($confirmacion);
                    $stmt2->bindParam(':id_cliente', $ultimoId);
                    $stmt2->bindParam(':correo', $correo);
                    $stmt2->bindParam(':token',$token);
                    $stmt2->execute();
                    echo 'Revisa tu correo para confirmar tu registro.';
                }
            } catch (Exception $e) {
                echo "El mensaje no pudo ser enviado. Mailer Error: {$mail->ErrorInfo}";
            }
        }
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }    
?>