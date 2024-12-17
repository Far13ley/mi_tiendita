<?php
require_once('../conection/cnx.php');

// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);  // Obtener el ID del producto
    $producto = mysqli_real_escape_string($cnx, $_POST['producto']);
    $precio = floatval($_POST['precio']);
    $otro = mysqli_real_escape_string($cnx, $_POST['otro']);  // Columna 'Otro'
    
    // Inicializar la variable de imagen
    $imagenes = $_POST['imagenes_actual'];  // Usar la imagen actual por defecto

    // Verificar si se sube una nueva imagen
    if (isset($_FILES['imagenes']) && $_FILES['imagenes']['error'] == 0) {
        $target_dir = "../plantilla/";  // Carpeta donde se guardarán las imágenes
        $target_file = $target_dir . basename($_FILES["imagenes"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Verificar si el archivo es una imagen
        $check = getimagesize($_FILES["imagenes"]["tmp_name"]);
        if ($check !== false) {
            // Mover la imagen a la carpeta "plantilla"
            if (move_uploaded_file($_FILES["imagenes"]["tmp_name"], $target_file)) {
                $imagenes = basename($_FILES["imagenes"]["name"]);  // Actualizar el nombre de la imagen
            }
        } else {
            echo "El archivo no es una imagen válida.";
        }
    }

    // Actualizar los datos del producto en la base de datos
    $query = "UPDATE productos SET Producto='$producto', Precio='$precio', Otro='$otro', Imagenes='$imagenes' WHERE id=$id";
    mysqli_query($cnx, $query) or die(mysqli_error($cnx));

    // Redirigir al panel de control después de guardar los cambios
    header("Location: controlpanel.php");
    exit;
}

// Obtener los detalles del producto que se desea editar
$id = intval($_GET['id']);
$query = "SELECT * FROM productos WHERE id=$id";
$result = mysqli_query($cnx, $query) or die(mysqli_error($cnx));
$product = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="../css/controlPanel.css">
</head>
<body>
    <main class="container">
        <h1>Editar Producto</h1>
        <form method="post" enctype="multipart/form-data">
            <!-- Campo oculto para el ID del producto -->
            <input type="hidden" name="id" value="<?php echo $product['id']; ?>">

            <label>Producto: 
                <input type="text" name="producto" value="<?php echo htmlspecialchars($product['Producto'], ENT_QUOTES, 'UTF-8'); ?>" required>
            </label>

            <label>Precio: 
                <input type="number" step="0.01" name="precio" value="<?php echo $product['Precio']; ?>" required>
            </label>

            <label>Descripción:  <!-- Cambié 'Categoría' a 'Descripción' -->
                <input type="text" name="otro" value="<?php echo htmlspecialchars($product['Otro'], ENT_QUOTES, 'UTF-8'); ?>" required>
            </label>

            <label>Imagen: 
                <input type="file" name="imagenes" accept="image/*">
                <br>
                <!-- Muestra la imagen actual si existe -->
                <small>Imagen actual: </small>
                <img src="../plantilla/<?php echo htmlspecialchars($product['Imagenes'], ENT_QUOTES, 'UTF-8'); ?>" alt="Imagen Actual" width="100">
                <!-- Campo oculto para guardar el nombre de la imagen actual si no se cambia -->
                <input type="hidden" name="imagenes_actual" value="<?php echo htmlspecialchars($product['Imagenes'], ENT_QUOTES, 'UTF-8'); ?>">
            </label>

            <button type="submit" class="button">Guardar Cambios</button>
        </form>
    </main>
</body>
</html>

<?php mysqli_close($cnx); ?>
