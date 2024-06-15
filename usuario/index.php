<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;700&display=swap">
    <style>
        body{
            font-family: 'Oswald', sans-serif;
            background-color: #00000029;;
        }
        .modal_m{
            position: absolute;
            text-align: center;
            width: 450px;
            height: 500px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .modal_m{
            background-image: url('../img/fondo2.png');
            background-size: cover;
            border: 10px solid #0000008f;
            border-radius: 5px;
        }
        .sub_t{
            border-radius: 10px;
            border: 1px solid rgb(0 0 0 / 0%);
        }
        .sub_t, .cja-ts{
            background-color: #0000008f;
            box-shadow: 0 0 20px 15px #0000008f, 0 6px 20px rgba(0, 0, 0, 0.19);
        }
        .sub_t:hover{
            background-color: rgb(0 0 0 / 98%);
            box-shadow: 0px 1px 20px 20px #000000, 0 6px 20px rgb(0 0 0 / 37%);
            border: 1px solid rgb(0 0 0 / 97%);
        }
        input{
            border-radius: 5px;
            text-align: center;
            position: relative;
            border-style: dashed;
            height: 25px;
            width: 70%;
            min-width: 290px;
            font-family: 'Oswald', sans-serif;
        }
        button{
            margin: auto;
            background: #ec891d;
            text-decoration: none;
            color: white;
            width: 40%;
            height: 30px;
            border-radius: 5px;
            box-shadow: 0px 0px 6px 5px #6a3f10e6, 0 6px 20px rgb(20 20 19 / 99%);
        }
        button:hover{
            background: #ec891d7a;
            box-shadow: 0px 0px 13px 13px #d17f268f, 0 6px 20px rgb(20 20 19 / 99%);
        }
        .caja{
            margin: 30px auto;
            width: max-content;
        }
        .caja1{
            display: none;
            position: absolute;
            background: black;
            color: white;
            width: 300px;
            min-height: 100px;
            border-radius: 10px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border: 3px dashed;
            padding: 10px;
        }
        .caja1 div {
            width: 100%;
            height: 100%;
            display: grid;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        h1{
            border-radius: 20%;
            color: white;
            background-color: #0000008f;
            border: 1px solid white;
            border-left: none;
            border-right: none;
        }
    </style>
</head>
<body>
    <div class="modal_m cja-ts">
        <h1>REGISTRO</h1>
    <form id="registro">
        <div class="caja sub_t">
            <input type="text" name="nombre" id="nombre" placeholder="Nombre de Usuario" required>
        </div>
        <div class="caja sub_t">
            <input type="email" name="email" id="email" placeholder="Correo" required>
        </div>
        <div class="caja sub_t">
            <input type="number" name="tel" id="tel" placeholder="Telefono" required>
        </div>
        <div class="caja sub_t">
            <input type="text" name="direccion" id="direccion" placeholder="Direccion" required>
        </div>
        <div class="caja sub_t">
            <input type="password" name="pass" id="pass" placeholder="Contraseña" required>
        </div>
        <div>
            <button type="submit">Crear Usuario</button>
        </div>
        </form>
        <div class="caja1" id="caja1">
            <div>
                <label id="mensaje">Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis consequuntur esse odio possimus necessitatibus iusto excepturi earum,</label>
                <a href="../"><button>OK</button></a>
            </div>  
        </div>
    </div>
<!-- scripts -->
<script>
    function mostra(){
        $('#caja1').show();
    }
$(document).ready(function() {
        $('#registro').on('submit', function(event) {
            event.preventDefault();

            $.ajax({
                url: '../procesos/nuevo_usuario.php',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    $('#mensaje').html(response);
                    mostra();
                },
                error: function(xhr, status, error) {
                    $('#mensaje').html(response)
                }
            });
        });
    });
</script>
</body>
</html>