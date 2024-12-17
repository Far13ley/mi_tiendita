<?php
// Conectar a la base de datos
require_once('conection/cnx.php');

// Consultar la base de datos para obtener los productos
$productos = [];
$query_PRODUCTOS = "SELECT * FROM productos";
$result = mysqli_query($cnx, $query_PRODUCTOS);
while ($row = mysqli_fetch_assoc($result)) {
    $productos[$row['id']] = $row;
}

// Definir las categorías (así puedes usarla en tu código)
$categorias = [
    'Gomitas' => [18, 19, 20],
    'Galletas' => [6, 7, 8, 9, 10],
    'Salado' => [1, 2, 16],
    'Dulce' => [3, 4, 5, 11, 12, 13],
    'Variedad' => array_keys($productos), // Todos los productos
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css">
    <!-- Font Awesome para los íconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<main class="products">
    <div class="tabs container">
        <?php $tabIndex = 1; ?>
        <?php foreach ($categorias as $nombre => $ids): ?>
            <!-- Crear input y label para cada categoría -->
            <input type="radio" name="tabs" id="tab<?php echo $tabIndex; ?>" class="tabInput" value="<?php echo $tabIndex; ?>" <?php echo $tabIndex === 1 ? 'checked' : ''; ?>>
            <label for="tab<?php echo $tabIndex; ?>"><?php echo htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8'); ?></label>

            <div class="tab">
                <div class="swiper mySwiper-2" id="swiper<?php echo $tabIndex; ?>">
                    <div class="swiper-wrapper">
                        <?php foreach ($ids as $id): ?>
                            <?php if (isset($productos[$id])): ?>
                                <div class="swiper-slide">
                                    <div class="ficha">
                                        <p><?php echo htmlspecialchars($productos[$id]['Producto'], ENT_QUOTES, 'UTF-8'); ?></p>
                                        <p>$<?php echo number_format(floatval($productos[$id]['Precio']), 2); ?></p>
                                        <p><?php echo htmlspecialchars($productos[$id]['Otro'], ENT_QUOTES, 'UTF-8'); ?></p>
                                        <img src="images/<?php echo htmlspecialchars($productos[$id]['Imagenes'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($productos[$id]['Producto'], ENT_QUOTES, 'UTF-8'); ?>">

                                        <!-- Formulario para agregar al carrito -->
                                        <form class="formAgregar" action="carrito.php" method="get">
                                            <input type="hidden" name="accion" value="agregar">
                                            <input type="hidden" name="id" value="<?php echo $productos[$id]['id']; ?>">
                                            <input type="hidden" name="cantidad" value="1"> <!-- Siempre agregar 1 unidad -->
                                            <button type="submit">Agregar al carrito</button>
                                        </form>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>

            <?php $tabIndex++; ?>
        <?php endforeach; ?>
    </div>
</main>

<!-- Icono flotante para el carrito (Font Awesome) -->
<div id="carritoFlotante" style="top: 20px; right: 20px;">
    <a href="carrito.php">
        <i class="fa fa-cart-shopping iconoCarrito"></i> <!-- Ícono de Font Awesome -->
        <span id="contadorCarrito">
            <?php echo isset($_SESSION['carrito']) ? count($_SESSION['carrito']) : 0; ?>
        </span>
    </a>
</div>

<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const swipers = document.querySelectorAll('.mySwiper-2');
        swipers.forEach((swiperContainer) => {
            new Swiper(swiperContainer, {
                slidesPerView: 3,
                spaceBetween: 10,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                    768: { slidesPerView: 2 },
                    1024: { slidesPerView: 3 },
                },
            });
        });
    });

    // Usar AJAX para agregar al carrito y refrescar la página
    document.querySelectorAll(".formAgregar").forEach(form => {
        form.addEventListener("submit", function(e) {
            e.preventDefault(); // Prevenir redirección
            let form = this;
            let data = new FormData(form);
            
            fetch('carrito.php?' + new URLSearchParams(data), {
                method: 'GET',
            })
            .then(response => response.text())
            .then(data => {
                alert("Producto agregado al carrito.");
                location.reload(); // Actualiza la página
            })
            .catch(error => console.error("Error al agregar al carrito:", error));
        });
    });
</script>


<style>
    #carritoFlotante {
        position: fixed;
        background-color: #ff6600;
        border-radius: 50%;
        padding: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        z-index: 1000;
    }

    #carritoFlotante a {
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        color: white;
        font-size: 24px;
        position: relative;
    }

    .iconoCarrito {
        font-size: 30px;
        color: white;
    }

    #contadorCarrito {
        position: absolute;
        top: -5px;
        right: -10px;
        background-color: red;
        color: white;
        border-radius: 50%;
        padding: 2px 6px;
        font-size: 14px;
        font-weight: bold;
    }
</style>

</body>
</html>
