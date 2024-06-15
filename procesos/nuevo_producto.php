<?php 
include ('../conexion/conexion.php');
if (isset($_FILES['imagen'])) {
    $file = $_FILES['imagen'];
    
    // Comprobar si se subió sin errores
    if ($file['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $file['tmp_name'];
        $fileName = $file['name'];
        $fileSize = $file['size'];
        $fileType = $file['type'];
        
        // Comprobar el tipo MIME del archivo
        $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif','image/webp'];
        if (in_array($fileType, $allowedMimeTypes)) {
            // El archivo es una imagen, proceder con el guardado
            $uploadFileDir = '../producto/images/';
            $destPath = $uploadFileDir . $fileName;
            
            if (move_uploaded_file($fileTmpPath, $destPath)) {
                //echo 'El archivo se ha subido correctamente.';
                $imagen = "producto/images/". $fileName;
                $nombre = $_POST['nombre'];
                $descripcion = $_POST['descripcion'];
                $unidad = $_POST['unidad'];
                $precio = $_POST['precio'];
                $stock = $_POST['stock'];
                try{
                    $sql = "INSERT INTO producto (nombre_prod, descripcion, medida, imagen, precio, stock) VALUES (:nombre, :descripcion, :unidad, :imagen, :precio, :stock)";
                    $stmt = $conexion ->prepare($sql);
                    $stmt -> bindParam(':nombre', $nombre);
                    $stmt -> bindParam(':descripcion', $descripcion);
                    $stmt -> bindParam(':unidad', $unidad);
                    $stmt -> bindParam(':imagen', $imagen);
                    $stmt -> bindParam(':precio', $precio);
                    $stmt -> bindParam(':stock', $stock);
                    $stmt -> execute();
                    echo "Producto agregado correctamente (".$nombre.")";
                } catch (PDOException $e) {
                    echo "Error:". $e->getMessage();
                }
            } else {
                echo 'Hubo un error al mover el archivo subido.';
            }
        } else {
            echo 'El archivo subido no es una imagen válida.';
        }
    } else {
        echo 'Hubo un error al subir el archivo.';
    }
} else {
    echo 'No se ha recibido ningún archivo.';
}
?>