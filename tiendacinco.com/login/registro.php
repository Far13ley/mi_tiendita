<?php 
include 'code_registro.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title> Registro</title>
        <link rel="stylesheet" href="../css/estilos_login.css">
        
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.o, minimum-scale=1.0">
    </head>
<body>
    <div class="container-all">
        <div class="ctn-form">

            <img src="../plantilla/logo.avif" alt ="" class="logo">
            <h1 class="title"> Registro</h1>
        
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <label for=""> Nombre de usuario</label>
            <input type="text" name="username">
            <span class="msg-error"> <?php echo $username_err ?> </span>
                <label for=""> Email</label>
                <input type="text" name = "email">
                <span class="msg-error"> <?php echo $username_err ?></span>
                <label for=""> Contraseña </label>
                <input type="password" name= "password">
                <span class="msg-error"><?php echo $username_err ?></span>

                <input type="submit" value="Registrarse">
            </form>

            <span class="text-footer"> ¿Y te has registrado? 
             <a href="inicio.php"> Iniciar sesión </a>
            </span>
        </div>

        <div class="ctn-text">
            <div class="capa"></div>
                <h1 class="title-description"> Tiendita chingona </h1>
             <p class="text-description"> Somos vendedores de productos a mayoreo y menudeo que busca ser accesible en cuanto a precios, manteniendo la calidad y creando confianza en nuestros compradores.</p>
            </div>
    </div>


</body>

</html>