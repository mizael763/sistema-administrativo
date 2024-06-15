<style>
    .caja_login{
        position: relative;
        margin: 10px;
    }
    .caja_logo{
        position: relative;
        width: 120px;
        height: 120px;
        margin: auto;
        border-radius: 30%;
        background: rgb(0 0 0 / 80%);
    }
    .img_logo{
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-52%, -49%);
        max-width: 100px;
    }
    .caja_login form{
        margin-bottom: 10px;
    }
    .caja_input input{
        height: 25px;
        font-size: 15px;
        text-align: center;
        min-width: fit-content;
        width: 60%;
        margin: 10px;
    }
    .btn_cerrar{
        position: absolute;
        right: 15px;
        top: 15px;
        background: #4caf50;
        color: white;
        border: none;
        border-radius: 5px;
        z-index: 100;
    }
    .btn_l{
        padding: 5px 10px;
    }
    .rojo{
        background: red;
    }
    .pre{
        text-decoration: none;
        color: gray;
    }
    .pre:hover{
        color: black;
    }
    .mandar{
        margin: 25px auto;
        padding: 5px 20px 8px 20px;
        background: rgb(255 255 255 / 50%);
        border: 3px dashed;
        border-right: none;
        border-left: none;
    }
</style>

<div class="caja_login" id="caja_login">
    <button type="button" id ="cerrar" class="btn-cerrar btn-ver" onclick="cerrarModal()">X</button>    
    <div class="caja_logo cja-ts">
        <img src="img/logo4.png" class="img_logo" alt="logo">
    </div>
    <form id="myForm">
        <p style="text-align: center;"><b class="font">INICIAR SESION</b></p>
        <div class="caja_input">
            <input type="hidden" name="verificar" value="1">
            <input type="text"  placeholder="Correo electronico" name="user" class="buscar_p1" style="min-width: 50%;max-width: 50%;">
            <input type="password"  placeholder="Contraseña" name="pass" class="buscar_p1" style="min-width: 50%;max-width: 50%;">
        </div>
        <div style="color: white;"><label id="mensaje_m"></label></div>
        <button class="buy-button btn-ver" style="width: 33%;margin-top: 10px;" type="submit">Iniciar Sesion</button>
    </form>
    <div>
        <a href="#" onclick="modalLogin(1)" class="pre">¿Olvidaste tu contraseña?</a>
    </div>
    <div style="margin: 10px;">
        <a href="usuario/" class="sub_t log" style="text-decoration: none;border-color: white;margin: auto;"> 
            <button type="button" class="sus">Registro</button> 
        </a>
    </div>
</div>
<div id="caja_recupera" style="display: none; position:relative; height: 100%; width: 100%;">
    <div class="caja_login" style="margin: 0;">
        <div class="caja_texto" style="color:white;">
            <h3 id="nombre_p" >Recuperar Contraseña</h3>
            <button type="button"class="btn-cerrar btn-ver" onclick="modalLogin(2)" style="margin-right: 10px;">X</button>
        </div>
        <h3 class="mandar">Se mandara a su correo un LINK de recuperacion</h3>
        <form id="recuperaform" style="display: grid; gap:20px; margin: 40px;">
            <input type="email" name="correorecuperacion" class="buscar_p1" placeholder="Introduce tu Correo" style="text-align: center; min-width: fit-content;width: auto;">
            <button type="submit" class="buy-button btn-ver" style="margin: auto;">Enviar</button>
        </form>
        <h3 class="mandar" id="reposde" style="display: none;">...</h3>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#recuperaform').on('submit', function(event) {
            event.preventDefault(); // Prevent the form from submitting via the browser

            $.ajax({
                url: 'procesos/recupera.php',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    $('#reposde').html(response);
                    $('#reposde').show();
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        });
    });
</script>
