<?phpsession_start();
if(!isset($_SESSION["loggedin"])|| $_SESSION["loggedin"] !== true){
header("location: index.php");
exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido - Mi tiendita chigona</title>
    <link rel="stylesheet" href="../css/estilos_login.css">
        
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.o, minimum-scale=1.0">
</head>
<body>
    <div class="ctn-welcome">
        <img src="../plantilla/logo.avif" alt="" class="logo-welcome">
        <h1 class="title-welcome">Gracias por contactarte con nosotros :) </h1>
        <a href="../index.php" class="close-sesion">Regresar</a>    

</body>
</html>