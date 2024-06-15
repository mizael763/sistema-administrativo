<?php
require('../conexion/conexion.php');    
if (isset($_POST['all'])) {
    $sql = "SELECT v.*, c.*, p.*, dv.*  FROM venta v INNER JOIN cliente c ON v.id_cliente = c.id_cliente INNER JOIN producto p ON v.id_producto = p.id_producto INNER JOIN detalle_venta dv ON v.id_venta = dv.id_venta ORDER BY fecha DESC LIMIT 20";
    $stmt = $conexion->query($sql);
    $recent_sales = $stmt->fetchAll();
    echo '<table>
        <tr class="tr1">
            <td>Cliente</td>
            <td>Producto</td>
            <td>Cantidad</td>
            <td>Total</td>
            <td>Comentario</td>
            <td>Fecha</td>
        </tr>';
    foreach ($recent_sales as $sale) {
    echo '<tr><td>'.$sale['nombre'] . '</td>
        <td>' .$sale['nombre_prod'] . '</td>
        <td>' . $sale['cantidad'] . '</td>
        <td>' . $sale['total'] . '</td>
        <td>' . $sale['comentario'] . '</td>
        <td>' . $sale['fecha'] . '</td></tr>';
    }
    echo '</table>';
}
else if (isset($_POST['fecha'])) {
    $fecha = $_POST['fecha'];

    $sql = "SELECT v.*, c.*, p.*, dv.*  FROM venta v INNER JOIN cliente c ON v.id_cliente = c.id_cliente INNER JOIN producto p ON v.id_producto = p.id_producto INNER JOIN detalle_venta dv ON v.id_venta = dv.id_venta WHERE DATE(v.fecha) = :fecha ORDER BY DATE(v.fecha) DESC";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':fecha', $fecha);
    $stmt->execute();
    $sales_by_date = $stmt->fetchAll();
    if(count($sales_by_date) > 0){
        echo '<table>
                    <tr class="tr1">
                        <td>Cliente</td>
                        <td>Producto</td>
                        <td>Cantidad</td>
                        <td>Total</td>
                        <td>Comentario</td>
                        <td>Fecha</td>
                    </tr>';
        foreach ($sales_by_date as $sale) {
            echo '<tr><td>'.$sale['nombre'] . '</td>
                    <td>' .$sale['nombre_prod'] . '</td>
                    <td>' . $sale['cantidad'] . '</td>
                    <td>' . $sale['total'] . '</td>
                    <td>' . $sale['comentario'] . '</td>
                    <td>' . $sale['fecha'] . '</td></tr>';
        }
        echo '</table>';
    } else {
        echo 'No hay ventas en esta fecha.';
    }
}

else if (isset($_POST['fecha_inicio']) && isset($_POST['fecha_fin'])) {
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];

    $sql = "SELECT v.*, c.*, p.*, dv.*  FROM venta v INNER JOIN cliente c ON v.id_cliente = c.id_cliente INNER JOIN producto p ON v.id_producto = p.id_producto INNER JOIN detalle_venta dv ON v.id_venta = dv.id_venta WHERE DATE(v.fecha) BETWEEN :fecha_inicio AND :fecha_fin ORDER BY DATE(v.fecha) DESC";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':fecha_inicio', $fecha_inicio);
    $stmt->bindParam(':fecha_fin', $fecha_fin);
    $stmt->execute();
    $sales_by_range = $stmt->fetchAll();
    if(count($sales_by_range) > 0){
        echo '<table>
                    <tr class="tr1">
                        <td>Cliente</td>
                        <td>Producto</td>
                        <td>Cantidad</td>
                        <td>Total</td>
                        <td>Comentario</td>
                        <td>Fecha</td>
                    </tr>';
        foreach ($sales_by_range as $sale) {
            echo '<tr><td>'.$sale['nombre'] . '</td>
                    <td>' .$sale['nombre_prod'] . '</td>
                    <td>' . $sale['cantidad'] . '</td>
                    <td>' . $sale['total'] . '</td>
                    <td>' . $sale['comentario'] . '</td>
                    <td>' . $sale['fecha'] . '</td></tr>';
        }
        echo '</table>';
    } else {
        echo 'No hay ventas en esta fecha.';
    }
}
?>
