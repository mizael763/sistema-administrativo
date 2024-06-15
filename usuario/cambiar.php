<?php 
require('../conexion/conexion.php');
if(isset($_GET['token'])){
    $token = $_GET['token'];
    $correo = $_GET['email'];
    try{
        $sql="SELECT id_cliente FROM verificar_correo WHERE correo = :correo AND token = :token";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
        $stmt->bindParam(':token', $token, PDO::PARAM_STR);
        $stmt->execute();
        $id_cliente = $stmt->fetchColumn();
        if($id_cliente){
            
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña</title>
</head>
<body>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;700&display=swap">
    <link rel="stylesheet" href="../css/modal.css">
</head>
<body>
    <div class="modal_m cja-ts">
        <h1>Cambiar Contraseña</h1>
        <div class="caja sub_t">
            <input type="password" name="contrasena1" id="contrasena1" placeholder="Ingresa contraseña nueva" required>
        </div>
        <div class="caja sub_t">
            <input type="password" name="contrasena2" id="contrasena2" placeholder="Ingresa tu nueva contraseña" required>
        </div>
        <div>
            <button type="button" id="comprobar" data-id_cambiar="<?php echo $id_cliente; ?>">Crear Usuario</button>
        </div>
        <div class="caja1" id="caja1">
            <div>
                <label id="mensaje"></label>
                <a href="../" id="ok"><button>OK</button></a>
                <button type="button" id="ok2" onclick="cerra()">OK</button>
            </div>  
        </div>
    </div>
<!-- scripts -->
<script>
    function mostra(){
        $('#caja1').show();
    }
    function cerra(){
        $('#caja1').hide();
    }
$(document).ready(function() {
    $("#comprobar").click(function(e){
        var id_cambiar = $(this).data('id_cambiar')
        var contra1 = $('#contrasena1').val();
        var contra2 = $('#contrasena2').val();
        if(contra1==contra2){
            $('#mensaje').text('Contraseña cambiada correctamente');
            $.ajax({
                url: '../procesos/cambiar.php',
                type: 'POST',
                data: {contra2:contra2, id_cambiar:id_cambiar},
                success: function(response) {
                    $('#ok2').hide();
                    $('#mensaje').html(response);
                    mostra();
                },
                error: function(xhr, status, error) {
                    $('#mensaje').html(response)
                }
            });
        } else {
            $('#ok').hide();
            $('#mensaje').text('Error las contraseñas no coinsiden');
            mostra();
        }
    });
});
</script>
</body>
</html>
</body>
</html>
<?php
        }
    } catch (PDOException $e){
        echo "Error: " . $e->getMessage();
    }
}
?>
