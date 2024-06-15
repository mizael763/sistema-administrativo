<?php 
session_start()
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de Productos</title>
    <link rel="stylesheet" href="css/styles2.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .ventana_1{
            width: 80%;
            margin: 40px auto;
            background: #3d3a39;
            border-radius: 20px;
            border: 4px dotted white;
            box-shadow: 0 6px 15px 13px black;
        }
        p{
            margin: 0;
            text-align: justify;
        }
        h3{
            margin: revert;
        }
        .cja-gion{
            position: relative;
            width: 100%;
            height: 100%;
        }
        .cja-gion .marco{
            border: 3px dashed;
            background: white;
        }
        .cja-gion div{
            position: absolute;
            width: 8px;
            height: 8px;
            background-color: black;
            border-radius: 50%;
            top: 9px;
            right: 5px;
        }
        .marco div{
            position: relative;
            top: 0;
            right: 0;
        }
        .ps p{
            margin-left: 10px;
        }
        .logo_ti{
            position: relative;
            background: rgb(0 0 0 / 70%);
            color: white;
            text-align: center;
            width: 300px;
            padding: 10px 5px 2px 0px;
            border-radius: 70px;
            border: 3px dashed;
            margin: auto;
            font-size: 40px;
        }
        .logo_ti img{
            height: 170px;
            padding: 0 4.05px;
        }
        .logo_ti div{
            width: max-content;
            position: absolute;
            padding-bottom: 10px;
            top: 50%;
            left: 50%;
            transform: translate(-49%, -50%);
        }
        .logo_ti svg{
            overflow: visible;
        }
        .logo_ti text {
            fill: white; /* Color del texto */
            stroke: black; /* Color del borde */
            stroke-width: 3px; /* Grosor del borde */
        }
        .texto-con-borde {
            font-size: 40px;
            color: white; /* Color del texto */
            position: relative;
            display: inline-block;
        }
        .texto-con-borde::before {
            content: attr(data-text);
            position: absolute;
            top: 0;
            left: 0;
            z-index: -1;
            color: black; /* Color del borde */
            filter: blur(2px); /* Ajusta el valor para controlar el grosor */
        }
        .princi{
            border-radius: 21px;
            width: 80%;
            margin: 20px auto;
            box-shadow: 0px 9px 12px 10px black;
        }
        .fondo{
            background-image: url(img/fondo.png);
            background-size: 478px;
            padding-top: 13px;
            border: 10px solid rgb(0 0 0 / 50%);
        }
        .f-1{
            border-bottom: none;
            border-radius: 20px 20px 0 0;
            background-position-y: 5%;
        }
        .f-2{
            background-position-y: -0.1%;
            border-top: none;
            border-radius: 0 0 20px 20px;
        }
        .title{
            padding: 10px 0;
        }
        .title h1,h2{
            background-color: rgb(0 0 0 / 50%);
            border: 4px dotted white;
            border-left: none;
            border-right: none;
            padding-bottom: 5px;
            color: white;
            text-align: center;
        }
        .white{
            color: white;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
            <li><a href="#" class="sub_t icono"><img src="img/logo4.png" alt="..." class="imglogo"><i class="ii"> EL Punto de Hierro</i></a></li>
                <li><a href="#" class="sub_t marcado"><i class="fas fa-home"></i><i class="ii"> Inicio</i></a></li>
                <li><a href="producto.php" class="sub_t"><i class="fas fa-shopping-cart"></i><i class="ii"> Productos</i></a></li>
                <li><a href="#" class="sub_t"><i class="fas fa-phone"></i><i class="ii"> Contacto</i></a></li>
                <?php
                    if(isset($_SESSION['id_user'])){
                        echo '<li class="dropdown_1"><a href="#" class="sub_t" onclick="toggleSubmenu(event)"><i class="fas fa-user"></i><i class="ii"> '.$_SESSION['user'].'</i></a>
                                <div class="dropdown-menu_1">
                                    <a href="procesos/cerrar.php"><i class="fas fa-sign-out-alt"></i><i class="ii"> Cerrar Session</i></a>
                                </div>
                            </li>';
                        if($_SESSION['rol']>1){
                            echo '<li><a href="administracion/" class="sub_t"><i class="fas fa-cog"></i><i class="ii"> Admin</i></a></li>';
                        }
                    } else {
                        echo '<li><div class="sub_t log"><button type="button" class="sus" onclick="mostrarModal()">Iniciar Sesion</button></div></li>';
                    }
                ?>
            </ul>
        </nav>
    </header>
    <div class="princi">
        <div class="fondo f-1">
            <div class="title">
                <h1>Bienvenidos a El Punto de Hierro</h1>
            </div>
        </div>
        <div class="fondo f-2"></div>
    </div>
    <div class="ventana_1" >
        <div style="padding: 20px 40px;">
            <h2>Tu Ferretería de Confianza</h2>
            <p>En El Punto de Hierro nos especializamos en ofrecerte todo lo que necesitas para tus proyectos de construcción, reparación y mantenimiento. Con más de 20 años de experiencia en el mercado, nos hemos consolidado como una de las ferreterías más confiables y completas de la región.</p>
        </div>
    <div style="padding: 20px 40px;">
        <div class="title ps">
            <h2>¿Por Qué Elegirnos?</h2>
            <div style="display: grid;grid-template-columns: 5% 93%;gap: 10px;justify-content: center;">
                <div class="cja-gion"><div class="marco"><div></div></div></div><p><b class="white"> Variedad de Productos:</b> Contamos con un amplio catálogo que incluye herramientas, materiales de construcción, artículos de jardinería, y mucho más.</p>
                <div class="cja-gion"><div class="marco"><div></div></div></div><p><b class="white"> Calidad Garantizada:</b> Trabajamos con las mejores marcas del mercado para asegurarte productos duraderos y de alta calidad.</p>
                <div class="cja-gion"><div class="marco"><div></div></div></div><p><b class="white"> Asesoramiento Profesional:</b> Nuestro equipo de expertos está siempre dispuesto a ayudarte y brindarte las mejores soluciones para tus proyectos.</p>
                <div class="cja-gion"><div class="marco"><div></div></div></div><p><b class="white"> Precios Competitivos:</b> Ofrecemos los mejores precios del mercado para que puedas llevar a cabo tus proyectos sin preocupaciones.</p>
            </div>
        </div>
        <div class="ps">
            <h2>Nuestras Categorías Principales</h2>
            <div style="margin-left: 10px;">
                <h3 class="white">Herramientas</h3>
                <p>Encuentra desde herramientas manuales hasta eléctricas de las mejores marcas.</p>
                <h3 class="white">Materiales de Construcción</h3>
                <p>Cemento, ladrillos, madera, y todo lo que necesitas para construir y remodelar.</p>
                <h3 class="white">Fontanería</h3>
                <p>Todo tipo de tuberías, accesorios y herramientas para tus proyectos de plomería.</p>
                <h3 class="white">Electricidad</h3>
                <p>Cables, interruptores, y equipos de iluminación de alta calidad.</p>
                <h3 class="white">Jardinería</h3>
                <p>Artículos para el cuidado y mantenimiento de tu jardín, desde herramientas hasta productos para el control de plagas.</p>
            </div>
        </div>
    </div>
    </div>
    <div id="response" class="modal_m cja-ts">
        <?php
            require ('usuario/form_login.php'); 
            ?>
    </div>
    <footer class="ventana_1" style="display: grid;grid-template-columns: 68% 30%;gap: 10px; padding: 0 10px 10px;">
        <div>
            <h3 class="white">Visítanos</h3>
            <div style="display: grid;grid-template-columns: 33.33% 28.33% 33.33%;gap: 10px;">
                <div>
                    <h4 class="white">Dirección:</h4>
                    <p>Av. Principal 123, Centro, Ciudad.</p>
                </div>
                <div>
                    <h4 class="white">Teléfono:</h4>
                    <p>(123) 456-7890</p>
                </div>
                <div>
                    <h4 class="white">Horario de Atención:</h4>
                    <p>Lunes a Viernes: 8:00 AM - 6:00 PM</p>
                    <p>Sábados: 9:00 AM - 3:00 PM</p>
                </div>
            </div>
        </div>
        <div>
        <h3 class="white">Contáctanos</h3>
        <p>Si tienes alguna pregunta o necesitas asesoramiento, no dudes en contactarnos. Estamos aquí para ayudarte.</p>
        </div>
    </footer>
    <script>
    function mostrarModal(){
        $("#response").show()
    }
    function cerrarModal() {
        $("#response").hide()
        $("#reposde").hide()
    }
    function modalLogin(caso){
        var condicion = caso;
        if(condicion == 1){
            $('#caja_login').hide();
            $('#caja_recupera').show();
        } else if (condicion == 2){
            $('#caja_recupera').hide();
            $('#caja_login').show();
        }
    }
    function cargar(){
        location.reload();
    }
    $(document).ready(function() {
        $('#myForm').on('submit', function(event) {
            event.preventDefault(); // Prevent the form from submitting via the browser

            $.ajax({
                url: 'procesos/login.php',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    var data = JSON.parse(response);
                    if(data.dato == true){
                        cargar();
                    } else {
                        $('#mensaje_m').html(data['mensaje']);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        });
    });
    </script>
</body>
</html>