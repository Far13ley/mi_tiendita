<?php  
require_once('plantilla/menu.php');  ?>

<link rel="stylesheet" href="css/estilocuatro.css">

<section class="contacto">
    <div class="contacto-header">
        <h2>Contacto</h2>
        <p>¡Nos encantaría saber de ti! Si tienes alguna pregunta o comentario, no dudes en ponerte en contacto con nosotros.</p>
    </div>
    
    <div class="contacto-form">
        <h3>Formulario de contacto</h3>
        <form action="https://formsubmit.co/steph.fahey13@gmail.com" method="POST">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="email">Correo electrónico</label>
            <input type="email" id="email" name="email" required>

            <label for="mensaje">Mensaje</label>
            <textarea id="mensaje" name="mensaje" rows="4" required></textarea>

            <button type="submit" class="btn">Enviar mensaje</button>
            <input type="hidden" name="_next" value="http://localhost/tiendacinco.com/tiendacinco.com/login/bienvenida.php">
        </form>
    </div>

    <div class="social-media">
        <h3>Síguenos en nuestras redes sociales</h3>
        <p>Conéctate con nosotros y mantente al tanto de nuestras promociones y novedades.</p>
    </div>
</section>