<?php
    require('../conexion/conexion.php');
    $var1 = $_POST['id_cliente'];
    $var2 = $_POST['id_producto'];
    $var3 = 00-00-00;
    try{
        $verificar = "SELECT * FROM carrito";
        $var = $conexion->prepare($verificar);
        $var->execute();
        $carrito = $var->fetchAll(PDO::FETCH_ASSOC);
        $valor = true;
        foreach ($carrito as $row){
            if($row['id_cliente'] == $var1 && $row['id_producto'] == $var2){
                $valor = false;
            }
        }
        if($valor){
            $sql = "INSERT INTO carrito (id_cliente, id_producto, fecha) VALUES (:cliente, :producto, :fecha)";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':cliente', $var1);
            $stmt->bindParam(':producto', $var2);
            $stmt->bindParam(':fecha', $var3);
            if($stmt->execute()){
                echo 'Añadido correctamente al carrito.';
            }
        } else {
            echo 'Ya esta en el carrito carrito.';
        }
    } catch (PDOException $e) {
        echo 'Mal mano: '. $e->getMessage();
    }
?>