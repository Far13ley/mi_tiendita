<?php
require_once('../conection/cnx.php');
require_once('plantilla/menu.php');  

$query = "SELECT * FROM productos";
$result = mysqli_query($cnx, $query) or die(mysqli_error($cnx));

session_start();

// Verificar si el usuario está logueado y tiene el rol de admin
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["rol"] !== "admin"){
    header("location: ../index.php"); // Redirigir a la página principal si no es admin
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control Panel</title>
    <link rel="stylesheet" href="../css/controlPanel.css">
</head>
<body>
    <main class="container">
        <h1>Panel de Control</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Descripción</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($row['Producto'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td>$<?php echo number_format(floatval($row['Precio']), 2); ?></td>
                        <td><?php echo htmlspecialchars($row['Otro'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><img src="../plantilla/<?php echo htmlspecialchars($row['Imagenes'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($row['Producto'], ENT_QUOTES, 'UTF-8'); ?>" width="50"></td>
                        <td>
                            <a href="editarproducto.php?id=<?php echo $row['id']; ?>">🖉</a>
                            <a href="eliminarproducto.php?id=<?php echo $row['id']; ?>" onclick="return confirm('¿Estás seguro de eliminar este producto?');">❌</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="agregarproducto.php" class="button">Agregar Producto</a>
    </main>
    <?php mysqli_close($cnx); ?>
</body>
</html>
