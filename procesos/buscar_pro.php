<?php
require('../conexion/conexion.php');
$busqueda = $_POST['busqueda'];
try{
    if($busqueda==""){
        $bus = "SELECT * FROM `producto`";
        $stmtbus = $conexion->prepare($bus);
    } else{
        $busqueda = '%' . $busqueda . '%';
        $bus = "SELECT * FROM `producto` WHERE nombre_prod LIKE :buscar;";
        $stmtbus = $conexion->prepare($bus);
        $stmtbus->bindParam(':buscar', $busqueda, PDO::PARAM_STR);
    }
    $stmtbus->execute();
    $productos = $stmtbus->fetchAll(PDO::FETCH_ASSOC);
    $condicion = (isset($_SESSION['id_user'])) ? true : false;
    if (count($productos) > 0) {
        foreach ($productos as $row) {
            if (($row['stock']>0) && ($row['estado']==1)){
                $sqlM = "SELECT * FROM `medida` WHERE id_medida = :medida";
                $stmtM = $conexion->prepare($sqlM);
                $stmtM->bindParam(':medida', $row['medida']);
                $stmtM->execute();
                $medida = $stmtM->fetchAll(PDO::FETCH_ASSOC);
                echo "<div class='product'>";
                echo "<div class='marcoimg'><img src='" . htmlspecialchars($row['imagen']) . "' alt='Producto'></div>";
                echo "<div class='nombre_prod'><p><strong>" . htmlspecialchars($row['nombre_prod']) . "</strong></p>";
                echo "<p>$" . htmlspecialchars($row['precio']) . "</p></div>";
                if($condicion){
                    echo "<a href='#' class='c' name='add_to_cart' data-cliente='".$_SESSION['id_user']."' data-prod='".$row['id_producto']."'>🛒 Añadir</a>";
                    ?>
                        <a href="#" class="btn-ver" onclick="ver('<?php echo $row['nombre_prod']?>',<?php echo $row['id_producto']?>,'<?php echo $row['imagen']?>','<?php echo $row['descripcion']?>',<?php echo $row['precio']?>,'<?php echo $row['precio']?>','<?php echo $medida[0]['nombre']?>',<?php echo $_SESSION['id_user']; ?>)">Ver</a>
                    <?php
                } else { 
                        echo "<a href='#' class='btn-ver' onclick='mostrarModal()'>Ver</a>";
                }
                echo "</div>";
            }
        }
    } else {
        echo "No hay productos disponibles.";
    }
} catch (PDOException $e){

}
?>