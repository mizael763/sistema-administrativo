<?php 
    require('../conexion/conexion.php');
    $id = $_POST['IDcliente'];
    $estado = $_POST['estado'];
    if($estado==1){
        $estado=0;
    } else if($estado==0) {
        $estado=1;
    }

    try{
        $sql = "UPDATE cliente SET estado = :estado WHERE id_cliente = :id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':estado', $estado, PDO::PARAM_INT);
        $stmt->execute();
        echo "Se ha actualizado el estado del cliente";
    } catch(PDOException $e){
        echo 'Error: ' . $e->getMessage();
    }
?>