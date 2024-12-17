

<?php
require_once('conection/cnx.php');

// Verificar si se ha pasado el ID del producto en la URL
if (isset($_GET['idr'])) {
    $id_producto = $_GET['idr'];

    // Consulta para obtener el producto basado en el ID
    $query_producto = "SELECT * FROM produtos WHERE id = $id_producto";
    $producto_resultado = mysqli_query($cnx, $query_producto) or die(mysqli_error($cnx));
    $producto = mysqli_fetch_assoc($producto_resultado);
} else {
    // Si no se pasa el ID, redirigir a la página principal o mostrar un mensaje de error
    echo "Producto no encontrado.";
    exit;   
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $producto['nombre']; ?></title>
    <link rel="stylesheet" href="css/estylepro.css">
</head>
<body>
    <header>
        <h1><?php echo $producto['nombre']; ?></h1>
    </header>
    <section class="producto-detalle">
        <img src="images/<?php echo $producto['Imagenes']; ?>" alt="<?php echo $producto['nombre']; ?>">
        <h2><?php echo $producto['nombre']; ?> <?php echo $producto['sabor']; ?> </h2>
        <p><?php echo $producto['descripcio']; ?></p> 
        <p><strong>Sabor:</strong> <?php echo $producto['sabor']; ?></p>
        <p><strong>Precio:</strong> <?php echo $producto['tamaño']; ?></p>
    </section>
</body>
</html>
