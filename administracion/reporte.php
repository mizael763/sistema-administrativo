<?php

require('../conexion/conexion.php');

$sql = "SELECT v.*, c.*, p.*, dv.*  FROM venta v INNER JOIN cliente c ON v.id_cliente = c.id_cliente INNER JOIN producto p ON v.id_producto = p.id_producto INNER JOIN detalle_venta dv ON v.id_venta = dv.id_venta ORDER BY fecha DESC LIMIT 20";
$stmt = $conexion->query($sql);
$recent_sales = $stmt->fetchAll();
?>
<style>
    .NONE{
        display: none;
    }
    .caja_form{
        display: flex;
        gap: 20px;
        margin: 10px;
        padding: 10px;
        justify-content: center;
    }
    form{
        display: flex;
        align-items: center;
        gap: 10px;
    }
    input[type="date" i]{
        border-radius: 10px;
        height: 26px;
        width: 120px;
        text-align: center;
        background: #e2ffff;
        border-color: #19354d;
        color: #19354d;
    }
    .fecha_r{
        margin: 10px;
        padding: 10px;
    }
</style>
<div class="ventana_inicio">
    <div class="contenido">
        <div class="titulo"><h2>Reportes</h2></div>
        <div class="sub_contenido">
            <div class="btn-fecha caja_form">
                <button type="button" id="btn-1" class="color1 NONE" onclick="caso1()">Selecionar fecha</button>
                <button type="button" id="btn-2" class="color1" onclick="caso2()">Rango de fecha</button>
                <div id="fecha1">
                    <form id="form1">
                        <label for="fecha">Fecha:</label>
                        <input type="date" name="fecha" id="fecha">
                        <button type="submit" class="color2">Buscar</button>
                    </form>
                </div>
                <div id="fecha2" class="NONE">
                    <form id="form2">
                        <label for="fecha_inicio">Fecha Inicio:</label>
                        <input type="date" name="fecha_inicio" id="fecha_inicio">
                        <label for="fecha_fin">Fecha Fin:</label>
                        <input type="date" name="fecha_fin" id="fecha_fin">
                        <button type="submit" class="color2">Buscar</button>
                    </form>
                </div>
            </div>
            <hr>
            <div class="fecha_r" id="fecha_r">
                <table>
                    <tr class="tr1">
                        <td>Cliente</td>
                        <td>Producto</td>
                        <td>Cantidad</td>
                        <td>Total</td>
                        <td>Comentario</td>
                        <td>Fecha</td>
                    </tr>
                    <?php 
                        foreach ($recent_sales as $sale) {
                            echo '<tr><td>'.$sale['nombre'] . '</td>
                                    <td>' .$sale['nombre_prod'] . '</td>
                                    <td>' . $sale['cantidad'] . '</td>
                                    <td>' . $sale['total'] . '</td>
                                    <td>' . $sale['comentario'] . '</td>
                                    <td>' . $sale['fecha'] . '</td></tr>';
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    function caso1(){
        $('#btn-1').hide();
        $('#fecha2').hide();
        $('#btn-2').show();
        $('#fecha1').show();
    }
    function caso2(){
        $('#btn-1').show();
        $('#fecha2').show();
        $('#btn-2').hide();
        $('#fecha1').hide();
    }
    $(document).ready(function() {
        $('#form1').on('submit', function(event) {
            event.preventDefault();
            console.log($(this).serialize());
            $.ajax({
                url: '../procesos/reporte_fecha.php',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    $('#fecha_r').html(response);
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        });
        $('#form2').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: '../procesos/reporte_fecha.php',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    $('#fecha_r').html(response);
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        });
    });
</script>