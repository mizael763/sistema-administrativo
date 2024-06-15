<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borde a las Letras</title>
    <style>
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
    </style>
</head>
<body>
    <select id="medida">
    <?php
    require 'conexion/conexion.php';
    $selecionar = 3;
    $sql ="SELECT * FROM `medida`";
    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    $medidas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($medidas as $row){
        $selected = ($row['id_medida'] == $selecionar) ? 'selected' : '';
        echo "<option value='".$row['id_medida']."' $selected>".$row['nombre']."</option>";
    }
    ?>
    </select>
    <span class="texto-con-borde" data-text="Texto con borde">Texto con borde</span>
</body>
</html>
