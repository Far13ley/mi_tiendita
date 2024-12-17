<?php
require_once('../conection/cnx.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $producto = mysqli_real_escape_string($cnx, $_POST['producto']);
    $precio = floatval($_POST['precio']);
    $otro = mysqli_real_escape_string($cnx, $_POST['otro']);  // Cambié 'categoria' a 'otro'
    
    // Manejo de imagen
    $imagenes = ''; // Valor por defecto, vacío

    if (isset($_FILES['imagenes']) && $_FILES['imagenes']['error'] == 0) {
        $target_dir = "../plantilla/";  // Carpeta donde se guardarán las imágenes
        $target_file = $target_dir . basename($_FILES["imagenes"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Verificar si el archivo es una imagen
        $check = getimagesize($_FILES["imagenes"]["tmp_name"]);
        if ($check !== false) {
            // Mover la imagen a la carpeta "plantilla"
            if (move_uploaded_file($_FILES["imagenes"]["tmp_name"], $target_file)) {
                $imagenes = basename($_FILES["imagenes"]["name"]); // Guardar el nombre del archivo
            }
        } else {
            echo "El archivo no es una imagen válida.";
        }
    }

    // Insertar el producto en la base de datos
    $query = "INSERT INTO productos (Producto, Precio, Otro, Imagenes) VALUES ('$producto', '$precio', '$otro', '$imagenes')";
    mysqli_query($cnx, $query) or die(mysqli_error($cnx));
    header("Location: controlpanel.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Producto</title>
    <link rel="stylesheet" href="../css/controlPanel.css">
</head>
<body>
    <main class="container">
        <h1>Agregar Producto</h1>
        <form method="post" enctype="multipart/form-data">
            <label>Producto: 
                <input type="text" name="producto" required>
            </label>
            <label>Precio: 
                <input type="number" step="0.01" name="precio" required>
            </label>
            <label>Descripción:  <!-- Cambié 'Categoría' a 'Descripción' -->
                <input type="text" name="otro" required>
            </label>
            <label>Imagen: 
                <input type="file" name="imagenes" accept="image/*" required>
                <br>
                <small>Selecciona una imagen desde tu computadora</small>
            </label>
            <button type="submit" class="button">Agregar Producto</button>
        </form>
    </main>
</body>
</html>
