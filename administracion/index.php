<?php
session_start();
require ('../conexion/conexion.php');
if($_SESSION['rol'] > 1){

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Document</title>
    <link rel="stylesheet" href="../css/admin.css">
<style>
    .titulo h2{
        font-family: monospace;
        font-size: 30px;
        margin: 10px;
    }
    .caja3{
        width: 95%;
        border: none;
        text-align: center;
    }
    .tr1 td{
        padding: 10px;
        color: #31335f;
        background: #a8c7fa;
    }
    #resultado_b{
        margin: 10px;
        padding: 10px;
    }
    td{
        background: white;
    }
</style>
</head>
<body>
    <div class="ventana">
        <div class="menu">
            <div class="marco">
                <a href="../?ver=true">
                        <div class="logo submenu"><img src="../img/logo4.png" alt="..." class="logo-icon"><h5 class="h5_t">Punto de Hierro</h5></div>
                    </a><hr style="margin-top: 0;">
                <div class="usuario submenu">
                    <h4><?php echo $_SESSION['user']."</h4>";
                    if($_SESSION['rol']==2){
                        echo "<h5>Empleado</h5>";
                    } else if($_SESSION['rol']==3) {
                        echo "<h5>Admin</h5>";
                    }
                    
                    ?>
                </div>
                <hr>
                <a href="#" onclick="inicio()">
                    <div class="submenu"><i class="fas fa-home"></i><h5>inicio</h5></div>
                </a><hr>
                <a href="#" onclick="insertar()">
                    <div class="submenu"><i class="fas fa-plus"></i><h5>Agregar Producto</h5></div>
                </a><hr>
                <a href="#" onclick="modificar()">
                    <div class="submenu"><i class="fas fa-edit"></i><h5>Modificar Producto</h5></div>
                </a><hr>
                <a href="#" onclick="reporte()">
                    <div class="submenu"><i class="fas fa-file-alt"></i><h5>Reportes</h5></div>
                </a><hr>
                <?php if($_SESSION['rol']==3){ ?>
                <a href="#" onclick="usuario()">
                    <div class="submenu"><i class="fas fa-user"></i><h5>Usuarios</h5></div>
                </a><hr>
                <?php } ?>
            </div>
            <div class="cerrar">
                <a href="../procesos/cerrar.php">
                    <div class="submenu"><i class="fas fa-sign-out-alt"></i><h5>Cerrar sesion</h5></div>
                </a>
            </div>
            
        </div>
        <div class="mostrar_menu">
            <div id="mostrar_menu" class="marco">
                <?php require_once('inicio.php'); ?>
            </div>
        </div>
        
    </div>
    <script>
        function inicio(){
            event.preventDefault();
            $.ajax({
                url: 'inicio.php',
                success: function(response) {
                    $('#mostrar_menu').html(response);
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }
        function insertar(){
            event.preventDefault();
            $.ajax({
                url: 'agregar_producto.php',
                success: function(response) {
                    $('#mostrar_menu').html(response);
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }
        function modificar(){
            event.preventDefault();
            $.ajax({
                url: 'modificar_producto.php',
                success: function(response) {
                    $('#mostrar_menu').html(response);
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }
        function reporte(){
            event.preventDefault();
            $.ajax({
                url: 'reporte.php',
                success: function(response) {
                    $('#mostrar_menu').html(response);
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }
        function usuario(){
            event.preventDefault();
            $.ajax({
                url: 'usuarios.php',
                success: function(response) {
                    $('#mostrar_menu').html(response);
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }
    </script>
</body>
</html>
<?php 
} else {
    header('Location: ../');
    //echo 'No tienes nivel';
}
?>