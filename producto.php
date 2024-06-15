<?php
session_start();
require('conexion/conexion.php');
try {
    // Consultar productos y categorías
    $sql = "SELECT * FROM `producto`";
    
    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    /* Consultar las categorías
    $sql_categorias = "SELECT * FROM `elemento_reciclable` WHERE cod_elemento_reciclable = 12";
    
    $stmt_categorias = $conexion->prepare($sql_categorias);
    $stmt_categorias->execute();
    
    $categorias = $stmt_categorias->fetchAll(PDO::FETCH_ASSOC);*/

} catch (PDOException $e) {
    die("Error al obtener los datos: " . $e->getMessage());
}
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
    <!--<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Anton&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap">-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        <nav>
            <ul>
            <li><a href="./" class="sub_t icono"><img src="img/logo4.png" alt="..." class="imglogo"><i class="ii"> EL Punto de Hierro</i></a></li>
                <li><a href="./" class="sub_t"><i class="fas fa-home"></i><i class="ii"> Inicio</i></a></li>
                <!--<li class="dropdown_1">
                    <a href="#" class="sub_t"><i class="fas fa-th-large"></i><i class="ii"> Categorías</i></a>
                    <div class="dropdown-menu_1">
                    </div>
                </li>-->
                <li><a href="#" class="sub_t marcado"><i class="fas fa-shopping-cart"></i><i class="ii"> Productos</i></a></li>
                <li><a href="#" class="sub_t"><i class="fas fa-phone"></i><i class="ii"> Contacto</i></a></li>
                <?php
                    if(isset($_SESSION['id_user'])){
                        echo '<li class="dropdown_1"><a href="#" class="sub_t" onclick="toggleSubmenu(event)"><i class="fas fa-user"></i><i class="ii"> '.$_SESSION['user'].'</i></a>
                                <div class="dropdown-menu_1">
                                    <a href="procesos/cerrar.php">Cerrar Session</a>
                                </div>
                            </li>';
                        if($_SESSION['rol']>1){
                            echo '<li><a href="administracion/" class="sub_t"><i class="fas fa-cog"></i><i class="ii"> Admin</i></a></li>';
                        }
                    } else {
                        echo '<li><div class="sub_t log"><button type="button" class="sus" onclick="mostrarModal()">Iniciar Sesion</button></div></li>';
                    }
                ?>
                <li><div><input type="text" name="buscar_p1" id="buscar_p1" class="buscar_p1" placeholder="Buscar Producto"><i class="fas fa-search lupa"></i></div></li>
            </ul>
        </nav>
    </header>
    <?php
        if(isset($_SESSION['id_user'])){
            ?>
    <div class="cajaM" id="cajaM"><label class="mensaje" id="mensaje">Hola, que miras.</label><button type="button" class="ok" id="ok" onclick="mensaje()">ok</button></div>
    <?php } ?>
    <div class="products" id="products">
        <?php
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
                        //echo "<a href='#' class='c' name='add_to_cart' data-cliente='".$_SESSION['id_user']."' data-prod='".$row['id_producto']."'>🛒 Añadir</a>";
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
        ?>
    </div>
    <!-- modal login -->
    <div id="response" class="modal_m cja-ts">
        <?php
            require ('usuario/form_login.php'); 
            ?>
    </div>
    <!-- mostrar producto-->
    <div id="mostrar_producto">
    <div id="mensaje_C" style="display:none;text-align: center;background: #ec891d;border: 2px solid; padding-bottom: 3px;"></div>
        <div class="caja_texto">
            <h3 id="nombre_p">Nombre Producto</h3>
            <button type="button" class="btn-cerrar btn-ver" onclick="cerrarVer()">x</button>
        </div>
        <div style="display: flex; position:relative">
            <div id="caja0"><img src="#" alt="..." id="img0"></div>
            <div style="min-width: 45vh;">
                <div class="caja_texto" id="descripcion_p"></div>
                <div class="caja_texto" id="PrecioMedida">
                    <h4 id="medida_p">Litros</h4>
                    <h2 id="precio_p">$40.30</h2>
                </div>
                <div style="text-align: center;margin: 20px;" id="venta">
                    <form id="form_venta">
                        <input type="hidden" name="id_producto" id="id_prod" value="#">
                        <input type="hidden" name="id_cliente" id="id_clien" value="#">
                        <input type="hidden" name="precio" id="precio_p2" value="#">
                        <input type="number" name="cantidad" id="cantidad" class="buscar_p1" placeholder="Cantidad" step="0.01" style="width: 50%;display:none; min-width: 50%;margin-bottom: 10px;">                   
                        <button type="submit" class="btn-ver" style="height: 30px;font-size: 16px; display:none;" id="ver2">Comprar</button>
                    </form>
                    <button type="submit" class="btn-ver" style="height: 30px;font-size: 16px;" onclick="ver2()" id="ver1">Comprar</button>
                </div>
            </div>
        </div>
        
    </div>
    <script>
    function ver(Nombre,IdProd,Img,Descripcion,Precio,preciot,Medida,IdCliente){
        event.preventDefault();
        var med = '$ '+preciot
        $('#mostrar_producto').show();
        $('#nombre_p').text(Nombre);
        $('#id_prod').val(IdProd);
        $('#descripcion_p').text(Descripcion);
        $('#precio_p').text(med);
        $('#precio_p2').val(Precio);
        $('#medida_p').text(Medida);
        $('#img0').attr('src', Img);
        $('#id_clien').val(IdCliente);
    }
    function ver2(){
        $("#ver2").show()
        $("#cantidad").show()
        $("#ver1").hide()
    }
    function cerrarVer(){
        $('#mostrar_producto').hide();
        $("#ver2").hide()
        $("#cantidad").hide()
        $("#ver1").show()
        $('#mensaje_C').hide();
    }
    function cargar(){
        location.reload();
    }
    function mostrarModal(){
        $("#response").show()
    }
    function cerrarModal() {
        $("#response").hide()
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
        /*
        $('.c').on('click', function(event) {
            event.preventDefault(); 
            var id_cliente = $(this).data('cliente');
            var id_producto = $(this).data('prod');
            $.ajax({
                url: 'procesos/añadir_carrito.php',
                type: 'POST',
                data: {id_cliente: id_cliente, id_producto: id_producto},
                success: function(response) {
                    $('#mensaje').html(response);
                    $('#cajaM').show();
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        });*/
        $('#form_venta').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: 'procesos/compra.php',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    $('#mensaje_C').html(response);
                    $('#mensaje_C').show();
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        });
        let debounceTimeout;
        $("#buscar_p1").keyup(function(e){
            var busqueda = $(this).val();
            console.log(busqueda.length);
            clearTimeout(debounceTimeout);
            debounceTimeout = setTimeout(function(){
                if(busqueda.length >= 3 || busqueda ==""){
                    $.ajax({
                        url: 'procesos/buscar_pro.php',
                        type: 'POST',
                        data: {busqueda:busqueda},
                        success: function(response) {
                            $('#products').html(response);
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                        }
                    });
                }
            }, 1000);
        });
    });
    function toggleSubmenu(event) {
        event.preventDefault();
        const submenu = event.target.nextElementSibling;
        if (submenu.style.display === "block") {
            submenu.style.display = "none";
        } else {
            submenu.style.display = "block";
        }
    }
</script>
</body>
</html>

