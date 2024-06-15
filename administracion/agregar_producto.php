<div class="ventana_inicio">
<div class="contenido">
<div class="titulo"><h2>Agregar Producto</h2></div>
    <form id="registro" enctype="multipart/form-data" class="width50">
        <div class="caja">
            <label for="nombre">Nombre Producto:</label>
            <input type="text" name="nombre" id="nombre">
        </div>
        <div class="caja">
            <label for="descripcion">Descripcion del Producto:</label>
            <textarea name="descripcion" id="descripcion" rows="10px"></textarea>
        </div>
        <div class="caja">
            <label for="unidad">Unidad de Medida:</label>
            <select name="unidad" id="unidad">
<?php
require('../conexion/conexion.php');
    $unidades = "SELECT * FROM medida";
    $resultado = $conexion->prepare($unidades);
    $resultado->execute();
    while ($fila = $resultado->fetch()) {
        echo "<option value='".$fila['id_medida']."'>".$fila['nombre']."</option>";
    }
?>
            </select>
        </div>
        <div class="caja">
            <label for="precio">Precio:</label>
            <input type="number" name="precio" id="precio" step="0.01">
        </div>
        <div class="caja">
            <label for="stock">Stock:</label>
            <input type="number" name="stock" id="stock">
        </div>
        <div class="caja">
            <label for="imagen">Imagen del Producto:</label>
            <div class="subir width100">
                <button class="custom-button width100 color2">Selecionar Archivo</button>
                <input type="file" id="imagen" name="imagen" accept="image/*" class="file-input">
            </div>
        </div>
        <div class="center width50">
            <img id="imagenSeleccionada" src="#" alt="Imagen Seleccionada" style="display:none;"/>
        </div>
        <div class="center">
            <button type="submit" class="color1">Cargar Producto</button>
        </div>
        <div id="mensaje"></div>
    </form>
</div>
</div>

<!-- scripts -->
<script>
document.querySelector('.file-input').addEventListener('change', function() {
    let fileName = this.files[0].name;
    document.querySelector('.custom-button').textContent = 'Archivo: ' + fileName;
});
document.getElementById('imagen').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.getElementById('imagenSeleccionada');
            img.src = e.target.result;
            img.style.display = 'block';
        }
        reader.readAsDataURL(file);
    }
});
$(document).ready(function() {
        $('#registro').on('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: '../procesos/nuevo_producto.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#mensaje').html(response)
                },
                error: function(xhr, status, error) {
                    $('#mensaje').html(response)
                }
            });
        });
    });
</script>