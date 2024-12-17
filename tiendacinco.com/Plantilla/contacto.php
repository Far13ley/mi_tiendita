<?php
$sentTo = "steph.fahey13@gmail.com";
$subject = "Mensaje desde Mi Tiendita Chingona.com"; // Agregado punto y coma

$headers = "From:".$_POST["nombre"]."<".$_POST["email"].">\r\n"; // Corregido "<" en lugar de "<<"
$headers .= "Reply-To: ".$_POST["email"]."\r\n";
$headers .= "Return-path: ".$_POST["email"];

$message = "==============="."\n";
$message .= "Mensaje desde Mi Tiendita Chingona.com"."\n";
$message .= "==============="."\n"."\n";
$message .= "Nombre:".$_POST["nombre"]."\n"."\n";
$message .= "Email:".$_POST["email"]."\n"."\n";
$message .= "Mensaje:".$_POST["mensaje"]."\n"."\n";

mail($sentTo, $subject, $message, $headers);
?>
<script type="text/javascript">
    var pagina = '../login/bienvenida.php';
    var segundos=0;

    function redirection(){
        document.location.href=pagina;
    }
    setTimeout("redirection()", segundos);
    </script>



