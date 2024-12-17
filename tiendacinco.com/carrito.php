<?php
session_start();

// Conectar a la base de datos
require_once('conection/cnx.php');

// Si no hay carrito en la sesión, crearlo
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Funciones para manejar el carrito
function agregarAlCarrito($idProducto, $cantidad) {
    if (isset($_SESSION['carrito'][$idProducto])) {
        $_SESSION['carrito'][$idProducto]['cantidad'] += $cantidad;
    } else {
        $_SESSION['carrito'][$idProducto] = ['cantidad' => $cantidad];
    }
}

function eliminarDelCarrito($idProducto) {
    unset($_SESSION['carrito'][$idProducto]);
}

function actualizarCantidad($idProducto, $cantidad) {
    if ($cantidad > 0) {
        $_SESSION['carrito'][$idProducto]['cantidad'] = $cantidad;
    } else {
        eliminarDelCarrito($idProducto);
    }
}

// Procesar las acciones del carrito
if (isset($_GET['accion'])) {
    $accion = $_GET['accion'];
    $idProducto = $_GET['id'];
    
    if ($accion == 'agregar') {
        $cantidad = $_GET['cantidad'] ?? 1;
        agregarAlCarrito($idProducto, $cantidad);
    } elseif ($accion == 'eliminar') {
        eliminarDelCarrito($idProducto);
    } elseif ($accion == 'actualizar') {
        $cantidad = $_GET['cantidad'] ?? 1;
        actualizarCantidad($idProducto, $cantidad);
    }
}

// Consultar la base de datos para obtener los productos
$productos = [];
$query_PRODUCTOS = "SELECT * FROM productos";
$result = mysqli_query($cnx, $query_PRODUCTOS);
while ($row = mysqli_fetch_assoc($result)) {
    $productos[$row['id']] = $row;
}

// Calcular el total y construir el mensaje para WhatsApp
$total = 0;
$mensaje = "Estos son mis productos:\n";
foreach ($_SESSION['carrito'] as $idProducto => $producto) {
    if (isset($productos[$idProducto])) {
        $productoInfo = $productos[$idProducto];
        $nombreProducto = $productoInfo['Producto'];
        $precio = floatval($productoInfo['Precio']);
        $cantidad = $producto['cantidad'];
        $subtotalProducto = $precio * $cantidad;
        
        // Solo sumamos el subtotal una vez por producto
        $total += $subtotalProducto;

        // Agregar cada producto al mensaje
        $mensaje .= "$nombreProducto - Cantidad: $cantidad - Precio: $" . number_format($precio, 2) . " - Subtotal: $" . number_format($subtotalProducto, 2) . "\n";
    }
}

// Agregar el total al mensaje
$mensaje .= "\nTotal: $" . number_format($total, 2);

// Codificar el mensaje para la URL
$mensajeCodificado = urlencode($mensaje);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Estilos del icono de flecha */
        .back-icon {
            position: fixed;
            top: 20px;
            left: 20px;
            font-size: 24px;
            color: #333;
            text-decoration: none;
            background-color: #f2f2f2;
            border: 1px solid #ccc;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease;
        }

        .back-icon:hover {
            background-color: #ddd;
            color: #000;
        }
    </style>
</head>
<body>

    <!-- Icono de flecha para regresar a la página principal -->
    <a href="index.php" class="back-icon" title="Volver a la página principal">
        &#8592;
    </a>

    <h1 align="center">Carrito de Compras</h1>

    <div class="carrito">
        <?php if (empty($_SESSION['carrito'])): ?>
            <p>Tu carrito está vacío.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Subtotal</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['carrito'] as $idProducto => $producto): ?>
                        <?php
                        if (isset($productos[$idProducto])) {
                            $productoInfo = $productos[$idProducto];
                            $nombreProducto = $productoInfo['Producto'];
                            $precio = floatval($productoInfo['Precio']);
                            $cantidad = $producto['cantidad'];
                            $subtotalProducto = $precio * $cantidad;
                        ?>
                            <tr>
                                <td>
                                    <img src="images/<?php echo htmlspecialchars($productoInfo['Imagenes'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($nombreProducto, ENT_QUOTES, 'UTF-8'); ?>" width="50">
                                    <?php echo htmlspecialchars($nombreProducto, ENT_QUOTES, 'UTF-8'); ?>
                                </td>
                                <td>
                                    <form action="carrito.php" method="get">
                                        <input type="number" name="cantidad" value="<?php echo $cantidad; ?>" min="1" required>
                                        <input type="hidden" name="accion" value="actualizar">
                                        <input type="hidden" name="id" value="<?php echo $idProducto; ?>">
                                        <button type="submit">Actualizar</button>
                                    </form>
                                </td>
                                <td>$<?php echo number_format($precio, 2); ?></td>
                                <td>$<?php echo number_format($subtotalProducto, 2); ?></td>
                                <td>
                                    <a href="carrito.php?accion=eliminar&id=<?php echo $idProducto; ?>">Eliminar</a>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="totales" style="border: 1px solid #ccc; padding: 10px; margin-top: 20px;">
                <p>Total: $<?php echo number_format($total, 2); ?></p>
                <!-- Enlace a WhatsApp con el mensaje codificado -->
                <a href="https://api.whatsapp.com/send?phone=5549161172&text=<?php echo $mensajeCodificado; ?>">Finalizar compra</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
