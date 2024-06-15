<?php 
session_start();
// require ('../conexion/conexion.php');
$producto = $_POST['id_producto'];
$nombre_p = $_POST['nombre'];
$precio_p = $_POST['precio'];

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<div>
    <div id="mensaje_C"></div>
    <form id="form_venta">
        <input type="hidden" name="id_cliente" value="<?php echo $_SESSION['id_user']; ?>">
        <input type="hidden" name="id_producto" value ="<?php echo $producto; ?>">
        <input type="hidden" name="precio" value ="<?php echo $precio_p; ?>">
        <div>
            <p><?php echo "Producto: ".$nombre_p; ?></p>
            <p><?php echo "Precio: ".$precio_p; ?></p>
        </div>
        <div>
            <label>Cantidad:</label>
            <input type="number" name="cantidad">
        </div>
        <div>
            <button type="submit">Comprar</button>
        </div>
    </form>
</div>
<script>
$(document).ready(function() {
    $('#form_venta').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            url: 'procesos/compra.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                $('#mensaje_C').html(response);
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    });
});
</script>