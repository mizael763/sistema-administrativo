<div class="ventana_inicio">
<div class="contenido">
<div class="titulo"><h2>Usuarios</h2></div>
<?php
require('../conexion/conexion.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['busqueda'])){
        $busqueda = $_POST['busqueda'];
        if($busqueda=="*"){
            $sql_b = "SELECT * FROM `cliente`";
            $stmt_b = $conexion->prepare($sql_b);
        } else {
            $busqueda = '%' . $busqueda . '%';
            if (strpos($busqueda, '@') !== false) {
                $sql_b = "SELECT * FROM cliente WHERE correo LIKE :nombre";
            } else {
                $sql_b = "SELECT * FROM cliente WHERE nombre LIKE :nombre";
            }
            $stmt_b = $conexion->prepare($sql_b);
            $stmt_b->bindParam(':nombre', $busqueda, PDO::PARAM_STR);
        }
        $stmt_b->execute();
        $resultados = $stmt_b->fetchAll(PDO::FETCH_ASSOC);

        echo'<div id="resultado">';
        echo'<table>
            <tr class="tr1">
                <td>Nombre Usuario</td>
                <td>Correo</td>
                <td>Telefono</td>
                <td>Direccion</td>
                <td>Verificacion</td>
                <td>Nivel</td>
                <td>Estado</td>
            </tr>';
        foreach ($resultados as $usuarios) {
            $rol = $usuarios['nivel'];
?>
            <tr>
                    <td><?php echo $usuarios['nombre']; ?></td>
                    <td><?php echo $usuarios['correo']; ?></td>
                    <td><?php echo $usuarios['telefono']; ?></td>
                    <td><?php echo $usuarios['direccion']; ?></td>
                    <td><?php
                        switch ($rol) {
                            case 0:
                                echo '<button type="button" class="F">No Verificado</button>';
                                break;
                            default:
                                echo '<button type="button" class="V">Verificado</button>';
                        }
                    ?></td>
                    <td class="btn"><?php
                        switch ($rol) {
                            case 1:
                                echo '<p>Usuario</p>';
                                break;
                            case 2:
                                echo '<p>Empleado</p>';
                                break;
                            case 3:
                                echo '<p>Admin</p>';
                                break;
                            default:
                                echo '';
                        }
                    ?>
                </td>
                <td class="btn"><?php
                        switch ($usuarios['estado']) {
                            case 1:
                                echo '<button type="button" class="V H" id="st_'.$usuarios['id_cliente'].'" onclick="estado('.$usuarios['id_cliente'].',1)">Activo</button>';
                                break;
                            default:
                                echo '<button type="button" class="F T" id="st_'.$usuarios['id_cliente'].'" onclick="estado('.$usuarios['id_cliente'].',0)">Suspendido</button>';
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
    .F,.V{
        cursor: auto;
    }
    .V{
        background-color: #1ce41c;
    }
    .F{
        background-color: red;
    }
    .H:hover{
        background-color: #11b811;
        cursor: pointer;
    }
    .T{
        background-color: #c40000;
        cursor: pointer;
    }
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
    <input type="text" id="busqueda" placeholder="Buscar nombre de usuario o correo" class="input_buscar">
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
                if(busqueda.length >= 3 || busqueda =="*"){
                    busqueda_b(busqueda);
                    $("#actualizar").val(busqueda);
                    $("#actualizar2").val(busqueda);
                }
            }, 1000);
        });
    });
    function estado(IDcliente, estado) {
        if(estado == 0){
            var mensaje = "¿Estás seguro que quieres habilitar este usuario?";
        } else if(estado == 1){
            var mensaje = "¿Estás seguro que quieres suspender este usuario?";
        }
        if(confirm(mensaje)) {
            $.ajax({
                url: '../procesos/estado_c.php',
                type: 'POST',
                data: { IDcliente: IDcliente, estado: estado },
                success: function(response) {
                    if(estado == 0){
                        $('#st_'+ IDcliente).text("Activo");
                        $('#st_'+ IDcliente).css("background-color", "#35da35");
                    } else if(estado == 1){
                        $('#st_'+ IDcliente).text("Suspendido");
                        $('#st_'+ IDcliente).css("background-color", "red");
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