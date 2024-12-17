<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="css/stylepromo.css"> <!-- Asegúrate de que la ruta sea correcta -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css">
</head>
<body>
    <header>
        <div class="header-content container">
            <div class="swiper mySwiper-1">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="slider">
                            <div class="slider-txt">
                                <h1>Cualquier barrita</h1>
                                <p>
                                    Todos los dias 2x$10 varotes <br>
                                    O una en $6
                                </p>
                                <div class="botones">
                                    <a href="#" class="btn-1">Comprar</a>
                                    <a href="#" class="btn-1">Menu</a>
                                </div>
                            </div>
                            <div class="slider-img">
                                <img src="images/promo b.jpg" alt="Hamburguesa">
                            </div>
                        </div>
                    </div>
                    <!-- Otros slides -->
                    <div class="swiper-slide">
                        <div class="slider">
                            <div class="slider-txt">
                                <h1>Principito</h1>
                                <p>
                                    Todos los dias 2x$17 varos <br>
                                    Un paquete en $10
                                </p>
                                <div class="botones">
                                    <a href="#" class="btn-1">Comprar</a>
                                    <a href="#" class="btn-1">Menu</a>
                                </div>
                            </div>
                            <div class="slider-img">
                                <img src="images/pri.jpg" alt="Torta">
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="slider">
                            <div class="slider-txt">
                                <h1>Triki Trakets</h1>
                                <p>
                                    Igualmente todos los perros dias 2x$17 pesos <br>
                                    Un paquete en $10
                                </p>
                                <div class="botones">
                                    <a href="#" class="btn-1">Comprar</a>
                                    <a href="#" class="btn-1">Menu</a>
                                </div>
                            </div>
                            <div class="slider-img">
                                <img src="images/trik.jpg" alt="Hamburguesa">
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="slider">
                            <div class="slider-txt">
                                <h1>Cacahuates</h1>
                                <p> 
                                    Hot nuts pirata todos los dias 2x$16 <br>
                                    Unos a $10 <br>
                                    NO SON HOT NUTS REALES (SON SOL)
                                </p>
                                <div class="botones">
                                    <a href="#" class="btn-1">Comprar</a>
                                    <a href="#" class="btn-1">Menu</a>
                                </div>
                            </div>
                            <div class="slider-img">
                                <img src="images/caca.jpg" alt="Hamburguesa">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </header>

    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script>
        // Inicialización de Swiper
        const swiper = new Swiper('.mySwiper-1', {
            slidesPerView: 1,
            spaceBetween: 10,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
    </script>
</body>
</html>
