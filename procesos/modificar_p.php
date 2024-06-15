<?php 
require('../conexion/conexion.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['productoID'])){
        try{
            $productoID = $_POST['productoID'];
            $estado = $_POST['estado'];
            if($estado == 1){
                $sql = "UPDATE producto SET estado = 0 WHERE id_producto = :id";
            } else if ($estado == 0){
                $sql = "UPDATE producto SET estado = 1 WHERE id_producto = :id";
            }
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':id', $productoID, PDO::PARAM_INT);
            $stmt->execute();
            if($estado == 1){
                echo "Producto quitado de la tienda con éxito.";
            } else if ($estado == 0){
                echo "Producto mostrado en la tienda con éxito.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else if (isset($_POST['descripcion'])){
        $id_producto = $_POST['id'];
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $descripcion = $_POST['descripcion'];
        $unidad = $_POST['unidad'];
        $stock = $_POST['stock'];
        try{
            $sql2="UPDATE producto SET nombre_prod = :nombre, precio = :precio, descripcion = :descripcion, medida = :unidad, stock = :stock WHERE id_producto = :id";
            $stmt2 = $conexion->prepare($sql2);
            $stmt2->bindParam(':nombre', $nombre);
            $stmt2->bindParam(':precio', $precio);
            $stmt2->bindParam(':descripcion', $descripcion);
            $stmt2->bindParam(':unidad', $unidad);
            $stmt2->bindParam(':stock', $stock);
            $stmt2->bindParam(':id', $id_producto);
            $stmt2->execute();
            echo 'Producto modificado correctamente.';
        } catch(PDOException $e){
            echo 'Error: '. $e->getMessage();
        }
    }
}
?>