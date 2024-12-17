
<section class="banner">
        <div class="banner-content">
            <h1>Bienvenido a Mi Tiendita Chingona</h1>
            <p>¡Lo mejor en productos exclusivos para ti!</p>
        </div>
    
    <div class="content">
        <?php
        
        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
            echo '<h2 style="text-align: center; color: #007FFF;">¡Bienvenido de nuevo, ' . $_SESSION["email"] . '!</h2>';
          
        } else {
            echo '<p style="text-align: center; color: #007FFF;">¡Inicia sesión o regístrate para empezar a comprar!</p>';
        }
        ?>
    </div>
    </section>