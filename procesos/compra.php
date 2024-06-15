<?php 
require('../conexion/conexion.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $var1 = $_POST['id_cliente'];
    $var2 = $_POST['id_producto'];
    $var3 = $_POST['cantidad'];
    $var4 = $_POST['precio'];
    $total = $var3 * $var4;
    try{
        $sql1 = "INSERT INTO venta (id_cliente, id_producto) VALUES (:id_1, :id_2)";
        $stmt1 = $conexion->prepare($sql1);
        $stmt1->bindParam(':id_1', $var1);
        $stmt1->bindParam(':id_2', $var2);
        if($stmt1->execute()){
            $id_venta = $conexion->lastInsertId();
            $sql2 = "INSERT INTO detalle_venta (id_venta, cantidad, total) VALUES (:id_0, :cantidad, :total)";
            $stmt2 = $conexion->prepare($sql2);
            $stmt2->bindParam(':id_0', $id_venta);
            $stmt2->bindParam(':cantidad', $var3);
            $stmt2->bindParam(':total', $total);
            $stmt2->execute();
            echo 'Compra con exito.';
        } else{
            echo 'No se ingreso venta.';
        }
        
    } catch (PDOException $e) {
        echo 'Mal mano: '. $e->getMessage();
    }
} else {
    echo 'No se recibio datos';
}
?>