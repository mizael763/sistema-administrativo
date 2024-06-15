<div class="ventana_inicio">
<div class="contenido">
<div class="titulo"><h2>Modificar Producto</h2></div>
<?php
require('../conexion/conexion.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['busqueda'])){
        $busqueda = $_POST['busqueda'];
        if($busqueda=="*"){
            $sql_b = "SELECT * FROM producto";
            $stmt_b = $conexion->prepare($sql_b);
        } else {
            $busqueda = '%' . $busqueda . '%';
            $sql_b = "SELECT * FROM producto WHERE nombre_prod LIKE :nombre";
            $stmt_b = $conexion->prepare($sql_b);
            $stmt_b->bindParam(':nombre', $busqueda, PDO::PARAM_STR);
        }
        $stmt_b->execute();
        $resultados = $stmt_b->fetchAll(PDO::FETCH_ASSOC);
        $sql_m ="SELECT * FROM `medida`";
        $stmt_m = $conexion->prepare($sql_m);
        $stmt_m->execute();
        $medidas = $stmt_m->fetchAll(PDO::FETCH_ASSOC);
        echo'<div id="resultado">';
        echo'<table>
            <tr class="tr1">
                <td>Nombre</td>
                <td>Precio</td>
                <td>Descipcion</td>
                <td>Unidad de Medida</td>
                <td>Stock</td>
                <td>*</td>
                <td>*</td>
            </tr>';
        foreach ($resultados as $producto) {
?>
            <tr>
                    <td><input type="text" id="<?php echo 'nombre_f'.$producto['id_producto']; ?>" value="<?php echo $producto['nombre_prod']; ?>" class="caja3"></td>
                    <td><input type="number" id="<?php echo 'precio_f'.$producto['id_producto']; ?>" value="<?php echo $producto['precio']; ?>" class="caja3"></td>
                    <td><textarea class="caja3" id="<?php echo 'descripcion_f'.$producto['id_producto']; ?>"><?php echo $producto['descripcion']; ?></textarea></td>
                    <td>
                        <select id="<?php echo 'medida_f'.$producto['id_producto']; ?>" class="caja3">
                            <?php foreach ($medidas as $medida) { ?>
                                <option value="<?php echo $medida['id_medida']; ?>" <?php if($medida['id_medida']==$producto['medida']) echo 'selected'; ?>><?php echo $medida['nombre']; ?></option>
                            <?php } ?>
                        </select>
                    </td>
                    <td><input type="number" id="<?php echo 'stock_f'.$producto['id_producto']; ?>" value="<?php echo $producto['stock']; ?>" class="caja5"></td>
                    <td class="btn"><button type="button" onclick="modificar_p(<?php echo $producto['id_producto']; ?>)" class="color2">modificar</button></td>
                    <td class="btn">
                    <?php
                    if($producto['estado']==1){
                        echo '<button type="button" id="boton'.$producto['id_producto'].'" class="b_eliminar color4" onclick="eliminar('.$producto['id_producto'].','.$producto['estado'].')">No Mostrar</button>';
                    } else {
                        echo '<button type="button" id="boton'.$producto['id_producto'].'" class="b_eliminar color3" onclick="eliminar('.$producto['id_producto'].','.$producto['estado'].')">Mostrar</button>';
                    }
                    ?>
                </td>
            </tr>
<?php
        }

        echo'</table></div>';
    }
}
?>
<style>
    .mensaje{
        display: none;
        position: fixed;
        border: 1px solid black;
        width: 20%;
        height: 100px;
        left: 60%;
        top: 50%;
        transform: translate(-50%, -50%);
        background: #4d6b85;
        text-align: center;
        border-radius: 5px;
        padding: 5px;
    }
    .caja_buscar{
        text-align: center;
        padding: 10px;
        margin: 10px;
    }
    .input_buscar{
        height: 24px;
        width: 50%;
        border-radius: 5px;
        margin-right: 50px;
    }
</style>
<div class="caja_buscar">
    <input type="text" id="busqueda" placeholder="Buscar Producto" class="input_buscar">
    <button type="button" value="*" id="actualizar" onclick="busqueda_b(false)" class="bton-actulizar color1" style="width: 10%;">actualizar</button>
</div><hr>
<div id="resultado_b"></div>
<div id="mensaje_b" class="mensaje">
    <p id="mensaje_txt">¿Que miras?</p>
    <button type="button" value="*" id="actualizar2" onclick="busqueda_b(2)" class="bton-actulizar color1">OK</button>
</div>
</div>
</div>
<script>
    function busqueda_b(valor){
        if(valor) {
            if(valor==2){
                var busqueda = $("#actualizar2").val();
                $('#mensaje_b').hide();
            } else{
                var busqueda = valor;
            }
        } else {
            var busqueda = $("#actualizar").val();
        }
        $.ajax({
            url: '<?php echo basename(__FILE__); ?>',
            type: 'POST',
            data: { busqueda: busqueda },
            success: function(response) {
                var tempDiv = $('<div>').html(response);
                var busqueda = tempDiv.find('#resultado').html();
                $('#resultado_b').html(busqueda);
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });
    }
    $(document).ready(function(){
        let debounceTimeout;
        $("#busqueda").keyup(function(e){
            var busqueda = $(this).val();
            console.log(busqueda.length);
            clearTimeout(debounceTimeout);
            debounceTimeout = setTimeout(function(){
                if(busqueda.length > 3 || busqueda =="*"){
                    busqueda_b(busqueda);
                    $("#actualizar").val(busqueda);
                    $("#actualizar2").val(busqueda);
                }
            }, 2000);
        });
    });
    
    function modificar_p(id){
        var nombre = $('#nombre_f'+id).val();
        var precio = $('#precio_f'+id).val();
        var descripcion = $('#descripcion_f'+id).text();
        var unidad = $('#medida_f'+id).val();
        var stock = $('#stock_f'+id).val(); 
        $.ajax({
            url: '../procesos/modificar_p.php',
            type: 'POST',
            data: {id: id, nombre: nombre, precio: precio, descripcion: descripcion, unidad: unidad, stock: stock},
            success: function(response) {
                $('#mensaje_txt').html(response);
                $('#mensaje_b').show();
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });              
    };
    function eliminar(productoID, estado) {
        if(estado == 0){
            var mensaje = "¿Estás seguro que quieres mostrar este producto en la tienda?";
        } else if(estado == 1){
            var mensaje = "¿Estás seguro que quieres quitar este producto de la tienda?";
        }
        if(confirm(mensaje)) {
            $.ajax({
                url: '../procesos/modificar_p.php',
                type: 'POST',
                data: { productoID: productoID, estado: estado },
                success: function(response) {
                    if(estado == 0){
                        $('#boton'+ productoID).text("No Mostrar");
                        $('#boton'+ productoID).css("background-color", "#35da35");
                    } else if(estado == 1){
                        $('#boton'+ productoID).text("Mostrar");
                        $('#boton'+ productoID).css("background-color", "red");
                    }
                    $('#mensaje_txt').html(response);
                    $('#mensaje_b').show();
                },
                error: function(error) {
                    console.error('Error:', error);
                    alert('Error al eliminar el producto.');
                }
            });
        }
    }
</script>