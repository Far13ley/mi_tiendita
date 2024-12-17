<?php
// Iniciar sesión
session_start();

// Verificar si el usuario ya está logueado
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ../index.php"); // Redirigir a la página principal
    exit;
}

require_once "../conection/cnx.php";

$email = $password = "";
$email_err = $password_err = ""; 

// Procesar el formulario de inicio de sesión cuando se envía
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validar el correo electrónico
    if(empty(trim($_POST["email"]))){
        $email_err = "Por favor ingrese el correo electrónico";
    } else {
        $email = trim($_POST["email"]);
    }
    
    // Validar la contraseña
    if(empty(trim($_POST["password"]))){
        $password_err = "Por favor ingrese una contraseña";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validar las credenciales
    if(empty($email_err) && empty($password_err)){
        $sql = "SELECT id, usuario, email, clave, rol FROM usuarios WHERE email = ?";
        
        if($stmt = mysqli_prepare($cnx, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            $param_email = $email;

            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                
                // Verificar si el correo existe
                if(mysqli_stmt_num_rows($stmt) == 1){
                    mysqli_stmt_bind_result($stmt, $id, $usuario, $email, $hashed_password, $rol);
                    if(mysqli_stmt_fetch($stmt)){
                        // Verificar la contraseña
                        if(password_verify($password, $hashed_password)){
                            // Iniciar sesión
                            session_start();

                            // Almacenar datos en variables de sesión
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["email"] = $email;
                            $_SESSION["rol"] = $rol; // Almacenar el rol en la sesión

                            // Redirigir a la página principal
                            header("location: ../index.php");
                        } else {
                            $password_err = "La contraseña introducida es incorrecta";
                        }
                    }
                } else {
                    $email_err = "No se ha encontrado ninguna cuenta con ese correo electrónico";
                }
            } else {
                echo "Algo salió mal, inténtalo más tarde";
            }
        }
        mysqli_close($cnx);
    }
}
?>
