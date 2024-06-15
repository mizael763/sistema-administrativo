<?php 
session_start();
require ('conexion/conexion.php');
$sql = "SELECT * FROM `producto`";
$stmt = $conexion->prepare($sql);
$stmt->execute();
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
$sql2 = "SELECT * FROM `carrito`";
$stmt2 = $conexion->prepare($sql2);
$stmt2->execute();
$carrito = $stmt2->fetchAll(PDO::FETCH_ASSOC);
if (count($productos) > 0) {
    foreach ($productos as $row) {
        if (!empty($row['imagen'] && ($row['stock']>0))){
            echo "<div class='product'>";
            echo "<img src='" . htmlspecialchars($row['imagen']) . "' alt='Producto'>";
            echo "<p>" . htmlspecialchars($row['nombre']) . "</p>";
            echo "<p>Precio: $" . htmlspecialchars($row['precio']) . "</p>";
            echo "<p class='category'>" . htmlspecialchars($row['descripcion']) . "</p>"; // Eliminé la referencia a 'descripcion'

            // Formulario para añadir al carrito
            if($condicion){
                echo "<a href='#' class='c' name='add_to_cart' data-cliente='".$_SESSION['id_user']."' data-prod='".$row['id_producto']."'>🛒 Añadir</a>";
                echo "<a href='#' class='buy-button' data-precio='".$row['precio']."' data-prod='".$row['id_producto']."' onclick='mostrar(event)'>Comprar</a>";
            } else { 
                echo "<a href='#' class='buy-button' onclick='mostrarModal()'>Comprar</a>";
            }
            echo "</div>";
        }
    }
} else {
    echo "No hay productos disponibles.";
}
?>
