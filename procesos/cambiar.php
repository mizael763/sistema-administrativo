<?php 
include('../conexion/conexion.php');
if(isset($_POST['id_cambiar'])){
    $id_cambiar = $_POST['id_cambiar'];
    $contrasenaHash = password_hash($_POST['contra2'], PASSWORD_BCRYPT);
    try{
        $sql ="UPDATE cliente SET contrasena = :contra WHERE id_cliente = :id";
        $resultado = $conexion->prepare($sql);
        $resultado->bindParam(':contra', $contrasenaHash);
        $resultado->bindParam(':id', $id_cambiar);
        $resultado->execute();
        echo "Contraseña cambiada con éxito";
    } catch (PDOException $e){
        echo 'Error: '.$e->getMessage();
    }
}
?>