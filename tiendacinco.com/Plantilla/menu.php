<?php
// Iniciar sesión
session_start();
?>
<header>
        <div class="logo">
            <img src="images/images.png" width="200%" height="200%" alt="Logo de la Tienda">
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="p2.php">Productos</a></li>
                <li><a href="c2.php">Contacto</a></li>
                <?php
                // Verificar si el usuario está logueado
                if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
                    echo '<li><a href="javascript:void(0);" onclick="toggleOptions()">Hola, ' . $_SESSION["email"] . '</a></li>';
                    echo '<ul id="user-options" style="display: none;">'; // Opciones ocultas por defecto
                    echo '<li><a href="co2.php">Comentarios</a></li>';
                    echo '<li><a href="login/cerrar_sesion.php">Cerrar sesión</a></li>';
                    
                    // Mostrar el Panel de Control solo si el rol es admin
                    if ($_SESSION["rol"] == "admin") {
                        echo '<li><a href="administrador/controlPanel.php">Panel de Control</a></li>';
                        echo '</ul>';
                    }
                } else {
                    echo '<li><a href="login/inicio.php">Iniciar sesión</a></li>';
                }
                ?>
            </ul>
            <script>
    function toggleOptions() {
        // Obtener el contenedor de las opciones
        var options = document.getElementById("user-options");
        
        // Alternar la visibilidad de las opciones (mostrar u ocultar)
        if (options.style.display === "none") {
            options.style.display = "block";
        } else {
            options.style.display = "none";
        }
    }
</script>

        </nav>
        </header>
 



